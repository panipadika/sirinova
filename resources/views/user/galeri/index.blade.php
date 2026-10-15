<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Kegiatan & Dokumentasi - SI RINOVA Kota Tasikmalaya</title>
    <!-- Favicon Logo Tasikmalaya -->
    <link rel="icon" type="image/png" href="{{ asset('storage/images/favicon_tasik.png') }}?v=3">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=3">
    <link rel="apple-touch-icon" href="{{ asset('storage/images/favicon_tasik.png') }}?v=3">
    <meta name="description" content="Dokumentasi foto kegiatan, pameran, dan sosialisasi Teknologi Tepat Guna (TTG) Bappelitbangda Kota Tasikmalaya.">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">

    <!-- Material Symbols -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* Hide scrollbar completely */
        html, body {
            -ms-overflow-style: none !important;
            scrollbar-width: none !important;
        }
        html::-webkit-scrollbar,
        body::-webkit-scrollbar {
            display: none !important;
            width: 0 !important;
            height: 0 !important;
        }

        /* Card Hover Effect */
        .galeri-card {
            transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        .galeri-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 32px -8px rgba(41, 171, 226, 0.15), 0 6px 12px -4px rgba(0, 0, 0, 0.08);
        }
        .galeri-card:hover .galeri-img {
            transform: scale(1.06);
        }
        .galeri-card:hover .galeri-overlay {
            opacity: 1;
        }

        .galeri-img {
            transition: transform 0.5s ease;
        }
        .galeri-overlay {
            transition: opacity 0.3s ease;
        }

        /* Reveal animation */
        .reveal-up {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.5s ease-out, transform 0.5s ease-out;
        }
        .reveal-up.active {
            opacity: 1;
            transform: translateY(0);
        }

        /* Modal active animation */
        #lightbox-modal.active {
            display: flex !important;
            opacity: 1 !important;
        }

        /* Custom Styled Scrollbar for Galeri Modal Content */
        .custom-modal-scrollbar {
            scrollbar-width: thin;
            scrollbar-color: #29abe2 #f1f5f9;
        }

        .custom-modal-scrollbar::-webkit-scrollbar {
            width: 10px;
        }

        .custom-modal-scrollbar::-webkit-scrollbar-track {
            background-color: #f1f5f9;
            border-radius: 9999px;
            margin: 4px 0;
        }

        .custom-modal-scrollbar::-webkit-scrollbar-thumb {
            background-color: #29abe2;
            border-radius: 9999px;
            border: 2px solid #f1f5f9;
            transition: background-color 0.2s ease;
        }

        .custom-modal-scrollbar::-webkit-scrollbar-thumb:hover {
            background-color: #1a95c9;
        }
    </style>
</head>

<body class="bg-[#f8fafc] text-slate-800 antialiased min-h-screen flex flex-col justify-between selection:bg-[#29abe2] selection:text-white overflow-x-hidden">

    <!-- 1. NAVBAR / HEADER -->
    <header class="sticky top-0 z-40 bg-white/95 backdrop-blur-md border-b border-slate-100 shadow-xs transition-all">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">

            <!-- Logo & Brand Name -->
            <a href="/" class="flex items-center gap-3 group">
                <img src="{{ asset('storage/images/logo_tasik.png') }}"
                     alt="Logo Kota Tasikmalaya" class="h-10 w-auto object-contain group-hover:scale-105 transition-transform">
                <span class="text-xl sm:text-2xl font-black text-[#29abe2] tracking-tight">
                    SI RINOVA
                </span>
            </a>

            <!-- Desktop Navigation Links -->
            <nav class="hidden md:flex items-center gap-8 font-semibold text-sm">
                <a href="/" class="text-slate-600 hover:text-[#29abe2] transition-colors py-1">Beranda</a>
                <a href="{{ route('public.indikator-makro') }}" class="text-slate-600 hover:text-[#29abe2] transition-colors py-1">Indikator Makro</a>
                <!-- Dropdown Katalog -->
                <div class="relative group py-5">
                    <button class="flex items-center gap-1 text-slate-600 group-hover:text-[#29abe2] transition-colors font-semibold text-sm focus:outline-none">
                        <span>Katalog TTG</span>
                        <span class="material-symbols-outlined text-base transition-transform group-hover:rotate-180">expand_more</span>
                    </button>
                    <div class="absolute left-0 top-full w-52 bg-white rounded-xl shadow-xl border border-slate-100 py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                        <a href="{{ route('katalog.index') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-xs font-semibold text-slate-700 hover:bg-sky-50 hover:text-[#29abe2] transition-colors">
                            <span class="material-symbols-outlined text-base text-[#29abe2]">inventory_2</span>
                            <span>Alat TTG</span>
                        </a>
                        <a href="{{ route('public.kategori') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-xs font-semibold text-slate-700 hover:bg-sky-50 hover:text-[#29abe2] transition-colors">
                            <span class="material-symbols-outlined text-base text-[#29abe2]">category</span>
                            <span>Kategori Sektor</span>
                        </a>
                        <a href="{{ route('public.wilayah') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-xs font-semibold text-slate-700 hover:bg-sky-50 hover:text-[#29abe2] transition-colors">
                            <span class="material-symbols-outlined text-base text-[#29abe2]">map</span>
                            <span>Sebaran Wilayah</span>
                        </a>
                    </div>
                </div>

                <a href="{{ route('public.ebook') }}" class="text-slate-600 hover:text-[#29abe2] transition-colors py-1">E-Book Kajian</a>
                <a href="{{ route('public.telaahan-staf') }}" class="text-slate-600 hover:text-[#29abe2] transition-colors py-1">Telaahan Staf</a>
                <a href="{{ route('public.galeri') }}" class="text-[#29abe2] border-b-2 border-[#29abe2] pb-1 transition-colors">Galeri</a>
                <a href="{{ route('lomba.info') }}" class="text-amber-500 hover:text-amber-600 transition-colors py-1 flex items-center gap-1 font-bold">
                    <span class="material-symbols-outlined text-base">emoji_events</span>
                    <span>Lomba TTG</span>
                </a>
                <a href="{{ route('public.tentang') }}" class="text-slate-600 hover:text-[#29abe2] transition-colors py-1">Tentang</a>
            </nav>

            <!-- Mobile Menu Toggle Button -->
            <button id="mobile-menu-btn" class="md:hidden text-slate-700 hover:text-[#29abe2] p-2 focus:outline-none">
                <span class="material-symbols-outlined text-2xl">menu</span>
            </button>
        </div>

        <!-- Mobile Nav Menu Dropdown -->
        <div id="mobile-nav" class="hidden md:hidden bg-white border-b border-slate-200 px-6 py-4 space-y-3 font-semibold text-sm">
            <a href="/" class="block text-slate-600">Beranda</a>
            <a href="{{ route('public.indikator-makro') }}" class="block text-slate-600 hover:text-[#29abe2]">Indikator Makro</a>
            <div class="py-0.5">
                <button id="mobile-katalog-btn" type="button" class="w-full flex items-center justify-between text-xs font-bold text-slate-600 uppercase tracking-wider focus:outline-none transition-colors py-1">
                    <span>Katalog TTG</span>
                    <span id="mobile-katalog-icon" class="material-symbols-outlined text-base transition-transform duration-200">expand_more</span>
                </button>
                <div id="mobile-katalog-sub" class="hidden space-y-2 pt-1.5 pl-3">
                    <a href="{{ route('katalog.index') }}" class="block text-slate-600 hover:text-[#29abe2]">Alat TTG</a>
                    <a href="{{ route('public.kategori') }}" class="block text-slate-600 hover:text-[#29abe2]">Kategori Sektor</a>
                    <a href="{{ route('public.wilayah') }}" class="block text-slate-600 hover:text-[#29abe2]">Sebaran Wilayah</a>
                </div>
            </div>
            <a href="{{ route('public.ebook') }}" class="block text-slate-600">E-Book Kajian</a>
            <a href="{{ route('public.telaahan-staf') }}" class="block text-slate-600">Telaahan Staf</a>
            <a href="{{ route('public.galeri') }}" class="block text-[#29abe2] font-bold">Galeri</a>
            <a href="{{ route('lomba.info') }}" class="flex items-center gap-1.5 text-amber-500 font-bold">
                <span class="material-symbols-outlined text-base">emoji_events</span>
                <span>Lomba TTG</span>
            </a>
            <a href="{{ route('public.tentang') }}" class="block text-slate-600">Tentang</a>
        </div>
    </header>

    <!-- 2. HERO & SEARCH SECTION -->
    <section class="relative bg-gradient-to-b from-sky-50/60 via-white to-[#f8fafc] pt-12 pb-14 overflow-hidden border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">

            <!-- Title & Subtitle -->
            <div class="text-center max-w-3xl mx-auto space-y-3 reveal-up">
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 tracking-tight leading-tight">
                    Galeri <span class="text-[#29abe2]">Kegiatan & Dokumentasi</span>
                </h1>
                <p class="text-slate-500 text-sm sm:text-base leading-relaxed max-w-2xl mx-auto">
                    Dokumentasi ragam aktivitas, pameran inovasi, bimbingan teknis, serta pendampingan Teknologi Tepat Guna oleh Bappelitbangda Kota Tasikmalaya.
                </p>
            </div>

            <!-- Search & Filter Form -->
            <form action="{{ route('public.galeri') }}" method="GET" class="reveal-up mt-6 max-w-2xl mx-auto flex flex-col sm:flex-row items-center gap-3" id="galeri-search-form">
                <div class="relative flex items-center bg-white rounded-xl shadow-md shadow-slate-200/60 border border-slate-200 p-1.5 focus-within:border-[#29abe2] focus-within:ring-2 focus-within:ring-[#29abe2]/20 transition-all flex-1 w-full">
                    <span class="material-symbols-outlined text-slate-400 pl-2.5 pr-1 text-lg">search</span>
                    <input type="text" id="galeri-search-input" name="search" value="{{ $search ?? '' }}"
                           placeholder="Cari kegiatan, lokasi, atau deskripsi..."
                           class="w-full bg-transparent border-none text-slate-800 placeholder-slate-400 text-xs sm:text-sm focus:outline-none pr-2"
                           autocomplete="off">
                    <button type="button" id="clear-search-btn" class="{{ empty($search) ? 'hidden' : '' }} text-slate-400 hover:text-slate-600 pr-1.5 focus:outline-none transition-colors" title="Hapus pencarian">
                        <span class="material-symbols-outlined text-base">cancel</span>
                    </button>
                    <button type="submit"
                            class="bg-[#29abe2] hover:bg-[#1a95c9] text-white px-4 py-2 rounded-lg font-bold text-xs sm:text-sm transition-all shadow-xs shrink-0 flex items-center gap-1">
                        <span>Cari</span>
                    </button>
                </div>

                <!-- Dropdown Filter Tahun -->
                <div class="relative w-full sm:w-auto shrink-0">
                    <select name="tahun" onchange="this.form.submit()"
                            class="w-full sm:w-auto appearance-none bg-white border border-slate-200 text-slate-700 font-bold text-xs sm:text-sm pl-3.5 pr-8 py-2.5 rounded-xl cursor-pointer shadow-md shadow-slate-200/60 focus:outline-none focus:ring-2 focus:ring-[#29abe2]/20 hover:bg-slate-50 transition-all">
                        <option value="Semua" {{ (string)($selectedTahun ?? 'Semua') === 'Semua' ? 'selected' : '' }}>Semua Tahun</option>
                        @foreach($tahunList as $thn)
                            <option value="{{ $thn }}" {{ (string)($selectedTahun ?? '') === (string)$thn ? 'selected' : '' }}>
                                {{ $thn }}
                            </option>
                        @endforeach
                    </select>
                    <span class="material-symbols-outlined absolute right-2.5 top-1/2 -translate-y-1/2 text-slate-400 text-base pointer-events-none">expand_more</span>
                </div>
            </form>

            @if (!empty($search) || ($selectedTahun ?? 'Semua') !== 'Semua')
                <div class="reveal-up mt-5 inline-flex flex-wrap items-center justify-center gap-2.5 sm:gap-3.5 px-4 py-2 bg-white/90 backdrop-blur-md rounded-2xl border border-slate-200/80 shadow-xs text-xs text-slate-600 max-w-full">
                    <span class="flex items-center gap-1.5 font-medium">
                        <span class="material-symbols-outlined text-base text-[#29abe2]">tune</span>
                        <span>Filter aktif:
                            @if(!empty($search)) kata kunci <strong class="text-slate-900 font-bold">"{{ $search }}"</strong> @endif
                            @if(!empty($search) && ($selectedTahun ?? 'Semua') !== 'Semua') <span class="text-slate-300">•</span> @endif
                            @if(($selectedTahun ?? 'Semua') !== 'Semua') tahun <strong class="text-slate-900 font-bold">{{ $selectedTahun }}</strong> @endif
                        </span>
                    </span>
                    <a href="{{ route('public.galeri') }}"
                       class="inline-flex items-center gap-1 px-3 py-1 bg-rose-50 hover:bg-rose-100 text-rose-600 border border-rose-200/60 rounded-xl text-xs font-extrabold transition-all duration-200 shadow-2xs hover:shadow-xs active:scale-95">
                        <span class="material-symbols-outlined text-xs">close</span>
                        <span>Reset Filter</span>
                    </a>
                </div>
            @endif

        </div>
    </section>

    <!-- 3. MAIN GALLERY CONTENT -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-12 flex-1 w-full">

        @if ($galeris->count() > 0)
            <!-- Gallery Grid (2 COLUMNS MOBILE, 3 COLUMNS DESKTOP) -->
            <div id="galeri-grid" class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-6 lg:gap-8">
                @foreach ($galeris as $item)
                    @php
                        $tglFormat = \Carbon\Carbon::parse($item->tanggal_kegiatan)->locale('id')->isoFormat('D MMMM Y');
                        
                        // Kumpulkan semua foto (Utama + Pendukung)
                        $allPhotos = [];
                        if ($item->foto) {
                            $allPhotos[] = asset($item->foto);
                        }
                        if (is_array($item->foto_pendukung)) {
                            foreach ($item->foto_pendukung as $p) {
                                if ($p) {
                                    $allPhotos[] = asset($p);
                                }
                            }
                        }
                        if (empty($allPhotos)) {
                            $allPhotos[] = asset('storage/images/logo_tasik.png');
                        }

                        $mainFotoUrl = $allPhotos[0];
                    @endphp

                    <div class="galeri-card reveal-up bg-white rounded-xl sm:rounded-2xl border border-slate-100 shadow-sm overflow-hidden flex flex-col justify-between cursor-pointer group"
                         style="transition-delay: {{ ($loop->index % 3) * 80 }}ms;"
                         data-title="{{ $item->judul }}"
                         data-date="{{ $tglFormat }}"
                         data-location="{{ $item->lokasi ?? 'Kota Tasikmalaya' }}"
                         data-desc="{{ $item->deskripsi ?? '-' }}"
                         data-photos='@json($allPhotos)'
                         onclick="openGaleriModal(this)">

                        <div>
                            <!-- Photo Container -->
                            <div class="relative aspect-[4/3] sm:aspect-auto sm:h-56 w-full overflow-hidden bg-slate-100">
                                <img src="{{ $mainFotoUrl }}" alt="{{ $item->judul }}"
                                     class="galeri-img w-full h-full object-cover">
                                
                                <!-- Date Badge -->
                                <div class="absolute top-2 left-2 sm:top-3 sm:left-3 bg-white/90 backdrop-blur-md px-2 sm:px-3 py-0.5 sm:py-1 rounded-full text-[9px] sm:text-xs font-bold text-slate-700 shadow-xs flex items-center gap-0.5 sm:gap-1 max-w-[90%] truncate">
                                    <span class="material-symbols-outlined text-[10px] sm:text-xs text-[#29abe2] shrink-0">calendar_today</span>
                                    <span class="truncate">{{ $tglFormat }}</span>
                                </div>

                                <!-- Overlay on Hover -->
                                <div class="galeri-overlay absolute inset-0 bg-slate-900/40 opacity-0 flex items-center justify-center text-white backdrop-blur-[2px]">
                                    <span class="w-8 h-8 sm:w-12 sm:h-12 rounded-full bg-white/20 backdrop-blur-md flex items-center justify-center border border-white/40 shadow-lg">
                                        <span class="material-symbols-outlined text-lg sm:text-2xl">zoom_in</span>
                                    </span>
                                </div>
                            </div>

                            <!-- Card Body -->
                            <div class="p-3 sm:p-5 pb-0 sm:pb-0 space-y-1.5 sm:space-y-2 bg-white">
                                @if ($item->lokasi)
                                    <div class="flex items-center gap-0.5 sm:gap-1 text-[10px] sm:text-xs text-[#29abe2] font-semibold">
                                        <span class="material-symbols-outlined text-xs sm:text-sm shrink-0">location_on</span>
                                        <span class="truncate">{{ $item->lokasi }}</span>
                                    </div>
                                @endif

                                <h3 class="text-xs sm:text-base font-extrabold sm:font-bold text-slate-900 leading-snug line-clamp-2 hover:text-[#29abe2] transition-colors">
                                    {{ $item->judul }}
                                </h3>

                                @if ($item->deskripsi && trim($item->deskripsi) !== '-')
                                    <p class="hidden sm:block text-xs text-slate-500 mt-2 line-clamp-2 leading-relaxed text-justify">
                                        {{ $item->deskripsi }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        <!-- Action Button: Lihat Detail -->
                        <div class="p-3 sm:p-5 pt-2.5 sm:pt-4">
                            <button type="button"
                                    class="w-full flex items-center justify-center py-1.5 sm:py-2.5 px-2 sm:px-4 bg-sky-50 hover:bg-[#29abe2] text-[#29abe2] hover:text-white rounded-lg sm:rounded-full text-[10px] sm:text-sm font-bold transition-all duration-200 text-center shadow-2xs hover:shadow-md cursor-pointer">
                                <span>Lihat Detail</span>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Live Empty State Container -->
            <div id="live-empty-state" class="hidden bg-white rounded-3xl p-12 text-center border border-slate-100 shadow-sm max-w-lg mx-auto my-6">
                <div class="w-16 h-16 bg-sky-50 text-[#29abe2] rounded-full flex items-center justify-center mx-auto mb-4 border border-sky-100">
                    <span class="material-symbols-outlined text-3xl">search_off</span>
                </div>
                <h3 class="text-lg font-bold text-slate-900">Kegiatan Tidak Ditemukan</h3>
                <p class="text-slate-500 text-xs mt-1.5 leading-relaxed">
                    Tidak ada dokumentasi kegiatan yang cocok dengan kata kunci live pencarian Anda.
                </p>
            </div>

            <!-- 5. PAGINATION CONTAINER -->
            <div id="pagination-wrapper" class="mt-8">
                @include('partials.pagination', ['paginator' => $galeris, 'itemLabel' => 'Dokumentasi'])
            </div>

        @else
            <!-- Empty State -->
            <div class="bg-white rounded-3xl p-12 text-center border border-slate-100 shadow-sm max-w-lg mx-auto">
                <div class="w-20 h-20 bg-sky-50 text-[#29abe2] rounded-full flex items-center justify-center mx-auto mb-4 border border-sky-100">
                    <span class="material-symbols-outlined text-4xl">photo_library</span>
                </div>
                <h3 class="text-xl font-bold text-slate-900">Belum Ada Dokumentasi Kegiatan</h3>
                <p class="text-slate-500 text-sm mt-2 leading-relaxed">
                    @if(!empty($search))
                        Tidak ada foto kegiatan yang sesuai dengan kata kunci "{{ $search }}". Silakan coba kata kunci lain.
                    @else
                        Dokumentasi kegiatan dan foto pelaksanaan acara akan segera ditampilkan di halaman ini.
                    @endif
                </p>

                @if(!empty($search))
                    <a href="{{ route('public.galeri') }}"
                       class="inline-flex items-center gap-2 mt-6 px-6 py-2.5 bg-[#29abe2] hover:bg-[#1a95c9] text-white rounded-xl text-sm font-semibold transition-colors shadow-md shadow-[#29abe2]/20">
                        <span class="material-symbols-outlined text-base">refresh</span> Lihat Semua Dokumentasi
                    </a>
                @endif
            </div>
        @endif

    </main>

    <!-- 4. LIGHTBOX MODAL DETAIL DENGAN SLIDER AUTOMATIS & IKON CHEVRON < > -->
    <div id="lightbox-modal" class="fixed inset-0 z-50 hidden opacity-0 flex items-center justify-center p-4 sm:p-6 bg-slate-950/85 backdrop-blur-md transition-opacity duration-300">
        <div class="relative bg-white rounded-3xl max-w-3xl w-full overflow-hidden shadow-2xl border border-white/20 transform transition-all scale-95" id="modal-card">
            
            <!-- Modal Header -->
            <div class="p-4 sm:p-5 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                <div class="flex items-center gap-2 text-xs font-bold text-[#29abe2]">
                    <span class="material-symbols-outlined text-base">photo_library</span> Dokumentasi Kegiatan
                    <span id="modal-photo-counter" class="ml-2 px-2.5 py-0.5 bg-sky-100 text-[#29abe2] rounded-full text-[11px] font-extrabold">1 / 1</span>
                </div>
                <button onclick="closeLightbox()" class="w-8 h-8 rounded-full bg-slate-200/60 hover:bg-slate-200 text-slate-600 flex items-center justify-center transition-colors">
                    <span class="material-symbols-outlined text-lg">close</span>
                </button>
            </div>

            <!-- Modal Content (Slider + Details) -->
            <div class="p-4 sm:p-6 max-h-[85vh] overflow-y-auto space-y-4 custom-modal-scrollbar pr-3">
                
                <!-- SLIDER CONTAINER (Landscape Aspect Ratio Frame) -->
                <div class="relative w-full aspect-[16/9] sm:aspect-[16/10] max-h-[460px] rounded-2xl overflow-hidden bg-slate-950 shadow-md group flex items-center justify-center">
                    
                    <!-- Background Blurred Backdrop for Seamless Edge Fill -->
                    <img id="modal-img-bg" src="" class="absolute inset-0 w-full h-full object-cover blur-2xl opacity-40 scale-110 pointer-events-none transition-all duration-300">

                    <!-- Slide Image (Edge-to-edge Landscape Fit) -->
                    <img id="modal-img" src="" alt="Foto Kegiatan" onclick="openFullImage()" title="Klik untuk membuka resolusi penuh"
                         class="relative z-10 w-full h-full object-cover mx-auto transition-all duration-300 cursor-zoom-in">
                    
                    <!-- Buka Foto Ukuran Penuh Badge -->
                    <button onclick="openFullImage()" type="button" class="absolute top-3 left-3 bg-slate-900/75 hover:bg-[#29abe2] text-white backdrop-blur-md px-3 py-1.5 rounded-full text-[11px] font-semibold transition-all flex items-center gap-1.5 border border-white/10 shadow-sm z-20">
                        <span class="material-symbols-outlined text-sm">open_in_new</span>
                        <span>Resolusi Penuh</span>
                    </button>
                </div>

                <!-- THUMBNAIL STRIP -->
                <div id="modal-thumbnails" class="flex items-center gap-2 overflow-x-auto pb-1 no-scrollbar justify-center">
                    <!-- Dynamically rendered thumbnails -->
                </div>

                <!-- Info Header -->
                <div>
                    <h2 id="modal-title" class="text-xl sm:text-2xl font-bold text-slate-900 leading-tight"></h2>
                    
                    <div class="flex flex-wrap items-center gap-4 mt-3 text-xs sm:text-sm text-slate-600">
                        <span class="flex items-center gap-1 font-semibold text-slate-700">
                            <span class="material-symbols-outlined text-base text-[#29abe2]">calendar_today</span>
                            <span id="modal-date"></span>
                        </span>
                        <span class="flex items-center gap-1 font-semibold text-slate-700">
                            <span class="material-symbols-outlined text-base text-[#29abe2]">location_on</span>
                            <span id="modal-location"></span>
                        </span>
                    </div>
                </div>

                <!-- Description -->
                <div class="pt-3 border-t border-slate-100">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Deskripsi Kegiatan</p>
                    <p id="modal-desc" class="text-sm text-slate-700 leading-relaxed whitespace-pre-line text-justify"></p>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="p-4 bg-slate-50 border-t border-slate-100 flex justify-end">
                <button onclick="closeLightbox()"
                        class="px-5 py-2 bg-[#29abe2] hover:bg-[#1a95c9] text-white rounded-xl text-xs sm:text-sm font-semibold transition-colors shadow-xs">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <!-- FOOTER -->
    @include('partials.footer')


    <!-- JavaScript -->
    <script>
        // Scroll Reveal Animation
        document.addEventListener('DOMContentLoaded', () => {
            const revealElements = document.querySelectorAll('.reveal-up');

            const observerOptions = {
                root: null,
                rootMargin: '0px 0px -20px 0px',
                threshold: 0.1
            };

            const revealObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('active');
                    }
                });
            }, observerOptions);

            revealElements.forEach(el => revealObserver.observe(el));
        });

        // Mobile Navigation Toggle & Auto-Close
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileNav = document.getElementById('mobile-nav');
        const mobileKatalogBtn = document.getElementById('mobile-katalog-btn');
        const mobileKatalogSub = document.getElementById('mobile-katalog-sub');
        const mobileKatalogIcon = document.getElementById('mobile-katalog-icon');

        if (mobileMenuBtn && mobileNav) {
            mobileMenuBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                mobileNav.classList.toggle('hidden');
            });

            if (mobileKatalogBtn && mobileKatalogSub) {
                mobileKatalogBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    mobileKatalogSub.classList.toggle('hidden');
                    if (mobileKatalogIcon) {
                        mobileKatalogIcon.classList.toggle('rotate-180');
                    }
                });
            }

            document.addEventListener('click', (e) => {
                if (!mobileNav.classList.contains('hidden')) {
                    const isClickInsideNav = mobileNav.contains(e.target);
                    const isClickOnBtn = mobileMenuBtn.contains(e.target);
                    const isClickOnKatalogBtn = mobileKatalogBtn && mobileKatalogBtn.contains(e.target);
                    const isLinkClick = e.target.closest('a');

                    if (!isClickOnBtn && !isClickOnKatalogBtn) {
                        if (!isClickInsideNav || isLinkClick) {
                            mobileNav.classList.add('hidden');
                        }
                    }
                }
            });
        }

        // SLIDER CAROUSEL LOGIC FOR LIGHTBOX MODAL
        let currentGalleryPhotos = [];
        let currentSlideIndex = 0;
        let autoSlideTimer = null;

        function openGaleriModal(cardEl) {
            const title = cardEl.getAttribute('data-title') || '';
            const date = cardEl.getAttribute('data-date') || '';
            const location = cardEl.getAttribute('data-location') || '';
            const desc = cardEl.getAttribute('data-desc') || '';
            let photos = [];
            try {
                photos = JSON.parse(cardEl.getAttribute('data-photos') || '[]');
            } catch(e) {
                console.error('Error parsing photos JSON:', e);
            }
            openLightbox(title, date, location, desc, photos);
        }

        function openLightbox(title, date, location, desc, photos) {
            if (!Array.isArray(photos) || photos.length === 0) {
                photos = ['/storage/images/logo_tasik.png'];
            }

            currentGalleryPhotos = photos;
            currentSlideIndex = 0;

            document.getElementById('modal-title').innerText = title;
            document.getElementById('modal-date').innerText = date;
            document.getElementById('modal-location').innerText = location;
            document.getElementById('modal-desc').innerText = desc;

            renderSlide();

            const modal = document.getElementById('lightbox-modal');
            modal.classList.remove('hidden');
            void modal.offsetWidth; // Trigger reflow for smooth opacity transition
            modal.classList.remove('opacity-0');
            modal.classList.add('active', 'opacity-100');
            document.body.style.overflow = 'hidden';

            startAutoSlide();
        }

        function renderSlide() {
            if (currentGalleryPhotos.length === 0) return;
            const currentUrl = currentGalleryPhotos[currentSlideIndex];
            document.getElementById('modal-img').src = currentUrl;
            
            const bgImg = document.getElementById('modal-img-bg');
            if (bgImg) {
                bgImg.src = currentUrl;
            }

            // Counter Update
            const counterEl = document.getElementById('modal-photo-counter');
            if (counterEl) {
                counterEl.innerText = `${currentSlideIndex + 1} / ${currentGalleryPhotos.length}`;
            }



            // Render Thumbnails Strip
            const thumbContainer = document.getElementById('modal-thumbnails');
            if (thumbContainer) {
                if (currentGalleryPhotos.length <= 1) {
                    thumbContainer.innerHTML = '';
                } else {
                    thumbContainer.innerHTML = currentGalleryPhotos.map((url, idx) => `
                        <button type="button" onclick="goToSlide(${idx})" class="w-14 h-11 rounded-lg overflow-hidden border-2 transition-all shrink-0 cursor-pointer ${idx === currentSlideIndex ? 'border-[#29abe2] scale-105 shadow-md opacity-100' : 'border-transparent opacity-50 hover:opacity-100'}">
                            <img src="${url}" class="w-full h-full object-cover">
                        </button>
                    `).join('');
                }
            }
        }

        function nextSlide() {
            if (currentGalleryPhotos.length <= 1) return;
            currentSlideIndex = (currentSlideIndex + 1) % currentGalleryPhotos.length;
            renderSlide();
            resetAutoSlide();
        }

        function prevSlide() {
            if (currentGalleryPhotos.length <= 1) return;
            currentSlideIndex = (currentSlideIndex - 1 + currentGalleryPhotos.length) % currentGalleryPhotos.length;
            renderSlide();
            resetAutoSlide();
        }

        function goToSlide(index) {
            currentSlideIndex = index;
            renderSlide();
            resetAutoSlide();
        }

        function openFullImage() {
            if (currentGalleryPhotos.length > 0 && currentGalleryPhotos[currentSlideIndex]) {
                window.open(currentGalleryPhotos[currentSlideIndex], '_blank');
            }
        }

        function startAutoSlide() {
            stopAutoSlide();
            if (currentGalleryPhotos.length > 1) {
                autoSlideTimer = setInterval(() => {
                    currentSlideIndex = (currentSlideIndex + 1) % currentGalleryPhotos.length;
                    renderSlide();
                }, 3500); // Auto slide every 3.5 seconds
            }
        }

        function stopAutoSlide() {
            if (autoSlideTimer) {
                clearInterval(autoSlideTimer);
                autoSlideTimer = null;
            }
        }

        function resetAutoSlide() {
            startAutoSlide();
        }

        function closeLightbox() {
            stopAutoSlide();
            const modal = document.getElementById('lightbox-modal');
            modal.classList.remove('active', 'opacity-100');
            modal.classList.add('opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
            document.body.style.overflow = 'auto';
        }

        // Close Modal on backdrop click
        document.getElementById('lightbox-modal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeLightbox();
            }
        });

        // Close Modal on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeLightbox();
            }
        });

        // Instant Live Search Handler
        const searchInput = document.getElementById('galeri-search-input');
        const clearSearchBtn = document.getElementById('clear-search-btn');
        const galeriCards = document.querySelectorAll('.galeri-card');
        const liveEmptyState = document.getElementById('live-empty-state');
        const paginationWrapper = document.getElementById('pagination-wrapper');

        if (searchInput) {
            function filterGaleriLive() {
                const query = searchInput.value.toLowerCase().trim();
                let visibleCount = 0;

                if (clearSearchBtn) {
                    if (query.length > 0) {
                        clearSearchBtn.classList.remove('hidden');
                    } else {
                        clearSearchBtn.classList.add('hidden');
                    }
                }

                galeriCards.forEach(card => {
                    const title = card.getAttribute('data-title') || '';
                    const location = card.getAttribute('data-location') || '';
                    const desc = card.getAttribute('data-desc') || '';
                    const fullText = title + ' ' + location + ' ' + desc;

                    if (query === '' || fullText.includes(query)) {
                        card.style.display = '';
                        visibleCount++;
                    } else {
                        card.style.display = 'none';
                    }
                });

                if (liveEmptyState) {
                    if (visibleCount === 0 && galeriCards.length > 0) {
                        liveEmptyState.classList.remove('hidden');
                        if (paginationWrapper) paginationWrapper.classList.add('hidden');
                    } else {
                        liveEmptyState.classList.add('hidden');
                        if (paginationWrapper && query === '') paginationWrapper.classList.remove('hidden');
                    }
                }
            }

            searchInput.addEventListener('input', filterGaleriLive);

            if (clearSearchBtn) {
                clearSearchBtn.addEventListener('click', function() {
                    searchInput.value = '';
                    filterGaleriLive();
                    searchInput.focus();
                });
            }
        }
    </script>
</body>

</html>
