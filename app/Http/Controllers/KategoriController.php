<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index(Request $request)
    {
        $query = Kategori::withCount('alatTtg');

        // Logika Sorting
        if ($request->sort == 'az') {
            $query->orderBy('nama_kategori', 'asc');
        } elseif ($request->sort == 'za') {
            $query->orderBy('nama_kategori', 'desc');
        } elseif ($request->sort == 'popular') {
            $query->orderBy('alat_ttg_count', 'desc');
        } else {
            $query->orderBy('id', 'desc'); // Default terbaru
        }

        // Fitur Pencarian berdasarkan nama kategori
        if ($request->filled('search')) {
            $query->where('nama_kategori', 'like', '%' . $request->search . '%');
        }

        $perPage = in_array((int)$request->input('per_page'), [5, 10, 25, 50, 100]) ? (int)$request->input('per_page') : 5;
        $kategori = $query->paginate($perPage)->appends($request->all());

        return view('admin.kategori.index', compact('kategori'));
    }

    public function create()
    {
        return view('admin.kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'deskripsi'     => 'nullable|string',
            'icon'          => 'nullable|string',
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.max'      => 'Nama kategori maksimal 255 karakter.',
        ]);

        Kategori::create([
            'nama_kategori' => $request->nama_kategori,
            'deskripsi'     => $request->deskripsi,
            'icon'          => $request->icon ?? 'category',
        ]);

        return redirect('/admin/kategori')->with('success', 'Kategori baru berhasil ditambahkan!');
    }

    public function edit(int $id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('admin.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'deskripsi'     => 'nullable|string',
            'icon'          => 'nullable|string',
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.max'      => 'Nama kategori maksimal 255 karakter.',
        ]);

        $kategori = Kategori::findOrFail($id);

        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
            'deskripsi'     => $request->deskripsi,
            'icon'          => $request->icon ?? $kategori->icon,
        ]);

        return redirect('/admin/kategori')->with('success', 'Data kategori berhasil diperbarui!');
    }

    public function destroy(int $id)
    {
        $kategori = Kategori::findOrFail($id);

        $countAlat = $kategori->alatTtg()->count();
        if ($countAlat > 0) {
            return redirect('/admin/kategori')->with(
                'error',
                "Kategori '{$kategori->nama_kategori}' tidak dapat dihapus karena masih digunakan oleh {$countAlat} data Alat TTG. Silakan hapus atau pindahkan data Alat TTG terkait terlebih dahulu."
            );
        }

        $kategori->delete();

        return redirect('/admin/kategori')->with('success', 'Data kategori berhasil dihapus!');
    }
}
