<?php

namespace App\Http\Controllers;

use App\Models\PendaftaranLomba;
use App\Models\JadwalLomba;
use App\Models\PengaturanLomba;
use App\Services\SecureFileUploadService;
use App\Services\SecurityAuditLogger;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LombaController extends Controller
{
    /**
     * Halaman informasi & ketentuan Lomba Inovasi Alat TTG Kota Tasikmalaya
     */
    public function index()
    {
        $totalPendaftar = PendaftaranLomba::count();
        $user = Auth::guard('peserta')->user();
        $pendaftaranUser = $user ? PendaftaranLomba::where('id_user', $user->id)->where('status', '!=', 'Ditolak')->get() : collect();
        $lockedKategori = $user ? ($user->kategori ?? ($pendaftaranUser->isNotEmpty() ? $pendaftaranUser->first()->kategori_peserta : null)) : null;
        $jadwalKategori = JadwalLomba::all()->keyBy('kategori');
        $linkTemplateProposal = PengaturanLomba::getTemplateUrl();

        return view('user.lomba.index', compact('totalPendaftar', 'user', 'pendaftaranUser', 'lockedKategori', 'jadwalKategori', 'linkTemplateProposal'));
    }

    /**
     * Tampilkan formulir pendaftaran lomba (wajib login peserta)
     */
    public function create()
    {
        $user = Auth::guard('peserta')->user();
        $jadwalKategori = JadwalLomba::all()->keyBy('kategori');
        $userRegistrations = PendaftaranLomba::where('id_user', $user->id)
            ->where('status', '!=', 'Ditolak')
            ->orderBy('id', 'desc')
            ->get();

        // Kategori terkunci dari akun peserta ($user->kategori) atau riwayat pendaftaran karya pertama
        $lockedKategori = $user->kategori ?? ($userRegistrations->isNotEmpty() ? $userRegistrations->first()->kategori_peserta : null);
        $totalKaryaUser = $userRegistrations->count();
        $linkTemplateProposal = PengaturanLomba::getTemplateUrl();

        // Prefill instansi & no_wa dari karya sebelumnya jika profil user masih kosong
        $latest = $userRegistrations->first();
        if ($latest) {
            if (!$user->asal_instansi) {
                $user->asal_instansi = $latest->asal_instansi;
            }
            if (!$user->no_wa) {
                $user->no_wa = $latest->nomor_wa;
            }
        }

        return view('user.lomba.daftar', compact('user', 'jadwalKategori', 'userRegistrations', 'lockedKategori', 'totalKaryaUser', 'linkTemplateProposal'));
    }

    /**
     * Proses penyimpanan formulir pendaftaran lomba
     */
    public function store(Request $request)
    {
        $user = Auth::guard('peserta')->user();

        // 1. Verifikasi: 1 akun yang sudah terdaftar di 1 kategori tidak bisa daftar lagi di kategori lain
        $userLockedKategori = $user->kategori ?? (
            PendaftaranLomba::where('id_user', $user->id)
                ->where('status', '!=', 'Ditolak')
                ->value('kategori_peserta')
        );

        if ($userLockedKategori && $userLockedKategori !== $request->kategori_peserta) {
            return back()->withInput()->withErrors([
                'kategori_peserta' => "Akun Anda telah terdaftar pada kategori '{$userLockedKategori}'. Satu akun peserta hanya dapat mendaftarkan karya pada satu kategori yang sama dan tidak diperbolehkan mendaftar di kategori lain.",
            ]);
        }

        // 2. Verifikasi: Cegah pendaftaran judul karya yang persis sama oleh akun yang sama
        $duplicateAlat = PendaftaranLomba::where('id_user', $user->id)
            ->where('nama_alat', $request->nama_alat)
            ->where('status', '!=', 'Ditolak')
            ->first();

        if ($duplicateAlat) {
            return back()->withInput()->withErrors([
                'nama_alat' => "Anda sudah mendaftarkan karya dengan judul '{$request->nama_alat}' (Nomor Registrasi: {$duplicateAlat->nomor_registrasi}). Silakan gunakan nama karya yang berbeda jika ingin mendaftarkan karya baru.",
            ]);
        }

        // 3. Verifikasi status gembok pendaftaran kategori yang dipilih
        $jadwal = JadwalLomba::where('kategori', $request->kategori_peserta)->first();
        if ($jadwal && !$jadwal->isPendaftaranDibuka()) {
            return back()->withInput()->withErrors([
                'kategori_peserta' => "Mohon maaf, pendaftaran untuk kategori '{$jadwal->judul_tampilan}' saat ini sedang DITUTUP oleh panitia ({$jadwal->status_label}).",
            ]);
        }

        // 1. Verifikasi kelengkapan dokumen proposal (bisa berupa file dokumen atau link Google Drive)
        $hasProposalFile = $request->hasFile('file_proposal_file') || $request->hasFile('file_proposal');
        $hasProposalUrl = $request->filled('file_proposal') && !is_object($request->file_proposal);

        if (!$hasProposalFile && !$hasProposalUrl) {
            throw ValidationException::withMessages([
                'file_proposal' => 'Dokumen proposal lomba (berkas PDF/DOC/DOCX atau tautan Google Drive) wajib disertakan.',
            ]);
        }

        $validated = $request->validate([
            'kategori_peserta' => 'required|in:SMA/SMK Sederajat,Perguruan Tinggi,Umum',
            'nama_inovator' => 'required|string|max:255',
            'nama_anggota' => 'nullable|string',
            'asal_instansi' => 'required|string|max:255',
            'nomor_wa' => 'required|string|max:25',
            'email' => 'required|email|max:255',
            'nama_alat' => 'required|string|max:255',
            'biaya_pembuatan' => 'required|numeric|min:0',
            'estimasi_harga_jual' => 'required|numeric|min:0',
            'fungsi' => 'required|string',
            'spesifikasi_bahan' => 'required|string',
            'latar_belakang' => 'nullable|string',
            'file_proposal' => 'nullable',
            'file_proposal_file' => 'nullable|file',
            'foto_alat' => 'required|file',
            'link_video' => 'nullable|url|max:255',
        ], [
            'kategori_peserta.required' => 'Pilih kategori peserta yang sesuai.',
            'kategori_peserta.in' => 'Kategori peserta tidak valid.',
            'nama_inovator.required' => 'Nama ketua inovator wajib diisi.',
            'asal_instansi.required' => 'Asal sekolah / perguruan tinggi / instansi wajib diisi.',
            'nomor_wa.required' => 'Nomor WhatsApp aktif wajib diisi.',
            'email.required' => 'Email aktif wajib diisi.',
            'nama_alat.required' => 'Nama alat teknologi tepat guna wajib diisi.',
            'biaya_pembuatan.required' => 'Biaya pembuatan wajib diisi dalam angka.',
            'estimasi_harga_jual.required' => 'Estimasi harga jual wajib diisi dalam angka.',
            'fungsi.required' => 'Fungsi alat TTG wajib dijelaskan.',
            'spesifikasi_bahan.required' => 'Spesifikasi teknis & bahan alat wajib dicantumkan.',
            'foto_alat.required' => 'Foto dokumentasi alat TTG wajib diunggah.',
            'link_video.url' => 'Format tautan video harus berupa URL valid (contoh: https://youtube.com/...).',
        ]);

        // 2. Simpan dokumen proposal secara aman
        // Jika diunggah sebagai file -> simpan di PRIVATE STORAGE (disk 'local')
        // Jika berupa tautan URL (misal Google Drive) -> simpan link setelah validasi
        $isPrivateDocument = false;
        if ($request->hasFile('file_proposal_file')) {
            $fileProposalPath = SecureFileUploadService::validateAndStoreProposalDocument($request->file('file_proposal_file'));
            $isPrivateDocument = true;
        } elseif ($request->hasFile('file_proposal')) {
            $fileProposalPath = SecureFileUploadService::validateAndStoreProposalDocument($request->file('file_proposal'));
            $isPrivateDocument = true;
        } else {
            $url = trim($request->file_proposal);
            if (!filter_var($url, FILTER_VALIDATE_URL) && !Str::startsWith($url, ['http://', 'https://'])) {
                throw ValidationException::withMessages([
                    'file_proposal' => 'Format tautan Google Drive harus berupa URL valid (contoh: https://drive.google.com/...).',
                ]);
            }
            $fileProposalPath = $url;
        }

        // 3. Simpan foto dokumentasi alat secara aman (Validasi MIME ketat & nama file UUID)
        $fotoAlatPath = SecureFileUploadService::validateAndStoreImage($request->file('foto_alat'), 'foto_lomba', 'public');

        // 4. Generate nomor registrasi atomik & simpan ke database dengan proteksi race condition
        $tahun = date('Y');
        $nomorRegistrasi = null;
        $pendaftaran = null;
        $maxAttempts = 5;

        for ($attempt = 1; $attempt <= $maxAttempts; $attempt++) {
            try {
                $pendaftaran = DB::transaction(function () use ($user, $validated, $tahun, $fileProposalPath, $fotoAlatPath, &$nomorRegistrasi) {
                    $lastRegistration = PendaftaranLomba::where('nomor_registrasi', 'LIKE', "TTG-{$tahun}-%")
                        ->orderByDesc('id')
                        ->lockForUpdate()
                        ->first();

                    $urutan = 1;
                    if ($lastRegistration && preg_match('/TTG-\d{4}-(\d+)/', $lastRegistration->nomor_registrasi, $matches)) {
                        $urutan = (int) $matches[1] + 1;
                    }

                    do {
                        $candidateNomor = sprintf('TTG-%s-%04d', $tahun, $urutan);
                        $exists = PendaftaranLomba::where('nomor_registrasi', $candidateNomor)->exists();
                        if ($exists) {
                            $urutan++;
                        }
                    } while ($exists);

                    $nomorRegistrasi = $candidateNomor;

                    return PendaftaranLomba::create([
                        'id_user' => $user->id,
                        'nomor_registrasi' => $nomorRegistrasi,
                        'kategori_peserta' => $validated['kategori_peserta'],
                        'nama_inovator' => $validated['nama_inovator'],
                        'nama_anggota' => $validated['nama_anggota'] ?? null,
                        'asal_instansi' => $validated['asal_instansi'],
                        'nomor_wa' => $validated['nomor_wa'],
                        'email' => $validated['email'],
                        'nama_alat' => $validated['nama_alat'],
                        'biaya_pembuatan' => $validated['biaya_pembuatan'],
                        'estimasi_harga_jual' => $validated['estimasi_harga_jual'],
                        'fungsi' => $validated['fungsi'],
                        'spesifikasi_bahan' => $validated['spesifikasi_bahan'],
                        'latar_belakang' => $validated['latar_belakang'] ?? null,
                        'file_proposal' => $fileProposalPath,
                        'foto_alat' => $fotoAlatPath,
                        'link_video' => $validated['link_video'] ?? null,
                        'status' => 'Menunggu Verifikasi',
                    ]);
                });

                break; // Berhasil disimpan
            } catch (\Illuminate\Database\QueryException $e) {
                if ($attempt === $maxAttempts) {
                    // Bersihkan file yang sudah diunggah jika gagal simpan database
                    if ($fotoAlatPath && Storage::disk('public')->exists($fotoAlatPath)) {
                        Storage::disk('public')->delete($fotoAlatPath);
                    }
                    if ($isPrivateDocument && $fileProposalPath && Storage::disk('local')->exists($fileProposalPath)) {
                        Storage::disk('local')->delete($fileProposalPath);
                    }
                    throw $e;
                }
                usleep(50000); // 50ms jeda sebelum retry
            }
        }

        // Pastikan kategori pada akun user tersimpan permanen jika sebelumnya masih kosong
        if (!$user->kategori) {
            $user->update(['kategori' => $pendaftaran->kategori_peserta]);
        }

        return redirect()->route('lomba.status')->with('pendaftaran_berhasil', [
            'nomor_registrasi' => $nomorRegistrasi,
            'nama_alat' => $pendaftaran->nama_alat,
            'kategori' => $pendaftaran->kategori_peserta,
            'foto_alat' => $fotoAlatPath,
        ])->with('success', 'Selamat! Pendaftaran karya "' . $pendaftaran->nama_alat . '" berhasil dikirim dengan Nomor Registrasi: ' . $nomorRegistrasi);
    }

    /**
     * Dashboard / Riwayat status pendaftaran peserta
     */
    public function status()
    {
        $user = Auth::guard('peserta')->user();
        $pendaftaran = PendaftaranLomba::where('id_user', $user->id)
            ->orderBy('dibuat_pada', 'desc')
            ->get();

        return view('user.lomba.status', compact('user', 'pendaftaran'));
    }

    /**
     * Buka / Download proposal peserta
     */
    public function downloadProposal($id)
    {
        $pendaftaran = PendaftaranLomba::findOrFail($id);
        $currentUser = Auth::guard('web')->user() ?? Auth::guard('peserta')->user();

        if (!$currentUser) {
            SecurityAuditLogger::log('UNAUTHENTICATED_ACCESS_ATTEMPT', [
                'target' => 'proposal_download',
                'proposal_id' => $id,
            ]);
            abort(401, 'Silakan login terlebih dahulu untuk mengakses berkas ini.');
        }

        // Otorisasi melalui Laravel Policy (IDOR prevention)
        $response = Gate::forUser($currentUser)->inspect('view', $pendaftaran);
        if (!$response->allowed()) {
            SecurityAuditLogger::log('IDOR_ATTEMPT', [
                'target_proposal_id' => $id,
                'owner_user_id' => $pendaftaran->id_user,
                'attempted_by_id' => $currentUser->id,
            ], 'critical');
            abort(403, $response->message() ?: 'Anda tidak memiliki hak akses untuk mengakses berkas ini.');
        }

        // 1. Jika berupa tautan URL eksternal (seperti Google Drive)
        if (filter_var($pendaftaran->file_proposal, FILTER_VALIDATE_URL) || Str::startsWith($pendaftaran->file_proposal, ['http://', 'https://'])) {
            SecurityAuditLogger::log('PROPOSAL_DOWNLOAD_ACCESSED', [
                'proposal_id' => $pendaftaran->id,
                'type' => 'external_url',
            ], 'info');
            return redirect()->away($pendaftaran->file_proposal);
        }

        // 2. Jika berkas tersimpan pada PRIVATE STORAGE (disk: local)
        /** @var FilesystemAdapter $localDisk */
        $localDisk = Storage::disk('local');
        if ($pendaftaran->file_proposal && $localDisk->exists($pendaftaran->file_proposal)) {
            SecurityAuditLogger::log('PROPOSAL_DOWNLOAD_ACCESSED', [
                'proposal_id' => $pendaftaran->id,
                'storage' => 'private_local',
            ], 'info');

            $namaFileDownload = 'Proposal_' . Str::slug($pendaftaran->nama_alat) . '_' . $pendaftaran->nomor_registrasi . '.' . pathinfo($pendaftaran->file_proposal, PATHINFO_EXTENSION);
            return $localDisk->download($pendaftaran->file_proposal, $namaFileDownload);
        }

        // 3. Fallback untuk berkas lokal lama jika masih ada di disk public
        /** @var FilesystemAdapter $publicDisk */
        $publicDisk = Storage::disk('public');
        if ($pendaftaran->file_proposal && $publicDisk->exists($pendaftaran->file_proposal)) {
            SecurityAuditLogger::log('PROPOSAL_DOWNLOAD_ACCESSED', [
                'proposal_id' => $pendaftaran->id,
                'storage' => 'legacy_public',
            ], 'info');

            $namaFileDownload = 'Proposal_' . Str::slug($pendaftaran->nama_alat) . '_' . $pendaftaran->nomor_registrasi . '.' . pathinfo($pendaftaran->file_proposal, PATHINFO_EXTENSION);
            return $publicDisk->download($pendaftaran->file_proposal, $namaFileDownload);
        }

        abort(404, 'Tautan atau berkas proposal tidak ditemukan.');
    }
}
