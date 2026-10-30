<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan Ebook - SI RINOVA Kota Tasikmalaya</title>
    <!-- Favicon Logo Tasikmalaya -->
    <link rel="icon" type="image/png" href="{{ asset('storage/images/favicon_tasik.png') }}?v=3">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=3">
    <link rel="apple-touch-icon" href="{{ asset('storage/images/favicon_tasik.png') }}?v=3">

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

        /* Hide scrollbar */
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

        /* Custom sleek horizontal scrollbar for filter pills */
        .custom-filter-scrollbar {
            scrollbar-width: thin;
            scrollbar-color: #00A3E0 #f1f5f9;
        }
        .custom-filter-scrollbar::-webkit-scrollbar {
            height: 5px;
            display: block !important;
        }
        .custom-filter-scrollbar::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 9999px;
            margin: 0 4px;
        }
        .custom-filter-scrollbar::-webkit-scrollbar-thumb {
            background: #00A3E0;
            border-radius: 9999px;
        }
        .custom-filter-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #008cc0;
        }

        /* Book Card Hover Effect */
        .book-card {
            transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        .book-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 32px -8px rgba(0, 163, 224, 0.15), 0 6px 12px -4px rgba(0, 0, 0, 0.08);
        }

        /* Active filter pill */
        .filter-pill-active {
            background-color: #2563eb;
            color: white;
            border-color: #2563eb;
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

        /* 3D E-Book Cover Real Mockup Animation */
        .book-3d-wrapper {
            perspective: 1200px;
            padding: 1rem;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: visible;
        }

        .book-3d-cover {
            position: relative;
            transform-style: preserve-3d;
            transform: rotateY(-16deg) rotateX(3deg);
            transition: transform 0.5s cubic-bezier(0.165, 0.84, 0.44, 1), box-shadow 0.5s cubic-bezier(0.165, 0.84, 0.44, 1);
            transform-origin: left center;
            box-shadow: -12px 12px 24px rgba(0, 0, 0, 0.35), -2px 2px 5px rgba(0, 0, 0, 0.2);
            border-radius: 4px 8px 8px 4px;
        }

        .group:hover .book-3d-cover {
            transform: rotateY(-25deg) rotateX(5deg) translateZ(10px);
            box-shadow: -20px 20px 35px rgba(0, 0, 0, 0.45), -4px 4px 10px rgba(0, 0, 0, 0.3);
        }

        /* Spine Strip & Crease (Jilid Buku Kiri) */
        .book-spine-strip {
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            width: 12px;
            background: linear-gradient(to right, rgba(0,0,0,0.45) 0%, rgba(255,255,255,0.15) 50%, rgba(0,0,0,0.25) 100%);
            pointer-events: none;
            z-index: 19;
            border-radius: 4px 0 0 4px;
        }

        .book-spine-crease {
            position: absolute;
            top: 0;
            left: 12px;
            bottom: 0;
            width: 3px;
            background: linear-gradient(to right, rgba(0, 0, 0, 0.35) 0%, rgba(255, 255, 255, 0.2) 50%, rgba(0, 0, 0, 0.2) 100%);
            box-shadow: -1px 0 2px rgba(0, 0, 0, 0.4);
            pointer-events: none;
            z-index: 20;
        }

        /* Samping / Ketebalan Halaman Ebook Kanan (Right Page Edge) */
        .book-3d-cover::after {
            content: '';
            position: absolute;
            top: 1px;
            right: -11px;
            width: 11px;
            height: calc(100% - 2px);
            background: repeating-linear-gradient(90deg, #f8fafc, #f8fafc 2px, #e2e8f0 2px, #e2e8f0 4px);
            transform: rotateY(90deg);
            transform-origin: left center;
            border-radius: 0 3px 3px 0;
            box-shadow: inset 1px 0 3px rgba(0, 0, 0, 0.2);
            opacity: 0.95;
        }
    </style>
</head>

<body class="bg-[#f8fafc] text-slate-800 antialiased min-h-screen flex flex-col justify-between selection:bg-[#00A3E0] selection:text-white overflow-x-hidden">

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
                    <button class="flex items-center gap-1 text-slate-600 group-hover:text-[#00A3E0] transition-colors font-semibold text-sm focus:outline-none">
                        <span>Katalog TTG</span>
                        <span class="material-symbols-outlined text-base transition-transform group-hover:rotate-180">expand_more</span>
                    </button>
                    <div class="absolute left-0 top-full w-52 bg-white rounded-xl shadow-xl border border-slate-100 py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                        <a href="{{ route('katalog.index') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-xs font-semibold text-slate-700 hover:bg-sky-50 hover:text-[#00A3E0] transition-colors">
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

                <a href="{{ route('public.ebook') }}" class="text-[#00A3E0] border-b-2 border-[#00A3E0] pb-1 transition-colors">E-Book Kajian</a>
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
                <button id="mobile-katalog-btn" type="button" class="w-full flex items-center justify-between text-xs font-bold text-slate-600 uppercase tracking-wider focus:outline-none transition-colors py-1">
                    <span>Katalog TTG</span>
                    <span id="mobile-katalog-icon" class="material-symbols-outlined text-base transition-transform duration-200">expand_more</span>
                </button>
                <div id="mobile-katalog-sub" class="hidden space-y-2 pt-1.5 pl-3">
                    <a href="{{ route('katalog.index') }}" class="block text-slate-600 hover:text-[#00A3E0]">Alat TTG</a>
                    <a href="{{ route('public.kategori') }}" class="block text-slate-600 hover:text-[#00A3E0]">Kategori Sektor</a>
                    <a href="{{ route('public.wilayah') }}" class="block text-slate-600 hover:text-[#00A3E0]">Sebaran Wilayah</a>
                </div>
            </div>
            <a href="{{ route('public.ebook') }}" class="block text-[#00A3E0]">E-Book Kajian</a>
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
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8 flex-1 w-full space-y-5">

        <!-- 2. HERO HEADER SECTION (Matches Katalog Page Style) -->
        <div class="text-center max-w-3xl mx-auto space-y-3 reveal-up">
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 tracking-tight leading-tight">
                E-Book <span class="text-[#00A3E0]">Kajian & Riset</span>
            </h1>
            <p class="text-slate-500 text-sm sm:text-base leading-relaxed max-w-2xl mx-auto">
                Jelajahi berbagai dokumen kajian ilmiah dan hasil riset inovasi yang dikembangkan di Kota Tasikmalaya.
            </p>
        </div>

        <!-- 3. SEARCH & FILTER CONTROLS CONTAINER -->
        <div class="bg-white rounded-2xl border border-slate-100 shadow-[0_4px_25px_rgba(0,0,0,0.03)] p-4 sm:p-5 space-y-3.5 reveal-up">
            <!-- Search Bar Row -->
            <form method="GET" action="{{ route('public.ebook') }}" id="search-form" class="w-full">
                <input type="hidden" name="kategori" value="{{ $selectedKategori }}">
                <input type="hidden" name="tahun" value="{{ $selectedTahun }}">
                <div class="relative w-full">
                    <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-lg pointer-events-none">search</span>
                    <input type="text" name="search" id="search-input" value="{{ $search }}" placeholder="Cari judul kajian atau kata kunci..."
                        class="w-full pl-10 pr-3.5 py-2 sm:py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs sm:text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:border-[#00A3E0] focus:ring-2 focus:ring-[#00A3E0]/20 transition-all">
                </div>
            </form>

            <div class="border-t border-slate-100 pt-3 flex flex-col sm:flex-row sm:items-center justify-between gap-3 sm:gap-4">
                <!-- Left: Kategori Pills (Horizontally scrollable with sleek indicator) -->
                <div class="flex items-center gap-1.5 overflow-x-auto p-1.5 pb-2.5 w-full sm:w-auto flex-1 custom-filter-scrollbar">
                    @foreach($kategoriFilter as $kat)
                        <a href="{{ route('public.ebook', ['kategori' => $kat, 'tahun' => $selectedTahun, 'search' => $search]) }}"
                           class="px-3.5 py-1.5 rounded-xl text-xs font-semibold shrink-0 transition-all duration-200
                                  {{ $selectedKategori === $kat ? 'bg-[#00A3E0] text-white shadow-xs' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                            {{ $kat }}
                        </a>
                    @endforeach
                </div>

                <!-- Right: Filter Tahun Dropdown Pill -->
                <form method="GET" action="{{ route('public.ebook') }}" class="relative shrink-0 self-end sm:self-auto">
                    <input type="hidden" name="kategori" value="{{ $selectedKategori }}">
                    <input type="hidden" name="search" value="{{ $search }}">
                    <div class="relative inline-block">
                        <select name="tahun" onchange="this.form.submit()"
                                class="appearance-none bg-slate-50 border border-slate-200 text-slate-700 font-bold text-xs sm:text-sm pl-3.5 pr-8 py-1.5 rounded-xl cursor-pointer focus:outline-none focus:ring-2 focus:ring-[#00A3E0]/20 hover:bg-slate-100 transition-all shadow-2xs">
                            @foreach($tahunFilter as $thn)
                                <option value="{{ $thn }}" {{ (string)$selectedTahun === (string)$thn ? 'selected' : '' }}>
                                    {{ $thn === 'Semua' ? 'Semua Tahun' : $thn }}
                                </option>
                            @endforeach
                        </select>
                        <span class="material-symbols-outlined absolute right-2.5 top-1/2 -translate-y-1/2 text-slate-600 text-base pointer-events-none">
                            expand_more
                        </span>
                    </div>
                </form>
            </div>
        </div>

        <!-- 4. PORTRAIT BOOK CARDS GRID (Matches Reference Cards Grid) -->
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3 sm:gap-5 pt-2">

            @forelse($ebooks as $index => $kajian)
                <div class="book-card bg-white rounded-2xl border border-slate-100 shadow-xs overflow-hidden group reveal-up flex flex-col justify-between" style="transition-delay: {{ ($index % 5) * 60 }}ms;">

                    <!-- Top Portion: Portrait 3D Real Book Cover Area -->
                    <div class="book-3d-wrapper p-3 sm:p-5 select-none bg-slate-50/50 border-b border-slate-100/80">
                        <div class="book-3d-cover relative aspect-[3/4] w-full bg-slate-800">
                            
                            <!-- Spine overlay elements (Jilid Buku Kiri) -->
                            <div class="book-spine-strip"></div>
                            <div class="book-spine-crease"></div>

                            @if(!empty($kajian->cover_image))
                                <!-- Real Book Cover Image -->
                                <img src="{{ Str::startsWith($kajian->cover_image, 'http') ? $kajian->cover_image : asset($kajian->cover_image) }}" 
                                     alt="{{ $kajian->judul }}" 
                                     class="absolute inset-0 w-full h-full object-cover rounded-r-sm">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/60 via-transparent to-slate-950/20 pointer-events-none"></div>
                            @else
                                <!-- Fallback Plain Gradient Cover -->
                                <div class="absolute inset-0 bg-gradient-to-br {{ $kajian->cover_bg ?? 'from-slate-800 to-slate-900' }} rounded-r-sm"></div>
                                
                                <!-- Subtle Vector Decoration -->
                                <div class="absolute inset-0 opacity-15 pointer-events-none">
                                    <div class="absolute -right-8 -top-8 w-32 h-32 border-4 border-white/20 rounded-full"></div>
                                    <div class="absolute -left-6 -bottom-6 w-24 h-24 border-4 border-white/20 rounded-lg rotate-12"></div>
                                </div>
                                
                                <!-- Clean Icon Placeholder Center -->
                                <div class="absolute inset-0 flex items-center justify-center pointer-events-none text-white/20 pl-3">
                                    <span class="material-symbols-outlined text-5xl">menu_book</span>
                                </div>
                            @endif

                            <!-- Top Cover Header Badges (Category - Always Top Left) -->
                            <div class="absolute top-2 left-4 z-25">
                                <span class="px-2 py-0.5 bg-blue-600/95 backdrop-blur-xs text-white text-[9px] font-extrabold rounded uppercase tracking-wider shadow-xs">
                                    {{ strtoupper($kajian->kategori) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Bottom Portion: Card Content & Actions (Matches Ref Design) -->
                    <div class="p-3.5 sm:p-4 space-y-3 flex-1 flex flex-col justify-between bg-white">
                        
                        <!-- Title & Year -->
                        <div>
                            <h4 class="text-xs sm:text-sm font-extrabold text-slate-900 leading-snug group-hover:text-[#00A3E0] transition-colors">
                                {{ $kajian->judul }}
                            </h4>
                            <p class="text-[11px] text-slate-400 font-medium mt-1">
                                {{ $kajian->tahun }}
                            </p>
                        </div>

                        <!-- Action Button: Lihat Detail -->
                        <div class="pt-2">
                            <a href="{{ route('public.ebook.detail', $kajian->id) }}"
                               class="w-full flex items-center justify-center py-2.5 px-4 bg-sky-50 hover:bg-[#00A3E0] text-[#00A3E0] hover:text-white rounded-full text-xs sm:text-sm font-bold transition-all duration-200 text-center shadow-2xs hover:shadow-md">
                                <span>Lihat Detail</span>
                            </a>
                        </div>

                    </div>

                </div>
            @empty
                <!-- Empty State -->
                <div class="col-span-full py-16 text-center space-y-3 bg-white rounded-2xl border border-slate-100 p-8">
                    <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto text-slate-400">
                        <span class="material-symbols-outlined text-3xl">search_off</span>
                    </div>
                    <h3 class="text-base font-bold text-slate-700">Tidak ada ebook ditemukan</h3>
                    <p class="text-xs text-slate-400 max-w-sm mx-auto">Coba gunakan kata kunci lain atau pilih kategori yang berbeda.</p>
                    <a href="{{ route('public.ebook') }}"
                       class="inline-flex items-center gap-1.5 px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs rounded-full transition-all">
                        <span class="material-symbols-outlined text-sm">refresh</span>
                        Reset Filter
                    </a>
                </div>
            @endforelse

        </div>

        <!-- 5. PAGINATION CONTAINER -->
        <div class="mt-8">
            @include('partials.pagination', ['paginator' => $ebooks, 'itemLabel' => 'E-Book Kajian'])
        </div>

    </main>

    <!-- FOOTER -->
    @include('partials.footer')


    <!-- JAVASCRIPT -->
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

        // Live Search Handler
        const searchInput = document.getElementById('search-input');
        const searchForm = document.getElementById('search-form');
        let searchTimeout;

        if (searchInput && searchForm) {
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    searchForm.submit();
                }, 500);
            });

            if (searchInput.value.length > 0) {
                searchInput.focus();
                searchInput.setSelectionRange(searchInput.value.length, searchInput.value.length);
            }
        }
    </script>

</body>
</html>
