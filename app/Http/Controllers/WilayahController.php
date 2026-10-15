<?php

namespace App\Http\Controllers;

use App\Models\Wilayah;
use Illuminate\Http\Request;

class WilayahController extends Controller
{
    public function index(Request $request)
    {
        $query = Wilayah::withCount('alatTtg');

        // 1. Fitur Pencarian (Berdasarkan nama kecamatan atau kode wilayah)
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_kecamatan', 'like', '%' . $request->search . '%')
                    ->orWhere('kode_wilayah', 'like', '%' . $request->search . '%');
            });
        }

        // 2. Fitur Sorting (Urutkan)
        if ($request->sort == 'az') {
            $query->orderBy('nama_kecamatan', 'asc');
        } elseif ($request->sort == 'za') {
            $query->orderBy('nama_kecamatan', 'desc');
        } elseif ($request->sort == 'popular') {
            $query->orderBy('alat_ttg_count', 'desc');
        } else {
            $query->orderBy('id', 'desc'); // Default: Data terbaru
        }

        $perPage = in_array((int)$request->input('per_page'), [5, 10, 25, 50, 100]) ? (int)$request->input('per_page') : 5;
        $wilayah = $query->paginate($perPage)->appends($request->all());

        return view('admin.wilayah.index', compact('wilayah'));
    }

    public function create()
    {
        return view('admin.wilayah.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kecamatan' => 'required|string|max:255|unique:wilayah,nama_kecamatan',
            'kode_wilayah'   => 'required|string|max:50|unique:wilayah,kode_wilayah',
            'deskripsi'      => 'nullable|string',
        ], [
            'nama_kecamatan.required' => 'Nama kecamatan wajib diisi.',
            'nama_kecamatan.unique'   => 'Nama kecamatan sudah terdaftar di sistem.',
            'nama_kecamatan.max'      => 'Nama kecamatan maksimal 255 karakter.',
            'kode_wilayah.required'   => 'Kode wilayah wajib diisi.',
            'kode_wilayah.unique'     => 'Kode wilayah sudah digunakan untuk kecamatan lain.',
            'kode_wilayah.max'        => 'Kode wilayah maksimal 50 karakter.',
        ]);

        Wilayah::create([
            'nama_kecamatan' => $request->nama_kecamatan,
            'kode_wilayah'   => $request->kode_wilayah,
            'deskripsi'      => $request->deskripsi,
        ]);

        return redirect('/admin/wilayah')->with('success', 'Data wilayah berhasil ditambahkan!');
    }

    public function edit(int $id)
    {
        $wilayah = Wilayah::findOrFail($id);
        return view('admin.wilayah.edit', compact('wilayah'));
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'nama_kecamatan' => 'required|string|max:255|unique:wilayah,nama_kecamatan,' . $id,
            'kode_wilayah'   => 'required|string|max:50|unique:wilayah,kode_wilayah,' . $id,
            'deskripsi'      => 'nullable|string',
        ], [
            'nama_kecamatan.required' => 'Nama kecamatan wajib diisi.',
            'nama_kecamatan.unique'   => 'Nama kecamatan sudah terdaftar di sistem.',
            'nama_kecamatan.max'      => 'Nama kecamatan maksimal 255 karakter.',
            'kode_wilayah.required'   => 'Kode wilayah wajib diisi.',
            'kode_wilayah.unique'     => 'Kode wilayah sudah digunakan untuk kecamatan lain.',
            'kode_wilayah.max'        => 'Kode wilayah maksimal 50 karakter.',
        ]);

        $wilayah = Wilayah::findOrFail($id);
        $wilayah->update([
            'nama_kecamatan' => $request->nama_kecamatan,
            'kode_wilayah'   => $request->kode_wilayah,
            'deskripsi'      => $request->deskripsi,
        ]);

        return redirect('/admin/wilayah')->with('success', 'Data wilayah berhasil diperbarui!');
    }

    public function destroy(int $id)
    {
        $wilayah = Wilayah::findOrFail($id);

        $countAlat = $wilayah->alatTtg()->count();
        $countInovator = $wilayah->inovator()->count();

        if ($countAlat > 0 || $countInovator > 0) {
            $terkait = [];
            if ($countAlat > 0) {
                $terkait[] = "{$countAlat} data Alat TTG";
            }
            if ($countInovator > 0) {
                $terkait[] = "{$countInovator} data Inovator";
            }

            return redirect('/admin/wilayah')->with(
                'error',
                "Wilayah '{$wilayah->nama_kecamatan}' tidak dapat dihapus karena masih digunakan oleh " . implode(' dan ', $terkait) . ". Silakan hapus atau pindahkan data terkait terlebih dahulu."
            );
        }

        $wilayah->delete();
        return redirect('/admin/wilayah')->with('success', 'Data wilayah berhasil dihapus!');
    }
}
