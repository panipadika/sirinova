<?php

namespace App\Http\Controllers;

use App\Models\Inovator;
use App\Models\Wilayah;
use Illuminate\Http\Request;

class InovatorController extends Controller
{
    // Fungsi untuk menampilkan halaman utama (tabel data)
    public function index(Request $request)
    {
        // Memanggil data wilayah untuk pilihan Dropdown Filter
        $wilayahList = Wilayah::all();

        // Mulai query Inovator, panggil relasi wilayah, dan hitung jumlah alat (withCount)
        $query = Inovator::with('wilayah')->withCount('alatTtg')->orderBy('id', 'desc');

        // Terapkan Filter jika ada input dari pengguna
        if ($request->filled('search')) {
            $query->where('nama_inovator', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('wilayah')) {
            $query->where('id_wilayah', $request->wilayah);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Eksekusi query dengan pagination dinamis per_page
        $perPage = in_array((int)$request->input('per_page'), [5, 10, 25, 50, 100]) ? (int)$request->input('per_page') : 5;
        $inovator = $query->paginate($perPage)->appends($request->all());

        return view('admin.inovator.index', compact('inovator', 'wilayahList'));
    }

    // Fungsi untuk menampilkan form Tambah Inovator
    public function create()
    {
        // Memanggil data wilayah untuk dropdown
        $wilayah = Wilayah::all();

        return view('admin.inovator.create', compact('wilayah'));
    }

    // Fungsi untuk memproses dan menyimpan data inovator baru ke database
    public function store(Request $request)
    {
        // 1. Validasi inputan dari form
        $request->validate([
            'nama_inovator' => 'required|string|max:255',
            'nomor_telepon' => 'required|string|max:20',
            'alamat_lengkap' => 'nullable|string',
            'id_wilayah'    => 'required|exists:wilayah,id',
            'status'        => 'required|in:Aktif,Non-Aktif',
        ], [
            'nama_inovator.required' => 'Nama inovator wajib diisi.',
            'nama_inovator.max'      => 'Nama inovator maksimal 255 karakter.',
            'nomor_telepon.required' => 'Nomor telepon wajib diisi.',
            'nomor_telepon.max'      => 'Nomor telepon maksimal 20 karakter.',
            'id_wilayah.required'    => 'Wilayah kecamatan wajib dipilih.',
            'id_wilayah.exists'      => 'Wilayah kecamatan yang dipilih tidak valid.',
            'status.required'        => 'Status keaktifan wajib dipilih.',
            'status.in'              => 'Status harus bernilai Aktif atau Non-Aktif.',
        ]);

        // 2. Simpan data ke dalam database
        Inovator::create([
            'nama_inovator' => $request->nama_inovator,
            'nomor_telepon' => $request->nomor_telepon,
            'alamat_lengkap'        => $request->alamat_lengkap,
            'id_wilayah'    => $request->id_wilayah,
            'status'        => $request->status,
        ]);

        // 3. Kembalikan pengguna ke halaman tabel dengan pesan sukses
        return redirect('/admin/inovator')->with('success', 'Data Inovator berhasil ditambahkan!');
    }

    // Menampilkan form Edit Inovator (Ikon Pensil)
    public function edit(int $id)
    {
        $inovator = Inovator::findOrFail($id);
        $wilayah = Wilayah::all();

        return view('admin.inovator.edit', compact('inovator', 'wilayah'));
    }

    // Memproses data yang diedit dan menyimpannya kembali
    public function update(Request $request, int $id)
    {
        $request->validate([
            'nama_inovator' => 'required|string|max:255',
            'nomor_telepon' => 'required|string|max:20',
            'alamat_lengkap' => 'nullable|string',
            'id_wilayah'    => 'required|exists:wilayah,id',
            'status'        => 'required|in:Aktif,Non-Aktif',
        ], [
            'nama_inovator.required' => 'Nama inovator wajib diisi.',
            'nama_inovator.max'      => 'Nama inovator maksimal 255 karakter.',
            'nomor_telepon.required' => 'Nomor telepon wajib diisi.',
            'nomor_telepon.max'      => 'Nomor telepon maksimal 20 karakter.',
            'id_wilayah.required'    => 'Wilayah kecamatan wajib dipilih.',
            'id_wilayah.exists'      => 'Wilayah kecamatan yang dipilih tidak valid.',
            'status.required'        => 'Status keaktifan wajib dipilih.',
            'status.in'              => 'Status harus bernilai Aktif atau Non-Aktif.',
        ]);

        $inovator = Inovator::findOrFail($id);

        $inovator->update([
            'nama_inovator' => $request->nama_inovator,
            'nomor_telepon' => $request->nomor_telepon,
            'alamat_lengkap'        => $request->alamat_lengkap ?? null,
            'id_wilayah'    => $request->id_wilayah,
            'status'        => $request->status,
        ]);

        return redirect('/admin/inovator')->with('success', 'Data Inovator berhasil diperbarui!');
    }

    // Menghapus data Inovator (Ikon Tong Sampah)
    public function destroy(int $id)
    {
        $inovator = Inovator::findOrFail($id);

        $countAlat = $inovator->alatTtg()->count();
        if ($countAlat > 0) {
            return redirect('/admin/inovator')->with(
                'error',
                "Inovator '{$inovator->nama_inovator}' tidak dapat dihapus karena masih memiliki {$countAlat} data Alat TTG. Silakan hapus atau pindahkan data Alat TTG terkait terlebih dahulu."
            );
        }

        $inovator->delete();

        return redirect('/admin/inovator')->with('success', 'Data Inovator berhasil dihapus!');
    }

    // Menampilkan halaman detail inovator (Ikon Mata)
    public function show(int $id)
    {
        // Memanggil data inovator beserta relasi wilayah dan alat ttg miliknya
        $inovator = Inovator::with(['wilayah', 'alatTtg'])->findOrFail($id);

        return view('admin.inovator.show', compact('inovator'));
    }
}
