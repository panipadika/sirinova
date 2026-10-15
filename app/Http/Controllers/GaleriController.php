<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Helpers\ImageHelper;

class GaleriController extends Controller
{
    /**
     * Display a listing of the resource (Admin List Galeri).
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');

        $query = Galeri::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('lokasi', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        if ($status && $status !== 'Semua') {
            $query->where('status', $status);
        }

        $perPage = in_array((int)$request->input('per_page'), [5, 10, 25, 50, 100]) ? (int)$request->input('per_page') : 5;
        $galeris = $query->latest('tanggal_kegiatan')->paginate($perPage)->appends($request->all());

        return view('admin.galeri.index', compact('galeris', 'search', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.galeri.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul'            => 'required|string|max:255',
            'tanggal_kegiatan' => 'required|date',
            'lokasi'           => 'nullable|string|max:255',
            'deskripsi'        => 'nullable|string',
            'status'           => 'required|in:Draft,Dipublikasikan',
            'foto'             => 'required|image|mimes:jpeg,png,jpg,webp|max:10240',
            'foto_pendukung'   => 'nullable|array|max:4',
            'foto_pendukung.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
        ], [
            'judul.required'            => 'Judul kegiatan wajib diisi.',
            'tanggal_kegiatan.required' => 'Tanggal kegiatan wajib dipilih.',
            'status.required'           => 'Status publikasi wajib dipilih.',
            'foto.required'             => 'Foto utama dokumentasi wajib diunggah.',
            'foto.image'                => 'File foto utama harus berupa gambar.',
            'foto.mimes'                => 'Format foto utama harus JPEG, PNG, JPG, atau WEBP.',
            'foto.max'                  => 'Ukuran foto utama maksimal 10MB.',
            'foto_pendukung.max'        => 'Maksimal 4 foto pendukung yang dapat diunggah.',
            'foto_pendukung.*.image'    => 'File foto pendukung harus berupa gambar.',
            'foto_pendukung.*.mimes'    => 'Format foto pendukung harus JPEG, PNG, JPG, atau WEBP.',
            'foto_pendukung.*.max'      => 'Ukuran foto pendukung maksimal 10MB.',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $uploaded = ImageHelper::convertToWebp($request->file('foto'), 'galeri/photos');
            $fotoPath = 'storage/' . $uploaded;
        }

        $fotoPendukungPaths = [];
        if ($request->hasFile('foto_pendukung')) {
            foreach ($request->file('foto_pendukung') as $file) {
                if ($file) {
                    $uploaded = ImageHelper::convertToWebp($file, 'galeri/photos');
                    $fotoPendukungPaths[] = 'storage/' . $uploaded;
                }
            }
        }

        Galeri::create([
            'judul'            => $request->judul,
            'tanggal_kegiatan' => $request->tanggal_kegiatan,
            'lokasi'           => $request->lokasi,
            'deskripsi'        => $request->deskripsi,
            'status'           => $request->status,
            'foto'             => $fotoPath,
            'foto_pendukung'   => $fotoPendukungPaths,
        ]);

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Dokumentasi kegiatan berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $galeri = Galeri::findOrFail($id);
        return view('admin.galeri.edit', compact('galeri'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $galeri = Galeri::findOrFail($id);

        $request->validate([
            'judul'            => 'required|string|max:255',
            'tanggal_kegiatan' => 'required|date',
            'lokasi'           => 'nullable|string|max:255',
            'deskripsi'        => 'nullable|string',
            'status'           => 'required|in:Draft,Dipublikasikan',
            'foto'             => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
            'foto_pendukung'   => 'nullable|array|max:4',
            'foto_pendukung.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
        ], [
            'judul.required'            => 'Judul kegiatan wajib diisi.',
            'tanggal_kegiatan.required' => 'Tanggal kegiatan wajib dipilih.',
            'status.required'           => 'Status publikasi wajib dipilih.',
            'foto.image'                => 'File foto utama harus berupa gambar.',
            'foto.mimes'                => 'Format foto utama harus JPEG, PNG, JPG, atau WEBP.',
            'foto.max'                  => 'Ukuran foto utama maksimal 10MB.',
            'foto_pendukung.max'        => 'Maksimal 4 foto pendukung yang dapat diunggah.',
            'foto_pendukung.*.image'    => 'File foto pendukung harus berupa gambar.',
            'foto_pendukung.*.mimes'    => 'Format foto pendukung harus JPEG, PNG, JPG, atau WEBP.',
            'foto_pendukung.*.max'      => 'Ukuran foto pendukung maksimal 10MB.',
        ]);

        // Main photo update
        $fotoPath = $galeri->foto;
        if ($request->hasFile('foto')) {
            if ($galeri->foto && str_contains($galeri->foto, 'storage/galeri/photos/')) {
                $oldPath = str_replace('storage/', '', $galeri->foto);
                Storage::disk('public')->delete($oldPath);
            }
            $uploaded = ImageHelper::convertToWebp($request->file('foto'), 'galeri/photos');
            $fotoPath = 'storage/' . $uploaded;
        }

        // Supporting photos update logic
        $existing = $request->input('existing_foto_pendukung', []);
        if (!is_array($existing)) {
            $existing = [];
        }

        $currentSupporting = is_array($galeri->foto_pendukung) ? $galeri->foto_pendukung : [];
        foreach ($currentSupporting as $oldSupport) {
            if (!in_array($oldSupport, $existing)) {
                if (str_contains($oldSupport, 'storage/galeri/photos/')) {
                    $oldPath = str_replace('storage/', '', $oldSupport);
                    Storage::disk('public')->delete($oldPath);
                }
            }
        }

        $fotoPendukungPaths = $existing;

        if ($request->hasFile('foto_pendukung')) {
            foreach ($request->file('foto_pendukung') as $file) {
                if ($file && count($fotoPendukungPaths) < 4) {
                    $uploaded = ImageHelper::convertToWebp($file, 'galeri/photos');
                    $fotoPendukungPaths[] = 'storage/' . $uploaded;
                }
            }
        }

        $galeri->update([
            'judul'            => $request->judul,
            'tanggal_kegiatan' => $request->tanggal_kegiatan,
            'lokasi'           => $request->lokasi,
            'deskripsi'        => $request->deskripsi,
            'status'           => $request->status,
            'foto'             => $fotoPath,
            'foto_pendukung'   => array_values($fotoPendukungPaths),
        ]);

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Dokumentasi kegiatan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $galeri = Galeri::findOrFail($id);

        if ($galeri->foto && str_contains($galeri->foto, 'storage/galeri/photos/')) {
            $oldPath = str_replace('storage/', '', $galeri->foto);
            Storage::disk('public')->delete($oldPath);
        }

        if (is_array($galeri->foto_pendukung)) {
            foreach ($galeri->foto_pendukung as $support) {
                if ($support && str_contains($support, 'storage/galeri/photos/')) {
                    $oldPath = str_replace('storage/', '', $support);
                    Storage::disk('public')->delete($oldPath);
                }
            }
        }

        $galeri->delete();

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Dokumentasi kegiatan berhasil dihapus!');
    }
}
