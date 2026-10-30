<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Alat TTG - Kota Tasikmalaya</title>
    <!-- Favicon Logo Tasikmalaya -->
    <link rel="icon" type="image/png" href="{{ asset('storage/images/favicon_tasik.png') }}?v=3">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=3">
    <link rel="apple-touch-icon" href="{{ asset('storage/images/favicon_tasik.png') }}?v=3">

    <!-- Google Fonts: Inter & Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">

    <!-- Material Symbols -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

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

        /* Hide scrollbar completely for all browsers */
        html, body {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        html::-webkit-scrollbar,
        body::-webkit-scrollbar {
            display: none;
            width: 0;
            height: 0;
        }

        .line-clamp-2 {
            display: -webkit-box !important;
            -webkit-line-clamp: 2 !important;
            -webkit-box-orient: vertical !important;
            overflow: hidden !important;
        }

        /* ========================================================
           SCROLL REVEAL ANIMATIONS
           ======================================================== */
        .reveal {
            opacity: 0;
            transform: translateY(35px);
            transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1), transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
            will-change: opacity, transform;
        }

        .reveal-left {
            opacity: 0;
            transform: translateX(-45px);
            transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1), transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
            will-change: opacity, transform;
        }

        .reveal-right {
            opacity: 0;
            transform: translateX(45px);
            transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1), transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
            will-change: opacity, transform;
        }

        .reveal-zoom {
            opacity: 0;
            transform: scale(0.92);
            transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1), transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
            will-change: opacity, transform;
        }

        .reveal.active,
        .reveal-left.active,
        .reveal-right.active,
        .reveal-zoom.active {
            opacity: 1;
            transform: translateY(0) translateX(0) scale(1);
        }

        /* Stagger Delays */
        .delay-100 { transition-delay: 0.1s; }
        .delay-200 { transition-delay: 0.2s; }
        .delay-300 { transition-delay: 0.3s; }
        .delay-400 { transition-delay: 0.4s; }
    </style>
</head>

<body class="bg-slate-50 text-slate-800 antialiased min-h-screen flex flex-col justify-between selection:bg-[#00A3E0] selection:text-white overflow-x-hidden">

    <!-- 1. NAVBAR / HEADER -->
    <header class="sticky top-0 z-40 bg-white/95 backdrop-blur-md border-b border-slate-100 shadow-xs transition-all">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">

            <!-- Logo & Brand Name -->
            <a href="/" class="flex items-center gap-3 group">
                <img src="{{ asset('storage/images/logo_tasik.png') }}"
                     alt="Logo Kota Tasikmalaya" class="h-10 w-auto object-contain group-hover:scale-105 transition-transform">
                <span class="text-xl sm:text-2xl font-black text-[#00A3E0] tracking-tight">
                    SI RINOVA
                </span>
            </a>

            <!-- Desktop Navigation Links -->
            <nav class="hidden md:flex items-center gap-8 font-semibold text-sm">
                <a href="/" class="text-slate-600 hover:text-[#00A3E0] transition-colors py-1">Beranda</a>
                <a href="{{ route('public.indikator-makro') }}" class="text-slate-600 hover:text-[#00A3E0] transition-colors py-1">Indikator Makro</a>
                
                <!-- Dropdown Katalog -->
                <div class="relative group py-5">
                    <button class="flex items-center gap-1 text-[#00A3E0] border-b-2 border-[#00A3E0] pb-1 transition-colors font-bold text-sm focus:outline-none">
                        <span>Katalog TTG</span>
                        <span class="material-symbols-outlined text-base transition-transform group-hover:rotate-180">expand_more</span>
                    </button>
                    <div class="absolute left-0 top-full w-52 bg-white rounded-xl shadow-xl border border-slate-100 py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                        <a href="{{ route('katalog.index') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-xs font-bold text-[#00A3E0] bg-sky-50/70 transition-colors">
                            <span class="material-symbols-outlined text-base text-[#00A3E0]">inventory_2</span>
                            <span>Alat TTG</span>
                        </a>
                        <a href="{{ route('public.kategori') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-xs font-semibold text-slate-700 hover:bg-sky-50 hover:text-[#00A3E0] transition-colors">
                            <span class="material-symbols-outlined text-base text-[#00A3E0]">category</span>
                            <span>Kategori Sektor</span>
                        </a>
                        <a href="{{ route('public.wilayah') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-xs font-semibold text-slate-700 hover:bg-sky-50 hover:text-[#00A3E0] transition-colors">
                            <span class="material-symbols-outlined text-base text-[#00A3E0]">map</span>
                            <span>Sebaran Wilayah</span>
                        </a>
                    </div>
                </div>

                <a href="{{ route('public.ebook') }}" class="text-slate-600 hover:text-[#00A3E0] transition-colors py-1">E-Book Kajian</a>
                <a href="{{ route('public.telaahan-staf') }}" class="text-slate-600 hover:text-[#00A3E0] transition-colors py-1">Telaahan Staf</a>
                <a href="{{ route('public.galeri') }}" class="text-slate-600 hover:text-[#00A3E0] transition-colors py-1">Galeri</a>
                <a href="{{ route('lomba.info') }}" class="text-amber-500 hover:text-amber-600 transition-colors py-1 flex items-center gap-1 font-bold">
                    <span class="material-symbols-outlined text-base">emoji_events</span>
                    <span>Lomba TTG</span>
                </a>
                <a href="{{ route('public.tentang') }}" class="text-slate-600 hover:text-[#00A3E0] transition-colors py-1">Tentang</a>
            </nav>

            <!-- Mobile Menu Toggle Button -->
            <button id="mobile-menu-btn" class="md:hidden text-slate-700 hover:text-[#00A3E0] p-2 focus:outline-none">
                <span class="material-symbols-outlined text-2xl">menu</span>
            </button>
        </div>

        <!-- Mobile Nav Menu Dropdown -->
        <div id="mobile-nav" class="hidden md:hidden bg-white border-b border-slate-200 px-6 py-4 space-y-3 font-semibold text-sm">
            <a href="/" class="block text-slate-600">Beranda</a>
            <a href="{{ route('public.indikator-makro') }}" class="block text-slate-600 hover:text-[#00A3E0]">Indikator Makro</a>
            <div class="py-0.5">
                <button id="mobile-katalog-btn" type="button" class="w-full flex items-center justify-between text-xs font-bold text-[#00A3E0] uppercase tracking-wider focus:outline-none transition-colors py-1">
                    <span>Katalog TTG</span>
                    <span id="mobile-katalog-icon" class="material-symbols-outlined text-base transition-transform duration-200">expand_more</span>
                </button>
                <div id="mobile-katalog-sub" class="hidden space-y-2 pt-1.5 pl-3">
                    <a href="{{ route('katalog.index') }}" class="block text-[#00A3E0] font-bold">Alat TTG</a>
                    <a href="{{ route('public.kategori') }}" class="block text-slate-600 hover:text-[#00A3E0]">Kategori Sektor</a>
                    <a href="{{ route('public.wilayah') }}" class="block text-slate-600 hover:text-[#00A3E0]">Sebaran Wilayah</a>
                </div>
            </div>
            <a href="{{ route('public.ebook') }}" class="block text-slate-600">E-Book Kajian</a>
            <a href="{{ route('public.telaahan-staf') }}" class="block text-slate-600">Telaahan Staf</a>
            <a href="{{ route('public.galeri') }}" class="block text-slate-600">Galeri</a>
            <a href="{{ route('lomba.info') }}" class="flex items-center gap-1.5 text-amber-500 font-bold">
                <span class="material-symbols-outlined text-base">emoji_events</span>
                <span>Lomba TTG</span>
            </a>
            <a href="{{ route('public.tentang') }}" class="block text-slate-600">Tentang</a>
        </div>
    </header>

    <!-- MAIN CONTENT CONTAINER -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-14 flex-1 w-full space-y-10">

        <!-- 2. HERO HEADER SECTION -->
        <div class="text-center max-w-3xl mx-auto space-y-3 reveal-zoom">

            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 tracking-tight leading-tight">
                Katalog Alat <span class="text-[#00A3E0]">Teknologi Tepat Guna</span>
            </h1>
            <p class="text-slate-500 text-sm sm:text-base leading-relaxed max-w-2xl mx-auto">
                Jelajahi berbagai inovasi teknologi tepat guna yang dikembangkan di Kota Tasikmalaya untuk mendukung efisiensi dan produktivitas masyarakat.
            </p>
        </div>

        <!-- 3. SEARCH & FILTER CONTROLS CARD CONTAINER -->
        <div class="bg-white rounded-2xl border border-slate-100 shadow-[0_4px_25px_rgba(0,0,0,0.03)] p-4 sm:p-5 space-y-4 reveal">
            
            <form id="katalog-filter-form" onsubmit="event.preventDefault(); triggerKatalogFilter();">
                <!-- TOP CONTROLS ROW: SEARCH INPUT + DROPDOWNS -->
                <div class="grid grid-cols-2 md:grid-cols-12 gap-2.5 sm:gap-3.5 items-center">
                    
                    <!-- Search Input Field (Span 2 on mobile, Span 6 on MD) -->
                    <div class="col-span-2 md:col-span-6 relative">
                        <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-lg pointer-events-none">search</span>
                        <input type="text" id="katalog-search-input" name="search" value="{{ request('search') }}"
                               onkeyup="debounceKatalogFilter()"
                               placeholder="Cari nama alat, inovator, atau deskripsi..."
                               class="w-full pl-10 pr-3.5 py-2 sm:py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs sm:text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:border-[#00A3E0] focus:ring-2 focus:ring-[#00A3E0]/20 transition-all">
                    </div>

                    <!-- Dropdown Wilayah (Span 1 on mobile, Span 2 on MD) -->
                    <div class="col-span-1 md:col-span-2">
                        <select name="wilayah" id="katalog-wilayah-select" onchange="triggerKatalogFilter()"
                                class="w-full px-2.5 sm:px-3.5 py-2 sm:py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs sm:text-sm font-semibold text-slate-700 focus:outline-none focus:border-[#00A3E0] focus:ring-2 focus:ring-[#00A3E0]/20 transition-all cursor-pointer truncate">
                            <option value="semua">Semua Wilayah</option>
                            @foreach($wilayahList as $w)
                                <option value="{{ $w->id }}" {{ request('wilayah') == $w->id ? 'selected' : '' }}>
                                    Kec. {{ $w->nama_kecamatan }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Dropdown Tahun (Span 1 on mobile, Span 2 on MD) -->
                    <div class="col-span-1 md:col-span-2">
                        <select name="tahun" id="katalog-tahun-select" onchange="triggerKatalogFilter()"
                                class="w-full px-2.5 sm:px-3.5 py-2 sm:py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs sm:text-sm font-semibold text-slate-700 focus:outline-none focus:border-[#00A3E0] focus:ring-2 focus:ring-[#00A3E0]/20 transition-all cursor-pointer truncate">
                            <option value="semua">Semua Tahun</option>
                            @foreach($tahunList as $th)
                                <option value="{{ $th }}" {{ request('tahun') == $th ? 'selected' : '' }}>
                                    {{ $th }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Dropdown Sort Urutan (Span 2 on mobile, Span 2 on MD) -->
                    <div class="col-span-2 md:col-span-2">
                        <select name="sort" id="katalog-sort-select" onchange="triggerKatalogFilter()"
                                class="w-full px-2.5 sm:px-3.5 py-2 sm:py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs sm:text-sm font-semibold text-slate-700 focus:outline-none focus:border-[#00A3E0] focus:ring-2 focus:ring-[#00A3E0]/20 transition-all cursor-pointer truncate">
                            <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                            <option value="terlama" {{ request('sort') == 'terlama' ? 'selected' : '' }}>Terlama</option>
                            <option value="nama_asc" {{ request('sort') == 'nama_asc' ? 'selected' : '' }}>Nama (A-Z)</option>
                            <option value="nama_desc" {{ request('sort') == 'nama_desc' ? 'selected' : '' }}>Nama (Z-A)</option>
                        </select>
                    </div>

                </div>

                <!-- BOTTOM ROW: CATEGORY FILTER PILLS CHIPS -->
                <div class="flex items-center gap-1.5 sm:gap-2 overflow-x-auto p-1.5 [scrollbar-width:none] [-ms-overflow-style:none] [&::-webkit-scrollbar]:hidden">
                    <input type="hidden" name="kategori" id="katalog-kategori-input" value="{{ request('kategori', 'semua') }}">

                    <button type="button" onclick="setKatalogKategori('semua')"
                            class="kategori-pill px-3.5 py-1.5 rounded-xl text-xs font-bold transition-all shrink-0 {{ request('kategori', 'semua') == 'semua' ? 'bg-[#00A3E0] text-white shadow-xs' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}"
                            data-kat="semua">
                        Semua Kategori
                    </button>

                    @foreach($kategoriList as $kat)
                        <button type="button" onclick="setKatalogKategori('{{ $kat->id }}')"
                                class="kategori-pill px-3.5 py-1.5 rounded-xl text-xs font-bold transition-all shrink-0 {{ request('kategori') == $kat->id ? 'bg-[#00A3E0] text-white shadow-xs' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}"
                                data-kat="{{ $kat->id }}">
                            {{ $kat->nama_kategori }}
                        </button>
                    @endforeach
                </div>
            </form>

        </div>

        <!-- 4. CATALOG GRID SECTION (4 COLUMNS DESKTOP) -->
        <div id="katalog-grid-wrapper" class="space-y-8">
            <div id="katalog-grid" class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-5 lg:gap-6">
                @forelse($alatList as $index => $item)
                    @php
                        $delayClass = 'delay-' . (($index % 4 + 1) * 100);
                    @endphp
                    <div class="bg-white rounded-xl sm:rounded-3xl border border-slate-100 shadow-[0_4px_20px_rgba(0,0,0,0.02)] hover:shadow-2xl hover:-translate-y-2 hover:border-[#00A3E0]/40 transition-all duration-300 overflow-hidden flex flex-col justify-between group reveal {{ $delayClass }}">
                        
                        <!-- Image Container with Floating Category Badge -->
                        <div>
                            <div class="relative w-full aspect-[4/3] bg-slate-100 overflow-hidden">
                                @if($item->foto)
                                    <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama_alat }}"
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                         onerror="this.src='https://placehold.co/600x400?text=Alat+TTG'">
                                @else
                                    <div class="w-full h-full flex flex-col items-center justify-center text-slate-400 gap-1 bg-slate-100">
                                        <span class="material-symbols-outlined text-2xl sm:text-4xl text-slate-300">inventory_2</span>
                                        <span class="text-[9px] sm:text-[10px] font-semibold">Tidak ada foto</span>
                                    </div>
                                @endif

                                <!-- Category Badge Pill (Top Left Over Image) -->
                                <span class="absolute top-2 left-2 sm:top-3 sm:left-3 bg-white/95 backdrop-blur-md text-[#00A3E0] text-[9px] sm:text-[10px] font-extrabold px-2 py-0.5 sm:px-3 sm:py-1 rounded-full shadow-xs uppercase tracking-wider">
                                    {{ $item->kategori->nama_kategori ?? 'Umum' }}
                                </span>
                            </div>

                            <!-- Card Body Info -->
                            <div class="p-3 sm:p-5 space-y-1.5 sm:space-y-3">
                                <h3 class="font-extrabold text-slate-900 text-xs sm:text-base leading-snug line-clamp-2 min-h-[2.25rem] sm:min-h-[2.75rem] group-hover:text-[#00A3E0] transition-colors flex items-start">
                                    <a href="{{ route('katalog.show', $item->id) }}">
                                        {{ $item->nama_alat }}
                                    </a>
                                </h3>
                                
                                <p class="hidden sm:block text-slate-500 text-xs leading-relaxed line-clamp-2 sm:min-h-[2.25rem]">
                                    {{ Str::limit($item->deskripsi ?? 'Tidak ada deskripsi singkat.', 90, '...') }}
                                </p>

                                <!-- Metadata info -->
                                <div class="pt-2 sm:pt-3 space-y-1 sm:space-y-1.5 text-[10px] sm:text-xs text-slate-500 font-medium border-t border-slate-100">
                                    <p class="flex items-center gap-1 sm:gap-2 truncate">
                                        <span class="material-symbols-outlined text-sm sm:text-base text-slate-400 shrink-0">person</span>
                                        <span class="truncate"><span class="hidden sm:inline">Inovator: </span><strong class="text-slate-800 font-semibold">{{ $item->inovator->nama_inovator ?? 'Inovator Mandiri' }}</strong></span>
                                    </p>
                                    <p class="flex items-center gap-1 sm:gap-2 truncate">
                                        <span class="material-symbols-outlined text-sm sm:text-base text-slate-400 shrink-0">location_on</span>
                                        <span class="truncate">Kec. <strong class="text-slate-800 font-semibold">{{ $item->wilayah->nama_kecamatan ?? 'Tasikmalaya' }}</strong></span>
                                    </p>
                                    <p class="flex items-center gap-1 sm:gap-2">
                                        <span class="material-symbols-outlined text-sm sm:text-base text-slate-400 shrink-0">calendar_today</span>
                                        <span>Tahun <strong class="text-slate-800 font-semibold">{{ $item->tahun_produksi ?? '-' }}</strong></span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Card Footer CTA Button -->
                        <div class="p-3 sm:p-5 pt-0">
                            <a href="{{ route('katalog.show', $item->id) }}"
                               class="w-full py-1.5 sm:py-2.5 px-2 sm:px-4 bg-sky-50 hover:bg-[#00A3E0] text-[#00A3E0] hover:text-white rounded-lg sm:rounded-xl text-[10px] sm:text-xs font-bold transition-all text-center flex items-center justify-center gap-1 group-hover:shadow-md">
                                <span>Lihat Detail</span>
                            </a>
                        </div>

                    </div>
                @empty
                    <div class="col-span-full py-16 text-center text-slate-400 space-y-3 bg-white rounded-3xl border border-slate-100 reveal">
                        <span class="material-symbols-outlined text-5xl text-slate-300">search_off</span>
                        <p class="text-base font-bold text-slate-700">Tidak ada alat TTG yang sesuai dengan kriteria pencarian Anda.</p>
                        <button onclick="resetKatalogAllFilters()" class="text-xs font-bold text-[#00A3E0] hover:underline inline-block">
                            Reset Semua Filter
                        </button>
                    </div>
                @endforelse
            </div>

            <!-- 5. PAGINATION CONTAINER -->
            <div id="katalog-pagination" class="mt-10 pt-6 border-t border-slate-200/70 reveal">
                @include('partials.pagination', ['paginator' => $alatList])
            </div>
        </div>

    </main>

    <!-- FOOTER -->
    @include('partials.footer')


    <!-- JAVASCRIPT: LIVE AJAX FILTERING & SCROLL ANIMATIONS -->
    <script>
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

        // ========================================================
        // INTERSECTION OBSERVER FOR SCROLL REVEAL ANIMATIONS
        // ========================================================
        let revealObserver;

        function initScrollReveal() {
            const revealElements = document.querySelectorAll('.reveal, .reveal-left, .reveal-right, .reveal-zoom');

            const observerOptions = {
                root: null,
                rootMargin: '0px 0px -50px 0px',
                threshold: 0.12
            };

            if (revealObserver) {
                revealObserver.disconnect();
            }

            revealObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('active');
                    }
                });
            }, observerOptions);

            revealElements.forEach(el => revealObserver.observe(el));
        }

        // Set Category Pill Filter Function
        function setKatalogKategori(katId) {
            document.getElementById('katalog-kategori-input').value = katId;
            
            // Update Active Pill UI State
            document.querySelectorAll('.kategori-pill').forEach(pill => {
                if (pill.getAttribute('data-kat') == katId) {
                    pill.className = 'kategori-pill px-3.5 py-1.5 rounded-xl text-xs font-bold transition-all shrink-0 bg-[#00A3E0] text-white shadow-xs';
                } else {
                    pill.className = 'kategori-pill px-3.5 py-1.5 rounded-xl text-xs font-bold transition-all shrink-0 bg-slate-100 text-slate-600 hover:bg-slate-200';
                }
            });

            triggerKatalogFilter();
        }

        // Debounce timer for search typing
        let debounceTimer;
        function debounceKatalogFilter() {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => {
                triggerKatalogFilter();
            }, 300);
        }

        // Reset Filters Function
        function resetKatalogAllFilters() {
            document.getElementById('katalog-search-input').value = '';
            document.getElementById('katalog-wilayah-select').value = 'semua';
            document.getElementById('katalog-tahun-select').value = 'semua';
            document.getElementById('katalog-sort-select').value = 'terbaru';
            setKatalogKategori('semua');
        }

        // Core AJAX Fetch Filter Function
        function triggerKatalogFilter(url = null) {
            const form = document.getElementById('katalog-filter-form');
            const formData = new FormData(form);
            const params = new URLSearchParams(formData);

            let fetchUrl = url || `{{ route('katalog.index') }}?` + params.toString();

            // Update browser URL without triggering reload
            window.history.pushState({}, '', fetchUrl);

            // Fetch partial DOM
            fetch(fetchUrl, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                
                const newGridWrapper = doc.getElementById('katalog-grid-wrapper');
                if (newGridWrapper) {
                    document.getElementById('katalog-grid-wrapper').innerHTML = newGridWrapper.innerHTML;
                    bindPaginationLinks();
                    initScrollReveal(); // Re-observe new animated cards
                }
            })
            .catch(error => console.error('Error filtering catalog:', error));
        }

        // Intercept Pagination Links for AJAX
        function bindPaginationLinks() {
            document.querySelectorAll('#katalog-pagination a').forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    triggerKatalogFilter(this.getAttribute('href'));
                });
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            bindPaginationLinks();
            initScrollReveal();
        });
    </script>

</body>
</html>
