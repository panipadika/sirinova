<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>SI RINOVA - Kota Tasikmalaya</title>
    <meta name="description"
        content="Katalog Resmi Teknologi Tepat Guna (TTG) Bapperida Kota Tasikmalaya. Mendorong inovasi untuk masyarakat.">

    <!-- OpenGraph Meta Tags (WhatsApp, Facebook, Twitter Sharing) -->
    <meta property="og:title" content="SI-RINOVA - Bapperida Kota Tasikmalaya">
    <meta property="og:description" content="Sistem Informasi Riset, Indikator Makro, Katalog & Lomba Inovasi TTG, Repositori Kajian, serta Inovasi Bapperida Kota Tasikmalaya.">
    <meta property="og:image" content="{{ asset('storage/images/bappelitbangda_building.png') }}">
    <meta property="og:type" content="website">

    <!-- Favicon Logo Tasikmalaya -->
    <link rel="icon" type="image/png" href="{{ asset('storage/images/favicon_tasik.png') }}?v=3">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=3">
    <link rel="apple-touch-icon" href="{{ asset('storage/images/favicon_tasik.png') }}?v=3">

    <!-- Preconnect ke Origin Eksternal untuk Mempercepat Download Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Preload Critical LCP Hero Image (Langsung mengunduh gambar gedung sejak awal) -->
    <link rel="preload" as="image" href="{{ asset('images/hero-bg.jpg') }}?v=3" fetchpriority="high">

    <!-- Compiled Static Tailwind CSS (Gzip-compressed, cached, No JS render blocking) -->
    <link rel="stylesheet" href="{{ asset('css/tailwind.min.css') }}?v=1">

    <!-- Google Fonts & Material Symbols (Non-render blocking dengan font-display: swap) -->
    <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" media="print" onload="this.media='all'">
    <noscript>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap">
    </noscript>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&display=swap" media="print" onload="this.media='all'">
    <noscript>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&display=swap">
    </noscript>

    <style>
        html, body {
            margin: 0 !important;
            padding: 0 !important;
        }
        body {
            font-family: 'Inter', sans-serif;
            background-color: #ffffff;
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

        .bg-hero {
            background-image: url("{{ asset('images/hero-bg.jpg') }}?v=3");
            background-size: cover;
            background-position: center right;
        }

        @media (max-width: 767px) {
            .bg-hero {
                background-position: 95% 10%;
            }
        }

        /* ========================================================
           SCROLL REVEAL ANIMATIONS (MATCHING ALL PAGES)
           ======================================================== */
        .reveal,
        .reveal-up,
        .reveal-on-scroll {
            opacity: 0;
            transform: translateY(40px);
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
        .reveal.is-visible,
        .reveal-up.active,
        .reveal-up.is-visible,
        .reveal-on-scroll.active,
        .reveal-on-scroll.is-visible,
        .reveal-left.active,
        .reveal-left.is-visible,
        .reveal-right.active,
        .reveal-right.is-visible,
        .reveal-zoom.active,
        .reveal-zoom.is-visible {
            opacity: 1;
            transform: translateY(0) translateX(0) scale(1);
        }

        /* Stagger Delays */
        .delay-100 { transition-delay: 0.1s; }
        .delay-150 { transition-delay: 0.15s; }
        .delay-200 { transition-delay: 0.2s; }
        .delay-300 { transition-delay: 0.3s; }
        .delay-400 { transition-delay: 0.4s; }
        .delay-500 { transition-delay: 0.5s; }

        @media (prefers-reduced-motion: reduce) {
            .reveal, .reveal-on-scroll, .reveal-left, .reveal-right, .reveal-zoom {
                opacity: 1 !important;
                transform: none !important;
                transition: none !important;
            }
        }

        /* Hero Load Entrance Animations */
        @keyframes heroSlideRight {
            0% {
                opacity: 0;
                transform: translateX(-60px);
            }

            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes heroSlideUp {
            0% {
                opacity: 0;
                transform: translateY(35px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes heroPopUp {
            0% {
                opacity: 0;
                transform: translateY(25px) scale(0.96);
            }

            100% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .animate-hero-title {
            animation: heroSlideRight 0.95s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        .animate-hero-subtitle {
            animation: heroSlideUp 0.9s cubic-bezier(0.16, 1, 0.3, 1) 0.22s forwards;
            opacity: 0;
        }

        .animate-hero-buttons {
            animation: heroPopUp 0.85s cubic-bezier(0.16, 1, 0.3, 1) 0.45s forwards;
            opacity: 0;
        }

        /* Hide scrollbar completely for all browsers */
        html,
        body {
            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            /* Firefox */
        }

        html::-webkit-scrollbar,
        body::-webkit-scrollbar {
            display: none;
            /* Chrome, Safari, Opera */
            width: 0;
            height: 0;
        }

        /* Custom Styled Scrollbar for Modal Content (Matching User Reference) */
        .custom-modal-scrollbar {
            scrollbar-width: thin;
            scrollbar-color: #00A3E0 #f1f5f9;
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
            background-color: #00A3E0;
            border-radius: 9999px;
            border: 2px solid #f1f5f9;
            transition: background-color 0.2s ease;
        }

        .custom-modal-scrollbar::-webkit-scrollbar-thumb:hover {
            background-color: #008cc0;
        }

        .custom-modal-scrollbar::-webkit-scrollbar-button:single-button:vertical:decrement {
            background: #f1f5f9 url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" viewBox="0 0 24 24"><path fill="%23334155" d="M12 8l-6 6h12z"/></svg>') no-repeat center center;
            height: 14px;
            border-top-left-radius: 9999px;
            border-top-right-radius: 9999px;
        }

        .custom-modal-scrollbar::-webkit-scrollbar-button:single-button:vertical:increment {
            background: #f1f5f9 url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" viewBox="0 0 24 24"><path fill="%23334155" d="M12 16l6-6H6z"/></svg>') no-repeat center center;
            height: 14px;
            border-bottom-left-radius: 9999px;
            border-bottom-right-radius: 9999px;
        }

        /* 3D E-Book Cover Real Mockup Animation */
        .book-card {
            transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        .book-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 32px -8px rgba(0, 163, 224, 0.15), 0 6px 12px -4px rgba(0, 0, 0, 0.08);
        }

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
            border-radius: 0 2px 2px 0;
            box-shadow: inset 1px 0 2px rgba(0,0,0,0.1);
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-800 antialiased min-h-screen flex flex-col justify-between selection:bg-[#00A3E0] selection:text-white overflow-x-hidden">

    <!-- 1. NAVBAR / HEADER -->
    <header class="bg-white/95 backdrop-blur-md sticky top-0 z-50 border-b border-slate-100 shadow-sm transition-all m-0" style="top: 0; margin-top: 0;">
        <div class="max-w-7xl 2xl:max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">

            <!-- Logo & Brand Name -->
            <a href="/" class="flex items-center gap-3 shrink-0 group">
                <img src="{{ asset('storage/images/logo_tasik.png') }}"
                     alt="Logo Kota Tasikmalaya" width="40" height="40" class="h-10 w-auto object-contain group-hover:scale-105 transition-transform" fetchpriority="high">
                <span class="text-xl sm:text-2xl font-black text-[#00A3E0] tracking-tight">
                    SI RINOVA
                </span>
            </a>

            <!-- Navigation Links (Desktop) -->
            <nav class="hidden md:flex items-center gap-6 xl:gap-8 font-semibold text-sm whitespace-nowrap">
                <a href="/" class="text-[#00A3E0] border-b-2 border-[#00A3E0] pb-1 transition-colors whitespace-nowrap">Beranda</a>
                <a href="{{ route('public.indikator-makro') }}" class="text-slate-600 hover:text-[#00A3E0] transition-colors py-1 whitespace-nowrap">Indikator Makro</a>
                
                <!-- Dropdown Katalog -->
                <div class="relative group py-5">
                    <button class="flex items-center gap-1 text-slate-600 group-hover:text-[#00A3E0] transition-colors font-semibold text-sm focus:outline-none whitespace-nowrap">
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

                <a href="{{ route('public.ebook') }}" class="text-slate-600 hover:text-[#00A3E0] transition-colors py-1 whitespace-nowrap">E-Book Kajian</a>
                <a href="{{ route('public.telaahan-staf') }}" class="text-slate-600 hover:text-[#00A3E0] transition-colors py-1 whitespace-nowrap">Telaahan Staf</a>
                <a href="{{ route('public.galeri') }}" class="text-slate-600 hover:text-[#00A3E0] transition-colors py-1 whitespace-nowrap">Galeri</a>
                <a href="{{ route('lomba.info') }}" class="text-amber-500 hover:text-amber-600 transition-colors py-1 flex items-center gap-1 font-bold whitespace-nowrap">
                    <span class="material-symbols-outlined text-base">emoji_events</span>
                    <span>Lomba TTG</span>
                </a>
                <a href="{{ route('public.tentang') }}" class="text-slate-600 hover:text-[#00A3E0] transition-colors py-1 whitespace-nowrap">Tentang</a>
            </nav>

            <!-- Mobile Menu Button -->
            <div class="md:hidden flex items-center">
                <button id="mobile-menu-btn" class="p-2 rounded-lg text-slate-600 hover:bg-slate-100">
                    <span class="material-symbols-outlined text-2xl">menu</span>
                </button>
            </div>
        </div>

        <!-- Mobile Nav Menu Dropdown -->
        <div id="mobile-nav" class="hidden md:hidden bg-white border-b border-slate-200 px-6 py-4 space-y-3 font-semibold text-sm">
            <a href="/" class="block text-[#00A3E0]">Beranda</a>
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
            <a href="{{ route('public.tentang') }}" class="block text-slate-600">Tentang</a>
        </div>
    </header>

    <!-- MAIN CONTENT -->
    <main id="beranda">

        <!-- 2. HERO BANNER SECTION -->
        <section
            class="bg-hero relative min-h-[580px] sm:min-h-[600px] md:h-[calc(100vh-80px)] md:max-h-[750px] flex items-end md:items-center overflow-hidden">
            <!-- Overlay gradasi lembut (Dari bawah ke atas di mobile untuk keterbacaan teks) -->
            <div
                class="absolute inset-0 bg-gradient-to-t md:bg-gradient-to-r from-sky-950/95 via-sky-950/40 md:via-sky-900/20 to-transparent">
            </div>

            <!-- Soft Fade Gradient di bagian dasar paling bawah -->
            <div
                class="absolute bottom-0 inset-x-0 h-20 sm:h-28 bg-gradient-to-t from-white via-white/10 to-transparent z-10 pointer-events-none">
            </div>

            <div
                class="w-full max-w-7xl mx-auto px-4 sm:px-10 lg:px-12 relative z-20 pt-20 pb-10 sm:py-12 md:py-16 flex justify-start items-end md:items-center">

                <!-- Text & CTA Container (Compact & User-Friendly on Mobile) -->
                <div class="max-w-md sm:max-w-lg lg:max-w-2xl text-white space-y-3.5 sm:space-y-5 text-left">
                    <h1
                        class="animate-hero-title text-xl sm:text-4xl lg:text-[44px] font-extrabold tracking-tight leading-snug sm:leading-[1.2] text-white drop-shadow-md">
                        Sistem Informasi Riset & Inovasi Kota Tasikmalaya
                    </h1>
                    <p
                        class="animate-hero-subtitle text-slate-100 text-xs sm:text-base leading-relaxed font-normal opacity-90 line-clamp-2 sm:line-clamp-none">
                        Wadah integrasi publikasi riset, capaian indikator makro, katalog & lomba inovasi TTG, repositori kajian, serta inovasi Bapperida Kota Tasikmalaya.
                    </p>

                    <!-- CTA Buttons (Symmetrical 2-Column Grid on Mobile & Desktop) -->
                    <div class="animate-hero-buttons grid grid-cols-2 gap-2 sm:gap-3 pt-1.5 justify-start w-full max-w-sm sm:max-w-md">
                        <!-- Row 1: Indikator Makro & Katalog TTG (Primary Blue) -->
                        <a href="{{ route('public.indikator-makro') }}"
                            class="bg-[#00A3E0] hover:bg-[#008bc0] hover:scale-105 active:scale-95 text-white px-2.5 sm:px-5 py-2 sm:py-3 rounded-xl font-bold text-[11px] sm:text-sm transition-all duration-300 shadow-md shadow-cyan-500/20 text-center flex items-center justify-center gap-1.5">
                            <span class="material-symbols-outlined text-base sm:text-lg shrink-0">analytics</span>
                            <span class="truncate">Indikator Makro</span>
                        </a>
                        <a href="{{ route('katalog.index') }}"
                            class="bg-[#00A3E0] hover:bg-[#008bc0] hover:scale-105 active:scale-95 text-white px-2.5 sm:px-5 py-2 sm:py-3 rounded-xl font-bold text-[11px] sm:text-sm transition-all duration-300 shadow-md shadow-cyan-500/20 text-center flex items-center justify-center gap-1.5">
                            <span class="material-symbols-outlined text-base sm:text-lg shrink-0">inventory_2</span>
                            <span class="truncate">Katalog TTG</span>
                        </a>

                        <!-- Row 2: E-Book Kajian & Lomba Alat TTG (Directly below Katalog TTG) -->
                        <a href="{{ route('public.ebook') }}"
                            class="bg-[#fed000] hover:bg-yellow-400 hover:scale-105 active:scale-95 text-slate-900 px-2.5 sm:px-5 py-2 sm:py-3 rounded-xl font-bold text-[11px] sm:text-sm transition-all duration-300 shadow-md shadow-yellow-500/20 text-center flex items-center justify-center gap-1.5">
                            <span class="material-symbols-outlined text-base sm:text-lg shrink-0">auto_stories</span>
                            <span class="truncate">E-Book Kajian</span>
                        </a>
                        <a href="{{ route('lomba.info') }}"
                            class="bg-gradient-to-r from-amber-400 to-amber-500 hover:from-amber-500 hover:to-amber-600 hover:scale-105 active:scale-95 text-slate-950 px-2.5 sm:px-5 py-2 sm:py-3 rounded-xl font-extrabold text-[11px] sm:text-sm transition-all duration-300 shadow-lg shadow-amber-500/25 text-center flex items-center justify-center gap-1.5 ring-2 ring-amber-300/60">
                            <span class="material-symbols-outlined text-base sm:text-lg shrink-0">emoji_events</span>
                            <span class="truncate">Lomba Alat TTG</span>
                        </a>

                        <!-- Row 3: Telaahan Staf & Galeri Kegiatan (Frosted Glass) -->
                        <a href="{{ route('public.telaahan-staf') }}"
                            class="bg-white/20 hover:bg-white/30 hover:scale-105 active:scale-95 text-white backdrop-blur-md border border-white/30 px-2.5 sm:px-4 py-2 sm:py-3 rounded-xl font-bold text-[11px] sm:text-sm transition-all duration-300 shadow-sm text-center flex items-center justify-center gap-1.5">
                            <span class="material-symbols-outlined text-base sm:text-lg shrink-0">description</span>
                            <span class="truncate">Telaahan Staf</span>
                        </a>
                        <a href="{{ route('public.galeri') }}"
                            class="bg-white/20 hover:bg-white/30 hover:scale-105 active:scale-95 text-white backdrop-blur-md border border-white/30 px-2.5 sm:px-4 py-2 sm:py-3 rounded-xl font-bold text-[11px] sm:text-sm transition-all duration-300 shadow-sm text-center flex items-center justify-center gap-1.5">
                            <span class="material-symbols-outlined text-base sm:text-lg shrink-0">photo_library</span>
                            <span class="truncate">Galeri Kegiatan</span>
                        </a>
                    </div>
                </div>

            </div>
        </section>

        <!-- 3. STATS METRIC CARDS (5 MAIN MODULES) -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-16 md:py-20 relative z-20">
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3 sm:gap-5">

                <!-- Stat 1: Total Indikator Makro (Far Left) -->
                <a href="{{ route('public.indikator-makro') }}"
                    class="reveal-up delay-100 bg-white rounded-2xl p-5 sm:p-6 border border-slate-100 shadow-[0_10px_30px_rgba(0,0,0,0.04)] text-center flex flex-col items-center justify-center hover:-translate-y-2 hover:shadow-xl transition-all duration-300 group block">
                    <div
                        class="w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-sky-50 text-[#00A3E0] flex items-center justify-center mb-3 group-hover:scale-110 group-hover:bg-[#00A3E0] group-hover:text-white transition-all">
                        <span class="material-symbols-outlined text-2xl">analytics</span>
                    </div>
                    <h3 class="text-2xl sm:text-3xl lg:text-4xl font-black text-[#00A3E0] tracking-tight">
                        <span class="stat-number" data-target="{{ $totalIndikator ?? 5 }}">0</span>+
                    </h3>
                    <p class="text-[10px] sm:text-xs font-bold text-slate-400 uppercase tracking-widest mt-1.5">INDIKATOR MAKRO</p>
                </a>

                <!-- Stat 2: Total Alat TTG -->
                <a href="{{ route('katalog.index') }}"
                    class="reveal-up delay-200 bg-white rounded-2xl p-5 sm:p-6 border border-slate-100 shadow-[0_10px_30px_rgba(0,0,0,0.04)] text-center flex flex-col items-center justify-center hover:-translate-y-2 hover:shadow-xl transition-all duration-300 group block">
                    <div
                        class="w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-sky-50 text-[#00A3E0] flex items-center justify-center mb-3 group-hover:scale-110 group-hover:bg-[#00A3E0] group-hover:text-white transition-all">
                        <span class="material-symbols-outlined text-2xl">hardware</span>
                    </div>
                    <h3 class="text-2xl sm:text-3xl lg:text-4xl font-black text-[#00A3E0] tracking-tight">
                        <span class="stat-number" data-target="{{ $totalAlat }}">0</span>+
                    </h3>
                    <p class="text-[10px] sm:text-xs font-bold text-slate-400 uppercase tracking-widest mt-1.5">ALAT TTG</p>
                </a>

                <!-- Stat 3: Total E-Book Kajian -->
                <a href="{{ route('public.ebook') }}"
                    class="reveal-up delay-300 bg-white rounded-2xl p-5 sm:p-6 border border-slate-100 shadow-[0_10px_30px_rgba(0,0,0,0.04)] text-center flex flex-col items-center justify-center hover:-translate-y-2 hover:shadow-xl transition-all duration-300 group block">
                    <div
                        class="w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-sky-50 text-[#00A3E0] flex items-center justify-center mb-3 group-hover:scale-110 group-hover:bg-[#00A3E0] group-hover:text-white transition-all">
                        <span class="material-symbols-outlined text-2xl">auto_stories</span>
                    </div>
                    <h3 class="text-2xl sm:text-3xl lg:text-4xl font-black text-[#00A3E0] tracking-tight">
                        <span class="stat-number" data-target="{{ $totalEbook }}">0</span>+
                    </h3>
                    <p class="text-[10px] sm:text-xs font-bold text-slate-400 uppercase tracking-widest mt-1.5">E-BOOK KAJIAN</p>
                </a>

                <!-- Stat 4: Total Telaahan Staf -->
                <a href="{{ route('public.telaahan-staf') }}"
                    class="reveal-up delay-400 bg-white rounded-2xl p-5 sm:p-6 border border-slate-100 shadow-[0_10px_30px_rgba(0,0,0,0.04)] text-center flex flex-col items-center justify-center hover:-translate-y-2 hover:shadow-xl transition-all duration-300 group block">
                    <div
                        class="w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-sky-50 text-[#00A3E0] flex items-center justify-center mb-3 group-hover:scale-110 group-hover:bg-[#00A3E0] group-hover:text-white transition-all">
                        <span class="material-symbols-outlined text-2xl">description</span>
                    </div>
                    <h3 class="text-2xl sm:text-3xl lg:text-4xl font-black text-[#00A3E0] tracking-tight">
                        <span class="stat-number" data-target="{{ $totalTelaahanStaf }}">0</span>+
                    </h3>
                    <p class="text-[10px] sm:text-xs font-bold text-slate-400 uppercase tracking-widest mt-1.5">TELAAHAN STAF</p>
                </a>

                <!-- Stat 5: Total Galeri Kegiatan -->
                <a href="{{ route('public.galeri') }}"
                    class="reveal-up delay-500 bg-white rounded-2xl p-5 sm:p-6 border border-slate-100 shadow-[0_10px_30px_rgba(0,0,0,0.04)] text-center flex flex-col items-center justify-center hover:-translate-y-2 hover:shadow-xl transition-all duration-300 group block col-span-2 sm:col-span-1">
                    <div
                        class="w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-sky-50 text-[#00A3E0] flex items-center justify-center mb-3 group-hover:scale-110 group-hover:bg-[#00A3E0] group-hover:text-white transition-all">
                        <span class="material-symbols-outlined text-2xl">photo_library</span>
                    </div>
                    <h3 class="text-2xl sm:text-3xl lg:text-4xl font-black text-[#00A3E0] tracking-tight">
                        <span class="stat-number" data-target="{{ $totalGaleri }}">0</span>+
                    </h3>
                    <p class="text-[10px] sm:text-xs font-bold text-slate-400 uppercase tracking-widest mt-1.5">GALERI KEGIATAN</p>
                </a>

            </div>
        </section>

        <!-- 4. JELAJAHI ALAT TTG SECTION -->
        <section id="katalog" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-16 space-y-8">

            <!-- Section Header -->
            <div class="reveal-zoom flex flex-col sm:flex-row sm:items-end justify-between gap-4 border-b border-slate-100 pb-5">
                <div>
                    <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 tracking-tight">Jelajahi Alat TTG</h2>
                    <p class="text-slate-500 text-xs sm:text-sm mt-1">Temukan berbagai inovasi teknologi tepat guna terbaru dari Kota Tasikmalaya.</p>
                </div>
                <a href="{{ route('katalog.index') }}"
                    class="inline-flex items-center gap-2 px-5 py-2.5 bg-sky-50 hover:bg-[#00A3E0] text-[#00A3E0] hover:text-white rounded-xl text-xs sm:text-sm font-bold transition-all duration-200 shadow-2xs hover:shadow-md shrink-0 self-start sm:self-auto group">
                    <span>Lihat Semua Katalog</span>
                    <span class="material-symbols-outlined text-sm group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </a>
            </div>

            <!-- Cards Grid: 2 kolom mobile, 4 kolom desktop -->
            <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-5 lg:gap-6">

                @forelse($alatList as $index => $item)
                    @php
                        $revealDir = ($index % 4 == 0) ? 'reveal-left' : (($index % 4 == 3) ? 'reveal-right' : 'reveal');
                        $delayCls = 'delay-' . (($index % 4 + 1) * 100);
                    @endphp
                    <div
                        class="{{ $revealDir }} {{ $delayCls }} bg-white rounded-xl sm:rounded-2xl border border-slate-200/80 shadow-[0_4px_20px_rgba(0,0,0,0.03)] hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col overflow-hidden group">

                        <!-- Thumbnail Image with Category Badge -->
                        <div class="relative h-32 sm:h-44 lg:h-56 w-full bg-slate-100 overflow-hidden">
                            @if($item->foto)
                                <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama_alat }}"
                                    loading="lazy" decoding="async"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                    onerror="this.src='https://placehold.co/600x400?text=Katalog+TTG'">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-slate-400">
                                    <span class="material-symbols-outlined text-3xl sm:text-4xl">inventory_2</span>
                                </div>
                            @endif

                            <!-- Category Badge -->
                            <div class="absolute top-2 left-2 sm:top-4 sm:left-4">
                                <span
                                    class="px-2 py-0.5 sm:px-3 sm:py-1 bg-white/90 backdrop-blur-md text-[#00A3E0] text-[10px] sm:text-xs font-bold rounded-full shadow-sm">
                                    {{ $item->kategori->nama_kategori ?? 'Teknologi' }}
                                </span>
                            </div>
                        </div>

                        <!-- Card Content -->
                        <div class="p-3 sm:p-5 lg:p-6 flex-1 flex flex-col justify-between gap-2 sm:gap-4">
                            <div>
                                <h3
                                    class="text-xs sm:text-base lg:text-lg font-bold text-slate-900 group-hover:text-[#00A3E0] transition-colors leading-snug line-clamp-2">
                                    {{ $item->nama_alat }}
                                </h3>

                                <div class="mt-1.5 sm:mt-3 space-y-1 sm:space-y-1.5 text-[10px] sm:text-xs text-slate-500 font-medium">
                                    <p class="flex items-center gap-1 sm:gap-2">
                                        <span class="material-symbols-outlined text-sm sm:text-base text-slate-400">person</span>
                                        <span class="truncate">{{ $item->inovator->nama_inovator ?? 'Inovator Mandiri' }}</span>
                                    </p>
                                    <p class="flex items-center gap-1 sm:gap-2">
                                        <span class="material-symbols-outlined text-sm sm:text-base text-slate-400">location_on</span>
                                        <span class="truncate">Kec. {{ $item->wilayah->nama_kecamatan ?? 'Tasikmalaya' }}</span>
                                    </p>
                                </div>
                            </div>

                            <!-- Detail Link Button -->
                            <a href="{{ route('katalog.show', $item->id) }}"
                                class="w-full py-1.5 sm:py-2.5 px-2 sm:px-4 border border-[#00A3E0]/40 text-[#00A3E0] hover:bg-[#00A3E0] hover:text-white rounded-lg sm:rounded-xl text-[10px] sm:text-xs font-bold transition-all text-center flex items-center justify-center gap-1">
                                Lihat Detail
                            </a>
                        </div>

                    </div>
                @empty
                    <div class="col-span-full py-16 text-center text-slate-400 space-y-2">
                        <span class="material-symbols-outlined text-5xl text-slate-300">search_off</span>
                        <p class="text-base font-semibold">Belum ada data alat TTG.</p>
                    </div>
                @endforelse

            </div>

        </section>

        <!-- 4.5. E-BOOK KAJIAN SECTION -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16 sm:pb-24 space-y-8">
            
            <!-- Section Header -->
            <div class="reveal-zoom flex flex-col sm:flex-row sm:items-end justify-between gap-4 border-b border-slate-100 pb-5">
                <div>
                    <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 tracking-tight">E-Book Kajian Riset Daerah</h2>
                    <p class="text-slate-500 text-xs sm:text-sm mt-1">Kumpulan dokumen publikasi dan hasil penelitian riset daerah Kota Tasikmalaya.</p>
                </div>
                <a href="{{ route('public.ebook') }}"
                    class="inline-flex items-center gap-2 px-5 py-2.5 bg-sky-50 hover:bg-[#00A3E0] text-[#00A3E0] hover:text-white rounded-xl text-xs sm:text-sm font-bold transition-all duration-200 shadow-2xs hover:shadow-md shrink-0 self-start sm:self-auto group">
                    <span>Lihat Semua E-Book Kajian</span>
                    <span class="material-symbols-outlined text-sm group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </a>
            </div>

            <!-- E-Book Grid (4 Cards 3D Mockup with Scroll Animation) -->
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-5 lg:gap-6">
                @forelse($latestEbooks as $index => $kajian)
                    @php
                        $revealDir = ($index % 4 == 0) ? 'reveal-left' : (($index % 4 == 3) ? 'reveal-right' : 'reveal');
                        $delayCls = 'delay-' . (($index % 4 + 1) * 100);
                    @endphp
                    <div class="{{ $revealDir }} {{ $delayCls }} book-card bg-white rounded-2xl border border-slate-100 shadow-xs overflow-hidden group flex flex-col justify-between">
                        
                        <!-- Top Portion: Portrait 3D Real Book Cover Area -->
                        <div class="book-3d-wrapper p-4 sm:p-5 select-none bg-slate-50/50 border-b border-slate-100/80">
                            <div class="book-3d-cover relative aspect-[3/4] w-full bg-slate-800">
                                
                                <!-- Spine overlay elements (Jilid Buku Kiri) -->
                                <div class="book-spine-strip"></div>
                                <div class="book-spine-crease"></div>

                                @if(!empty($kajian->cover_image))
                                    <!-- Real Book Cover Image -->
                                    <img src="{{ Str::startsWith($kajian->cover_image, 'http') ? $kajian->cover_image : (Str::startsWith($kajian->cover_image, 'storage/') ? asset($kajian->cover_image) : asset('storage/' . $kajian->cover_image)) }}" 
                                         alt="{{ $kajian->judul }}" 
                                         loading="lazy" decoding="async"
                                         class="absolute inset-0 w-full h-full object-cover rounded-r-sm">
                                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/60 via-transparent to-slate-950/20 pointer-events-none"></div>
                                @else
                                    <!-- Fallback Plain Gradient Cover -->
                                    <div class="absolute inset-0 bg-gradient-to-br from-slate-800 to-slate-900 rounded-r-sm"></div>
                                    <div class="absolute inset-0 flex items-center justify-center pointer-events-none text-white/20 pl-3">
                                        <span class="material-symbols-outlined text-5xl">menu_book</span>
                                    </div>
                                @endif

                                <!-- Top Cover Header Badges (Category - Always Top Left) -->
                                @if(!empty($kajian->kategori))
                                    <div class="absolute top-2 left-4 z-25">
                                        <span class="px-2 py-0.5 bg-blue-600/95 backdrop-blur-xs text-white text-[9px] font-extrabold rounded uppercase tracking-wider shadow-xs">
                                            {{ strtoupper($kajian->kategori) }}
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Bottom Portion: Card Content & Actions -->
                        <div class="p-3.5 sm:p-4 space-y-3 flex-1 flex flex-col justify-between bg-white">
                            <div>
                                <h4 class="text-xs sm:text-sm font-extrabold text-slate-900 leading-snug group-hover:text-[#00A3E0] transition-colors line-clamp-2">
                                    {{ $kajian->judul }}
                                </h4>
                                <p class="text-[11px] text-slate-400 font-medium mt-1">
                                    {{ $kajian->tahun }}
                                </p>
                            </div>

                            <div class="pt-2">
                                <a href="{{ route('public.ebook.detail', $kajian->id) }}"
                                   class="w-full flex items-center justify-center py-2.5 px-4 bg-sky-50 hover:bg-[#00A3E0] text-[#00A3E0] hover:text-white rounded-full text-xs sm:text-sm font-bold transition-all duration-200 text-center shadow-2xs hover:shadow-md">
                                    <span>Lihat Detail</span>
                                </a>
                            </div>
                        </div>

                    </div>
                @empty
                    <div class="col-span-full py-12 text-center text-slate-400 space-y-2 bg-white rounded-2xl border border-slate-100">
                        <span class="material-symbols-outlined text-4xl text-slate-300">auto_stories</span>
                        <p class="text-sm font-semibold">Belum ada data E-Book Kajian.</p>
                    </div>
                @endforelse
            </div>

        </section>

        <!-- 4.6. TELAAHAN STAF SECTION -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16 sm:pb-24 space-y-8">
            
            <!-- Section Header -->
            <div class="reveal-zoom flex flex-col sm:flex-row sm:items-end justify-between gap-4 border-b border-slate-100 pb-5">
                <div>
                    <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 tracking-tight">Telaahan Staf & Rekomendasi</h2>
                    <p class="text-slate-500 text-xs sm:text-sm mt-1">Dokumen analisis strategis dan pertimbangan teknis kebijakan inovasi daerah Kota Tasikmalaya.</p>
                </div>
                <a href="{{ route('public.telaahan-staf') }}"
                    class="inline-flex items-center gap-2 px-5 py-2.5 bg-sky-50 hover:bg-[#00A3E0] text-[#00A3E0] hover:text-white rounded-xl text-xs sm:text-sm font-bold transition-all duration-200 shadow-2xs hover:shadow-md shrink-0 self-start sm:self-auto group">
                    <span>Lihat Semua Telaahan Staf</span>
                    <span class="material-symbols-outlined text-sm group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </a>
            </div>

            <!-- 3 Telaahan Staf Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($latestTelaahanStaf as $index => $item)
                    @php
                        $revealDir = ($index % 3 == 0) ? 'reveal-left' : (($index % 3 == 1) ? 'reveal' : 'reveal-right');
                        $delayCls = 'delay-' . (($index % 3 + 1) * 100);
                    @endphp
                    <div class="{{ $revealDir }} {{ $delayCls }} bg-white rounded-2xl border border-slate-200/80 shadow-[0_4px_20px_rgba(0,0,0,0.03)] hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between overflow-hidden group">
                        
                        <div class="p-6 space-y-4 flex-1 flex flex-col justify-between">
                            <div class="space-y-3">
                                <!-- Top Badges & Date -->
                                <div class="flex items-center justify-between gap-2">
                                    <span class="px-2.5 py-1 bg-sky-50 text-[#00A3E0] text-[10px] font-extrabold rounded-md uppercase tracking-wider flex items-center gap-1 max-w-[70%] truncate" title="{{ $item->pembuat_bidang }}">
                                        <span class="material-symbols-outlined text-[13px] shrink-0">corporate_fare</span>
                                        <span class="truncate">{{ $item->pembuat_bidang }}</span>
                                    </span>
                                    <span class="text-xs text-slate-400 font-medium flex items-center gap-1 shrink-0">
                                        <span class="material-symbols-outlined text-sm">calendar_today</span>
                                        {{ $item->tahun_dokumen ?? '-' }}
                                    </span>
                                </div>

                                <!-- Document Title -->
                                <h3 class="text-base font-extrabold text-slate-900 leading-snug group-hover:text-[#00A3E0] transition-colors line-clamp-2">
                                    <a href="{{ route('public.telaahan-staf.detail', $item->id) }}">
                                        {{ $item->judul }}
                                    </a>
                                </h3>

                                <!-- Summary Snippet -->
                                @if(!empty($item->ringkasan))
                                    <p class="text-xs text-slate-500 leading-relaxed line-clamp-3 bg-slate-50/80 p-3 rounded-xl border border-slate-100/80 text-left">
                                        {{ Str::limit($item->ringkasan, 130) }}
                                    </p>
                                @endif
                            </div>

                            <!-- Bottom Action Buttons -->
                            <div class="pt-4 border-t border-slate-100">
                                <a href="{{ route('public.telaahan-staf.detail', $item->id) }}"
                                   class="w-full py-2.5 px-4 bg-sky-50 hover:bg-[#00A3E0] text-[#00A3E0] hover:text-white rounded-xl text-xs font-bold transition-all duration-200 text-center flex items-center justify-center gap-1.5">
                                    <span class="material-symbols-outlined text-base">visibility</span>
                                    <span>Lihat Detail</span>
                                </a>
                            </div>
                        </div>

                    </div>
                @empty
                    <div class="col-span-full py-12 text-center text-slate-400 space-y-2 bg-white rounded-2xl border border-slate-100">
                        <span class="material-symbols-outlined text-4xl text-slate-300">description</span>
                        <p class="text-sm font-semibold">Belum ada data Telaahan Staf.</p>
                    </div>
                @endforelse
            </div>

        </section>

        <!-- 4.7. GALERI KEGIATAN SECTION (AUTO-SLIDING CAROUSEL) -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16 sm:pb-24 space-y-10">
            
            <!-- Section Header (Centered) -->
            <div class="reveal-zoom text-center max-w-2xl mx-auto space-y-3">
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                    Galeri Kegiatan & Inovasi
                </h2>
                <p class="text-slate-500 text-sm sm:text-base font-normal">
                    Dokumentasi kaji kegiatan, pameran, serta sosialisasi riset dan teknologi tepat guna Kota Tasikmalaya.
                </p>
            </div>

            <!-- Auto Sliding Carousel Container -->
            <div id="galeri-carousel-container" class="reveal-zoom relative overflow-hidden group">
                <div id="galeri-slider" class="flex gap-6 transition-transform duration-500 ease-out">
                    @forelse($galeriList as $item)
                        <div class="galeri-card flex-none w-full sm:w-[calc(50%-12px)] lg:w-[calc(33.333%-16px)] bg-white rounded-3xl border border-slate-200/80 shadow-[0_4px_20px_rgba(0,0,0,0.03)] hover:shadow-xl hover:-translate-y-2 transition-all duration-300 flex flex-col justify-between overflow-hidden group/card">
                            
                            <!-- Image Portion with Date Badge -->
                            <div class="relative h-56 w-full bg-slate-100 overflow-hidden">
                                @if(!empty($item->foto))
                                    <img src="{{ asset($item->foto) }}" alt="{{ $item->judul }}"
                                         loading="lazy" decoding="async"
                                         class="w-full h-full object-cover group-hover/card:scale-105 transition-transform duration-500"
                                         onerror="this.src='https://placehold.co/600x400?text=Galeri+Kegiatan'">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-slate-400">
                                        <span class="material-symbols-outlined text-5xl">photo_camera</span>
                                    </div>
                                @endif

                                <!-- Gradient Overlay -->
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/40 via-transparent to-transparent pointer-events-none"></div>

                                <!-- Date Badge (Top Left - Matching Reference Design) -->
                                <div class="absolute top-3.5 left-3.5 z-10">
                                    <span class="px-3 py-1 bg-[#00A3E0]/95 backdrop-blur-md text-white text-[11px] font-extrabold rounded-full shadow-md uppercase tracking-wider">
                                        {{ $item->tanggal_kegiatan ? \Carbon\Carbon::parse($item->tanggal_kegiatan)->translatedFormat('d M Y') : 'Terbaru' }}
                                    </span>
                                </div>
                            </div>

                            <!-- Card Body Content -->
                            <div class="p-6 flex-1 flex flex-col justify-between space-y-4 bg-white">
                                <div class="space-y-2">
                                    <h3 class="text-base sm:text-lg font-extrabold text-slate-900 leading-snug group-hover/card:text-[#00A3E0] transition-colors line-clamp-2">
                                        {{ $item->judul }}
                                    </h3>
                                    
                                    @if(!empty($item->lokasi))
                                        <p class="text-xs text-slate-400 font-medium flex items-center gap-1">
                                            <span class="material-symbols-outlined text-sm text-[#00A3E0]">location_on</span>
                                            <span>{{ $item->lokasi }}</span>
                                        </p>
                                    @endif

                                    @if(!empty($item->deskripsi))
                                        <p class="text-xs text-slate-500 leading-relaxed line-clamp-2 pt-1 font-normal">
                                            {{ Str::limit($item->deskripsi, 100) }}
                                        </p>
                                    @endif
                                </div>

                                <!-- Selengkapnya Pill Button (Matching Reference Image) -->
                                <div class="pt-2">
                                    <a href="{{ route('public.galeri') }}"
                                       class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#00A3E0] hover:bg-[#008cc0] text-white rounded-full text-xs font-bold transition-all duration-200 shadow-sm hover:shadow-md group/btn">
                                        <span>SELENGKAPNYA</span>
                                        <span class="material-symbols-outlined text-sm group-hover/btn:translate-x-1 transition-transform">arrow_forward</span>
                                    </a>
                                </div>
                            </div>

                        </div>
                    @empty
                        <div class="w-full py-12 text-center text-slate-400 space-y-2 bg-white rounded-2xl border border-slate-100">
                            <span class="material-symbols-outlined text-4xl text-slate-300">photo_library</span>
                            <p class="text-sm font-semibold">Belum ada dokumentasi galeri kegiatan.</p>
                        </div>
                    @endforelse
                </div>

                <!-- Carousel Dots Indicator -->
                <div id="galeri-dots" class="flex justify-center items-center gap-2 pt-6"></div>
            </div>

        </section>

        <!-- 5. CALL TO ACTION BANNER -->
        <section id="tentang" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
            <div
                class="bg-gradient-to-r from-[#00A3E0] via-[#008bc0] to-[#0284c7] rounded-3xl p-8 sm:p-12 text-center text-white space-y-6 shadow-2xl relative overflow-hidden">
                <!-- Decorative Blur Glows -->
                <div class="absolute -top-24 -left-24 w-72 h-72 bg-white/10 rounded-full blur-3xl pointer-events-none">
                </div>
                <div
                    class="absolute -bottom-24 -right-24 w-72 h-72 bg-yellow-300/15 rounded-full blur-3xl pointer-events-none">
                </div>

                <div class="relative z-10 max-w-2xl mx-auto space-y-4">
                    <span
                        class="inline-flex items-center gap-1.5 px-4 py-1.5 bg-white/15 backdrop-blur-md rounded-full text-xs font-bold text-yellow-300 border border-white/20">
                        <span class="material-symbols-outlined text-sm">lightbulb</span>
                        Fasilitasi Inovasi Daerah
                    </span>

                    <h2 class="text-2xl sm:text-4xl font-extrabold tracking-tight leading-tight">
                        Punya Inovasi Teknologi Tepat Guna?
                    </h2>

                    <p class="text-sky-100 text-sm sm:text-base font-normal leading-relaxed">
                        Daftarkan karya atau hasil inovasi Anda agar terpublikasi di SI RINOVA Kota Tasikmalaya dan
                        dapat dimanfaatkan oleh masyarakat luas.
                    </p>

                    <div class="pt-3 flex justify-center">
                        <a href="{{ route('public.tentang') }}#form-pesan"
                            class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-[#fed000] hover:bg-yellow-400 hover:scale-105 active:scale-95 text-slate-900 px-8 py-3.5 rounded-xl font-bold text-sm transition-all duration-300 shadow-lg shadow-yellow-500/20">
                            <span class="material-symbols-outlined text-lg">send</span>
                            <span>Kirim Pesan</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <!-- FOOTER -->
    @include('partials.footer')


    <!-- DETAIL MODAL -->
    <div id="detail-modal"
        class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/50 backdrop-blur-sm hidden opacity-0 transition-opacity duration-300 p-4">
        <div id="detail-modal-content"
            class="bg-white rounded-3xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto custom-modal-scrollbar transform scale-95 transition-transform duration-300 p-6 sm:p-8 space-y-6">

            <div class="flex justify-between items-start border-b border-slate-100 pb-4">
                <div>
                    <span id="modal-kategori"
                        class="px-3 py-1 bg-sky-50 text-[#00A3E0] font-bold text-xs rounded-full">Kategori</span>
                    <h3 id="modal-title" class="text-2xl font-bold text-slate-900 mt-2">Nama Alat TTG</h3>
                </div>
                <button onclick="closeDetailModal()" class="text-slate-400 hover:text-slate-700 p-1">
                    <span class="material-symbols-outlined text-2xl">close</span>
                </button>
            </div>

            <!-- Image Container -->
            <div class="h-64 w-full bg-slate-100 rounded-2xl overflow-hidden border border-slate-200">
                <img id="modal-image" src="" alt="Foto Alat TTG" class="w-full h-full object-cover">
            </div>

            <!-- Details List Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                <div class="p-3.5 bg-slate-50 rounded-xl space-y-1">
                    <span class="text-slate-400 font-medium block">Inovator / Pembuat</span>
                    <span id="modal-inovator" class="font-bold text-slate-800 text-sm">-</span>
                </div>
                <div class="p-3.5 bg-slate-50 rounded-xl space-y-1">
                    <span class="text-slate-400 font-medium block">Lokasi Kecamatan</span>
                    <span id="modal-wilayah" class="font-bold text-slate-800 text-sm">-</span>
                </div>
            </div>

            <!-- Deskripsi & Spesifikasi -->
            <div class="space-y-4 text-xs text-slate-600 leading-relaxed">
                <div>
                    <h4 class="font-bold text-slate-900 text-sm mb-1">Deskripsi & Manfaat</h4>
                    <p id="modal-deskripsi"
                        class="bg-slate-50 p-4 rounded-xl text-slate-700 font-normal whitespace-pre-line">-</p>
                </div>
                <div>
                    <h4 class="font-bold text-slate-900 text-sm mb-1">Spesifikasi Alat</h4>
                    <p id="modal-spesifikasi"
                        class="bg-slate-50 p-4 rounded-xl text-slate-700 font-normal whitespace-pre-line">-</p>
                </div>
            </div>

            <div class="pt-2 flex justify-end">
                <button onclick="closeDetailModal()"
                    class="px-6 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold rounded-xl transition-all">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <!-- JavaScript Live Search, Scroll Reveal, Count-up, & Modal Handlers -->
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

        // IntersectionObserver for Scroll Reveal & Count-Up Animation (Matching tentang.blade.php)
        let revealObserver;
        function initScrollReveals() {
            const revealElements = document.querySelectorAll('.reveal, .reveal-up, .reveal-left, .reveal-right, .reveal-zoom, .reveal-on-scroll');
            const observerOptions = {
                root: null,
                rootMargin: '0px 0px -50px 0px',
                threshold: 0.15
            };

            revealObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('active');
                        entry.target.classList.add('is-visible');

                        // Animate number count-up inside card
                        const numElement = entry.target.querySelector('.stat-number');
                        if (numElement && !numElement.classList.contains('counted')) {
                            numElement.classList.add('counted');
                            const target = parseInt(numElement.getAttribute('data-target')) || 0;
                            let count = 0;
                            const duration = 1200; // ms
                            const stepTime = Math.max(Math.floor(duration / (target || 1)), 25);

                            const timer = setInterval(() => {
                                count += Math.max(1, Math.ceil(target / (duration / stepTime)));
                                if (count >= target) {
                                    numElement.textContent = target;
                                    clearInterval(timer);
                                } else {
                                    numElement.textContent = count;
                                }
                            }, stepTime);
                        }
                    }
                });
            }, observerOptions);

            revealElements.forEach(el => revealObserver.observe(el));
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initScrollReveals);
        } else {
            initScrollReveals();
        }

        // Detail Modal Logic
        const modal = document.getElementById('detail-modal');
        const modalContent = document.getElementById('detail-modal-content');

        function openDetailModal(id) {
            fetch(`/alat/detail/${id}`)
                .then(res => res.json())
                .then(data => {
                    document.getElementById('modal-title').textContent = data.nama_alat;
                    document.getElementById('modal-kategori').textContent = data.kategori ? data.kategori.nama_kategori : 'Kategori';
                    document.getElementById('modal-inovator').textContent = data.inovator ? data.inovator.nama_inovator : 'Inovator Mandiri';
                    document.getElementById('modal-wilayah').textContent = data.wilayah ? 'Kecamatan ' + data.wilayah.nama_kecamatan : 'Tasikmalaya';
                    document.getElementById('modal-deskripsi').textContent = data.manfaat || data.deskripsi || 'Tidak ada deskripsi rinci.';
                    document.getElementById('modal-spesifikasi').textContent = data.spesifikasi || 'Spesifikasi tidak tertera.';

                    const img = document.getElementById('modal-image');
                    if (data.foto) {
                        img.src = `/storage/${data.foto}`;
                    } else {
                        img.src = 'https://placehold.co/600x400?text=No+Photo';
                    }

                    modal.classList.remove('hidden');
                    requestAnimationFrame(() => {
                        modal.classList.remove('opacity-0');
                        modalContent.classList.remove('scale-95');
                    });
                })
                .catch(err => console.error(err));
        }

        function closeDetailModal() {
            modal.classList.add('opacity-0');
            modalContent.classList.add('scale-95');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }

        modal?.addEventListener('click', (e) => {
            if (e.target === modal) closeDetailModal();
        });

        // ==========================================
        // Dynamic AJAX Live Search & Category Filter
        // (Tanpa Full Page Reload / Reset Scroll)
        // ==========================================
        let activeKategori = "{{ request('kategori', '') }}";
        const searchInput = document.getElementById('search-input');
        const resultsContainer = document.getElementById('katalog-results-container');
        const categoryBtns = document.querySelectorAll('.category-btn');
        let searchDebounceTimer = null;

        function fetchKatalog(url) {
            if (resultsContainer) {
                resultsContainer.style.opacity = '0.4';
                resultsContainer.style.pointerEvents = 'none';
            }

            fetch(url, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
                .then(res => res.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const newResults = doc.getElementById('katalog-results-container');

                    if (newResults && resultsContainer) {
                        resultsContainer.innerHTML = newResults.innerHTML;
                        resultsContainer.style.opacity = '1';
                        resultsContainer.style.pointerEvents = 'auto';

                        // Observe dynamic cards in section Jelajahi Katalog
                        if (revealObserver) {
                            const newReveals = resultsContainer.querySelectorAll('.reveal, .reveal-left, .reveal-right, .reveal-zoom, .reveal-on-scroll');
                            newReveals.forEach(el => revealObserver.observe(el));
                        }
                    }

                    // Update URL tanpa refresh halaman atau reset scroll
                    history.pushState(null, '', url);
                })
                .catch(err => {
                    console.error('Filtering error:', err);
                    if (resultsContainer) {
                        resultsContainer.style.opacity = '1';
                        resultsContainer.style.pointerEvents = 'auto';
                    }
                });
        }

        // Category Filter Buttons Handler
        categoryBtns.forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                activeKategori = btn.getAttribute('data-kategori') || '';

                // Update Active Pill Styling
                categoryBtns.forEach(b => {
                    b.className = 'category-btn px-5 py-2 rounded-full transition-all bg-slate-100 text-slate-600 hover:bg-slate-200';
                });
                btn.className = 'category-btn px-5 py-2 rounded-full transition-all bg-[#00A3E0] text-white shadow-md';

                const searchVal = searchInput ? searchInput.value.trim() : '';
                const params = new URLSearchParams();
                if (searchVal) params.set('search', searchVal);
                if (activeKategori) params.set('kategori', activeKategori);

                const newUrl = `/?${params.toString()}#katalog`;
                fetchKatalog(newUrl);
            });
        });

        // Real-time Search Input Handler (Debounce 300ms)
        searchInput?.addEventListener('input', () => {
            clearTimeout(searchDebounceTimer);
            searchDebounceTimer = setTimeout(() => {
                const searchVal = searchInput.value.trim();
                const params = new URLSearchParams();
                if (searchVal) params.set('search', searchVal);
                if (activeKategori) params.set('kategori', activeKategori);

                const newUrl = `/?${params.toString()}#katalog`;
                fetchKatalog(newUrl);
            }, 300);
        });

        // Reset Filter Handler
        function resetKatalogFilter() {
            if (searchInput) searchInput.value = '';
            activeKategori = '';
            categoryBtns.forEach((b, i) => {
                if (i === 0) {
                    b.className = 'category-btn px-5 py-2 rounded-full transition-all bg-[#00A3E0] text-white shadow-md';
                } else {
                    b.className = 'category-btn px-5 py-2 rounded-full transition-all bg-slate-100 text-slate-600 hover:bg-slate-200';
                }
            });
            fetchKatalog('/#katalog');
        }

        // Pagination AJAX Event Delegation
        document.addEventListener('click', (e) => {
            const link = e.target.closest('#katalog-pagination a');
            if (link && link.href) {
                e.preventDefault();
                fetchKatalog(link.href);
            }
        });

        // ==========================================
        // Galeri Auto-Sliding Carousel Script
        // ==========================================
        const galeriSlider = document.getElementById('galeri-slider');
        const galeriPrevBtn = document.getElementById('galeri-prev-btn');
        const galeriNextBtn = document.getElementById('galeri-next-btn');
        const galeriDotsContainer = document.getElementById('galeri-dots');
        const galeriContainer = document.getElementById('galeri-carousel-container');

        if (galeriSlider && galeriContainer) {
            const galeriCards = Array.from(galeriSlider.children);
            let galeriCurrentIndex = 0;
            let galeriAutoSlideTimer = null;

            function getGaleriVisibleCount() {
                if (window.innerWidth >= 1024) return 3;
                if (window.innerWidth >= 640) return 2;
                return 1;
            }

            function getGaleriMaxIndex() {
                const visible = getGaleriVisibleCount();
                return Math.max(0, galeriCards.length - visible);
            }

            function createGaleriDots() {
                if (!galeriDotsContainer) return;
                galeriDotsContainer.innerHTML = '';
                const maxIdx = getGaleriMaxIndex();
                for (let i = 0; i <= maxIdx; i++) {
                    const dot = document.createElement('button');
                    dot.setAttribute('aria-label', `Slide ${i + 1}`);
                    dot.className = `h-2.5 rounded-full transition-all duration-300 cursor-pointer ${i === galeriCurrentIndex ? 'w-8 bg-[#00A3E0]' : 'w-2.5 bg-slate-200 hover:bg-slate-300'}`;
                    dot.addEventListener('click', () => {
                        galeriCurrentIndex = i;
                        updateGaleriSlider();
                        resetGaleriAutoSlide();
                    });
                    galeriDotsContainer.appendChild(dot);
                }
            }

            function updateGaleriSlider() {
                const maxIdx = getGaleriMaxIndex();
                if (galeriCurrentIndex > maxIdx) galeriCurrentIndex = 0;
                if (galeriCurrentIndex < 0) galeriCurrentIndex = maxIdx;

                // Hitung pergeseran murni via CSS calc tanpa query offsetWidth yang memicu forced reflow
                let stepCalc = '100% + 24px';
                if (window.innerWidth >= 1024) {
                    stepCalc = '33.333% + 8px';
                } else if (window.innerWidth >= 640) {
                    stepCalc = '50% + 12px';
                }
                galeriSlider.style.transform = `translateX(calc(-1 * ${galeriCurrentIndex} * (${stepCalc})))`;

                // Update Dots
                if (galeriDotsContainer) {
                    const dots = Array.from(galeriDotsContainer.children);
                    dots.forEach((dot, idx) => {
                        dot.className = `h-2.5 rounded-full transition-all duration-300 cursor-pointer ${idx === galeriCurrentIndex ? 'w-8 bg-[#00A3E0]' : 'w-2.5 bg-slate-200 hover:bg-slate-300'}`;
                    });
                }
            }

            function nextGaleriSlide() {
                const maxIdx = getGaleriMaxIndex();
                if (galeriCurrentIndex >= maxIdx) {
                    galeriCurrentIndex = 0;
                } else {
                    galeriCurrentIndex++;
                }
                updateGaleriSlider();
            }

            function prevGaleriSlide() {
                const maxIdx = getGaleriMaxIndex();
                if (galeriCurrentIndex <= 0) {
                    galeriCurrentIndex = maxIdx;
                } else {
                    galeriCurrentIndex--;
                }
                updateGaleriSlider();
            }

            function startGaleriAutoSlide() {
                stopGaleriAutoSlide();
                galeriAutoSlideTimer = setInterval(() => {
                    nextGaleriSlide();
                }, 3500); // Auto slide every 3.5 seconds
            }

            function stopGaleriAutoSlide() {
                if (galeriAutoSlideTimer) clearInterval(galeriAutoSlideTimer);
            }

            function resetGaleriAutoSlide() {
                stopGaleriAutoSlide();
                startGaleriAutoSlide();
            }

            galeriNextBtn?.addEventListener('click', () => {
                nextGaleriSlide();
                resetGaleriAutoSlide();
            });

            galeriPrevBtn?.addEventListener('click', () => {
                prevGaleriSlide();
                resetGaleriAutoSlide();
            });

            // Pause on hover
            galeriContainer.addEventListener('mouseenter', stopGaleriAutoSlide);
            galeriContainer.addEventListener('mouseleave', startGaleriAutoSlide);

            // Responsive Resize Listener
            window.addEventListener('resize', () => {
                createGaleriDots();
                updateGaleriSlider();
            });

            // Init Carousel
            createGaleriDots();
            updateGaleriSlider();
            startGaleriAutoSlide();
        }
    </script>
</body>

</html>