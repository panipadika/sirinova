<?php

namespace App\Http\Controllers;

use App\Models\PendaftaranLomba;
use App\Models\JadwalLomba;
use App\Models\PengaturanLomba;
use App\Models\User;
use App\Exports\PendaftaranLombaExport;
use App\Exports\AkunPesertaExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminLombaController extends Controller
{
    /**
     * Tampilkan seluruh data pendaftar lomba TTG
     */
    public function index(Request $request)
    {
        $query = PendaftaranLomba::with('user')->orderBy('dibuat_pada', 'desc');

        // Filter Pencarian
        if ($request->filled('q')) {
            $keyword = $request->q;
            $query->where(function ($q) use ($keyword) {
                $q->where('nama_alat', 'like', "%{$keyword}%")
                    ->orWhere('nama_inovator', 'like', "%{$keyword}%")
                    ->orWhere('asal_instansi', 'like', "%{$keyword}%")
                    ->orWhere('nomor_registrasi', 'like', "%{$keyword}%");
            });
        }

        // Filter Kategori Peserta
        if ($request->filled('kategori')) {
            $query->where('kategori_peserta', $request->kategori);
        }

        // Filter Status Verifikasi
        if ($request->filled('status')) {
            if (in_array($request->status, ['Ditolak / Perbaikan', 'ditolak_perbaikan'], true)) {
                $query->whereIn('status', ['Ditolak', 'Perlu Perbaikan']);
            } else {
                $query->where('status', $request->status);
            }
        }

        $perPage = (int) $request->input('per_page', 10);
        if (!in_array($perPage, [5, 10, 25, 50, 100], true)) {
            $perPage = 10;
        }

        $pendaftar = $query->paginate($perPage)->appends($request->query());

        // Data Jadwal & Gembok Pendaftaran per Kategori
        $jadwalLomba = JadwalLomba::orderBy('id')->get();

        // Link Template Proposal Resmi (Google Drive)
        $linkTemplateProposal = PengaturanLomba::getTemplateUrl();

        // Statistik Cepat untuk Card Dashboard Lomba
        $stats = [
            'total' => PendaftaranLomba::count(),
            'menunggu' => PendaftaranLomba::where('status', 'Menunggu Verifikasi')->count(),
            'lolos' => PendaftaranLomba::where('status', 'Lolos Administrasi')->count(),
            'perlu_perbaikan' => PendaftaranLomba::where('status', 'Perlu Perbaikan')->count(),
            'ditolak' => PendaftaranLomba::where('status', 'Ditolak')->count(),
            'sma' => PendaftaranLomba::where('kategori_peserta', 'SMA/SMK Sederajat')->count(),
            'pt' => PendaftaranLomba::where('kategori_peserta', 'Perguruan Tinggi')->count(),
            'umum' => PendaftaranLomba::where('kategori_peserta', 'Umum')->count(),
        ];

        return view('admin.lomba.index', compact('pendaftar', 'stats', 'jadwalLomba', 'linkTemplateProposal'));
    }

    /**
     * Tampilkan detail pendaftaran inovasi lomba TTG
     */
    public function show($id)
    {
        $item = PendaftaranLomba::with('user')->findOrFail($id);
        return view('admin.lomba.show', compact('item'));
    }

    /**
     * Update status verifikasi & catatan admin
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Menunggu Verifikasi,Lolos Administrasi,Perlu Perbaikan,Ditolak',
            'catatan_admin' => 'nullable|string|max:1000',
        ]);

        $item = PendaftaranLomba::findOrFail($id);
        $item->update([
            'status' => $request->status,
            'catatan_admin' => $request->catatan_admin,
        ]);

        return back()->with('success', 'Status pendaftaran inovasi "' . $item->nama_alat . '" berhasil diperbarui menjadi: ' . $request->status);
    }

    /**
     * Hapus data pendaftaran lomba
     */
    public function destroy($id)
    {
        $item = PendaftaranLomba::findOrFail($id);

        // Hapus file proposal dan foto dari storage jika ada (hanya jika berupa berkas lokal)
        if ($item->file_proposal && !Str::startsWith($item->file_proposal, ['http://', 'https://'])) {
            if (Storage::disk('local')->exists($item->file_proposal)) {
                Storage::disk('local')->delete($item->file_proposal);
            }
            if (Storage::disk('public')->exists($item->file_proposal)) {
                Storage::disk('public')->delete($item->file_proposal);
            }
        }
        if ($item->foto_alat && Storage::disk('public')->exists($item->foto_alat)) {
            Storage::disk('public')->delete($item->foto_alat);
        }

        $item->delete();

        if (request()->wantsJson() || request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Data pendaftaran karya "' . $item->nama_alat . '" berhasil dihapus.',
                'id' => $id,
            ]);
        }

        return back()->with('success', 'Data pendaftaran karya "' . $item->nama_alat . '" berhasil dihapus.');
    }

    /**
     * Cetak rekapitulasi pendaftar lomba (Print View)
     */
    public function print(Request $request)
    {
        $query = PendaftaranLomba::with('user')->orderBy('dibuat_pada', 'asc');

        if ($request->filled('q')) {
            $keyword = $request->q;
            $query->where(function ($q) use ($keyword) {
                $q->where('nama_alat', 'like', "%{$keyword}%")
                    ->orWhere('nama_inovator', 'like', "%{$keyword}%")
                    ->orWhere('asal_instansi', 'like', "%{$keyword}%")
                    ->orWhere('nomor_registrasi', 'like', "%{$keyword}%");
            });
        }
        if ($request->filled('kategori')) {
            $query->where('kategori_peserta', $request->kategori);
        }
        if ($request->filled('status')) {
            if (in_array($request->status, ['Ditolak / Perbaikan', 'ditolak_perbaikan'], true)) {
                $query->whereIn('status', ['Ditolak', 'Perlu Perbaikan']);
            } else {
                $query->where('status', $request->status);
            }
        }

        $pendaftar = $query->get();
        return view('admin.lomba.print', compact('pendaftar'));
    }

    /**
     * Unduh Rekapitulasi Pendaftaran Lomba format PDF (DomPDF)
     */
    public function exportPdf(Request $request)
    {
        $query = PendaftaranLomba::with('user')->orderBy('dibuat_pada', 'asc');

        if ($request->filled('q')) {
            $keyword = $request->q;
            $query->where(function ($q) use ($keyword) {
                $q->where('nama_alat', 'like', "%{$keyword}%")
                    ->orWhere('nama_inovator', 'like', "%{$keyword}%")
                    ->orWhere('asal_instansi', 'like', "%{$keyword}%")
                    ->orWhere('nomor_registrasi', 'like', "%{$keyword}%");
            });
        }
        if ($request->filled('kategori')) {
            $query->where('kategori_peserta', $request->kategori);
        }
        if ($request->filled('status')) {
            if (in_array($request->status, ['Ditolak / Perbaikan', 'ditolak_perbaikan'], true)) {
                $query->whereIn('status', ['Ditolak', 'Perlu Perbaikan']);
            } else {
                $query->where('status', $request->status);
            }
        }

        $pendaftar = $query->get();
        $kategoriFilter = $request->kategori ?? null;
        $statusFilter = $request->status ?? null;
        $keywordFilter = $request->q ?? null;

        $pdf = Pdf::loadView('admin.lomba.pdf', compact('pendaftar', 'kategoriFilter', 'statusFilter', 'keywordFilter'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('Rekap-Pendaftaran-Lomba-TTG-' . date('Ymd-His') . '.pdf');
    }

    /**
     * Unduh Rekapitulasi Pendaftaran Lomba format Excel (.xlsx)
     */
    public function exportExcel(Request $request)
    {
        return Excel::download(
            new PendaftaranLombaExport($request->kategori, $request->status, $request->q),
            'Rekap-Pendaftaran-Lomba-TTG-' . date('Ymd-His') . '.xlsx'
        );
    }

    /**
     * Buka / Tutup Gembok Pendaftaran per Kategori
     */
    public function toggleGembok($id)
    {
        $jadwal = JadwalLomba::findOrFail($id);
        $jadwal->is_buka = !$jadwal->is_buka;
        $jadwal->save();

        $statusTeks = $jadwal->is_buka ? 'DIBUKA (Pendaftaran Aktif)' : 'DITUTUP (Pendaftaran Ditutup)';
        $pesan = "Status pendaftaran kategori '{$jadwal->judul_tampilan}' berhasil {$statusTeks}.";

        if (request()->wantsJson() || request()->ajax()) {
            return response()->json([
                'success' => true,
                'is_buka' => $jadwal->is_buka,
                'message' => $pesan,
                'status_label' => $jadwal->status_label,
                'gembok_teks' => $jadwal->gembok_teks,
            ]);
        }

        return back()->with('success', $pesan);
    }

    /**
     * Update Jadwal & Tanggal Pendaftaran per Kategori
     */
    public function updateJadwal(Request $request, $id)
    {
        $jadwal = JadwalLomba::findOrFail($id);

        $request->validate([
            'tanggal_buka' => 'nullable|date',
            'tanggal_tutup' => 'nullable|date|after_or_equal:tanggal_buka',
            'is_buka' => 'nullable',
            'keterangan' => 'nullable|string|max:500',
        ], [
            'tanggal_tutup.after_or_equal' => 'Tanggal penutupan pendaftaran tidak boleh sebelum tanggal pembukaan.',
        ]);

        $jadwal->update([
            'tanggal_buka' => $request->filled('tanggal_buka') ? $request->tanggal_buka : null,
            'tanggal_tutup' => $request->filled('tanggal_tutup') ? $request->tanggal_tutup : null,
            'is_buka' => $request->has('is_buka') ? (bool)$request->is_buka : $jadwal->is_buka,
            'keterangan' => $request->keterangan,
        ]);

        return back()->with('success', "Pengaturan jadwal pendaftaran kategori '{$jadwal->judul_tampilan}' berhasil disimpan.");
    }

    /**
     * Update Link Template Proposal (Google Drive)
     */
    public function updateTemplateProposal(Request $request)
    {
        $request->validate([
            'link_template_proposal' => 'required|url|max:1000',
        ], [
            'link_template_proposal.required' => 'Link Google Drive template proposal wajib diisi.',
            'link_template_proposal.url' => 'Format tautan harus berupa URL valid (contoh: https://drive.google.com/...).',
            'link_template_proposal.max' => 'Panjang tautan maksimal 1000 karakter.',
        ]);

        PengaturanLomba::set(
            'link_template_proposal',
            trim($request->link_template_proposal),
            'Link Google Drive template proposal dan pedoman ketentuan Lomba TTG Kota Tasikmalaya'
        );

        return back()->with('success', 'Tautan Google Drive template proposal berhasil diperbarui dan langsung aktif di halaman peserta.');
    }

    /**
     * Tampilkan daftar seluruh akun peserta lomba TTG
     */
    public function akunIndex(Request $request)
    {
        $query = User::withCount('pendaftaranLomba')->with('pendaftaranLomba')->orderBy('created_at', 'desc');

        // Filter Pencarian
        if ($request->filled('q')) {
            $keyword = $request->q;
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                    ->orWhere('email', 'like', "%{$keyword}%")
                    ->orWhere('no_wa', 'like', "%{$keyword}%")
                    ->orWhere('asal_instansi', 'like', "%{$keyword}%");
            });
        }

        // Filter Kategori Akun
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        // Filter Status Partisipasi Lomba
        if ($request->filled('partisipasi')) {
            if ($request->partisipasi === 'sudah') {
                $query->has('pendaftaranLomba');
            } elseif ($request->partisipasi === 'belum') {
                $query->doesntHave('pendaftaranLomba');
            }
        }

        $perPage = (int) $request->input('per_page', 10);
        if (!in_array($perPage, [5, 10, 25, 50, 100], true)) {
            $perPage = 10;
        }

        $users = $query->paginate($perPage)->appends($request->query());

        // Statistik Cepat Akun Peserta
        $stats = [
            'total' => User::count(),
            'sma' => User::where('kategori', 'SMA/SMK Sederajat')->count(),
            'pt' => User::where('kategori', 'Perguruan Tinggi')->count(),
            'umum' => User::where('kategori', 'Umum')->count(),
            'sudah_daftar' => User::has('pendaftaranLomba')->count(),
            'belum_daftar' => User::doesntHave('pendaftaranLomba')->count(),
        ];

        $totalKarya = PendaftaranLomba::count();

        return view('admin.lomba.akun', compact('users', 'stats', 'totalKarya'));
    }

    /**
     * Detail akun peserta untuk modal AJAX
     */
    public function akunShow($id)
    {
        $user = User::with(['pendaftaranLomba' => function ($q) {
            $q->orderBy('dibuat_pada', 'desc');
        }])->findOrFail($id);

        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'no_wa' => $user->no_wa ?? '-',
            'asal_instansi' => $user->asal_instansi ?? '-',
            'kategori' => $user->kategori ?? '-',
            'created_at_formatted' => $user->created_at ? $user->created_at->translatedFormat('d F Y, H:i') : '-',
            'total_karya' => $user->pendaftaranLomba->count(),
            'karya' => $user->pendaftaranLomba->map(function ($karya) {
                return [
                    'id' => $karya->id,
                    'nomor_registrasi' => $karya->nomor_registrasi,
                    'nama_alat' => $karya->nama_alat,
                    'kategori_peserta' => $karya->kategori_peserta,
                    'status' => $karya->status,
                    'status_badge' => $karya->status_badge,
                    'dibuat_pada' => $karya->dibuat_pada ? $karya->dibuat_pada->translatedFormat('d M Y') : '-',
                    'detail_url' => route('admin.lomba.show', $karya->id),
                ];
            }),
        ]);
    }

    /**
     * Hapus akun peserta dan berkas/karya pendaftarannya
     */
    public function akunDestroy($id)
    {
        $user = User::with('pendaftaranLomba')->findOrFail($id);
        $nama = $user->name;

        // Bersihkan berkas karya jika ada
        foreach ($user->pendaftaranLomba as $item) {
            if ($item->file_proposal && !Str::startsWith($item->file_proposal, ['http://', 'https://'])) {
                Storage::disk('local')->delete($item->file_proposal);
                Storage::disk('public')->delete($item->file_proposal);
            }
            if ($item->foto_alat) {
                Storage::disk('public')->delete($item->foto_alat);
            }
            $item->delete();
        }

        $user->delete();

        if (request()->wantsJson() || request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => "Akun peserta '{$nama}' beserta riwayat pendaftarannya berhasil dihapus.",
            ]);
        }

        return back()->with('success', "Akun peserta '{$nama}' berhasil dihapus.");
    }

    /**
     * Cetak rekapitulasi akun peserta (Browser Print View)
     */
    public function akunPrint(Request $request)
    {
        $query = User::withCount('pendaftaranLomba')->with('pendaftaranLomba')->orderBy('created_at', 'desc');

        if ($request->filled('q')) {
            $keyword = $request->q;
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                    ->orWhere('email', 'like', "%{$keyword}%")
                    ->orWhere('no_wa', 'like', "%{$keyword}%")
                    ->orWhere('asal_instansi', 'like', "%{$keyword}%");
            });
        }

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->filled('partisipasi')) {
            if ($request->partisipasi === 'sudah') {
                $query->has('pendaftaranLomba');
            } elseif ($request->partisipasi === 'belum') {
                $query->doesntHave('pendaftaranLomba');
            }
        }

        $users = $query->get();

        return view('admin.lomba.akun_print', compact('users'));
    }

    /**
     * Unduh PDF Rekapitulasi Akun Peserta (DomPDF)
     */
    public function akunExportPdf(Request $request)
    {
        $query = User::withCount('pendaftaranLomba')->with('pendaftaranLomba')->orderBy('created_at', 'desc');

        if ($request->filled('q')) {
            $keyword = $request->q;
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                    ->orWhere('email', 'like', "%{$keyword}%")
                    ->orWhere('no_wa', 'like', "%{$keyword}%")
                    ->orWhere('asal_instansi', 'like', "%{$keyword}%");
            });
        }

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->filled('partisipasi')) {
            if ($request->partisipasi === 'sudah') {
                $query->has('pendaftaranLomba');
            } elseif ($request->partisipasi === 'belum') {
                $query->doesntHave('pendaftaranLomba');
            }
        }

        $users = $query->get();

        $pdf = Pdf::loadView('admin.lomba.akun_pdf', [
            'users' => $users,
            'kategori' => $request->kategori,
            'partisipasi' => $request->partisipasi,
            'keyword' => $request->q,
            'tanggal_cetak' => now()->translatedFormat('d F Y, H:i') . ' WIB',
        ])->setPaper('a4', 'landscape');

        $filename = 'Rekap-Akun-Peserta-Lomba-TTG-' . date('Ymd-His') . '.pdf';
        return $pdf->download($filename);
    }

    /**
     * Unduh Excel Rekapitulasi Akun Peserta (Laravel Excel)
     */
    public function akunExportExcel(Request $request)
    {
        $kategori = $request->filled('kategori') ? $request->kategori : null;
        $partisipasi = $request->filled('partisipasi') ? $request->partisipasi : null;
        $keyword = $request->filled('q') ? $request->q : null;

        $filename = 'Rekap-Akun-Peserta-Lomba-TTG-' . date('Ymd-His') . '.xlsx';
        return Excel::download(new AkunPesertaExport($kategori, $partisipasi, $keyword), $filename);
    }
}
