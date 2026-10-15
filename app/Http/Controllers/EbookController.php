<?php

namespace App\Http\Controllers;

use App\Models\Ebook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Helpers\ImageHelper;

class EbookController extends Controller
{
    /**
     * Display a listing of the resource (Admin List E-Book Kajian).
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $kategori = $request->input('kategori');
        $tahun = $request->input('tahun');

        $query = Ebook::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('kategori', 'like', "%{$search}%")
                  ->orWhere('tahun', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        if ($kategori && $kategori !== 'Semua') {
            $query->where('kategori', $kategori);
        }

        if ($tahun && $tahun !== 'Semua') {
            $query->where('tahun', $tahun);
        }

        $perPage = in_array((int)$request->input('per_page'), [5, 10, 25, 50, 100]) ? (int)$request->input('per_page') : 5;
        $ebooks = $query->latest()->paginate($perPage)->appends($request->all());

        // List Kategori & Tahun dari database
        $listKategori = Ebook::distinct()->whereNotNull('kategori')->where('kategori', '!=', '')->pluck('kategori')->sort()->values();
        $listTahun = Ebook::distinct()->whereNotNull('tahun')->where('tahun', '!=', '')->pluck('tahun')->sortDesc()->values();

        return view('admin.ebook.index', compact('ebooks', 'search', 'kategori', 'tahun', 'listKategori', 'listTahun'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.ebook.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul'       => 'required|string|max:255',
            'kategori'    => 'required|string|max:255',
            'tahun'       => 'required|string|max:10',
            'deskripsi'   => 'required|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'file_pdf'    => 'nullable|mimes:pdf|max:20480',
        ], [
            'judul.required'     => 'Judul E-Book Kajian wajib diisi.',
            'kategori.required'  => 'Kategori E-Book wajib dipilih atau diisi.',
            'tahun.required'     => 'Tahun terbit wajib diisi.',
            'deskripsi.required' => 'Deskripsi singkat / Abstraksi wajib diisi.',
            'cover_image.image'  => 'File cover harus berupa gambar.',
            'cover_image.max'    => 'Ukuran cover maksimal 5MB.',
            'file_pdf.mimes'     => 'File dokumen E-Book harus berformat PDF.',
            'file_pdf.max'       => 'Ukuran file PDF maksimal 20MB.',
        ]);

        $coverPath = null;
        if ($request->hasFile('cover_image')) {
            $coverPath = ImageHelper::convertToWebp($request->file('cover_image'), 'ebooks/covers');
        }

        $pdfPath = null;
        if ($request->hasFile('file_pdf')) {
            $pdfPath = $request->file('file_pdf')->store('ebooks/pdfs', 'public');
        }

        Ebook::create([
            'judul'       => $request->judul,
            'kategori'    => $request->kategori,
            'tahun'       => $request->tahun,
            'deskripsi'   => $request->deskripsi,
            'cover_image' => $coverPath ? 'storage/' . $coverPath : null,
            'file_url'    => $pdfPath ? 'storage/' . $pdfPath : null,
        ]);

        return redirect()->route('admin.ebook.index')
            ->with('success', 'E-Book Kajian berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ebook $ebook)
    {
        return view('admin.ebook.edit', compact('ebook'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ebook $ebook)
    {
        $request->validate([
            'judul'       => 'required|string|max:255',
            'kategori'    => 'required|string|max:255',
            'tahun'       => 'required|string|max:10',
            'deskripsi'   => 'required|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'file_pdf'    => 'nullable|mimes:pdf|max:20480',
        ], [
            'judul.required'     => 'Judul E-Book Kajian wajib diisi.',
            'kategori.required'  => 'Kategori E-Book wajib dipilih atau diisi.',
            'tahun.required'     => 'Tahun terbit wajib diisi.',
            'deskripsi.required' => 'Deskripsi singkat / Abstraksi wajib diisi.',
            'cover_image.image'  => 'File cover harus berupa gambar.',
            'cover_image.max'    => 'Ukuran cover maksimal 5MB.',
            'file_pdf.mimes'     => 'File dokumen E-Book harus berformat PDF.',
            'file_pdf.max'       => 'Ukuran file PDF maksimal 20MB.',
        ]);

        $coverPath = $ebook->cover_image;
        if ($request->hasFile('cover_image')) {
            // Delete old image if stored in public
            if ($ebook->cover_image && str_contains($ebook->cover_image, 'storage/ebooks/covers/')) {
                $oldPath = str_replace('storage/', '', $ebook->cover_image);
                Storage::disk('public')->delete($oldPath);
            }
            $uploadedCover = ImageHelper::convertToWebp($request->file('cover_image'), 'ebooks/covers');
            $coverPath = 'storage/' . $uploadedCover;
        }

        $pdfPath = $ebook->file_url;
        if ($request->hasFile('file_pdf')) {
            // Delete old PDF if stored in public
            if ($ebook->file_url && str_contains($ebook->file_url, 'storage/ebooks/pdfs/')) {
                $oldPath = str_replace('storage/', '', $ebook->file_url);
                Storage::disk('public')->delete($oldPath);
            }
            $uploadedPdf = $request->file('file_pdf')->store('ebooks/pdfs', 'public');
            $pdfPath = 'storage/' . $uploadedPdf;
        }

        $ebook->update([
            'judul'       => $request->judul,
            'kategori'    => $request->kategori,
            'tahun'       => $request->tahun,
            'deskripsi'   => $request->deskripsi,
            'cover_image' => $coverPath,
            'file_url'    => $pdfPath,
        ]);

        return redirect()->route('admin.ebook.index')
            ->with('success', 'E-Book Kajian berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ebook $ebook)
    {
        if ($ebook->cover_image && str_contains($ebook->cover_image, 'storage/ebooks/covers/')) {
            $oldPath = str_replace('storage/', '', $ebook->cover_image);
            Storage::disk('public')->delete($oldPath);
        }

        if ($ebook->file_url && str_contains($ebook->file_url, 'storage/ebooks/pdfs/')) {
            $oldPath = str_replace('storage/', '', $ebook->file_url);
            Storage::disk('public')->delete($oldPath);
        }

        $ebook->delete();

        return redirect()->route('admin.ebook.index')
            ->with('success', 'E-Book Kajian berhasil dihapus!');
    }
}
