<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang SI RINOVA - Sistem Informasi Riset & Inovasi Kota Tasikmalaya</title>
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

        /* Floating Micro Animations */
        @keyframes floatSlow {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-8px) rotate(1.5deg); }
        }
        @keyframes floatReverse {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(8px) rotate(-1.5deg); }
        }
        .animate-float-1 { animation: floatSlow 4s ease-in-out infinite; }
        .animate-float-2 { animation: floatReverse 4.5s ease-in-out infinite; }
        .animate-float-3 { animation: floatSlow 5s ease-in-out infinite; }
        .animate-float-4 { animation: floatReverse 5.5s ease-in-out infinite; }

        /* Pulse Glow Animation */
        @keyframes pulseGlow {
            0%, 100% { opacity: 0.35; transform: scale(1); }
            50% { opacity: 0.75; transform: scale(1.15); }
        }
        .animate-pulse-glow { animation: pulseGlow 6s ease-in-out infinite; }
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

                <a href="{{ route('public.ebook') }}" class="text-slate-600 hover:text-[#00A3E0] transition-colors py-1">E-Book Kajian</a>
                <a href="{{ route('public.telaahan-staf') }}" class="text-slate-600 hover:text-[#00A3E0] transition-colors py-1">Telaahan Staf</a>
                <a href="{{ route('public.galeri') }}" class="text-slate-600 hover:text-[#00A3E0] transition-colors py-1">Galeri</a>
                <a href="{{ route('lomba.info') }}" class="text-amber-500 hover:text-amber-600 transition-colors py-1 flex items-center gap-1 font-bold">
                    <span class="material-symbols-outlined text-base">emoji_events</span>
                    <span>Lomba TTG</span>
                </a>
                <a href="{{ route('public.tentang') }}" class="text-[#00A3E0] border-b-2 border-[#00A3E0] pb-1 transition-colors">Tentang</a>
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
                <button id="mobile-katalog-btn" type="button" class="w-full flex items-center justify-between text-xs font-bold text-slate-400 hover:text-[#00A3E0] uppercase tracking-wider focus:outline-none transition-colors py-1">
                    <span>Katalog TTG</span>
                    <span id="mobile-katalog-icon" class="material-symbols-outlined text-base transition-transform duration-200">expand_more</span>
                </button>
                <div id="mobile-katalog-sub" class="hidden space-y-2 pt-1.5 pl-3">
                    <a href="{{ route('katalog.index') }}" class="block text-slate-600 hover:text-[#00A3E0]">Alat TTG</a>
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
            <a href="{{ route('public.tentang') }}" class="block text-[#00A3E0]">Tentang</a>
        </div>
    </header>

    <!-- MAIN CONTENT CONTAINER -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-14 flex-1 w-full space-y-20">

        <!-- 2. HERO HEADER SECTION -->
        <div class="text-center max-w-3xl mx-auto space-y-4 reveal-zoom">

            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 tracking-tight leading-tight">
                Sistem Informasi Riset & Inovasi <br class="hidden sm:inline">
                <span class="text-[#00A3E0]">SI RINOVA Kota Tasikmalaya</span>
            </h1>

            <p class="text-slate-500 text-sm sm:text-base leading-relaxed max-w-2xl mx-auto">
                Platform integrasi publikasi riset, inovasi daerah, capaian indikator makro, dan penerapan Teknologi Tepat Guna (TTG) Bappelitbangda Kota Tasikmalaya.
            </p>
        </div>

        <!-- 3. "APA ITU SI RINOVA?" SECTION -->
        <div class="bg-white rounded-3xl border border-slate-100 p-6 sm:p-10 shadow-[0_4px_25px_rgba(0,0,0,0.03)] grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            
            <!-- Left Side: Visual Illustration Container -->
            <div class="lg:col-span-6 bg-gradient-to-br from-sky-100 via-sky-50 to-blue-100/70 rounded-2xl p-6 sm:p-8 flex flex-col items-center justify-center min-h-[360px] relative overflow-hidden border border-sky-100 reveal-left">
                <!-- Background decorative glowing blur -->
                <div class="absolute -top-10 -left-10 w-44 h-44 bg-[#00A3E0]/20 rounded-full blur-3xl pointer-events-none animate-pulse-glow"></div>
                <div class="absolute -bottom-10 -right-10 w-44 h-44 bg-blue-500/15 rounded-full blur-3xl pointer-events-none animate-pulse-glow"></div>

                <!-- 3D Conceptual Floating Cards (6 Modules Symmetrical Grid) -->
                <div class="relative z-10 w-full max-w-sm space-y-2.5">
                    <!-- Row 1: Indikator Makro & Alat TTG -->
                    <div class="grid grid-cols-2 gap-2.5">
                        <div class="bg-white/95 backdrop-blur-md p-3 rounded-2xl shadow-sm border border-white/80 flex flex-col items-center gap-1.5 text-center transition-all hover:scale-105 hover:shadow-md animate-float-1">
                            <div class="w-9 h-9 rounded-xl bg-cyan-50 text-[#00A3E0] flex items-center justify-center">
                                <span class="material-symbols-outlined text-xl">analytics</span>
                            </div>
                            <span class="text-[10px] font-extrabold text-slate-800 uppercase tracking-wider">Indikator Makro</span>
                        </div>

                        <div class="bg-white/95 backdrop-blur-md p-3 rounded-2xl shadow-sm border border-white/80 flex flex-col items-center gap-1.5 text-center transition-all hover:scale-105 hover:shadow-md animate-float-2">
                            <div class="w-9 h-9 rounded-xl bg-sky-50 text-[#00A3E0] flex items-center justify-center">
                                <span class="material-symbols-outlined text-xl">hardware</span>
                            </div>
                            <span class="text-[10px] font-extrabold text-slate-800 uppercase tracking-wider">Katalog TTG</span>
                        </div>
                    </div>

                    <!-- Row 2: E-Book Kajian & Telaahan Staf -->
                    <div class="grid grid-cols-2 gap-2.5">
                        <div class="bg-white/95 backdrop-blur-md p-3 rounded-2xl shadow-sm border border-white/80 flex flex-col items-center gap-1.5 text-center transition-all hover:scale-105 hover:shadow-md animate-float-3">
                            <div class="w-9 h-9 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                                <span class="material-symbols-outlined text-xl">auto_stories</span>
                            </div>
                            <span class="text-[10px] font-extrabold text-slate-800 uppercase tracking-wider">E-Book Kajian</span>
                        </div>

                        <div class="bg-white/95 backdrop-blur-md p-3 rounded-2xl shadow-sm border border-white/80 flex flex-col items-center gap-1.5 text-center transition-all hover:scale-105 hover:shadow-md animate-float-4">
                            <div class="w-9 h-9 rounded-xl bg-sky-50 text-[#00A3E0] flex items-center justify-center">
                                <span class="material-symbols-outlined text-xl">description</span>
                            </div>
                            <span class="text-[10px] font-extrabold text-slate-800 uppercase tracking-wider">Telaahan Staf</span>
                        </div>
                    </div>

                    <!-- Row 3: Galeri Kegiatan & Lomba TTG -->
                    <div class="grid grid-cols-2 gap-2.5">
                        <div class="bg-white/95 backdrop-blur-md p-3 rounded-2xl shadow-sm border border-white/80 flex flex-col items-center gap-1.5 text-center transition-all hover:scale-105 hover:shadow-md animate-float-1">
                            <div class="w-9 h-9 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                                <span class="material-symbols-outlined text-xl">photo_library</span>
                            </div>
                            <span class="text-[10px] font-extrabold text-slate-800 uppercase tracking-wider">Galeri Kegiatan</span>
                        </div>

                        <div class="bg-gradient-to-br from-white to-amber-50/90 backdrop-blur-md p-3 rounded-2xl shadow-sm border border-amber-200/80 flex flex-col items-center gap-1.5 text-center transition-all hover:scale-105 hover:shadow-md animate-float-2 relative">
                            <div class="w-9 h-9 rounded-xl bg-amber-500 text-white flex items-center justify-center shadow-xs">
                                <span class="material-symbols-outlined text-xl">emoji_events</span>
                            </div>
                            <span class="text-[10px] font-extrabold text-slate-800 uppercase tracking-wider">Lomba TTG</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side: Explanation & Feature Pills -->
            <div class="lg:col-span-6 space-y-5 reveal-right">
                <h2 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">
                    Apa Itu SI RINOVA?
                </h2>
                
                <p class="text-slate-600 text-xs sm:text-sm leading-relaxed text-justify">
                    <strong class="text-slate-800">SI RINOVA (Sistem Informasi Riset dan Inovasi)</strong> adalah wadah publikasi dan informasi terpadu Bappelitbangda Kota Tasikmalaya yang dirancang untuk memfasilitasi riset ilmiah, dokumen kebijakan, data indikator makro, penerapan inovasi daerah, serta pelaksanaan kompetisi teknologi tepat guna.
                </p>

                <p class="text-slate-600 text-xs sm:text-sm leading-relaxed text-justify">
                    Platform ini menyajikan enam menu layanan utama: <span class="text-[#00A3E0] font-semibold">Capaian Indikator Makro</span>, <span class="text-[#00A3E0] font-semibold">Katalog Alat Teknologi Tepat Guna (TTG)</span>, <span class="text-[#00A3E0] font-semibold">Repositori E-Book Kajian</span>, <span class="text-[#00A3E0] font-semibold">Naskah Telaahan Staf</span>, <span class="text-[#00A3E0] font-semibold">Dokumentasi Galeri Kegiatan</span>, serta <span class="text-amber-600 font-semibold">Pendaftaran Lomba Inovasi TTG</span> Bappelitbangda Kota Tasikmalaya.
                </p>

                <!-- Feature Badges -->
                <div class="flex flex-wrap items-center gap-2.5 pt-2">
                    <a href="{{ route('public.indikator-makro') }}" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 bg-sky-50 text-[#00A3E0] border border-sky-100 font-bold text-xs rounded-full shadow-2xs hover:scale-105 transition-transform">
                        <span class="material-symbols-outlined text-sm">analytics</span>
                        <span>Indikator Makro</span>
                    </a>
                    <a href="{{ route('katalog.index') }}" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 bg-sky-50 text-[#00A3E0] border border-sky-100 font-bold text-xs rounded-full shadow-2xs hover:scale-105 transition-transform">
                        <span class="material-symbols-outlined text-sm">hardware</span>
                        <span>Alat TTG</span>
                    </a>
                    <a href="{{ route('public.ebook') }}" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 bg-sky-50 text-[#00A3E0] border border-sky-100 font-bold text-xs rounded-full shadow-2xs hover:scale-105 transition-transform">
                        <span class="material-symbols-outlined text-sm">auto_stories</span>
                        <span>E-Book Kajian</span>
                    </a>
                    <a href="{{ route('public.telaahan-staf') }}" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 bg-sky-50 text-[#00A3E0] border border-sky-100 font-bold text-xs rounded-full shadow-2xs hover:scale-105 transition-transform">
                        <span class="material-symbols-outlined text-sm">description</span>
                        <span>Telaahan Staf</span>
                    </a>
                    <a href="{{ route('public.galeri') }}" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 bg-sky-50 text-[#00A3E0] border border-sky-100 font-bold text-xs rounded-full shadow-2xs hover:scale-105 transition-transform">
                        <span class="material-symbols-outlined text-sm">photo_library</span>
                        <span>Galeri Kegiatan</span>
                    </a>
                    <a href="{{ route('lomba.info') }}" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 bg-amber-50 text-amber-700 border border-amber-200 font-bold text-xs rounded-full shadow-2xs hover:scale-105 transition-transform">
                        <span class="material-symbols-outlined text-sm text-amber-500">emoji_events</span>
                        <span>Lomba TTG</span>
                    </a>
                </div>
            </div>

        </div>

        <!-- 4. LIVE ANIMATED COUNTER STATS SECTION -->
        <div class="space-y-6">
            <div class="text-center max-w-xl mx-auto space-y-1 reveal">
                <h2 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Capaian Inovasi Daerah</h2>
                <p class="text-slate-500 text-xs sm:text-sm">Data statistik perkembangan teknologi tepat guna di Kota Tasikmalaya.</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6">
                <!-- Stat 1: Total Alat -->
                <div class="bg-white rounded-2xl border border-slate-100 p-5 sm:p-6 text-center space-y-2 shadow-[0_2px_15px_rgba(0,0,0,0.02)] hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 group reveal delay-100">
                    <div class="w-10 h-10 bg-sky-50 group-hover:bg-[#00A3E0] text-[#00A3E0] group-hover:text-white rounded-xl flex items-center justify-center mx-auto transition-colors duration-300">
                        <span class="material-symbols-outlined text-2xl">build</span>
                    </div>
                    <div class="text-2xl sm:text-3xl font-black text-slate-900 group-hover:text-[#00A3E0] transition-colors counter-num" data-target="{{ $totalAlat ?? 0 }}">0</div>
                    <div class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Alat TTG</div>
                </div>

                <!-- Stat 2: Total Inovator -->
                <div class="bg-white rounded-2xl border border-slate-100 p-5 sm:p-6 text-center space-y-2 shadow-[0_2px_15px_rgba(0,0,0,0.02)] hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 group reveal delay-200">
                    <div class="w-10 h-10 bg-sky-50 group-hover:bg-[#00A3E0] text-[#00A3E0] group-hover:text-white rounded-xl flex items-center justify-center mx-auto transition-colors duration-300">
                        <span class="material-symbols-outlined text-2xl">person_pin</span>
                    </div>
                    <div class="text-2xl sm:text-3xl font-black text-slate-900 group-hover:text-[#00A3E0] transition-colors counter-num" data-target="{{ $totalInovator ?? 0 }}">0</div>
                    <div class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Inovator</div>
                </div>

                <!-- Stat 3: Total Kategori -->
                <div class="bg-white rounded-2xl border border-slate-100 p-5 sm:p-6 text-center space-y-2 shadow-[0_2px_15px_rgba(0,0,0,0.02)] hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 group reveal delay-300">
                    <div class="w-10 h-10 bg-sky-50 group-hover:bg-[#00A3E0] text-[#00A3E0] group-hover:text-white rounded-xl flex items-center justify-center mx-auto transition-colors duration-300">
                        <span class="material-symbols-outlined text-2xl">category</span>
                    </div>
                    <div class="text-2xl sm:text-3xl font-black text-slate-900 group-hover:text-[#00A3E0] transition-colors counter-num" data-target="{{ $totalKategori ?? 0 }}">0</div>
                    <div class="text-xs font-bold text-slate-400 uppercase tracking-wider">Kategori TTG</div>
                </div>

                <!-- Stat 4: Total Kecamatan -->
                <div class="bg-white rounded-2xl border border-slate-100 p-5 sm:p-6 text-center space-y-2 shadow-[0_2px_15px_rgba(0,0,0,0.02)] hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 group reveal delay-400">
                    <div class="w-10 h-10 bg-sky-50 group-hover:bg-[#00A3E0] text-[#00A3E0] group-hover:text-white rounded-xl flex items-center justify-center mx-auto transition-colors duration-300">
                        <span class="material-symbols-outlined text-2xl">location_city</span>
                    </div>
                    <div class="text-2xl sm:text-3xl font-black text-slate-900 group-hover:text-[#00A3E0] transition-colors counter-num" data-target="{{ $totalWilayah ?? 0 }}">0</div>
                    <div class="text-xs font-bold text-slate-400 uppercase tracking-wider">Kecamatan</div>
                </div>
            </div>
        </div>

        <!-- 5. "LAYANAN UTAMA SI RINOVA" SECTION (6 Columns Grid) -->
        <div class="space-y-8">
            <div class="text-center max-w-2xl mx-auto space-y-2 reveal">
                <h2 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">
                    Layanan Utama SI RINOVA
                </h2>
                <p class="text-slate-500 text-xs sm:text-sm leading-relaxed">
                    SI RINOVA menghadirkan enam pilar utama untuk mendorong kemajuan riset, publikasi kebijakan, visualisasi data pembangunan, inovasi terapan, dan kompetisi karya inovasi di Kota Tasikmalaya.
                </p>
            </div>

            <!-- 6 Columns Cards (3 Cols on Desktop, 2 Cols on Tablet, 1 Col on Mobile) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                
                <!-- Card 1: Indikator Makro -->
                <div class="bg-white rounded-3xl border border-slate-100 p-6 shadow-[0_4px_20px_rgba(0,0,0,0.02)] hover:shadow-2xl hover:-translate-y-2 hover:border-[#00A3E0]/40 transition-all duration-300 space-y-4 group reveal delay-100 flex flex-col justify-between">
                    <div class="space-y-3">
                        <div class="w-12 h-12 bg-cyan-50 group-hover:bg-[#29abe2] rounded-2xl flex items-center justify-center text-[#29abe2] group-hover:text-white relative transition-colors duration-300">
                            <span class="material-symbols-outlined text-2xl group-hover:scale-110 transition-transform">analytics</span>
                            <span class="absolute top-1 right-1 flex h-2.5 w-2.5">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-400"></span>
                            </span>
                        </div>

                        <h3 class="text-base font-extrabold text-slate-900 group-hover:text-[#00A3E0] transition-colors tracking-tight">
                            Indikator Makro
                        </h3>

                        <p class="text-slate-500 text-xs leading-relaxed">
                            Visualisasi dan perbandingan 27 indikator pembangunan makro daerah Kota Tasikmalaya dan Jawa Barat secara komprehensif.
                        </p>
                    </div>
                    <div class="pt-2 border-t border-slate-100/80">
                        <a href="{{ route('public.indikator-makro') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#00A3E0] hover:text-[#008cc0] group-hover:translate-x-0.5 transition-all">
                            <span>Lihat Data Makro</span>
                            <span class="material-symbols-outlined text-base">arrow_forward</span>
                        </a>
                    </div>
                </div>

                <!-- Card 2: Alat TTG -->
                <div class="bg-white rounded-3xl border border-slate-100 p-6 shadow-[0_4px_20px_rgba(0,0,0,0.02)] hover:shadow-2xl hover:-translate-y-2 hover:border-[#00A3E0]/40 transition-all duration-300 space-y-4 group reveal delay-200 flex flex-col justify-between">
                    <div class="space-y-3">
                        <div class="w-12 h-12 bg-sky-50 group-hover:bg-[#00A3E0] rounded-2xl flex items-center justify-center text-[#00A3E0] group-hover:text-white relative transition-colors duration-300">
                            <span class="material-symbols-outlined text-2xl group-hover:scale-110 transition-transform">hardware</span>
                            <span class="absolute top-1 right-1 flex h-2.5 w-2.5">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-amber-400"></span>
                            </span>
                        </div>

                        <h3 class="text-base font-extrabold text-slate-900 group-hover:text-[#00A3E0] transition-colors tracking-tight">
                            Katalog Alat TTG
                        </h3>

                        <p class="text-slate-500 text-xs leading-relaxed">
                            Publikasi teknologi tepat guna yang praktis, ekonomis, dan ramah lingkungan untuk efisiensi produktivitas masyarakat lokal.
                        </p>
                    </div>
                    <div class="pt-2 border-t border-slate-100/80">
                        <a href="{{ route('katalog.index') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#00A3E0] hover:text-[#008cc0] group-hover:translate-x-0.5 transition-all">
                            <span>Jelajahi Alat</span>
                            <span class="material-symbols-outlined text-base">arrow_forward</span>
                        </a>
                    </div>
                </div>

                <!-- Card 3: E-Book Kajian -->
                <div class="bg-white rounded-3xl border border-slate-100 p-6 shadow-[0_4px_20px_rgba(0,0,0,0.02)] hover:shadow-2xl hover:-translate-y-2 hover:border-[#00A3E0]/40 transition-all duration-300 space-y-4 group reveal delay-300 flex flex-col justify-between">
                    <div class="space-y-3">
                        <div class="w-12 h-12 bg-amber-50 group-hover:bg-[#fed000] rounded-2xl flex items-center justify-center text-amber-600 group-hover:text-slate-900 relative transition-colors duration-300">
                            <span class="material-symbols-outlined text-2xl group-hover:scale-110 transition-transform">auto_stories</span>
                            <span class="absolute top-1 right-1 flex h-2.5 w-2.5">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#00A3E0] opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-[#00A3E0]"></span>
                            </span>
                        </div>

                        <h3 class="text-base font-extrabold text-slate-900 group-hover:text-[#00A3E0] transition-colors tracking-tight">
                            E-Book Hasil Kajian
                        </h3>

                        <p class="text-slate-500 text-xs leading-relaxed">
                            Publikasi riset dan kajian ilmiah daerah dalam format e-book 3D interaktif yang mudah diakses dan dibaca secara daring.
                        </p>
                    </div>
                    <div class="pt-2 border-t border-slate-100/80">
                        <a href="{{ route('public.ebook') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#00A3E0] hover:text-[#008cc0] group-hover:translate-x-0.5 transition-all">
                            <span>Baca E-Book</span>
                            <span class="material-symbols-outlined text-base">arrow_forward</span>
                        </a>
                    </div>
                </div>

                <!-- Card 4: Telaahan Staf -->
                <div class="bg-white rounded-3xl border border-slate-100 p-6 shadow-[0_4px_20px_rgba(0,0,0,0.02)] hover:shadow-2xl hover:-translate-y-2 hover:border-[#00A3E0]/40 transition-all duration-300 space-y-4 group reveal delay-400 flex flex-col justify-between">
                    <div class="space-y-3">
                        <div class="w-12 h-12 bg-sky-50 group-hover:bg-[#00A3E0] rounded-2xl flex items-center justify-center text-[#00A3E0] group-hover:text-white relative transition-colors duration-300">
                            <span class="material-symbols-outlined text-2xl group-hover:scale-110 transition-transform">description</span>
                            <span class="absolute top-1 right-1 flex h-2.5 w-2.5">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-amber-400"></span>
                            </span>
                        </div>

                        <h3 class="text-base font-extrabold text-slate-900 group-hover:text-[#00A3E0] transition-colors tracking-tight">
                            Telaahan Staf
                        </h3>

                        <p class="text-slate-500 text-xs leading-relaxed">
                            Dokumen analisis strategis dan rekomendasi kebijakan ilmiah inovasi daerah untuk pembangunan Kota Tasikmalaya.
                        </p>
                    </div>
                    <div class="pt-2 border-t border-slate-100/80">
                        <a href="{{ route('public.telaahan-staf') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#00A3E0] hover:text-[#008cc0] group-hover:translate-x-0.5 transition-all">
                            <span>Lihat Telaahan</span>
                            <span class="material-symbols-outlined text-base">arrow_forward</span>
                        </a>
                    </div>
                </div>

                <!-- Card 5: Galeri Kegiatan -->
                <div class="bg-white rounded-3xl border border-slate-100 p-6 shadow-[0_4px_20px_rgba(0,0,0,0.02)] hover:shadow-2xl hover:-translate-y-2 hover:border-[#00A3E0]/40 transition-all duration-300 space-y-4 group reveal delay-500 flex flex-col justify-between">
                    <div class="space-y-3">
                        <div class="w-12 h-12 bg-emerald-50 group-hover:bg-emerald-500 rounded-2xl flex items-center justify-center text-emerald-600 group-hover:text-white relative transition-colors duration-300">
                            <span class="material-symbols-outlined text-2xl group-hover:scale-110 transition-transform">photo_library</span>
                            <span class="absolute top-1 right-1 flex h-2.5 w-2.5">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#00A3E0] opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-[#00A3E0]"></span>
                            </span>
                        </div>

                        <h3 class="text-base font-extrabold text-slate-900 group-hover:text-[#00A3E0] transition-colors tracking-tight">
                            Galeri Kegiatan
                        </h3>

                        <p class="text-slate-500 text-xs leading-relaxed">
                            Dokumentasi foto kegiatan riset, pameran inovasi, bimbingan teknis, serta sosialisasi teknologi tepat guna daerah.
                        </p>
                    </div>
                    <div class="pt-2 border-t border-slate-100/80">
                        <a href="{{ route('public.galeri') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#00A3E0] hover:text-[#008cc0] group-hover:translate-x-0.5 transition-all">
                            <span>Buka Galeri</span>
                            <span class="material-symbols-outlined text-base">arrow_forward</span>
                        </a>
                    </div>
                </div>

                <!-- Card 6: Lomba Inovasi TTG (NEW) -->
                <div class="bg-white rounded-3xl border border-slate-100 p-6 shadow-[0_4px_20px_rgba(0,0,0,0.02)] hover:shadow-2xl hover:-translate-y-2 hover:border-amber-400/40 transition-all duration-300 space-y-4 group reveal delay-100 flex flex-col justify-between relative overflow-hidden">
                    <div class="absolute -right-12 -top-12 w-28 h-28 bg-amber-400/10 rounded-full blur-xl pointer-events-none"></div>

                    <div class="space-y-3">
                        <div class="w-12 h-12 bg-amber-50 group-hover:bg-amber-500 rounded-2xl flex items-center justify-center text-amber-500 group-hover:text-white relative transition-colors duration-300">
                            <span class="material-symbols-outlined text-2xl group-hover:scale-110 transition-transform">emoji_events</span>
                            <span class="absolute top-1 right-1 flex h-2.5 w-2.5">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-amber-400"></span>
                            </span>
                        </div>

                        <div class="flex items-center gap-2">
                            <h3 class="text-base font-extrabold text-slate-900 group-hover:text-amber-500 transition-colors tracking-tight">
                                Lomba Inovasi TTG
                            </h3>
                            <span class="px-2 py-0.5 bg-amber-50 border border-amber-200 text-amber-600 text-[10px] font-extrabold rounded-full uppercase">Baru</span>
                        </div>

                        <p class="text-slate-500 text-xs leading-relaxed">
                            Kompetisi tahunan karya inovasi teknologi tepat guna bagi pelajar, mahasiswa, dan masyarakat umum Kota Tasikmalaya.
                        </p>
                    </div>
                    <div class="pt-2 border-t border-slate-100/80">
                        <a href="{{ route('lomba.info') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-amber-500 hover:text-amber-600 group-hover:translate-x-0.5 transition-all">
                            <span>Daftar & Info Lomba</span>
                            <span class="material-symbols-outlined text-base">arrow_forward</span>
                        </a>
                    </div>
                </div>

            </div>
        </div>

        <!-- 6. "HUBUNGI KAMI" & GOOGLE MAP SECTION -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
            
            <!-- Left Info Panel -->
            <div class="lg:col-span-5 bg-white rounded-3xl border border-slate-100 p-7 shadow-[0_4px_20px_rgba(0,0,0,0.02)] space-y-5 reveal-left">
                <div class="space-y-1.5">
                    <h2 class="text-2xl font-black text-slate-900 tracking-tight">
                        Hubungi Kami
                    </h2>
                    <p class="text-slate-500 text-xs sm:text-sm leading-relaxed">
                        Punya pertanyaan atau ingin berkolaborasi? Kami siap membantu Anda.
                    </p>
                </div>

                <div class="space-y-2">
                    <!-- Alamat -->
                    <a href="https://maps.google.com/?q=BAPPELITBANGDA+KOTA+TASIKMALAYA" target="_blank"
                       class="flex items-start gap-3.5 p-2.5 -mx-2 rounded-2xl hover:bg-sky-50/70 border border-transparent hover:border-sky-100 transition-all duration-300 group">
                        <div class="w-9 h-9 bg-sky-50 group-hover:bg-[#00A3E0] rounded-xl flex items-center justify-center text-[#00A3E0] group-hover:text-white shrink-0 transition-colors">
                            <span class="material-symbols-outlined text-lg">location_on</span>
                        </div>
                        <div>
                            <h4 class="font-extrabold text-slate-900 text-sm group-hover:text-[#00A3E0] transition-colors">Alamat</h4>
                            <p class="text-xs text-slate-500 font-medium">Jl. Letnan Harun, Panglayungan Cipedes, Tasikmalaya, Jawa Barat 46134</p>
                        </div>
                    </a>

                    <!-- Email -->
                    <a href="mailto:litbang@tasikmalayakota.go.id"
                       class="flex items-start gap-3.5 p-2.5 -mx-2 rounded-2xl hover:bg-sky-50/70 border border-transparent hover:border-sky-100 transition-all duration-300 group">
                        <div class="w-9 h-9 bg-sky-50 group-hover:bg-[#00A3E0] rounded-xl flex items-center justify-center text-[#00A3E0] group-hover:text-white shrink-0 transition-colors">
                            <span class="material-symbols-outlined text-lg">mail</span>
                        </div>
                        <div>
                            <h4 class="font-extrabold text-slate-900 text-sm group-hover:text-[#00A3E0] transition-colors">Email</h4>
                            <p class="text-xs text-slate-500 font-medium">litbang@tasikmalayakota.go.id</p>
                        </div>
                    </a>

                    <!-- Telepon Kantor -->
                    <a href="tel:0265331234"
                       class="flex items-start gap-3.5 p-2.5 -mx-2 rounded-2xl hover:bg-sky-50/70 border border-transparent hover:border-sky-100 transition-all duration-300 group">
                        <div class="w-9 h-9 bg-sky-50 group-hover:bg-[#00A3E0] rounded-xl flex items-center justify-center text-[#00A3E0] group-hover:text-white shrink-0 transition-colors">
                            <span class="material-symbols-outlined text-lg">call</span>
                        </div>
                        <div>
                            <h4 class="font-extrabold text-slate-900 text-sm group-hover:text-[#00A3E0] transition-colors">Telepon Kantor</h4>
                            <p class="text-xs text-slate-500 font-medium">(0265) 331234</p>
                        </div>
                    </a>

                    <!-- WhatsApp -->
                    <a href="https://wa.me/6281393515410?text=Halo%20Bappelitbangda%20Kota%20Tasikmalaya," target="_blank"
                       class="flex items-start gap-3.5 p-2.5 -mx-2 rounded-2xl hover:bg-emerald-50/70 border border-transparent hover:border-emerald-100 transition-all duration-300 group">
                        <div class="w-9 h-9 bg-emerald-50 group-hover:bg-emerald-600 rounded-xl flex items-center justify-center text-emerald-600 group-hover:text-white shrink-0 transition-colors">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-extrabold text-slate-900 text-sm group-hover:text-emerald-600 transition-colors">WhatsApp</h4>
                            <p class="text-xs text-slate-500 font-medium">0813-9351-5410</p>
                        </div>
                    </a>

                    <!-- Jam Operasional -->
                    <div class="flex items-start gap-3.5 p-2.5 -mx-2 rounded-2xl hover:bg-amber-50/70 border border-transparent hover:border-amber-100 transition-all duration-300 group">
                        <div class="w-9 h-9 bg-amber-100/80 group-hover:bg-amber-500 rounded-xl flex items-center justify-center text-amber-600 group-hover:text-white shrink-0 transition-colors">
                            <span class="material-symbols-outlined text-lg">schedule</span>
                        </div>
                        <div>
                            <h4 class="font-extrabold text-slate-900 text-sm group-hover:text-amber-600 transition-colors">Jam Operasional</h4>
                            <p class="text-xs text-slate-500 font-medium leading-relaxed">
                                Senin - Kamis : 07.30 - 15.30 WIB <br>
                                Jumat : 07.30 - 16.00 WIB
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Google Map Panel -->
            <div class="lg:col-span-7 bg-white rounded-3xl border border-slate-100 overflow-hidden shadow-[0_4px_20px_rgba(0,0,0,0.02)] min-h-[360px] relative reveal-right">
                <iframe
                    src="https://maps.google.com/maps?q=BAPPELITBANGDA+KOTA+TASIKMALAYA,+Jl.+Ir.+H.+Juanda+No.191,+Bungursari,+Kota+Tasikmalaya&t=&z=16&ie=UTF8&iwloc=&output=embed"
                    class="w-full h-full min-h-[360px] border-0"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>

        </div>

        <!-- 7. FORM KIRIM PESAN SECTION -->
        <div class="reveal mt-8 scroll-mt-24 sm:scroll-mt-28" id="form-pesan">
            <div class="bg-white rounded-3xl border border-slate-100 p-7 shadow-[0_4px_20px_rgba(0,0,0,0.02)]">

                <!-- Header -->
                <div class="space-y-1.5 mb-6">
                    <div class="flex items-center gap-2.5">
                        <div class="w-10 h-10 bg-sky-50 rounded-2xl flex items-center justify-center text-[#00A3E0]">
                            <span class="material-symbols-outlined text-xl">send</span>
                        </div>
                        <div>
                            <h2 class="text-2xl font-black text-slate-900 tracking-tight">
                                Kirim Pesan
                            </h2>
                            <p class="text-slate-500 text-xs sm:text-sm leading-relaxed">
                                Kirimkan pesan, pertanyaan, atau permohonan data langsung kepada kami.
                            </p>
                        </div>
                    </div>
                </div>



                <!-- Alert Error Validasi -->
                @if($errors->any())
                    <div class="mb-5 p-4 bg-red-50 text-red-700 border border-red-200 rounded-2xl flex items-start gap-3 text-sm">
                        <span class="material-symbols-outlined text-lg shrink-0 mt-0.5">error</span>
                        <div>
                            <p class="font-semibold">Terjadi Kesalahan</p>
                            <ul class="list-disc pl-4 mt-1 text-xs space-y-0.5">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <!-- Form -->
                <form method="POST" action="{{ route('pesan.store') }}" class="space-y-5">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        <!-- Nama Lengkap -->
                        <div class="space-y-1.5">
                            <label for="nama" class="text-xs font-bold text-slate-700 flex items-center gap-1">
                                <span class="material-symbols-outlined text-sm text-slate-400">person</span> Nama Lengkap <span class="text-rose-500"></span>
                            </label>
                            <input type="text" name="nama" id="nama" value="{{ old('nama') }}" required
                                placeholder="Masukkan nama lengkap Anda"
                                class="w-full px-4 py-3 bg-slate-50/80 border border-slate-200 rounded-xl text-sm text-slate-800 placeholder-slate-400 focus:ring-2 focus:ring-[#00A3E0]/30 focus:border-[#00A3E0] outline-none transition-all duration-200">
                        </div>

                        <!-- Email -->
                        <div class="space-y-1.5">
                            <label for="email" class="text-xs font-bold text-slate-700 flex items-center gap-1">
                                <span class="material-symbols-outlined text-sm text-slate-400">mail</span> Email <span class="text-rose-500"></span>
                            </label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                placeholder="Masukkan email Anda"
                                class="w-full px-4 py-3 bg-slate-50/80 border border-slate-200 rounded-xl text-sm text-slate-800 placeholder-slate-400 focus:ring-2 focus:ring-[#00A3E0]/30 focus:border-[#00A3E0] outline-none transition-all duration-200">
                        </div>

                        <!-- No. WhatsApp / Telepon -->
                        <div class="space-y-1.5">
                            <label for="no_wa" class="text-xs font-bold text-slate-700 flex items-center gap-1">
                                <span class="material-symbols-outlined text-sm text-slate-400">call</span> No. WhatsApp / HP <span class="text-slate-400 font-normal text-[11px]"></span>
                            </label>
                            <input type="tel" name="no_wa" id="no_wa" value="{{ old('no_wa') }}" required
                                placeholder="Contoh: 08123456789"
                                class="w-full px-4 py-3 bg-slate-50/80 border border-slate-200 rounded-xl text-sm text-slate-800 placeholder-slate-400 focus:ring-2 focus:ring-[#00A3E0]/30 focus:border-[#00A3E0] outline-none transition-all duration-200">
                        </div>
                    </div>

                    <!-- Subjek -->
                    <div class="space-y-1.5">
                        <label for="subjek" class="text-xs font-bold text-slate-700 flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm text-slate-400">topic</span> Subjek Pesan
                        </label>
                        <select name="subjek" id="subjek" required
                            class="w-full px-4 py-3 bg-slate-50/80 border border-slate-200 rounded-xl text-sm text-slate-800 focus:ring-2 focus:ring-[#00A3E0]/30 focus:border-[#00A3E0] outline-none transition-all duration-200 cursor-pointer">
                            <option value="" disabled {{ old('subjek') ? '' : 'selected' }}>Pilih subjek pesan...</option>
                            <option value="Pertanyaan Umum" {{ old('subjek') == 'Pertanyaan Umum' ? 'selected' : '' }}>Pertanyaan Umum</option>
                            <option value="Permohonan Data" {{ old('subjek') == 'Permohonan Data' ? 'selected' : '' }}>Permohonan Data</option>
                            <option value="Kolaborasi Riset" {{ old('subjek') == 'Kolaborasi Riset' ? 'selected' : '' }}>Kolaborasi Riset</option>
                            <option value="Lainnya" {{ old('subjek') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                    </div>

                    <!-- Isi Pesan -->
                    <div class="space-y-1.5">
                        <label for="pesan" class="text-xs font-bold text-slate-700 flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm text-slate-400">chat</span> Isi Pesan
                        </label>
                        <textarea name="pesan" id="pesan" rows="5" required maxlength="5000"
                            placeholder="Tulis pesan Anda di sini..."
                            class="w-full px-4 py-3 bg-slate-50/80 border border-slate-200 rounded-xl text-sm text-slate-800 placeholder-slate-400 focus:ring-2 focus:ring-[#00A3E0]/30 focus:border-[#00A3E0] outline-none transition-all duration-200 resize-none">{{ old('pesan') }}</textarea>
                        <p class="text-[11px] text-slate-400 text-right"></p>
                    </div>

                    <!-- Tombol Kirim -->
                    <div class="flex items-center justify-end pt-1">
                        <button type="submit"
                            class="bg-[#00A3E0] hover:bg-[#0090c7] text-white px-8 py-3 rounded-xl text-sm font-bold shadow-lg shadow-[#00A3E0]/20 hover:shadow-[#00A3E0]/40 transition-all duration-300 flex items-center gap-2 group">
                            <span class="material-symbols-outlined text-lg group-hover:translate-x-0.5 transition-transform">send</span>
                            Kirim Pesan
                        </button>
                    </div>
                </form>

            </div>
        </div>

    </main>

    <!-- FOOTER -->
    @include('partials.footer')


    <!-- JAVASCRIPT: INTERACTIVE SCROLL ANIMATIONS & COUNTER -->
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

            const revealObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('active');
                        // Trigger counter animation if element has counter-num
                        const counters = entry.target.querySelectorAll('.counter-num');
                        counters.forEach(counter => startCounter(counter));
                    }
                });
            }, observerOptions);

            revealElements.forEach(el => revealObserver.observe(el));

            // Standalone Counter Trigger
            const counterObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        startCounter(entry.target);
                    }
                });
            }, { threshold: 0.5 });

            document.querySelectorAll('.counter-num').forEach(counter => counterObserver.observe(counter));
        });

        // ========================================================
        // DYNAMIC COUNTER NUMBER ANIMATION
        // ========================================================
        function startCounter(el) {
            if (el.dataset.started) return;
            el.dataset.started = "true";

            const target = parseInt(el.getAttribute('data-target')) || 0;
            if (target === 0) {
                el.innerText = '0';
                return;
            }

            let start = 0;
            const duration = 1600; // ms
            const stepTime = Math.max(Math.floor(duration / target), 30);

            const timer = setInterval(() => {
                start += Math.ceil(target / 30);
                if (start >= target) {
                    el.innerText = target;
                    clearInterval(timer);
                } else {
                    el.innerText = start;
                }
            }, stepTime);
        }

        // ========================================================
        // PRESISI AUTO-SCROLL KE FORM PESAN (TIDAK TERLALU KE BAWAH)
        // ========================================================
        function scrollToFormPesan() {
            const formEl = document.getElementById('form-pesan');
            if (formEl) {
                const header = document.querySelector('header');
                const headerHeight = header ? header.offsetHeight : 80;
                const rect = formEl.getBoundingClientRect();
                const targetScrollY = window.pageYOffset + rect.top - headerHeight - 16;

                window.scrollTo({
                    top: Math.max(0, targetScrollY),
                    behavior: 'smooth'
                });

                formEl.classList.add('active');
            }
        }

        if (window.location.hash === '#form-pesan') {
            document.addEventListener('DOMContentLoaded', () => {
                setTimeout(scrollToFormPesan, 150);
            });
            window.addEventListener('load', () => {
                setTimeout(scrollToFormPesan, 100);
            });
        }
        window.addEventListener('hashchange', () => {
            if (window.location.hash === '#form-pesan') {
                scrollToFormPesan();
            }
        });
    </script>

    <!-- POPUP SUKSES KIRIM PESAN -->
    @if(session('pesan_success'))
    <div class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/40 backdrop-blur-sm transition-opacity duration-300" id="pesan-popup-overlay">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md mx-4 p-7 transform scale-95 transition-all duration-300 text-center" id="pesan-popup-content">
            <!-- Ikon Sukses Animated -->
            <div class="mx-auto w-16 h-16 bg-emerald-100 rounded-full flex items-center justify-center mb-5">
                <span class="material-symbols-outlined text-4xl text-emerald-500" style="font-variation-settings: 'FILL' 1;">check_circle</span>
            </div>

            <h3 class="text-xl font-black text-slate-900 tracking-tight">Pesan Berhasil Terkirim!</h3>
            <p class="text-sm text-slate-500 mt-2 leading-relaxed">{{ session('pesan_success') }}</p>

            <!-- Tombol Tutup -->
            <button onclick="closePesanPopup()"
                class="mt-6 bg-[#00A3E0] hover:bg-[#0090c7] text-white px-8 py-2.5 rounded-xl text-sm font-bold shadow-lg shadow-[#00A3E0]/25 hover:shadow-[#00A3E0]/40 transition-all duration-300 cursor-pointer">
                Tutup
            </button>
        </div>
    </div>

    <script>
        // Auto-show popup with animation
        document.addEventListener('DOMContentLoaded', () => {
            const overlay = document.getElementById('pesan-popup-overlay');
            const content = document.getElementById('pesan-popup-content');
            if (overlay && content) {
                requestAnimationFrame(() => {
                    content.classList.remove('scale-95');
                    content.classList.add('scale-100');
                });
            }
        });

        function closePesanPopup() {
            const overlay = document.getElementById('pesan-popup-overlay');
            const content = document.getElementById('pesan-popup-content');
            if (overlay && content) {
                overlay.classList.add('opacity-0');
                content.classList.remove('scale-100');
                content.classList.add('scale-95');
                setTimeout(() => overlay.remove(), 300);
            }
        }

        // Klik di luar popup untuk tutup
        document.getElementById('pesan-popup-overlay')?.addEventListener('click', (e) => {
            if (e.target === e.currentTarget) closePesanPopup();
        });
    </script>
    @endif

</body>
</html>
