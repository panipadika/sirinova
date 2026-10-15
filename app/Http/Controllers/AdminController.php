<?php

namespace App\Http\Controllers;

use App\Models\AlatTtg;
use App\Models\Inovator;
use App\Models\Kategori;
use App\Models\Wilayah;
use App\Models\Ebook;
use App\Models\TelaahanStaf;
use App\Models\Galeri;
use App\Models\IndikatorMakro;
use App\Models\DataIndikatorMakro;
use App\Models\Pesan;
use App\Models\PendaftaranLomba;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        // 1. Total Metrics
        $totalAlat = AlatTtg::count();
        $totalInovator = Inovator::count();
        $totalKategori = Kategori::count();
        $totalWilayah = Wilayah::count();
        $totalEbook = Ebook::count();
        $totalTelaahan = TelaahanStaf::count();
        $totalGaleri = Galeri::count();
        $totalIndikator = IndikatorMakro::count();
        $totalPesanBelumDibaca = Pesan::where('is_dibaca', false)->count();
        $totalLomba = PendaftaranLomba::count();
        $lombaMenunggu = PendaftaranLomba::where('status', 'Menunggu Verifikasi')->count();

        // 2. Data Aktivitas Terbaru (5 Data Terakhir)
        $aktivitasTerbaru = AlatTtg::with(['inovator', 'kategori', 'wilayah'])
                            ->orderBy('id', 'desc')
                            ->take(5)
                            ->get();

        // 3. Chart Data: Distribusi Alat per Kategori
        $kategoriData = Kategori::withCount('alatTtg')->get();
        $kategoriLabels = $kategoriData->pluck('nama_kategori')->toArray();
        $kategoriCounts = $kategoriData->pluck('alat_ttg_count')->toArray();

        // 4. Chart Data: Sebaran Alat per Wilayah (Kecamatan)
        $wilayahData = Wilayah::withCount('alatTtg')
                        ->orderBy('alat_ttg_count', 'desc')
                        ->get();
        $wilayahLabels = $wilayahData->pluck('nama_kecamatan')->toArray();
        $wilayahCounts = $wilayahData->pluck('alat_ttg_count')->toArray();

        // 5. Chart Data: Status Publikasi (Publik vs Draft)
        $statusPublik = AlatTtg::where('status_publikasi', 'Publik')->count();
        $statusDraft  = AlatTtg::where('status_publikasi', 'Draft')->count();

        // 6. Maximum Alat untuk progress indicator
        $maxAlat = $wilayahData->max('alat_ttg_count') ?: 1;

        // 7. Data Grafik Perbandingan Indikator Makro (Kota Tasik vs 26 Daerah Jabar)
        $indikatorList = IndikatorMakro::orderBy('urutan', 'asc')->orderBy('id', 'asc')->get();
        $tahunList = DataIndikatorMakro::select('tahun')->distinct()->orderBy('tahun', 'desc')->pluck('tahun')->toArray();
        if (empty($tahunList)) {
            $tahunList = [(int)date('Y')];
        }

        $indikatorChartMap = [];
        foreach ($indikatorList as $ind) {
            foreach ($tahunList as $th) {
                $rows = DataIndikatorMakro::where('indikator_id', $ind->id)
                    ->where('tahun', $th)
                    ->orderBy('nilai', 'desc')
                    ->get();

                $labels = [];
                $values = [];
                $isTasik = [];

                foreach ($rows as $r) {
                    $labels[] = $r->nama_daerah;
                    $values[] = (float) $r->nilai;
                    $isTasik[] = (bool) $r->is_kota_tasik;
                }

                $indikatorChartMap[$ind->id][$th] = [
                    'nama' => $ind->nama_indikator,
                    'satuan' => $ind->satuan,
                    'labels' => $labels,
                    'values' => $values,
                    'isTasik' => $isTasik,
                ];
            }
        }

        return view('admin.dashboard', compact(
            'totalAlat',
            'totalInovator',
            'totalKategori',
            'totalWilayah',
            'totalEbook',
            'totalTelaahan',
            'totalGaleri',
            'totalIndikator',
            'aktivitasTerbaru',
            'kategoriLabels',
            'kategoriCounts',
            'wilayahLabels',
            'wilayahCounts',
            'statusPublik',
            'statusDraft',
            'maxAlat',
            'indikatorList',
            'tahunList',
            'indikatorChartMap',
            'totalPesanBelumDibaca',
            'totalLomba',
            'lombaMenunggu'
        ));
    }

    /**
     * Tampilkan halaman Pengaturan Akun Admin
     */
    public function pengaturan()
    {
        $admin = Auth::user();
        return view('admin.pengaturan.index', compact('admin'));
    }

    /**
     * Perbarui Profil Admin (Nama & Email)
     */
    public function updateProfile(Request $request)
    {
        $admin = Auth::user();

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:admin,email,' . $admin->id,
        ], [
            'nama.required' => 'Nama administrator wajib diisi.',
            'email.required' => 'Email administrator wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email tersebut sudah digunakan oleh akun lain.',
        ]);

        $admin->nama = $request->nama;
        $admin->email = $request->email;
        $admin->save();

        return back()->with('success', 'Profil administrator (Nama & Email) berhasil diperbarui!');
    }

    /**
     * Perbarui Kata Sandi Admin
     */
    public function updatePassword(Request $request)
    {
        $admin = Auth::user();

        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:6|confirmed|different:current_password',
        ], [
            'current_password.required' => 'Kata sandi saat ini wajib diisi.',
            'password.required' => 'Kata sandi baru wajib diisi.',
            'password.min' => 'Kata sandi baru minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi baru tidak cocok.',
            'password.different' => 'Kata sandi baru harus berbeda dari kata sandi saat ini.',
        ]);

        if (!Hash::check($request->current_password, $admin->kata_sandi)) {
            return back()->withErrors(['current_password' => 'Kata sandi saat ini yang Anda masukkan salah.']);
        }

        $admin->kata_sandi = Hash::make($request->password);
        $admin->save();

        return back()->with('success', 'Kata sandi administrator berhasil diperbarui! Silakan gunakan kata sandi baru untuk login berikutnya.');
    }
}
