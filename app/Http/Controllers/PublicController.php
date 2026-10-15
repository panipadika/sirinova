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
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class PublicController extends Controller
{
    public function index(Request $request)
    {
        // 1. Stat Counts
        $totalAlat = AlatTtg::where('status_publikasi', 'Publik')->count();
        $totalKategori = Kategori::count();
        $totalInovator = Inovator::count();
        $totalWilayah = Wilayah::count();
        $totalIndikator = IndikatorMakro::count();
        $totalEbook = Ebook::count();
        $totalTelaahanStaf = TelaahanStaf::where('status', 'Dipublikasikan')->count();
        $totalGaleri = Galeri::where('status', 'Dipublikasikan')->count();

        // 2. Kategori List for Filter Pills
        $kategoriList = Kategori::all();

        // 3. Query Alat TTG (Support Search & Kategori Filter)
        $query = AlatTtg::with(['inovator', 'kategori', 'wilayah'])
            ->where('status_publikasi', 'Publik');

        // Pencarian berdasarkan Nama Alat, Inovator, Kategori, atau Wilayah
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_alat', 'like', "%{$search}%")
                  ->orWhereHas('inovator', function ($q2) use ($search) {
                      $q2->where('nama_inovator', 'like', "%{$search}%");
                  })
                  ->orWhereHas('kategori', function ($q3) use ($search) {
                      $q3->where('nama_kategori', 'like', "%{$search}%");
                  })
                  ->orWhereHas('wilayah', function ($q4) use ($search) {
                      $q4->where('nama_kecamatan', 'like', "%{$search}%");
                  });
            });
        }

        // Filter berdasarkan ID Kategori
        if ($request->filled('kategori')) {
            if ($request->kategori != 'semua') {
                $query->where('id_kategori', $request->kategori);
            }
        }

        $alatList = $query->orderBy('id', 'desc')->take(4)->get();

        // 4. Latest E-Books (4 Latest)
        $latestEbooks = Ebook::orderBy('id', 'desc')->take(4)->get();

        // 5. Latest Telaahan Staf (3 Latest)
        $latestTelaahanStaf = TelaahanStaf::where('status', 'Dipublikasikan')->orderBy('id', 'desc')->take(3)->get();

        // 6. Latest Galeri Activities
        $galeriList = Galeri::where('status', 'Dipublikasikan')->orderBy('id', 'desc')->take(6)->get();

        return view('user.welcome', compact(
            'totalAlat',
            'totalKategori',
            'totalInovator',
            'totalWilayah',
            'totalIndikator',
            'totalEbook',
            'totalTelaahanStaf',
            'totalGaleri',
            'kategoriList',
            'alatList',
            'latestEbooks',
            'latestTelaahanStaf',
            'galeriList'
        ));
    }

    public function katalog(Request $request)
    {
        $kategoriList = Kategori::all();
        $wilayahList = Wilayah::all();
        $tahunList = AlatTtg::where('status_publikasi', 'Publik')
            ->whereNotNull('tahun_produksi')
            ->distinct()
            ->orderBy('tahun_produksi', 'desc')
            ->pluck('tahun_produksi');

        $query = AlatTtg::with(['inovator', 'kategori', 'wilayah'])
            ->where('status_publikasi', 'Publik');

        // Pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_alat', 'like', "%{$search}%")
                  ->orWhereHas('inovator', function ($q2) use ($search) {
                      $q2->where('nama_inovator', 'like', "%{$search}%");
                  })
                  ->orWhereHas('kategori', function ($q3) use ($search) {
                      $q3->where('nama_kategori', 'like', "%{$search}%");
                  })
                  ->orWhereHas('wilayah', function ($q4) use ($search) {
                      $q4->where('nama_kecamatan', 'like', "%{$search}%");
                  });
            });
        }

        // Filter Kategori
        if ($request->filled('kategori') && $request->kategori != 'semua') {
            $query->where('id_kategori', $request->kategori);
        }

        // Filter Wilayah
        if ($request->filled('wilayah') && $request->wilayah != 'semua') {
            $query->where('id_wilayah', $request->wilayah);
        }

        // Filter Tahun
        if ($request->filled('tahun') && $request->tahun != 'semua') {
            $query->where('tahun_produksi', $request->tahun);
        }

        // Sort / Urutan
        $sort = $request->get('sort', 'terbaru');
        if ($sort === 'terlama') {
            $query->orderBy('id', 'asc');
        } elseif ($sort === 'nama_asc') {
            $query->orderBy('nama_alat', 'asc');
        } elseif ($sort === 'nama_desc') {
            $query->orderBy('nama_alat', 'desc');
        } else {
            $query->orderBy('id', 'desc');
        }

        $perPage = in_array((int)$request->input('per_page'), [8, 12, 16, 24, 48, 80]) ? (int)$request->input('per_page') : 8;
        $alatList = $query->paginate($perPage)->appends($request->all());

        return view('user.katalog.index', compact(
            'kategoriList',
            'wilayahList',
            'tahunList',
            'alatList'
        ));
    }

    public function kategoriPage(Request $request)
    {
        $query = Kategori::withCount(['alatTtg' => function ($q) {
            $q->where('status_publikasi', 'Publik');
        }]);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_kategori', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        $kategoriList = $query->get();

        return view('user.kategori.index', compact('kategoriList'));
    }

    public function kategoriDetail(Request $request, $id)
    {
        $kategori = Kategori::withCount(['alatTtg' => function ($q) {
            $q->where('status_publikasi', 'Publik');
        }])->findOrFail($id);

        $wilayahList = Wilayah::all();

        $query = AlatTtg::with(['inovator', 'kategori', 'wilayah'])
            ->where('id_kategori', $id)
            ->where('status_publikasi', 'Publik');

        // Filter Wilayah
        if ($request->filled('wilayah') && $request->wilayah != 'semua') {
            $query->where('id_wilayah', $request->wilayah);
        }

        // Sort / Urutan
        $sort = $request->get('sort', 'terbaru');
        if ($sort === 'terlama') {
            $query->orderBy('id', 'asc');
        } elseif ($sort === 'nama_asc') {
            $query->orderBy('nama_alat', 'asc');
        } elseif ($sort === 'nama_desc') {
            $query->orderBy('nama_alat', 'desc');
        } else {
            $query->orderBy('id', 'desc');
        }

        $perPage = in_array((int)$request->input('per_page'), [8, 12, 16, 24, 48, 80]) ? (int)$request->input('per_page') : 8;
        $alatList = $query->paginate($perPage)->appends($request->all());

        return view('user.kategori.detail', compact('kategori', 'wilayahList', 'alatList'));
    }

    public function wilayahPage(Request $request)
    {
        $query = Wilayah::withCount(['alatTtg' => function ($q) {
            $q->where('status_publikasi', 'Publik');
        }]);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('nama_kecamatan', 'like', "%{$search}%");
        }

        $wilayahList = $query->get();

        return view('user.wilayah.index', compact('wilayahList'));
    }

    public function wilayahDetail(Request $request, $id)
    {
        $wilayah = Wilayah::withCount(['alatTtg' => function ($q) {
            $q->where('status_publikasi', 'Publik');
        }])->findOrFail($id);

        $kategoriList = Kategori::all();

        $query = AlatTtg::with(['inovator', 'kategori', 'wilayah'])
            ->where('id_wilayah', $id)
            ->where('status_publikasi', 'Publik');

        // Filter Kategori
        if ($request->filled('kategori') && $request->kategori != 'semua') {
            $query->where('id_kategori', $request->kategori);
        }

        // Sort / Urutan
        $sort = $request->get('sort', 'terbaru');
        if ($sort === 'terlama') {
            $query->orderBy('id', 'asc');
        } elseif ($sort === 'nama_asc') {
            $query->orderBy('nama_alat', 'asc');
        } elseif ($sort === 'nama_desc') {
            $query->orderBy('nama_alat', 'desc');
        } else {
            $query->orderBy('id', 'desc');
        }

        $perPage = in_array((int)$request->input('per_page'), [8, 12, 16, 24, 48, 80]) ? (int)$request->input('per_page') : 8;
        $alatList = $query->paginate($perPage)->appends($request->all());

        return view('user.wilayah.detail', compact('wilayah', 'kategoriList', 'alatList'));
    }

    public function tentangPage()
    {
        $totalAlat = AlatTtg::where('status_publikasi', 'Publik')->count();
        $totalKategori = Kategori::count();
        $totalInovator = Inovator::count();
        $totalWilayah = Wilayah::count();
        $totalEbook = Ebook::count();
        $totalTelaahanStaf = TelaahanStaf::where('status', 'Dipublikasikan')->count();
        $totalGaleri = Galeri::where('status', 'Dipublikasikan')->count();

        return view('user.tentang', compact(
            'totalAlat',
            'totalKategori',
            'totalInovator',
            'totalWilayah',
            'totalEbook',
            'totalTelaahanStaf',
            'totalGaleri'
        ));
    }

    public function ebookPage(Request $request)
    {
        $selectedKategori = $request->get('kategori', 'Semua');
        $selectedTahun = $request->get('tahun', 'Semua');
        $search = $request->get('search', '');

        $kategoriFilter = ['Semua', 'Ekonomi', 'Lingkungan', 'Pendidikan', 'Kesehatan', 'Infrastruktur', 'Lainnya'];
        
        $query = Ebook::query();

        if ($selectedKategori !== 'Semua') {
            $query->where('kategori', $selectedKategori);
        }

        if ($selectedTahun !== 'Semua') {
            $query->where('tahun', $selectedTahun);
        }

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        $allYears = Ebook::select('tahun')->distinct()->whereNotNull('tahun')->where('tahun', '!=', '')->pluck('tahun')->sortDesc()->values()->toArray();
        $tahunFilter = array_merge(['Semua'], $allYears);

        $perPage = in_array((int)$request->input('per_page'), [5, 10, 20, 30, 50, 100]) ? (int)$request->input('per_page') : 10;
        $ebooks = $query->latest()->paginate($perPage)->appends($request->all());

        return view('user.ebook.index', compact('ebooks', 'kategoriFilter', 'selectedKategori', 'tahunFilter', 'selectedTahun', 'search'));
    }

    public function ebookDetail($id)
    {
        $ebook = Ebook::findOrFail($id);
        return view('user.ebook.detail', compact('ebook'));
    }

    public function show($id)
    {
        $item = AlatTtg::with(['inovator', 'kategori', 'wilayah'])
            ->where('status_publikasi', 'Publik')
            ->findOrFail($id);
        return view('user.katalog.detail', compact('item'));
    }

    public function detail($id)
    {
        $item = AlatTtg::with(['inovator', 'kategori', 'wilayah'])
            ->where('status_publikasi', 'Publik')
            ->findOrFail($id);
        return response()->json($item);
    }

    public function telaahanStafPage(Request $request)
    {
        $search = $request->input('search', '');
        $selectedTahun = $request->input('tahun', 'Semua');

        $tahunList = TelaahanStaf::where('status', 'Dipublikasikan')
            ->whereNotNull('tahun_dokumen')
            ->distinct()
            ->orderBy('tahun_dokumen', 'desc')
            ->pluck('tahun_dokumen')
            ->filter()
            ->values()
            ->toArray();

        $query = TelaahanStaf::where('status', 'Dipublikasikan');

        if ($selectedTahun !== 'Semua' && !empty($selectedTahun)) {
            $query->where('tahun_dokumen', $selectedTahun);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('ringkasan', 'like', "%{$search}%")
                  ->orWhere('pembuat_bidang', 'like', "%{$search}%");
            });
        }

        $perPage = in_array((int)$request->input('per_page'), [6, 12, 18, 24, 48]) ? (int)$request->input('per_page') : 6;
        $telaahanStafs = $query->orderBy('tahun_dokumen', 'desc')->latest('dibuat_pada')->paginate($perPage)->appends($request->all());

        return view('user.telaahan-staf.index', compact('telaahanStafs', 'search', 'tahunList', 'selectedTahun'));
    }

    public function telaahanStafDetail($id)
    {
        $dokumen = TelaahanStaf::where('status', 'Dipublikasikan')->findOrFail($id);
        $terkait = TelaahanStaf::where('status', 'Dipublikasikan')
            ->where('id', '!=', $id)
            ->orderBy('tahun_dokumen', 'desc')
            ->latest('dibuat_pada')
            ->take(3)
            ->get();

        return view('user.telaahan-staf.detail', compact('dokumen', 'terkait'));
    }

    public function galeriPage(Request $request)
    {
        $search = $request->input('search', '');
        $selectedTahun = $request->input('tahun', 'Semua');

        $tahunList = Galeri::where('status', 'Dipublikasikan')
            ->whereNotNull('tanggal_kegiatan')
            ->selectRaw('YEAR(tanggal_kegiatan) as thn')
            ->distinct()
            ->orderBy('thn', 'desc')
            ->pluck('thn')
            ->filter()
            ->values()
            ->toArray();

        $query = Galeri::where('status', 'Dipublikasikan');

        if ($selectedTahun !== 'Semua' && !empty($selectedTahun)) {
            $query->whereYear('tanggal_kegiatan', $selectedTahun);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('lokasi', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        $perPage = in_array((int)$request->input('per_page'), [6, 12, 18, 24, 48]) ? (int)$request->input('per_page') : 6;
        $galeris = $query->latest('tanggal_kegiatan')->paginate($perPage)->appends($request->all());

        return view('user.galeri.index', compact('galeris', 'search', 'tahunList', 'selectedTahun'));
    }

    public function galeriDetail($id)
    {
        $galeri = Galeri::where('status', 'Dipublikasikan')->findOrFail($id);
        return response()->json($galeri);
    }

    public function indikatorMakroPage(Request $request)
    {
        $indikatorList = IndikatorMakro::orderBy('urutan', 'asc')->orderBy('id', 'asc')->get();
        
        $tahunList = DataIndikatorMakro::select('tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun')
            ->toArray();

        if (empty($tahunList)) {
            $tahunList = [(int)date('Y')];
        }

        $selectedTahun = $request->get('tahun', $tahunList[0]);
        $selectedIndikator = $request->get('indikator', 'Semua');

        $activeIndikatorNama = null;

        $targetIndikators = $indikatorList;
        if ($selectedIndikator !== 'Semua' && !empty($selectedIndikator)) {
            $filtered = $indikatorList->where('id', (int)$selectedIndikator);
            if ($filtered->count() > 0) {
                $targetIndikators = $filtered;
                $activeObj = $filtered->first();
                $activeIndikatorNama = $activeObj->nama_indikator;
            }
        }

        $chartsData = [];

        foreach ($targetIndikators as $indikator) {
            $data = DataIndikatorMakro::where('indikator_id', $indikator->id)
                ->where('tahun', $selectedTahun)
                ->orderBy('nilai', 'desc')
                ->get();

            // Kota Tasikmalaya data record
            $tasikRecord = $data->firstWhere('is_kota_tasik', true);

            $chartsData[] = [
                'indikator' => $indikator,
                'data' => $data,
                'tasikRecord' => $tasikRecord,
                'labels' => $data->pluck('nama_daerah')->toArray(),
                'values' => $data->pluck('nilai')->toArray(),
                'isTasik' => $data->pluck('is_kota_tasik')->toArray(),
            ];
        }

        return view('user.indikator-makro.index', compact(
            'indikatorList',
            'tahunList',
            'selectedTahun',
            'selectedIndikator',
            'activeIndikatorNama',
            'chartsData'
        ));
    }
}
