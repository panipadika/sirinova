<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori: {{ $kategori->nama_kategori }} - SI RINOVA Kota Tasikmalaya</title>
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

        /* Hide scrollbar completely */
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
    </style>
</head>

<body class="bg-slate-50 text-slate-800 antialiased min-h-screen flex flex-col justify-between selection:bg-[#00A3E0] selection:text-white">

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
                    <button class="flex items-center gap-1 text-[#00A3E0] font-bold border-b-2 border-[#00A3E0] pb-1 transition-colors font-bold text-sm focus:outline-none">
                        <span>Katalog TTG</span>
                        <span class="material-symbols-outlined text-base transition-transform group-hover:rotate-180">expand_more</span>
                    </button>
                    <div class="absolute left-0 top-full w-52 bg-white rounded-xl shadow-xl border border-slate-100 py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                        <a href="{{ route('katalog.index') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-xs font-semibold text-slate-700 hover:bg-sky-50 hover:text-[#00A3E0] transition-colors">
                            <span class="material-symbols-outlined text-base text-[#00A3E0]">inventory_2</span>
                            <span>Alat TTG</span>
                        </a>
                        <a href="{{ route('public.kategori') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-xs font-bold text-[#00A3E0] bg-sky-50/70 transition-colors">
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
                    <a href="{{ route('katalog.index') }}" class="block text-slate-600 hover:text-[#00A3E0]">Alat TTG</a>
                    <a href="{{ route('public.kategori') }}" class="block text-[#00A3E0] font-bold">Kategori Sektor</a>
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
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-10 flex-1 w-full space-y-8">

        <!-- 2. BREADCRUMB & HERO HEADER SECTION -->
        <div class="space-y-3">
            <!-- Breadcrumb -->
            <nav class="flex items-center gap-2 text-xs font-semibold text-slate-500">
                <a href="{{ route('public.kategori') }}" class="hover:text-[#00A3E0] transition-colors">Kategori</a>
                <span class="text-slate-300">&rsaquo;</span>
                <span class="text-slate-900 font-bold">{{ $kategori->nama_kategori }}</span>
            </nav>

            @php
                $namaLower = strtolower($kategori->nama_kategori);
                $icon = 'category';
                if (str_contains($namaLower, 'tani') || str_contains($namaLower, 'kebun')) {
                    $icon = 'agriculture';
                } elseif (str_contains($namaLower, 'ternak')) {
                    $icon = 'pets';
                } elseif (str_contains($namaLower, 'ikan') || str_contains($namaLower, 'air')) {
                    $icon = 'phishing';
                } elseif (str_contains($namaLower, 'pangan') || str_contains($namaLower, 'makan')) {
                    $icon = 'restaurant';
                } elseif (str_contains($namaLower, 'energi') || str_contains($namaLower, 'listrik')) {
                    $icon = 'bolt';
                } elseif (str_contains($namaLower, 'lingkungan') || str_contains($namaLower, 'sampah')) {
                    $icon = 'eco';
                } elseif (str_contains($namaLower, 'rajin') || str_contains($namaLower, 'kriya') || str_contains($namaLower, 'industri')) {
                    $icon = 'precision_manufacturing';
                }
            @endphp

            <!-- Hero Header Title & Description -->
            <div class="space-y-2 max-w-4xl">
                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-black text-slate-900 tracking-tight flex items-center gap-3">
                    <span class="material-symbols-outlined text-3xl sm:text-4xl text-[#00A3E0]">{{ $icon }}</span>
                    <span>Kategori: {{ $kategori->nama_kategori }}</span>
                </h1>
                <p class="text-slate-500 text-xs sm:text-sm leading-relaxed max-w-3xl">
                    {{ $kategori->deskripsi ?? "Eksplorasi inovasi Teknologi Tepat Guna (TTG) di sektor ".strtolower($kategori->nama_kategori).". Temukan solusi permesinan dan alat mekanis yang dirancang untuk meningkatkan efisiensi dan hasil panen masyarakat Kota Tasikmalaya." }}
                </p>
            </div>
        </div>

        <!-- 3. MAIN SECTION: SIDEBAR FILTER + PRODUCT GRID -->
        <div class="flex flex-col lg:flex-row gap-8 items-start">
            
            <!-- LEFT SIDEBAR FILTER PANEL -->
            <aside class="w-full lg:w-64 shrink-0 bg-white rounded-2xl border border-slate-100 p-5 space-y-6 shadow-[0_2px_15px_rgba(0,0,0,0.02)]">
                
                <!-- Filter Header -->
                <div class="flex items-center gap-2 border-b border-slate-100 pb-3">
                    <span class="material-symbols-outlined text-slate-600 text-xl">tune</span>
                    <h2 class="font-extrabold text-slate-900 text-base">Filter</h2>
                </div>

                <form id="kategori-detail-filter-form" onsubmit="event.preventDefault(); triggerKatDetailFilter();">
                    
                    <!-- Sub-Kategori Section -->
                    <div class="space-y-3">
                        <label class="text-[11px] font-extrabold text-slate-400 uppercase tracking-wider block">SUB-KATEGORI</label>
                        <label class="flex items-center gap-2.5 text-xs font-bold text-slate-800 cursor-pointer">
                            <input type="checkbox" checked disabled class="w-4 h-4 text-[#00A3E0] rounded border-slate-300 focus:ring-[#00A3E0]">
                            <span>Semua {{ $kategori->nama_kategori }}</span>
                        </label>
                    </div>

                    <!-- Wilayah Section -->
                    <div class="space-y-2 pt-4 border-t border-slate-100">
                        <label class="text-[11px] font-extrabold text-slate-400 uppercase tracking-wider block">WILAYAH</label>
                        <select name="wilayah" id="filter-wilayah" onchange="triggerKatDetailFilter()"
                                class="w-full px-3 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-medium text-slate-700 focus:outline-none focus:border-[#00A3E0] focus:ring-2 focus:ring-[#00A3E0]/20 transition-all cursor-pointer">
                            <option value="semua">Semua Kecamatan</option>
                            @foreach($wilayahList as $w)
                                <option value="{{ $w->id }}" {{ request('wilayah') == $w->id ? 'selected' : '' }}>
                                    Kec. {{ $w->nama_kecamatan }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Reset Filter Button -->
                    <div class="pt-5 border-t border-slate-100">
                        <button type="button" onclick="resetKatDetailFilter()"
                                class="w-full py-2.5 px-4 bg-white border border-slate-200 hover:border-slate-300 text-slate-600 hover:text-slate-900 rounded-xl text-xs font-bold transition-all text-center">
                            Reset Filter
                        </button>
                    </div>

                </form>

            </aside>

            <!-- RIGHT CONTENT AREA (PRODUCT GRID & HEADER BAR) -->
            <div id="kat-detail-wrapper" class="flex-1 w-full space-y-6">
                
                <!-- TOP CONTENT BAR: TOTAL INOVASI COUNT + SORT DROPDOWN -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white/50 p-2 rounded-xl">
                    <p class="text-xs sm:text-sm font-semibold text-slate-600">
                        Menampilkan <span class="font-extrabold text-[#00A3E0]">{{ $alatList->firstItem() ?? 0 }}-{{ $alatList->lastItem() ?? 0 }}</span> dari total <span class="font-extrabold text-slate-900">{{ $alatList->total() }}</span> Alat
                    </p>

                    <div class="flex items-center gap-2 self-end sm:self-auto text-xs font-medium text-slate-500">
                        <label for="filter-sort" class="shrink-0 font-semibold">Urutkan:</label>
                        <select name="sort" id="filter-sort" form="kategori-detail-filter-form" onchange="triggerKatDetailFilter()"
                                class="px-3 py-1.5 bg-white border border-slate-200 rounded-xl text-xs font-bold text-slate-800 focus:outline-none focus:border-[#00A3E0] transition-all cursor-pointer shadow-xs">
                            <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                            <option value="terlama" {{ request('sort') == 'terlama' ? 'selected' : '' }}>Terlama</option>
                            <option value="nama_asc" {{ request('sort') == 'nama_asc' ? 'selected' : '' }}>Nama (A-Z)</option>
                            <option value="nama_desc" {{ request('sort') == 'nama_desc' ? 'selected' : '' }}>Nama (Z-A)</option>
                        </select>
                    </div>
                </div>

                <!-- PRODUCT CARDS GRID (2 COLUMNS MOBILE, 3 COLUMNS DESKTOP) -->
                <div id="kat-detail-grid" class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-5 lg:gap-6">
                    @forelse($alatList as $item)
                        <div class="bg-white rounded-xl sm:rounded-2xl border border-slate-100 shadow-[0_2px_15px_rgba(0,0,0,0.02)] hover:shadow-lg transition-all duration-300 overflow-hidden flex flex-col justify-between group">
                            
                            <div>
                                <!-- Product Image Container with Floating Category Badge -->
                                <div class="relative w-full aspect-[4/3] bg-slate-100 overflow-hidden">
                                    @if($item->foto)
                                        <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama_alat }}"
                                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                             onerror="this.src='https://placehold.co/600x400?text=Alat+TTG'">
                                    @else
                                        <div class="w-full h-full flex flex-col items-center justify-center text-slate-400 gap-1 bg-slate-100">
                                            <span class="material-symbols-outlined text-2xl sm:text-4xl text-slate-300">inventory_2</span>
                                            <span class="text-[9px] sm:text-[10px] font-semibold">Tidak ada foto</span>
                                        </div>
                                    @endif

                                    <!-- Category Badge Pill -->
                                    <span class="absolute top-2 left-2 sm:top-3 sm:left-3 bg-white/95 backdrop-blur-md text-[#00A3E0] text-[9px] sm:text-[10px] font-extrabold px-2 py-0.5 sm:px-2.5 sm:py-1 rounded-full shadow-xs uppercase tracking-wider">
                                        {{ $item->kategori->nama_kategori ?? $kategori->nama_kategori }}
                                    </span>
                                </div>

                                <!-- Card Body Info -->
                                <div class="p-3 sm:p-5 space-y-1.5 sm:space-y-3">
                                    <h3 class="font-extrabold text-slate-900 text-xs sm:text-base leading-snug line-clamp-2 group-hover:text-[#00A3E0] transition-colors">
                                        <a href="{{ route('katalog.show', $item->id) }}">
                                            {{ $item->nama_alat }}
                                        </a>
                                    </h3>

                                    <!-- Metadata Info List -->
                                    <div class="space-y-1 sm:space-y-1.5 text-[10px] sm:text-xs text-slate-500 font-medium">
                                        <p class="flex items-center gap-1 sm:gap-2 truncate">
                                            <span class="material-symbols-outlined text-sm sm:text-base text-slate-400 shrink-0">person</span>
                                            <span class="truncate"><span class="hidden sm:inline">Inovator: </span><strong class="text-slate-800 font-semibold">{{ $item->inovator->nama_inovator ?? 'Inovator Mandiri' }}</strong></span>
                                        </p>
                                        <p class="flex items-center gap-1 sm:gap-2 truncate">
                                            <span class="material-symbols-outlined text-sm sm:text-base text-slate-400 shrink-0">location_on</span>
                                            <span class="truncate">Kec. <strong class="text-slate-800 font-semibold">{{ $item->wilayah->nama_kecamatan ?? 'Tasikmalaya' }}</strong></span>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Bottom CTA Button -->
                            <div class="p-3 sm:p-5 pt-0">
                                <a href="{{ route('katalog.show', $item->id) }}"
                                   class="w-full py-1.5 sm:py-2.5 px-2 sm:px-4 bg-sky-50 hover:bg-[#00A3E0] text-[#00A3E0] hover:text-white rounded-lg sm:rounded-xl text-[10px] sm:text-xs font-bold transition-all text-center flex items-center justify-center gap-1">
                                    Lihat Detail
                                </a>
                            </div>

                        </div>
                    @empty
                        <div class="col-span-full py-16 text-center text-slate-400 space-y-3 bg-white rounded-2xl border border-slate-100">
                            <span class="material-symbols-outlined text-5xl text-slate-300">search_off</span>
                            <p class="text-base font-bold text-slate-700">Belum ada alat TTG dalam kategori {{ $kategori->nama_kategori }}.</p>
                        </div>
                    @endforelse
                </div>

                <!-- PAGINATION CONTAINER -->
                <div id="kat-detail-pagination" class="mt-8 pt-6 border-t border-slate-200/70">
                    @include('partials.pagination', ['paginator' => $alatList])
                </div>

            </div>

        </div>

    </main>

    <!-- FOOTER -->
    @include('partials.footer')


    <!-- JAVASCRIPT: LIVE FILTERING -->
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

        // Reset Filter Handler
        function resetKatDetailFilter() {
            document.getElementById('filter-wilayah').value = 'semua';
            document.getElementById('filter-sort').value = 'terbaru';
            triggerKatDetailFilter();
        }

        // AJAX Live Filter Function
        function triggerKatDetailFilter(url = null) {
            const form = document.getElementById('kategori-detail-filter-form');
            const formData = new FormData(form);
            const params = new URLSearchParams(formData);

            let fetchUrl = url || `{{ route('public.kategori.detail', $kategori->id) }}?` + params.toString();

            window.history.pushState({}, '', fetchUrl);

            fetch(fetchUrl, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                
                const newWrapper = doc.getElementById('kat-detail-wrapper');
                if (newWrapper) {
                    document.getElementById('kat-detail-wrapper').innerHTML = newWrapper.innerHTML;
                    bindPaginationLinks();
                }
            })
            .catch(error => console.error('Error filtering category detail:', error));
        }

        // Intercept Pagination Links for AJAX
        function bindPaginationLinks() {
            document.querySelectorAll('#kat-detail-pagination a').forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    triggerKatDetailFilter(this.getAttribute('href'));
                });
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            bindPaginationLinks();
        });
    </script>

</body>
</html>
