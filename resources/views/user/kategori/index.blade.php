<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori Teknologi Tepat Guna - Kota Tasikmalaya</title>
    <!-- Favicon Logo Tasikmalaya -->
    <link rel="icon" type="image/png" href="{{ asset('storage/images/favicon_tasik.png') }}?v=3">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=3">
    <link rel="apple-touch-icon" href="{{ asset('storage/images/favicon_tasik.png') }}?v=3">

    <!-- Google Fonts: Inter & Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Material Symbols -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* Hide scrollbar completely */
        html,
        body {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        html::-webkit-scrollbar,
        body::-webkit-scrollbar {
            display: none;
            width: 0;
            height: 0;
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
        .delay-100 {
            transition-delay: 0.1s;
        }

        .delay-200 {
            transition-delay: 0.2s;
        }

        .delay-300 {
            transition-delay: 0.3s;
        }

        .delay-400 {
            transition-delay: 0.4s;
        }

        .delay-500 {
            transition-delay: 0.5s;
        }

        /* Floating Micro Animation for Icon Badges */
        @keyframes floatIcon {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-5px);
            }
        }

        .animate-float-icon {
            animation: floatIcon 3.5s ease-in-out infinite;
        }
    </style>
</head>

<body
    class="bg-slate-50 text-slate-800 antialiased min-h-screen flex flex-col justify-between selection:bg-[#00A3E0] selection:text-white overflow-x-hidden">

    <!-- 1. NAVBAR / HEADER -->
    <header class="sticky top-0 z-40 bg-white/95 backdrop-blur-md border-b border-slate-100 shadow-xs transition-all">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">

            <!-- Logo & Brand Name -->
            <a href="/" class="flex items-center gap-3 group">
                <img src="{{ asset('storage/images/logo_tasik.png') }}" alt="Logo Kota Tasikmalaya"
                    class="h-10 w-auto object-contain group-hover:scale-105 transition-transform">
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
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-14 flex-1 w-full space-y-12">

        <!-- 2. HERO HEADER SECTION -->
        <div class="text-center max-w-3xl mx-auto space-y-4 reveal-zoom">

            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 tracking-tight leading-tight">
                Kategori Teknologi <br class="hidden sm:inline">
                <span class="text-[#00A3E0]">Tepat Guna</span>
            </h1>

            <p class="text-slate-500 text-sm sm:text-base leading-relaxed max-w-2xl mx-auto">
                Telusuri berbagai kategori inovasi teknologi yang dikembangkan untuk berbagai sektor kebutuhan
                masyarakat Kota Tasikmalaya.
            </p>

            <!-- Search Bar Input Box -->
            <div class="pt-2 max-w-xl mx-auto">
                <div class="relative flex items-center bg-white rounded-xl sm:rounded-2xl shadow-md shadow-slate-200/60 border border-slate-200 p-1.5 focus-within:border-[#00A3E0] focus-within:ring-2 focus-within:ring-[#00A3E0]/20 transition-all">
                    <span class="material-symbols-outlined text-slate-400 pl-2.5 pr-1 text-lg pointer-events-none">search</span>
                    <input type="text" id="search-kategori-input" onkeyup="filterKategoriCards()"
                        placeholder="Cari kategori teknologi (misal: Pertanian, Pangan, Energi)..."
                        class="w-full bg-transparent border-none text-slate-800 placeholder-slate-400 text-xs sm:text-sm focus:outline-none pr-2"
                        autocomplete="off">
                    <button type="button" onclick="filterKategoriCards()"
                        class="bg-[#00A3E0] hover:bg-[#008cc0] text-white px-4 sm:px-5 py-2 rounded-lg sm:rounded-xl font-bold text-xs sm:text-sm transition-all shadow-xs shrink-0 flex items-center justify-center">
                        Cari
                    </button>
                </div>
            </div>
        </div>


        <!-- 4. CATEGORY CARDS GRID SECTION (4 COLUMNS DESKTOP) -->
        <div class="space-y-6">
            <div class="flex items-center justify-between border-b border-slate-200/80 pb-4 reveal">
                <h2 class="text-2xl font-black text-slate-900 tracking-tight">Daftar Sektor Kategori</h2>
                <span id="kategori-counter-label" class="text-xs font-bold text-slate-500">
                    Menampilkan {{ count($kategoriList) }} Kategori
                </span>
            </div>

            <div id="kategori-grid" class="grid grid-cols-3 sm:grid-cols-2 lg:grid-cols-4 gap-2 sm:gap-5 lg:gap-6">
                @forelse($kategoriList as $index => $kat)
                    @php
                        $namaLower = strtolower($kat->nama_kategori);
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
                            $icon = 'solar_power';
                        } elseif (str_contains($namaLower, 'lingkungan') || str_contains($namaLower, 'sampah') || str_contains($namaLower, 'limbah')) {
                            $icon = 'recycling';
                        } elseif (str_contains($namaLower, 'rajin') || str_contains($namaLower, 'kriya') || str_contains($namaLower, 'industri') || str_contains($namaLower, 'mesin')) {
                            $icon = 'precision_manufacturing';
                        }

                        $delayClass = 'delay-' . (($index % 4 + 1) * 100);
                    @endphp

                    <div class="kategori-card bg-white rounded-xl sm:rounded-3xl border border-slate-100 p-2.5 sm:p-6 shadow-[0_4px_20px_rgba(0,0,0,0.02)] hover:shadow-2xl hover:-translate-y-2 hover:border-[#00A3E0]/40 transition-all duration-300 flex flex-col justify-between group reveal {{ $delayClass }}"
                        data-name="{{ strtolower($kat->nama_kategori) }}"
                        data-desc="{{ strtolower($kat->deskripsi ?? '') }}">

                        <div>
                            <!-- Top Icon Box Container with Gradient & Hover Scale -->
                            <div
                                class="w-full h-16 sm:h-44 bg-gradient-to-br from-sky-50 via-sky-100/60 to-blue-50 rounded-xl sm:rounded-2xl flex items-center justify-center mb-2 sm:mb-5 group-hover:from-sky-100 group-hover:to-blue-100 transition-all duration-300 relative overflow-hidden border border-sky-100">
                                <span
                                    class="material-symbols-outlined text-3xl sm:text-6xl text-[#00A3E0] group-hover:scale-110 transition-transform duration-300 animate-float-icon">
                                    {{ $icon }}
                                </span>
                            </div>

                            <!-- Card Header & Title -->
                            <div class="space-y-0.5 sm:space-y-2 mb-2 sm:mb-4">
                                <h3
                                    class="text-xs sm:text-xl font-extrabold text-slate-900 tracking-tight group-hover:text-[#00A3E0] transition-colors leading-tight line-clamp-1">
                                    {{ $kat->nama_kategori }}
                                </h3>
                                <p class="hidden sm:block text-slate-500 text-xs leading-relaxed line-clamp-2">
                                    {{ $kat->deskripsi ?? 'Alat dan teknologi untuk meningkatkan efisiensi serta produktivitas di sektor ini.' }}
                                </p>
                            </div>
                        </div>

                        <div class="space-y-1.5 sm:space-y-4 pt-1 sm:pt-2">
                            <!-- Total Count Badge Pill -->
                            <div class="flex items-center justify-between">
                                <span
                                    class="inline-flex items-center gap-1 sm:gap-1.5 px-1.5 sm:px-3 py-0.5 sm:py-1 bg-sky-50 text-[#00A3E0] font-extrabold text-[9px] sm:text-xs rounded-full">
                                    <span class="material-symbols-outlined text-xs sm:text-sm">build</span>
                                    <span>{{ $kat->alat_ttg_count }} Alat</span>
                                </span>
                            </div>

                            <!-- CTA Button (Explore Category) -->
                            <a href="{{ route('public.kategori.detail', $kat->id) }}"
                                class="w-full py-1 sm:py-3 px-1 sm:px-4 bg-white border border-[#00A3E0] text-[#00A3E0] hover:bg-[#00A3E0] hover:text-white rounded-lg sm:rounded-xl text-[9px] sm:text-sm font-bold transition-all text-center flex items-center justify-center gap-1 sm:gap-2 group-hover:shadow-md">
                                <span class="hidden sm:inline">Jelajahi Kategori</span>
                                <span class="sm:hidden">Jelajahi</span>
                            </a>
                        </div>

                    </div>
                @empty
                    <div
                        class="col-span-full py-16 text-center text-slate-400 space-y-3 bg-white rounded-2xl border border-slate-100">
                        <span class="material-symbols-outlined text-5xl text-slate-300">grid_off</span>
                        <p class="text-base font-bold text-slate-700">Belum ada kategori yang ditambahkan.</p>
                    </div>
                @endforelse
            </div>

            <!-- Empty State Container when Live Search returns nothing -->
            <div id="search-empty-state"
                class="hidden py-16 text-center text-slate-400 space-y-3 bg-white rounded-2xl border border-slate-100">
                <span class="material-symbols-outlined text-5xl text-slate-300">search_off</span>
                <p class="text-base font-bold text-slate-700">Tidak ada kategori yang cocok dengan pencarian Anda.</p>
            </div>
        </div>

    </main>

    <!-- FOOTER -->
    @include('partials.footer')


    <!-- JAVASCRIPT: LIVE FILTER, SCROLL REVEAL & MOBILE MENU -->
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
        document.addEventListener('DOMContentLoaded', () => {
            const revealElements = document.querySelectorAll('.reveal, .reveal-left, .reveal-right, .reveal-zoom');

            const observerOptions = {
                root: null,
                rootMargin: '0px 0px -50px 0px',
                threshold: 0.15
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

        // Live Search Kategori Cards
        function filterKategoriCards() {
            const query = document.getElementById('search-kategori-input').value.toLowerCase().trim();
            const cards = document.querySelectorAll('.kategori-card');
            let visibleCount = 0;
            const totalCount = cards.length;

            cards.forEach(card => {
                const name = card.getAttribute('data-name');
                const desc = card.getAttribute('data-desc');

                if (name.includes(query) || desc.includes(query)) {
                    card.classList.remove('hidden');
                    visibleCount++;
                } else {
                    card.classList.add('hidden');
                }
            });

            const emptyState = document.getElementById('search-empty-state');
            const counterLabel = document.getElementById('kategori-counter-label');

            if (counterLabel) {
                counterLabel.innerText = `Menampilkan ${visibleCount} dari ${totalCount} Kategori`;
            }

            if (visibleCount === 0) {
                emptyState.classList.remove('hidden');
            } else {
                emptyState.classList.add('hidden');
            }
        }
    </script>

</body>

</html>