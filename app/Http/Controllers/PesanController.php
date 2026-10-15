<?php

namespace App\Http\Controllers;

use App\Models\Pesan;
use Illuminate\Http\Request;

class PesanController extends Controller
{
    /**
     * Menyimpan pesan dari form publik (tanpa login).
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'   => 'required|string|max:100',
            'email'  => 'required|email:filter|max:100',
            'no_wa'  => [
                'required',
                'string',
                'min:8',
                'max:25',
                'regex:/^(\+?[0-9\s\-()]+)$/',
                function ($attribute, $value, $fail) {
                    $digitsOnly = preg_replace('/[^0-9]/', '', $value);
                    if (strlen($digitsOnly) < 8 || strlen($digitsOnly) > 16) {
                        $fail('Nomor WhatsApp / HP harus mengandung antara 8 hingga 16 digit angka.');
                    }
                },
            ],
            'subjek' => 'required|string|max:150',
            'pesan'  => 'required|string|max:5000',
        ], [
            'nama.required'   => 'Nama lengkap wajib diisi.',
            'nama.max'        => 'Nama lengkap maksimal 100 karakter.',
            'email.required'  => 'Email wajib diisi.',
            'email.email'     => 'Format email tidak valid.',
            'email.max'       => 'Email maksimal 100 karakter.',
            'no_wa.required'  => 'Nomor WhatsApp / HP wajib diisi.',
            'no_wa.min'       => 'Nomor WhatsApp / HP minimal 8 karakter.',
            'no_wa.max'       => 'Nomor WhatsApp / HP maksimal 25 karakter.',
            'no_wa.regex'     => 'Format nomor WhatsApp / HP tidak valid. Masukkan nomor yang benar (contoh: 081234567890 atau +6281234567890).',
            'subjek.required' => 'Subjek pesan wajib dipilih.',
            'subjek.max'      => 'Subjek pesan maksimal 150 karakter.',
            'pesan.required'  => 'Isi pesan wajib diisi.',
            'pesan.max'       => 'Isi pesan maksimal 5000 karakter.',
        ]);

        Pesan::create([
            'nama'   => strip_tags(trim($request->nama)),
            'email'  => trim($request->email),
            'no_wa'  => strip_tags(trim($request->no_wa)),
            'subjek' => strip_tags(trim($request->subjek)),
            'pesan'  => strip_tags(trim($request->pesan)),
        ]);

        return redirect()->back()->with('pesan_success', 'Pesan Anda berhasil terkirim! Terima kasih telah menghubungi kami.');
    }

    /**
     * Menampilkan daftar pesan masuk di admin.
     */
    public function index(Request $request)
    {
        $search = $request->input('search', '');
        $filter = $request->input('filter', 'semua');

        $query = Pesan::query();

        // Filter status baca
        if ($filter === 'belum_dibaca') {
            $query->where('is_dibaca', false);
        } elseif ($filter === 'sudah_dibaca') {
            $query->where('is_dibaca', true);
        }

        // Search
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('no_wa', 'like', "%{$search}%")
                  ->orWhere('subjek', 'like', "%{$search}%")
                  ->orWhere('pesan', 'like', "%{$search}%");
            });
        }

        $totalBelumDibaca = Pesan::where('is_dibaca', false)->count();
        $pesanList = $query->latest()->paginate(10)->appends($request->all());

        return view('admin.pesan.index', compact('pesanList', 'search', 'filter', 'totalBelumDibaca'));
    }

    /**
     * Menampilkan detail pesan & otomatis tandai sudah dibaca.
     */
    public function show($id)
    {
        $pesan = Pesan::findOrFail($id);

        // Otomatis tandai sudah dibaca
        if (!$pesan->is_dibaca) {
            $pesan->update(['is_dibaca' => true]);
        }

        return view('admin.pesan.show', compact('pesan'));
    }

    /**
     * Menghapus pesan.
     */
    public function destroy($id)
    {
        $pesan = Pesan::findOrFail($id);
        $pesan->delete();

        return redirect()->route('admin.pesan.index')->with('success', 'Pesan berhasil dihapus.');
    }

    /**
     * Toggle status dibaca / belum dibaca.
     */
    public function toggleDibaca($id)
    {
        $pesan = Pesan::findOrFail($id);
        $newStatus = !$pesan->is_dibaca;
        $pesan->update(['is_dibaca' => $newStatus]);

        $statusText = $newStatus ? 'sudah dibaca' : 'belum dibaca';
        $message = "Pesan berhasil ditandai {$statusText}.";

        // Jika ditandai belum dibaca dari halaman detail, arahkan kembali ke daftar pesan masuk
        // agar tidak langsung otomatis ditandai terbaca kembali oleh show()
        if (!$newStatus && str_contains(url()->previous(), "/admin/pesan/{$id}")) {
            return redirect()->route('admin.pesan.index')->with('success', $message);
        }

        return redirect()->back()->with('success', $message);
    }
}
