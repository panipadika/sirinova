<?php

namespace App\Http\Controllers;

use App\Models\PendaftaranLomba;
use App\Models\JadwalLomba;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LombaController extends Controller
{
    /**
     * Halaman informasi & ketentuan Lomba Inovasi Alat TTG Kota Tasikmalaya
     */
    public function index()
    {
        $totalPendaftar = PendaftaranLomba::count();
        $user = Auth::guard('peserta')->user();
        $pendaftaranUser = $user ? PendaftaranLomba::where('id_user', $user->id)->get() : collect();
        $jadwalKategori = JadwalLomba::all()->keyBy('kategori');

        return view('user.lomba.index', compact('totalPendaftar', 'user', 'pendaftaranUser', 'jadwalKategori'));
    }

    /**
     * Tampilkan formulir pendaftaran lomba (wajib login peserta)
     */
    public function create()
    {
        $user = Auth::guard('peserta')->user();
        $jadwalKategori = JadwalLomba::all()->keyBy('kategori');
        return view('user.lomba.daftar', compact('user', 'jadwalKategori'));
    }

    /**
     * Proses penyimpanan formulir pendaftaran lomba
     */
    public function store(Request $request)
    {
        $user = Auth::guard('peserta')->user();

        // 0. Verifikasi status gembok pendaftaran kategori yang dipilih
        $jadwal = JadwalLomba::where('kategori', $request->kategori_peserta)->first();
        if ($jadwal && !$jadwal->isPendaftaranDibuka()) {
            return back()->withInput()->withErrors([
                'kategori_peserta' => "Mohon maaf, pendaftaran untuk kategori '{$jadwal->judul_tampilan}' saat ini sedang DITUTUP oleh panitia ({$jadwal->status_label}).",
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
            'file_proposal' => 'required|file|mimes:pdf,doc,docx|max:15360', // Maks 15MB
            'foto_alat' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120', // Maks 5MB (Wajib)
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
            'file_proposal.required' => 'File proposal wajib diunggah.',
            'file_proposal.mimes' => 'Format file proposal harus berupa PDF, DOC, atau DOCX.',
            'file_proposal.max' => 'Ukuran file proposal maksimal 15 MB.',
            'foto_alat.required' => 'Foto dokumentasi alat TTG wajib diunggah.',
            'foto_alat.image' => 'File foto dokumentasi alat harus berupa gambar (JPG, PNG, atau WEBP).',
            'foto_alat.max' => 'Ukuran foto alat maksimal 5 MB.',
            'link_video.url' => 'Format tautan video harus berupa URL valid (contoh: https://youtube.com/...).',
        ]);

        // 1. Generate nomor registrasi resmi yang unik
        $tahun = date('Y');
        $urutan = PendaftaranLomba::whereYear('dibuat_pada', $tahun)->count() + 1;
        $nomorRegistrasi = sprintf('TTG-%s-%04d', $tahun, $urutan);

        // 2. Upload file proposal
        $fileProposalPath = $request->file('file_proposal')->store('proposal_lomba', 'public');

        // 3. Upload foto alat (wajib)
        $fotoAlatPath = null;
        if ($request->hasFile('foto_alat')) {
            $fotoAlatPath = $request->file('foto_alat')->store('foto_lomba', 'public');
        }

        // 4. Simpan ke database
        $pendaftaran = PendaftaranLomba::create([
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
     * Download proposal peserta
     */
    public function downloadProposal($id)
    {
        $pendaftaran = PendaftaranLomba::findOrFail($id);
        $user = Auth::guard('peserta')->user();

        // Peserta hanya bisa mengunduh proposal miliknya sendiri (kecuali admin)
        if ($user && $pendaftaran->id_user !== $user->id && !Auth::check()) {
            abort(403, 'Anda tidak memiliki hak akses untuk mengunduh berkas ini.');
        }

        if (!Storage::disk('public')->exists($pendaftaran->file_proposal)) {
            abort(404, 'File proposal tidak ditemukan di penyimpanan server.');
        }

        $namaFileDownload = 'Proposal_' . Str::slug($pendaftaran->nama_alat) . '_' . $pendaftaran->nomor_registrasi . '.' . pathinfo($pendaftaran->file_proposal, PATHINFO_EXTENSION);
        /** @var \Illuminate\Filesystem\FilesystemAdapter $disk */
        $disk = Storage::disk('public');
        return $disk->download($pendaftaran->file_proposal, $namaFileDownload);
    }
}
