<?php

namespace App\Http\Controllers;

use App\Models\TelaahanStaf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TelaahanStafController extends Controller
{
    /**
     * Display a listing of the resource (Admin List Telaahan Staf).
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');
        $selectedTahun = $request->input('tahun', 'Semua');

        $query = TelaahanStaf::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('pembuat_bidang', 'like', "%{$search}%");
            });
        }

        if ($status && $status !== 'Semua') {
            $query->where('status', $status);
        }

        if ($selectedTahun && $selectedTahun !== 'Semua') {
            $query->where('tahun_dokumen', $selectedTahun);
        }

        $tahunList = TelaahanStaf::whereNotNull('tahun_dokumen')
            ->distinct()
            ->orderBy('tahun_dokumen', 'desc')
            ->pluck('tahun_dokumen');

        $perPage = in_array((int)$request->input('per_page'), [5, 10, 25, 50, 100]) ? (int)$request->input('per_page') : 5;
        $telaahanStafs = $query->latest('dibuat_pada')->paginate($perPage)->appends($request->all());

        return view('admin.telaahan-staf.index', compact('telaahanStafs', 'search', 'status', 'tahunList', 'selectedTahun'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.telaahan-staf.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul'           => 'required|string|max:255',
            'tahun_dokumen'   => 'required|numeric|digits:4',
            'pembuat_bidang'  => 'required|string|max:255',
            'ringkasan'       => 'nullable|string',
            'status'          => 'required|in:Draft,Dipublikasikan',
            'file_pdf'        => 'nullable|mimes:pdf|max:20480',
        ], [
            'judul.required'         => 'Judul Telaahan Staf wajib diisi.',
            'tahun_dokumen.required' => 'Tahun dokumen wajib diisi.',
            'tahun_dokumen.digits'   => 'Tahun dokumen harus 4 digit angka (misal: 2026).',
            'pembuat_bidang.required'=> 'Bidang pembuat dokumen wajib diisi.',
            'file_pdf.mimes'         => 'File dokumen harus berformat PDF.',
            'file_pdf.max'           => 'Ukuran file PDF maksimal 20MB.',
        ]);

        $pdfPath = null;
        if ($request->hasFile('file_pdf')) {
            $pdfPath = $request->file('file_pdf')->store('telaahan_staf/pdfs', 'public');
        }

        TelaahanStaf::create([
            'judul'           => $request->judul,
            'tahun_dokumen'   => $request->tahun_dokumen,
            'pembuat_bidang'  => $request->pembuat_bidang,
            'status'          => $request->status,
            'ringkasan'       => $request->ringkasan,
            'file_pdf'        => $pdfPath ? 'storage/' . $pdfPath : null,
        ]);

        return redirect()->route('admin.telaahan-staf.index')
            ->with('success', 'Dokumen Telaahan Staf berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $telaahanStaf = TelaahanStaf::findOrFail($id);
        return view('admin.telaahan-staf.edit', compact('telaahanStaf'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $telaahanStaf = TelaahanStaf::findOrFail($id);

        $request->validate([
            'judul'           => 'required|string|max:255',
            'tahun_dokumen'   => 'required|numeric|digits:4',
            'pembuat_bidang'  => 'required|string|max:255',
            'ringkasan'       => 'nullable|string',
            'status'          => 'required|in:Draft,Dipublikasikan',
            'file_pdf'        => 'nullable|mimes:pdf|max:20480',
        ], [
            'judul.required'         => 'Judul Telaahan Staf wajib diisi.',
            'tahun_dokumen.required' => 'Tahun dokumen wajib diisi.',
            'tahun_dokumen.digits'   => 'Tahun dokumen harus 4 digit angka (misal: 2026).',
            'pembuat_bidang.required'=> 'Bidang pembuat dokumen wajib diisi.',
            'file_pdf.mimes'         => 'File dokumen harus berformat PDF.',
            'file_pdf.max'           => 'Ukuran file PDF maksimal 20MB.',
        ]);

        $pdfPath = $telaahanStaf->file_pdf;
        if ($request->hasFile('file_pdf')) {
            if ($telaahanStaf->file_pdf && str_contains($telaahanStaf->file_pdf, 'storage/telaahan_staf/pdfs/')) {
                $oldPath = str_replace('storage/', '', $telaahanStaf->file_pdf);
                Storage::disk('public')->delete($oldPath);
            }
            $uploadedPdf = $request->file('file_pdf')->store('telaahan_staf/pdfs', 'public');
            $pdfPath = 'storage/' . $uploadedPdf;
        }

        $telaahanStaf->update([
            'judul'           => $request->judul,
            'tahun_dokumen'   => $request->tahun_dokumen,
            'pembuat_bidang'  => $request->pembuat_bidang,
            'status'          => $request->status,
            'ringkasan'       => $request->ringkasan,
            'file_pdf'        => $pdfPath,
        ]);

        return redirect()->route('admin.telaahan-staf.index')
            ->with('success', 'Dokumen Telaahan Staf berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $telaahanStaf = TelaahanStaf::findOrFail($id);

        if ($telaahanStaf->file_pdf && str_contains($telaahanStaf->file_pdf, 'storage/telaahan_staf/pdfs/')) {
            $oldPath = str_replace('storage/', '', $telaahanStaf->file_pdf);
            Storage::disk('public')->delete($oldPath);
        }

        $telaahanStaf->delete();

        return redirect()->route('admin.telaahan-staf.index')
            ->with('success', 'Dokumen Telaahan Staf berhasil dihapus!');
    }
}
