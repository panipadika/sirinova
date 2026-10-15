<?php

namespace App\Http\Controllers;

use App\Models\IndikatorMakro;
use App\Models\DataIndikatorMakro;
use Illuminate\Http\Request;

class IndikatorMakroController extends Controller
{
    public const DAFTAR_DAERAH_JABAR = [
        'Kota Tasikmalaya',
        'Kota Bandung',
        'Kota Bekasi',
        'Kota Depok',
        'Kota Cimahi',
        'Kota Bogor',
        'Kota Cirebon',
        'Kota Sukabumi',
        'Kota Banjar',
        'Kab. Tasikmalaya',
        'Kab. Bandung',
        'Kab. Bandung Barat',
        'Kab. Bekasi',
        'Kab. Bogor',
        'Kab. Ciamis',
        'Kab. Cianjur',
        'Kab. Cirebon',
        'Kab. Garut',
        'Kab. Indramayu',
        'Kab. Karawang',
        'Kab. Kuningan',
        'Kab. Majalengka',
        'Kab. Pangandaran',
        'Kab. Purwakarta',
        'Kab. Subang',
        'Kab. Sukabumi',
        'Kab. Sumedang',
    ];

    public function index(Request $request)
    {
        $indikatorList = IndikatorMakro::withCount('dataIndikator')
            ->orderBy('urutan', 'asc')
            ->orderBy('id', 'asc')
            ->get();

        $tahunList = DataIndikatorMakro::select('tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun')
            ->toArray();

        if (empty($tahunList)) {
            $tahunList = [(int)date('Y')];
        }

        $selectedTahun = (int) $request->get('tahun', $tahunList[0]);

        if (!in_array($selectedTahun, $tahunList)) {
            $tahunList[] = $selectedTahun;
            rsort($tahunList);
        }

        // Rekap data per indikator pada tahun terpilih
        $rekapData = [];
        foreach ($indikatorList as $ind) {
            $count = DataIndikatorMakro::where('indikator_id', $ind->id)
                ->where('tahun', $selectedTahun)
                ->where('nilai', '!=', 0)
                ->whereNotNull('nilai')
                ->count();
            $tasikData = DataIndikatorMakro::where('indikator_id', $ind->id)
                ->where('tahun', $selectedTahun)
                ->where('is_kota_tasik', true)
                ->where('nilai', '!=', 0)
                ->whereNotNull('nilai')
                ->first();

            $rekapData[$ind->id] = [
                'total_daerah' => $count,
                'nilai_tasik' => $tasikData ? $tasikData->nilai : null,
            ];
        }

        return view('admin.indikator-makro.index', compact(
            'indikatorList',
            'tahunList',
            'selectedTahun',
            'rekapData'
        ));
    }

    public function storeIndikator(Request $request)
    {
        $request->validate([
            'nama_indikator' => 'required|string|max:255',
            'satuan' => 'required|string|max:50',
            'deskripsi' => 'nullable|string',
            'urutan' => 'nullable|integer',
        ]);

        IndikatorMakro::create([
            'nama_indikator' => $request->nama_indikator,
            'satuan' => $request->satuan,
            'deskripsi' => $request->deskripsi,
            'urutan' => $request->urutan ?? 0,
        ]);

        return redirect()->route('admin.indikator-makro.index')
            ->with('success', 'Berhasil menambahkan Master Indikator Makro baru.');
    }

    public function updateIndikator(Request $request, $id)
    {
        $indikator = IndikatorMakro::findOrFail($id);

        $request->validate([
            'nama_indikator' => 'required|string|max:255',
            'satuan' => 'required|string|max:50',
            'deskripsi' => 'nullable|string',
            'urutan' => 'nullable|integer',
        ]);

        $indikator->update([
            'nama_indikator' => $request->nama_indikator,
            'satuan' => $request->satuan,
            'deskripsi' => $request->deskripsi,
            'urutan' => $request->urutan ?? 0,
        ]);

        return redirect()->route('admin.indikator-makro.index')
            ->with('success', 'Berhasil memperbarui Master Indikator Makro.');
    }

    public function destroyIndikator($id)
    {
        $indikator = IndikatorMakro::findOrFail($id);
        $indikator->delete();

        return redirect()->route('admin.indikator-makro.index')
            ->with('success', 'Master Indikator Makro beserta data terkait berhasil dihapus.');
    }

    public function inputBatch(Request $request)
    {
        $indikator_id = $request->get('indikator_id');
        $tahun = $request->get('tahun', (int)date('Y'));

        $indikator = IndikatorMakro::findOrFail($indikator_id);
        $daftarDaerah = self::DAFTAR_DAERAH_JABAR;

        // Ambil data yang sudah ada di database
        $existingData = DataIndikatorMakro::where('indikator_id', $indikator_id)
            ->where('tahun', $tahun)
            ->get()
            ->keyBy('nama_daerah');

        return view('admin.indikator-makro.input', compact(
            'indikator',
            'tahun',
            'daftarDaerah',
            'existingData'
        ));
    }

    public function storeBatch(Request $request)
    {
        $request->validate([
            'indikator_id' => 'required|exists:indikator_makros,id',
            'tahun' => 'required|integer|min:2000|max:2100',
            'nilai' => 'required|array',
            'nilai.*' => 'nullable|numeric',
        ]);

        $indikatorId = $request->indikator_id;
        $tahun = $request->tahun;
        $nilaiMap = $request->nilai;

        foreach ($nilaiMap as $namaDaerah => $val) {
            if ($val !== null && $val !== '' && (float)$val != 0) {
                DataIndikatorMakro::updateOrCreate(
                    [
                        'indikator_id' => $indikatorId,
                        'tahun' => $tahun,
                        'nama_daerah' => $namaDaerah,
                    ],
                    [
                        'nilai' => (float)$val,
                        'is_kota_tasik' => (trim($namaDaerah) === 'Kota Tasikmalaya'),
                    ]
                );
            } else {
                // Jika nilai 0, null, atau kosong, hapus record agar status menjadi Kosong
                DataIndikatorMakro::where('indikator_id', $indikatorId)
                    ->where('tahun', $tahun)
                    ->where('nama_daerah', $namaDaerah)
                    ->delete();
            }
        }

        return redirect()->route('admin.indikator-makro.index', ['tahun' => $tahun])
            ->with('success', "Berhasil menyimpan data 27 Kabupaten/Kota untuk Indikator tahun {$tahun}.");
    }
}
