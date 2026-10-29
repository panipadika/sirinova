<?php

namespace App\Http\Controllers;

use App\Models\AlatTtg;
use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Wilayah;
use App\Models\Inovator;
use App\Helpers\ImageHelper;
use Illuminate\Support\Facades\Storage;
use App\Exports\AlatTtgExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class AlatController extends Controller
{
    // Fungsi untuk menampilkan halaman Edit
    public function edit(int $id)
    {
        $alat = AlatTtg::findOrFail($id);
        $kategori = Kategori::all();
        $wilayah = Wilayah::all();
        $inovator = Inovator::where('status', 'Aktif')->get();

        return view('admin.alatTTG.edit', compact('alat', 'kategori', 'wilayah', 'inovator'));
    }

    // Fungsi untuk memproses data yang diedit
    public function update(Request $request, int $id)
    {
        $alat = AlatTtg::findOrFail($id);

        $request->validate([
            'nama_alat' => 'required|string|max:255',
            'id_kategori' => 'required|exists:kategori,id',
            'tahun_produksi' => 'required|integer|digits:4',
            'deskripsi' => 'required|string',
            'id_inovator' => 'required|exists:inovator,id',
            'estimasi_harga' => 'required|string|max:255',
            'nomor_telepon' => 'nullable|string|max:20',
            'id_wilayah' => 'required|exists:wilayah,id',
            'status_publikasi' => 'required|in:Publik,Draft',
            'alamat_lengkap' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ], [
            'nama_alat.required'      => 'Nama alat wajib diisi.',
            'nama_alat.max'           => 'Nama alat maksimal 255 karakter.',
            'id_kategori.required'    => 'Kategori alat wajib dipilih.',
            'id_kategori.exists'      => 'Kategori yang dipilih tidak valid.',
            'tahun_produksi.required' => 'Tahun produksi wajib diisi.',
            'tahun_produksi.integer'  => 'Tahun produksi harus berupa angka tahun.',
            'tahun_produksi.digits'   => 'Tahun produksi harus terdiri dari 4 digit angka (contoh: 2024).',
            'deskripsi.required'      => 'Deskripsi alat wajib diisi.',
            'id_inovator.required'    => 'Inovator penemu alat wajib dipilih.',
            'id_inovator.exists'      => 'Inovator yang dipilih tidak valid.',
            'estimasi_harga.required' => 'Estimasi harga wajib diisi.',
            'estimasi_harga.max'      => 'Estimasi harga maksimal 255 karakter.',
            'nomor_telepon.max'       => 'Nomor telepon maksimal 20 karakter.',
            'id_wilayah.required'     => 'Wilayah kecamatan wajib dipilih.',
            'id_wilayah.exists'       => 'Wilayah yang dipilih tidak valid.',
            'status_publikasi.required' => 'Status publikasi wajib dipilih.',
            'status_publikasi.in'     => 'Status publikasi harus bernilai Publik atau Draft.',
            'alamat_lengkap.required' => 'Alamat lengkap wajib diisi.',
            'foto.image'              => 'File yang diunggah harus berupa gambar.',
            'foto.mimes'              => 'Format foto harus berupa JPEG, PNG, JPG, atau WebP.',
            'foto.max'                => 'Ukuran foto maksimal 5MB.',
        ]);

        $image = $alat->foto;

        // Jika admin mengunggah foto baru (Otomatis kompresi & konversi ke WebP)
        if ($request->hasFile('foto')) {
            // Hapus foto lama dari penyimpanan agar tidak menumpuk
            if ($image) {
                try {
                    $cleanPath = str_replace('storage/', '', $image);
                    if (Storage::disk('public')->exists($cleanPath)) {
                        Storage::disk('public')->delete($cleanPath);
                    }
                } catch (\Throwable $e) {
                    // Abaikan kegagalan hapus file lama
                }
            }
            // Simpan & Kompresi foto baru ke format WebP
            $image = ImageHelper::convertToWebp($request->file('foto'), 'alat_ttg');
        }

        // Update ke database
        $alat->update([
            'nama_alat' => $request->nama_alat,
            'id_kategori' => $request->id_kategori,
            'tahun_produksi' => $request->tahun_produksi,
            'deskripsi' => $request->deskripsi,
            'id_inovator' => $request->id_inovator,
            'estimasi_harga' => $request->estimasi_harga,
            'nomor_telepon' => $request->nomor_telepon,
            'id_wilayah' => $request->id_wilayah,
            'status_publikasi' => $request->status_publikasi,
            'alamat_lengkap' => $request->alamat_lengkap,
            'foto' => $image,
        ]);

        return redirect('/admin/alat')->with('success', 'Data Alat TTG berhasil diperbarui!');
    }

    // Fungsi untuk menghapus data (Tong Sampah)
    public function destroy(int $id)
    {
        $alat = AlatTtg::findOrFail($id);

        // Hapus file foto dari folder storage sebelum datanya dihapus
        if ($alat->foto && Storage::disk('public')->exists($alat->foto)) {
            Storage::disk('public')->delete($alat->foto);
        }

        $alat->delete();

        return redirect('/admin/alat')->with('success', 'Data Alat TTG berhasil dihapus!');
    }

    // Fungsi untuk halaman "Lihat Detail" (Mata)
    public function show(int $id)
    {
        $alat = AlatTtg::with(['kategori', 'inovator', 'wilayah'])->findOrFail($id);
        return view('admin.alatTTG.show', compact('alat'));
    }

    public function index(Request $request)
    {
        // 1. Ambil data master untuk pilihan Dropdown Filter
        $kategoriList = Kategori::all();
        $wilayahList = Wilayah::all();
        // Mengambil daftar tahun yang unik dari data alat yang ada
        $tahunList = AlatTtg::select('tahun_produksi')->distinct()->orderBy('tahun_produksi', 'desc')->pluck('tahun_produksi');

        // 2. Mulai query dasar Alat TTG
        $query = AlatTtg::with(['kategori', 'inovator', 'wilayah'])->orderBy('dibuat_pada', 'desc');

        // 3. Terapkan Filter jika ada input dari pengguna
        if ($request->filled('search')) {
            $search = $request->search;
            // Dibungkus function agar "OR" tidak merusak filter dropdown lainnya
            $query->where(function ($q) use ($search) {
                $q->where('nama_alat', 'like', '%' . $search . '%')
                    ->orWhereHas('inovator', function ($qInovator) use ($search) {
                        $qInovator->where('nama_inovator', 'like', '%' . $search . '%');
                    });
            });
        }

        if ($request->filled('kategori')) {
            $query->where('id_kategori', $request->kategori);
        }
        if ($request->filled('wilayah')) {
            $query->where('id_wilayah', $request->wilayah);
        }
        if ($request->filled('tahun')) {
            $query->where('tahun_produksi', $request->tahun);
        }
        if ($request->filled('status')) {
            $query->where('status_publikasi', $request->status);
        }

        // 4. Eksekusi query dengan pagination dinamis per_page, dan bawa parameter filter (appends)
        $perPage = in_array((int)$request->input('per_page'), [5, 10, 25, 50, 100]) ? (int)$request->input('per_page') : 5;
        $alat = $query->paginate($perPage)->appends($request->all());

        return view('admin.alatTTG.index', compact('alat', 'kategoriList', 'wilayahList', 'tahunList'));
    }

    public function create()
    {
        // Memanggil data master untuk diisi ke dalam pilihan <select> dropdown
        $kategori = Kategori::all();
        $wilayah = Wilayah::all();
        $inovator = Inovator::where('status', 'Aktif')->get();

        return view('admin.alatTTG.create', compact('kategori', 'wilayah', 'inovator'));
    }

    public function store(Request $request)
    {
        // 1. Validasi Inputan
        $request->validate([
            'nama_alat' => 'required|string|max:255',
            'id_kategori' => 'required|exists:kategori,id',
            'tahun_produksi' => 'required|integer|digits:4',
            'deskripsi' => 'required|string',
            'id_inovator' => 'required|exists:inovator,id',
            'estimasi_harga' => 'required|string|max:255',
            'nomor_telepon' => 'nullable|string|max:20',
            'id_wilayah' => 'required|exists:wilayah,id',
            'status_publikasi' => 'required|in:Publik,Draft',
            'alamat_lengkap' => 'required|string',
            'foto' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
        ], [
            'nama_alat.required'      => 'Nama alat wajib diisi.',
            'nama_alat.max'           => 'Nama alat maksimal 255 karakter.',
            'id_kategori.required'    => 'Kategori alat wajib dipilih.',
            'id_kategori.exists'      => 'Kategori yang dipilih tidak valid.',
            'tahun_produksi.required' => 'Tahun produksi wajib diisi.',
            'tahun_produksi.integer'  => 'Tahun produksi harus berupa angka tahun.',
            'tahun_produksi.digits'   => 'Tahun produksi harus terdiri dari 4 digit angka (contoh: 2024).',
            'deskripsi.required'      => 'Deskripsi alat wajib diisi.',
            'id_inovator.required'    => 'Inovator penemu alat wajib dipilih.',
            'id_inovator.exists'      => 'Inovator yang dipilih tidak valid.',
            'estimasi_harga.required' => 'Estimasi harga wajib diisi.',
            'estimasi_harga.max'      => 'Estimasi harga maksimal 255 karakter.',
            'nomor_telepon.max'       => 'Nomor telepon maksimal 20 karakter.',
            'id_wilayah.required'     => 'Wilayah kecamatan wajib dipilih.',
            'id_wilayah.exists'       => 'Wilayah yang dipilih tidak valid.',
            'status_publikasi.required' => 'Status publikasi wajib dipilih.',
            'status_publikasi.in'     => 'Status publikasi harus bernilai Publik atau Draft.',
            'alamat_lengkap.required' => 'Alamat lengkap wajib diisi.',
            'foto.required'           => 'Foto dokumentasi alat wajib diunggah.',
            'foto.image'              => 'File yang diunggah harus berupa gambar.',
            'foto.mimes'              => 'Format foto harus berupa JPEG, PNG, JPG, atau WebP.',
            'foto.max'                => 'Ukuran foto maksimal 5MB.',
        ]);

        // 2. Logika Upload Foto (Otomatis Kompresi & Konversi ke WebP)
        $image = '';
        if ($request->hasFile('foto')) {
            $image = ImageHelper::convertToWebp($request->file('foto'), 'alat_ttg');
        }

        // 3. Simpan ke Database
        AlatTtg::create([
            'nama_alat' => $request->nama_alat,
            'id_kategori' => $request->id_kategori,
            'tahun_produksi' => $request->tahun_produksi,
            'deskripsi' => $request->deskripsi,
            'id_inovator' => $request->id_inovator,
            'nomor_telepon' => $request->nomor_telepon,
            'estimasi_harga' => $request->estimasi_harga,
            'id_wilayah' => $request->id_wilayah,
            'status_publikasi' => $request->status_publikasi,
            'alamat_lengkap' => $request->alamat_lengkap,
            'foto' => $image,
        ]);

        // 4. Kembali ke halaman tabel dengan pesan sukses
        return redirect('/admin/alat')->with('success', 'Data Alat TTG berhasil ditambahkan!');
    }

    // --- FITUR LAPORAN ---

    // 1. Cetak Biasa (Browser Print)
    public function print()
    {
        $alatTtg = AlatTtg::with(['inovator', 'kategori', 'wilayah'])->get();
        return view('admin.alatTTG.print', compact('alatTtg'));
    }

    // 2. Export ke PDF
    public function exportPdf()
    {
        $alatTtg = AlatTtg::with(['inovator', 'kategori', 'wilayah'])->get();

        // Load view print tapi ubah menjadi format PDF
        $pdf = Pdf::loadView('admin.alatTTG.print', compact('alatTtg'))->setPaper('a4', 'landscape');

        return $pdf->download('Laporan-Data-Alat-TTG.pdf');
    }

    // 3. Export ke Excel
    public function exportExcel()
    {
        return Excel::download(new AlatTtgExport, 'Laporan-Data-Alat-TTG.xlsx');
    }
}
