<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Telaahan Staf - SI RINOVA Kota Tasikmalaya</title>
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
        .doc-card {
            transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        .doc-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 16px 32px -8px rgba(41, 171, 226, 0.15), 0 6px 12px -4px rgba(0, 0, 0, 0.05);
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
                <a href="{{ route('public.telaahan-staf') }}" class="text-[#29abe2] border-b-2 border-[#29abe2] pb-1 transition-colors">Telaahan Staf</a>
                <a href="{{ route('public.galeri') }}" class="text-slate-600 hover:text-[#29abe2] transition-colors py-1">Galeri</a>
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
            <a href="{{ route('public.telaahan-staf') }}" class="block text-[#29abe2]">Telaahan Staf</a>
            <a href="{{ route('public.galeri') }}" class="block text-slate-600">Galeri</a>
            <a href="{{ route('lomba.info') }}" class="flex items-center gap-1.5 text-amber-500 font-bold">
                <span class="material-symbols-outlined text-base">emoji_events</span>
                <span>Lomba TTG</span>
            </a>
            <a href="{{ route('public.tentang') }}" class="block text-slate-600">Tentang</a>
        </div>
    </header>

    <!-- MAIN CONTENT CONTAINER -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8 flex-1 w-full space-y-6">

        <!-- 2. HERO HEADER SECTION -->
        <div class="text-center max-w-3xl mx-auto space-y-3 reveal-up">
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 tracking-tight leading-tight">
                Telaahan Staf & <span class="text-[#29abe2]">Rekomendasi Kebijakan</span>
            </h1>
            <p class="text-slate-500 text-sm sm:text-base leading-relaxed max-w-2xl mx-auto">
                Akses kumpulan dokumen analisis strategis, pertimbangan teknis, serta rekomendasi kebijakan inovasi daerah Kota Tasikmalaya.
            </p>
        </div>

        <!-- 3. SEARCH & FILTER CONTROLS -->
        <div class="bg-white rounded-2xl border border-slate-100 shadow-[0_4px_25px_rgba(0,0,0,0.03)] p-3.5 sm:p-4 reveal-up">
            <!-- Search & Filter Row -->
            <form method="GET" action="{{ route('public.telaahan-staf') }}" id="search-form" class="w-full flex flex-col sm:flex-row items-center gap-3">
                <div class="relative w-full flex-1">
                    <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-lg pointer-events-none">search</span>
                    <input type="text" name="search" id="search-input" value="{{ $search }}" placeholder="Cari judul telaahan atau pembuat bidang..." autocomplete="off"
                        class="w-full pl-10 pr-3.5 py-2 sm:py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs sm:text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:border-[#29abe2] focus:ring-2 focus:ring-[#29abe2]/20 transition-all">
                </div>

                <!-- Dropdown Filter Tahun -->
                <div class="relative w-full sm:w-auto shrink-0">
                    <select name="tahun" onchange="this.form.submit()"
                        class="w-full sm:w-auto appearance-none bg-slate-50 border border-slate-200 text-slate-700 font-bold text-xs sm:text-sm pl-3.5 pr-8 py-2 sm:py-2.5 rounded-xl cursor-pointer focus:outline-none focus:ring-2 focus:ring-[#29abe2]/20 hover:bg-slate-100 transition-all shadow-2xs">
                        <option value="Semua" {{ (string)$selectedTahun === 'Semua' ? 'selected' : '' }}>Semua Tahun</option>
                        @foreach($tahunList as $thn)
                            <option value="{{ $thn }}" {{ (string)$selectedTahun === (string)$thn ? 'selected' : '' }}>
                                {{ $thn }}
                            </option>
                        @endforeach
                    </select>
                    <span class="material-symbols-outlined absolute right-2.5 top-1/2 -translate-y-1/2 text-slate-400 text-base pointer-events-none">expand_more</span>
                </div>
            </form>

            @if (!empty($search) || ($selectedTahun ?? 'Semua') !== 'Semua')
                <div class="mt-3 pt-3 border-t border-slate-100 flex flex-wrap items-center justify-between gap-2 text-xs text-slate-600">
                    <div class="flex items-center gap-1.5 font-medium">
                        <span class="material-symbols-outlined text-base text-[#29abe2]">tune</span>
                        <span>Filter aktif:
                            @if(!empty($search)) kata kunci <strong class="text-slate-900 font-bold">"{{ $search }}"</strong> @endif
                            @if(!empty($search) && ($selectedTahun ?? 'Semua') !== 'Semua') <span class="text-slate-300">•</span> @endif
                            @if(($selectedTahun ?? 'Semua') !== 'Semua') tahun <strong class="text-slate-900 font-bold">{{ $selectedTahun }}</strong> @endif
                        </span>
                    </div>
                    <a href="{{ route('public.telaahan-staf') }}"
                       class="inline-flex items-center gap-1 px-3 py-1 bg-rose-50 hover:bg-rose-100 text-rose-600 border border-rose-200/60 rounded-xl text-xs font-extrabold transition-all duration-200 shadow-2xs hover:shadow-xs active:scale-95">
                        <span class="material-symbols-outlined text-xs">close</span>
                        <span>Reset Filter</span>
                    </a>
                </div>
            @endif
        </div>

        <!-- 4. TELAAHAN STAF DOCUMENTS GRID (2 COLUMNS MOBILE, 3 COLUMNS DESKTOP) -->
        <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-5 pt-2">

            @forelse($telaahanStafs as $index => $item)
                <div class="doc-card bg-white rounded-xl sm:rounded-2xl border border-slate-100 shadow-xs overflow-hidden group reveal-up flex flex-col justify-between" style="transition-delay: {{ ($index % 3) * 60 }}ms;">
                    
                    <div class="p-3 sm:p-6 space-y-2.5 sm:space-y-4 flex-1 flex flex-col justify-between">
                        <!-- Top Metadata -->
                        <div class="space-y-2 sm:space-y-3">
                            <div class="flex items-center justify-between gap-1 sm:gap-2">
                                <span class="px-1.5 sm:px-2.5 py-0.5 sm:py-1 bg-sky-50 text-[#29abe2] text-[8.5px] sm:text-[10px] font-extrabold rounded sm:rounded-md uppercase tracking-wider flex items-center gap-0.5 sm:gap-1 max-w-[62%] sm:max-w-[70%] truncate" title="{{ $item->pembuat_bidang }}">
                                    <span class="material-symbols-outlined text-[11px] sm:text-[13px] shrink-0">corporate_fare</span>
                                    <span class="truncate">{{ $item->pembuat_bidang }}</span>
                                </span>
                                <span class="text-[10px] sm:text-xs text-slate-400 font-medium flex items-center gap-0.5 sm:gap-1 shrink-0">
                                    <span class="material-symbols-outlined text-xs sm:text-sm">calendar_today</span>
                                    {{ $item->tahun_dokumen ?? '-' }}
                                </span>
                            </div>

                            <!-- Title -->
                            <h3 class="text-xs sm:text-base font-extrabold text-slate-900 leading-snug group-hover:text-[#29abe2] transition-colors line-clamp-2">
                                <a href="{{ route('public.telaahan-staf.detail', $item->id) }}">
                                    {{ $item->judul }}
                                </a>
                            </h3>

                            <!-- Summary Snippet -->
                            @if(!empty($item->ringkasan))
                                <div class="bg-slate-50/70 p-2 sm:p-3 rounded-lg sm:rounded-xl border border-slate-100 overflow-hidden">
                                    <p class="text-[10px] sm:text-xs text-slate-500 leading-relaxed line-clamp-2 sm:line-clamp-3 text-left sm:text-justify m-0">
                                        {{ Str::limit($item->ringkasan, 130) }}
                                    </p>
                                </div>
                            @endif
                        </div>

                        <!-- Card Action Buttons (Matches E-Book & Galeri Style) -->
                        <div class="pt-2.5 sm:pt-4 border-t border-slate-100">
                            <a href="{{ route('public.telaahan-staf.detail', $item->id) }}"
                               class="w-full flex items-center justify-center py-1.5 sm:py-2.5 px-2 sm:px-4 bg-sky-50 hover:bg-[#29abe2] text-[#29abe2] hover:text-white rounded-lg sm:rounded-full text-[11px] sm:text-sm font-bold transition-all duration-200 text-center shadow-2xs hover:shadow-md">
                                <span>Lihat Detail</span>
                            </a>
                        </div>

                    </div>

                </div>
            @empty
                <!-- Empty State -->
                <div class="col-span-full py-16 text-center space-y-3 bg-white rounded-2xl border border-slate-100 p-8">
                    <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto text-slate-400">
                        <span class="material-symbols-outlined text-3xl">description</span>
                    </div>
                    <h3 class="text-base font-bold text-slate-700">Tidak ada dokumen Telaahan Staf ditemukan</h3>
                    <p class="text-xs text-slate-400 max-w-sm mx-auto">Coba gunakan kata kunci lain atau pilih kategori yang berbeda.</p>
                    <a href="{{ route('public.telaahan-staf') }}"
                       class="inline-flex items-center gap-1.5 px-5 py-2 bg-[#29abe2] hover:bg-[#1a95c9] text-white font-bold text-xs rounded-full transition-all">
                        <span class="material-symbols-outlined text-sm">refresh</span>
                        Reset Filter
                    </a>
                </div>
            @endforelse

        </div>

        <!-- 5. PAGINATION CONTAINER -->
        <div class="mt-8">
            @include('partials.pagination', ['paginator' => $telaahanStafs, 'itemLabel' => 'Dokumen Telaahan Staf'])
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
                }, 100);
            });

            window.addEventListener('DOMContentLoaded', () => {
                if (searchInput.value.length > 0) {
                    searchInput.focus();
                    searchInput.setSelectionRange(searchInput.value.length, searchInput.value.length);
                }
            });
        }
    </script>

</body>
</html>
