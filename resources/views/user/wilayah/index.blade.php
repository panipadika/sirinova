<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peta Sebaran & Wilayah Alat TTG - Kota Tasikmalaya</title>
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

    <!-- Leaflet CSS & JS for Interactive Map -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

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
        .delay-500 { transition-delay: 0.5s; }

        /* Leaflet Custom Marker & Popup Styles */
        .custom-map-pin {
            display: flex;
            align-items: center;
            justify-content: center;
            background: #00A3E0;
            color: white;
            border-radius: 9999px;
            box-shadow: 0 4px 14px rgba(0, 163, 224, 0.4);
            border: 3px solid white;
            transition: all 0.3s ease;
            font-weight: 800;
            font-size: 11px;
        }

        .custom-map-pin:hover {
            transform: scale(1.2);
            background: #008cc0;
            box-shadow: 0 6px 20px rgba(0, 163, 224, 0.6);
        }

        .leaflet-popup-content-wrapper {
            border-radius: 1.25rem !important;
            padding: 0 !important;
            box-shadow: 0 12px 30px -5px rgba(0, 0, 0, 0.15), 0 8px 10px -6px rgba(0, 0, 0, 0.1) !important;
            font-family: 'Inter', sans-serif !important;
            overflow: hidden !important;
        }

        .leaflet-popup-content {
            margin: 14px 16px 14px 16px !important;
            width: auto !important;
            line-height: inherit !important;
        }

        .leaflet-popup-content p {
            margin: 0 !important;
        }

        .leaflet-popup-content a {
            color: #ffffff !important;
            text-decoration: none !important;
        }

        .leaflet-popup-close-button {
            top: 10px !important;
            right: 10px !important;
            color: #94a3b8 !important;
            font-size: 16px !important;
            padding: 4px !important;
        }

        .leaflet-popup-close-button:hover {
            color: #0f172a !important;
        }

        .leaflet-popup-tip {
            background: white !important;
        }
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
                    <button class="flex items-center gap-1 text-[#00A3E0] font-bold border-b-2 border-[#00A3E0] pb-1 transition-colors font-bold text-sm focus:outline-none">
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
                        <a href="{{ route('public.wilayah') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-xs font-bold text-[#00A3E0] bg-sky-50/70 transition-colors">
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
                    <a href="{{ route('public.kategori') }}" class="block text-slate-600 hover:text-[#00A3E0]">Kategori Sektor</a>
                    <a href="{{ route('public.wilayah') }}" class="block text-[#00A3E0] font-bold">Sebaran Wilayah</a>
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
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-14 flex-1 w-full space-y-16">

        <!-- 2. HERO HEADER SECTION -->
        <div class="text-center max-w-3xl mx-auto space-y-4 reveal-zoom">

            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 tracking-tight leading-tight">
                Sebaran Alat TTG <br class="hidden sm:inline">
                <span class="text-[#00A3E0]">Kota Tasikmalaya</span>
            </h1>

            <p class="text-slate-500 text-sm sm:text-base leading-relaxed max-w-2xl mx-auto">
                Eksplorasi peta interaktif sebaran Teknologi Tepat Guna di 10 kecamatan Kota Tasikmalaya. Klik marker lokasi atau kartu wilayah untuk info detail.
            </p>
        </div>

        <!-- 3. INTERACTIVE MAP SECTION -->
        <div class="bg-white rounded-3xl border border-slate-100 p-4 sm:p-6 shadow-[0_4px_25px_rgba(0,0,0,0.03)] space-y-4 reveal">
            <!-- Map Header Title -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 px-2">
                <div class="flex items-center gap-2.5">
                    <div class="w-10 h-10 bg-sky-50 rounded-xl flex items-center justify-center text-[#00A3E0]">
                        <span class="material-symbols-outlined text-2xl">explore</span>
                    </div>
                    <div>
                        <h2 class="text-lg sm:text-xl font-extrabold text-slate-900 tracking-tight">Peta Digital Sebaran Alat TTG Kota Tasikmalaya</h2>
                        <p class="text-xs text-slate-500 font-medium">Klik pada penanda peta untuk membuka ringkasan katalog wilayah.</p>
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    <span class="inline-flex items-center gap-1 px-3 py-1 bg-emerald-50 text-emerald-700 border border-emerald-100 text-xs font-extrabold rounded-full">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-ping"></span>
                        10 Kecamatan Terdaftar
                    </span>
                </div>
            </div>

            <!-- Leaflet Container -->
            <div id="tasikmalaya-map" class="w-full h-[400px] sm:h-[460px] rounded-2xl z-10 border border-slate-200"></div>
        </div>

        <!-- 4. SEARCH & DISTRICT LIST SECTION -->
        <div class="space-y-6">
            
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-slate-200/80 pb-4 reveal">
                <div>
                    <h2 class="text-2xl font-black text-slate-900 tracking-tight">
                        Daftar Kecamatan
                    </h2>
                    <p class="text-xs text-slate-500">Pilih kecamatan untuk menjelajahi seluruh daftar alat TTG yang tersedia.</p>
                </div>

                <!-- Search Input Box -->
                <div class="w-full sm:w-80 relative">
                    <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-lg pointer-events-none">search</span>
                    <input type="text" id="search-wilayah-input"
                           onkeyup="filterWilayahCards()"
                           placeholder="Cari nama kecamatan..."
                           class="w-full pl-10 pr-3.5 py-2 sm:py-2.5 bg-white border border-slate-200 rounded-xl text-xs sm:text-sm font-medium text-slate-800 placeholder-slate-400 shadow-xs focus:outline-none focus:border-[#00A3E0] focus:ring-2 focus:ring-[#00A3E0]/20 transition-all">
                </div>
            </div>

            <!-- DISTRICT CARDS GRID (2 COLUMNS MOBILE, 4 COLUMNS DESKTOP) -->
            <div id="wilayah-grid" class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6">
                @forelse($wilayahList as $index => $w)
                    @php
                        $namaLower = strtolower($w->nama_kecamatan);
                        $icon = 'location_city';
                        if (str_contains($namaLower, 'cihideung')) {
                            $icon = 'domain';
                        } elseif (str_contains($namaLower, 'tawang')) {
                            $icon = 'apartment';
                        } elseif (str_contains($namaLower, 'cipedes')) {
                            $icon = 'precision_manufacturing';
                        } elseif (str_contains($namaLower, 'kawalu')) {
                            $icon = 'checkroom';
                        } elseif (str_contains($namaLower, 'mangkubumi')) {
                            $icon = 'agriculture';
                        } elseif (str_contains($namaLower, 'tamansari')) {
                            $icon = 'park';
                        } elseif (str_contains($namaLower, 'purbaratu')) {
                            $icon = 'recycling';
                        } elseif (str_contains($namaLower, 'indihiang')) {
                            $icon = 'storefront';
                        } elseif (str_contains($namaLower, 'bungursari')) {
                            $icon = 'nature_people';
                        } elseif (str_contains($namaLower, 'cibeureum') || str_contains($namaLower, 'cibereum')) {
                            $icon = 'handshake';
                        }

                        $delayClass = 'delay-' . (($index % 4 + 1) * 100);
                    @endphp

                    <div class="wilayah-card bg-white rounded-2xl sm:rounded-3xl border border-slate-100 p-3.5 sm:p-6 shadow-[0_4px_20px_rgba(0,0,0,0.02)] hover:shadow-2xl hover:-translate-y-1 sm:hover:-translate-y-2 hover:border-[#00A3E0]/40 transition-all duration-300 flex flex-col justify-between space-y-3 sm:space-y-6 group cursor-pointer reveal {{ $delayClass }}"
                         data-name="{{ strtolower($w->nama_kecamatan) }}"
                         onclick="focusMapOnDistrict('{{ strtolower($w->nama_kecamatan) }}')">
                        
                        <div class="space-y-2.5 sm:space-y-4">
                            <!-- Top Row: Icon Box + Count Pill Badge -->
                            <div class="flex items-center justify-between">
                                <div class="w-9 h-9 sm:w-12 sm:h-12 bg-sky-50 rounded-xl sm:rounded-2xl flex items-center justify-center text-[#00A3E0] group-hover:bg-[#00A3E0] group-hover:text-white transition-colors duration-300 shadow-2xs shrink-0">
                                    <span class="material-symbols-outlined text-xl sm:text-2xl group-hover:scale-110 transition-transform">
                                        {{ $icon }}
                                    </span>
                                </div>

                                <span class="inline-flex items-center gap-1 sm:gap-1.5 px-2 sm:px-3 py-0.5 sm:py-1 bg-amber-100/70 text-amber-800 font-extrabold text-[10px] sm:text-xs rounded-full shrink-0">
                                    <span class="material-symbols-outlined text-[10px] sm:text-xs">build</span>
                                    <span>{{ $w->alat_ttg_count }} Alat</span>
                                </span>
                            </div>

                            <!-- Card Body Title & Description -->
                            <div class="space-y-1 sm:space-y-2">
                                <h3 class="text-xs sm:text-xl font-black sm:font-extrabold text-slate-900 tracking-tight group-hover:text-[#00A3E0] transition-colors leading-tight line-clamp-1">
                                    Kec. {{ $w->nama_kecamatan }}
                                </h3>
                                <p class="text-slate-500 text-[11px] sm:text-xs leading-relaxed line-clamp-2 sm:line-clamp-3">
                                    {{ $w->deskripsi ?? 'Kawasan inovasi Teknologi Tepat Guna berbasis keunggulan lokal masyarakat Kecamatan '.$w->nama_kecamatan.'.' }}
                                </p>
                            </div>
                        </div>

                        <!-- Bottom Link CTA -->
                        <div class="pt-2 sm:pt-2 border-t border-slate-100 flex items-center justify-between">
                            <a href="{{ route('public.wilayah.detail', $w->id) }}"
                               onclick="event.stopPropagation();"
                               class="inline-flex items-center gap-1 text-[11px] sm:text-xs font-extrabold text-[#00A3E0] hover:text-[#008cc0] group-hover:translate-x-1 transition-all">
                                <span class="hidden sm:inline">Lihat Alat Katalog</span>
                                <span class="sm:hidden">Lihat Katalog</span>
                            </a>

                            <span class="text-[9px] sm:text-[10px] font-bold text-slate-400 group-hover:text-[#00A3E0] transition-colors whitespace-nowrap">
                                <span class="hidden sm:inline">Fokus Peta &gt;</span>
                                <span class="sm:hidden">Peta &gt;</span>
                            </span>
                        </div>

                    </div>
                @empty
                    <div class="col-span-full py-16 text-center text-slate-400 space-y-3 bg-white rounded-2xl border border-slate-100">
                        <span class="material-symbols-outlined text-5xl text-slate-300">map</span>
                        <p class="text-base font-bold text-slate-700">Belum ada data wilayah kecamatan.</p>
                    </div>
                @endforelse
            </div>

            <!-- Empty State Container when Live Search returns nothing -->
            <div id="wilayah-search-empty" class="hidden py-16 text-center text-slate-400 space-y-3 bg-white rounded-2xl border border-slate-100">
                <span class="material-symbols-outlined text-5xl text-slate-300">search_off</span>
                <p class="text-base font-bold text-slate-700">Tidak ada kecamatan yang cocok dengan pencarian Anda.</p>
            </div>
        </div>

    </main>

    <!-- FOOTER -->
    @include('partials.footer')


    <!-- JAVASCRIPT: MAP INTERACTION, LIVE SEARCH & ANIMATIONS -->
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
        // INTERVIEW & LEAFLET MAP INITIALIZATION
        // ========================================================
        // Center coordinates for marker pins in each Kecamatan
        const districtCoords = {
            'indihiang':  { lat: -7.278, lng: 108.195 },
            'bungursari': { lat: -7.295, lng: 108.168 },
            'cipedes':    { lat: -7.310, lng: 108.210 },
            'purbaratu':  { lat: -7.318, lng: 108.258 },
            'mangkubumi': { lat: -7.338, lng: 108.172 },
            'cihideung':  { lat: -7.332, lng: 108.206 },
            'tawang':     { lat: -7.336, lng: 108.226 },
            'cibeureum':  { lat: -7.352, lng: 108.256 },
            'cibereum':   { lat: -7.352, lng: 108.256 },
            'kawalu':     { lat: -7.382, lng: 108.192 },
            'tamansari':  { lat: -7.382, lng: 108.234 }
        };

        function getDistrictCoords(nameStr) {
            const clean = nameStr.toLowerCase().trim().replace(/kecamatan|kec\.|[\s_-]/g, '');
            for (let k in districtCoords) {
                if (clean.includes(k) || k.includes(clean)) {
                    return districtCoords[k];
                }
            }
            return { lat: -7.330, lng: 108.220 };
        }

        let map, markers = {};

        document.addEventListener('DOMContentLoaded', () => {
            // Initialize Leaflet map centered at Kota Tasikmalaya
            map = L.map('tasikmalaya-map', {
                scrollWheelZoom: false
            }).setView([-7.330, 108.220], 13);

            // Add OpenStreetMap Standard Tile Layer (Free, No API Key Required)
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                maxZoom: 19
            }).addTo(map);

            // Render Markers for each Wilayah
            @foreach($wilayahList as $w)
                (function() {
                    const rawName = '{{ $w->nama_kecamatan }}';
                    const key = rawName.toLowerCase().trim();
                    const count = '{{ $w->alat_ttg_count }}';
                    const detailUrl = '{{ route('public.wilayah.detail', $w->id) }}';
                    const coords = getDistrictCoords(rawName);

                    const popupHtml = `
                        <div class="p-0.5 text-slate-800 space-y-2.5 min-w-[190px]">
                            <div class="flex items-center gap-2 border-b border-slate-100 pb-2 pr-5">
                                <span class="material-symbols-outlined text-[#00A3E0] text-xl shrink-0">location_on</span>
                                <h4 class="font-extrabold text-sm text-slate-900 leading-snug">Kec. ${rawName}</h4>
                            </div>
                            <p class="text-xs text-slate-500 font-medium">Tersedia <strong class="text-[#00A3E0] font-extrabold">${count} Alat TTG</strong></p>
                            <a href="${detailUrl}" 
                               class="block w-full text-center py-2 px-3 bg-[#00A3E0] hover:bg-[#008cc0] !text-white rounded-xl text-xs font-bold shadow-xs transition-all">
                                Lihat Katalog
                            </a>
                        </div>
                    `;

                    // Create custom pin marker
                    const customIcon = L.divIcon({
                        className: 'custom-map-pin-container',
                        html: `<div class="custom-map-pin w-9 h-9">
                                <span>${count}</span>
                               </div>`,
                        iconSize: [36, 36],
                        iconAnchor: [18, 18]
                    });

                    const marker = L.marker([coords.lat, coords.lng], { icon: customIcon })
                        .addTo(map)
                        .bindPopup(popupHtml);

                    markers[key] = marker;
                })();
            @endforeach

            // Setup IntersectionObserver for Scroll Reveal
            const revealElements = document.querySelectorAll('.reveal, .reveal-left, .reveal-right, .reveal-zoom');

            const observerOptions = {
                root: null,
                rootMargin: '0px 0px -50px 0px',
                threshold: 0.12
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

        // Function to focus map on clicked district card
        function focusMapOnDistrict(key) {
            if (map) {
                const coords = getDistrictCoords(key);
                map.flyTo([coords.lat, coords.lng], 14.5, {
                    duration: 1.2
                });

                if (markers[key]) {
                    setTimeout(() => {
                        markers[key].openPopup();
                    }, 800);
                }

                // Scroll map into view smoothly if user is far down
                const mapContainer = document.getElementById('tasikmalaya-map');
                if (mapContainer) {
                    mapContainer.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }
        }

        // Live Search Wilayah Cards Filter
        function filterWilayahCards() {
            const query = document.getElementById('search-wilayah-input').value.toLowerCase().trim();
            const cards = document.querySelectorAll('.wilayah-card');
            let visibleCount = 0;

            cards.forEach(card => {
                const name = card.getAttribute('data-name');

                if (name.includes(query)) {
                    card.classList.remove('hidden');
                    visibleCount++;
                } else {
                    card.classList.add('hidden');
                }
            });

            const emptyState = document.getElementById('wilayah-search-empty');
            if (visibleCount === 0) {
                emptyState.classList.remove('hidden');
            } else {
                emptyState.classList.add('hidden');
            }
        }
    </script>

</body>
</html>
