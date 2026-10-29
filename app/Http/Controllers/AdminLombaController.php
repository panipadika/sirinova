<?php

namespace App\Http\Controllers;

use App\Models\PendaftaranLomba;
use App\Models\JadwalLomba;
use App\Models\PengaturanLomba;
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

        return redirect()->route('admin.lomba.index')->with('success', 'Data pendaftaran berhasil dihapus.');
    }

    /**
     * Cetak rekapitulasi pendaftar lomba
     */
    public function print(Request $request)
    {
        $query = PendaftaranLomba::with('user')->orderBy('dibuat_pada', 'asc');

        if ($request->filled('kategori')) {
            $query->where('kategori_peserta', $request->kategori);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $pendaftar = $query->get();
        return view('admin.lomba.print', compact('pendaftar'));
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
}
