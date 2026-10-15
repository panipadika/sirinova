<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $ebook->judul }} - SI RINOVA Kota Tasikmalaya</title>
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
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        /* 3D E-Book Cover Hover Animation */
        .book-3d-wrapper {
            perspective: 1000px;
        }

        .book-3d-cover {
            position: relative;
            transform-style: preserve-3d;
            transition: transform 0.5s cubic-bezier(0.2, 0.8, 0.2, 1), box-shadow 0.5s cubic-bezier(0.2, 0.8, 0.2, 1);
            transform-origin: left center;
        }

        .book-3d-wrapper:hover .book-3d-cover,
        .book-3d-cover:hover {
            transform: rotateY(-22deg) rotateX(4deg) translateZ(10px);
            box-shadow: -15px 15px 30px rgba(0, 0, 0, 0.35);
        }

        /* Samping / Ketebalan Halaman Ebook (3D Book Side Pages) */
        .book-3d-cover::after {
            content: '';
            position: absolute;
            top: 0;
            right: -12px;
            width: 12px;
            height: 100%;
            background: linear-gradient(to right, #e2e8f0 0%, #ffffff 30%, #cbd5e1 70%, #94a3b8 100%);
            transform: rotateY(90deg);
            transform-origin: left center;
            border-radius: 0 2px 2px 0;
            box-shadow: inset 1px 0 2px rgba(0,0,0,0.15);
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .book-3d-wrapper:hover .book-3d-cover::after,
        .book-3d-cover:hover::after {
            opacity: 1;
        }
    </style>
</head>

<body class="bg-[#f8fafc] text-slate-800 antialiased min-h-screen flex flex-col justify-between selection:bg-[#00A3E0] selection:text-white overflow-x-hidden">

    <!-- 1. NAVBAR / HEADER (Exact match to ebook.blade.php) -->
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
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8 flex-1 w-full space-y-6">

        <!-- BREADCRUMB & BACK ACTION -->
        <div class="flex items-center justify-between">
            <nav class="flex items-center gap-2 text-xs font-medium text-slate-500">
                <a href="{{ route('home') }}" class="hover:text-[#00A3E0] transition-colors">Beranda</a>
                <span class="material-symbols-outlined text-sm text-slate-400">chevron_right</span>
                <a href="{{ route('public.ebook') }}" class="hover:text-[#00A3E0] transition-colors">E-Book Kajian</a>
                <span class="material-symbols-outlined text-sm text-slate-400">chevron_right</span>
                <span class="text-slate-800 font-semibold">Detail Kajian</span>
            </nav>

            <a href="{{ route('public.ebook') }}" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 rounded-full text-xs font-bold transition-all shadow-2xs">
                <span class="material-symbols-outlined text-sm">arrow_back</span>
                <span>Kembali</span>
            </a>
        </div>

        <!-- E-BOOK DETAIL CONTAINER CARD -->
        <div class="bg-white rounded-3xl border border-slate-100 shadow-xs p-6 sm:p-8 lg:p-10">

            <!-- MAIN CONTENT GRID (2 COLUMNS: LEFT COVER, RIGHT TITLE, ABSTRAKSI & BUTTONS) -->
            <div class="grid grid-cols-1 md:grid-cols-12 gap-8 lg:gap-12 items-start">
                
                <!-- LEFT COLUMN: COVER CONTAINER ONLY (4 Cols on MD+) -->
                <div class="md:col-span-5 lg:col-span-4 book-3d-wrapper max-w-xs sm:max-w-sm md:max-w-none mx-auto w-full">
                    <!-- Book Cover Card Container (Portrait 3:4 Aspect Ratio) -->
                    <div class="book-3d-cover relative aspect-[3/4] w-full rounded-2xl border border-slate-200 shadow-md overflow-hidden bg-slate-800 group">
                        @if(!empty($ebook->cover_image))
                            <img src="{{ Str::startsWith($ebook->cover_image, 'http') ? $ebook->cover_image : asset($ebook->cover_image) }}" 
                                 alt="{{ $ebook->judul }}" 
                                 class="w-full h-full object-cover">
                        @else
                            <!-- Fallback Plain Gradient Cover -->
                            <div class="absolute inset-0 bg-gradient-to-br {{ $ebook->cover_bg ?? 'from-slate-800 to-slate-900' }}"></div>
                            
                            <!-- Subtle Vector Graphic Elements -->
                            <div class="absolute inset-0 opacity-20 pointer-events-none">
                                <div class="absolute -right-8 -top-8 w-36 h-36 border-4 border-white/20 rounded-full"></div>
                                <div class="absolute -left-6 -bottom-6 w-28 h-28 border-4 border-white/20 rounded-lg rotate-12"></div>
                            </div>

                            <!-- Clean Icon Placeholder Center -->
                            <div class="absolute inset-0 flex flex-col items-center justify-center text-white/30 p-6 text-center space-y-3">
                                <span class="material-symbols-outlined text-6xl">{{ $ebook->cover_icon ?? 'menu_book' }}</span>
                                <span class="text-xs font-bold text-white/50 uppercase tracking-widest">Cover E-Book</span>
                            </div>
                        @endif

                        <!-- Top Left Category Badge -->
                        <div class="absolute top-4 left-4 z-10">
                            <span class="px-3 py-1 bg-blue-600/90 backdrop-blur-xs text-white text-xs font-extrabold rounded-md uppercase tracking-wider shadow-sm">
                                {{ strtoupper($ebook->kategori) }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- RIGHT COLUMN: TITLE, ABSTRAKSI & ACTION BUTTONS BELOW (7-8 Cols on MD+) -->
                <div class="md:col-span-7 lg:col-span-8 flex flex-col justify-between self-stretch space-y-6">

                    <!-- TITLE & BAGIKAN HEADER SECTION (Above Abstraksi) -->
                    <div class="space-y-3 border-b border-slate-100 pb-5">
                        <div class="flex items-center justify-between gap-4">
                            <div class="inline-flex items-center gap-2">
                                <span class="px-3 py-1 bg-blue-50 text-[#00A3E0] border border-blue-200/60 rounded-full text-xs font-extrabold uppercase tracking-wider">
                                    {{ $ebook->kategori }}
                                </span>
                                <span class="text-xs font-bold text-slate-400">• {{ $ebook->tahun }}</span>
                            </div>

                            <!-- Bagikan Share Button -->
                            <button onclick="shareEbook()" class="inline-flex items-center gap-2 px-3.5 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl text-xs font-bold transition-all shrink-0 shadow-2xs hover:shadow-xs active:scale-95">
                                <span class="material-symbols-outlined text-base">share</span>
                                <span>Bagikan</span>
                            </button>
                        </div>

                        <!-- E-Book Title -->
                        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-[#0b3c5d] tracking-tight leading-snug">
                            {{ $ebook->judul }}
                        </h1>
                    </div>

                    <!-- Deskripsi Singkat Section -->
                    <div class="space-y-3 flex-1">
                        <h2 class="text-lg sm:text-xl font-extrabold text-slate-900 border-b border-slate-200 pb-2">
                            Deskripsi Singkat
                        </h2>
                        <div class="text-slate-600 text-sm sm:text-base leading-relaxed space-y-3 text-justify">
                            <p class="text-justify">
                                {{ $ebook->deskripsi }}
                            </p>
                        </div>
                    </div>

                    <!-- Action Buttons Moved Below Abstraksi (In the Empty Space) -->
                    <div class="pt-4 border-t border-slate-100 flex flex-col sm:flex-row items-center gap-3">
                        @php
                            $hasPdf = !empty($ebook->file_url) && $ebook->file_url !== '#';
                            $pdfUrl = $hasPdf ? (str_starts_with($ebook->file_url, 'http') ? $ebook->file_url : asset($ebook->file_url)) : '#';
                        @endphp

                        @if($hasPdf)
                            <!-- Primary Button: Unduh Publikasi -->
                            <a href="{{ $pdfUrl }}" download
                               class="w-full sm:w-auto flex-1 flex items-center justify-center gap-2 py-3 px-6 bg-[#00A3E0] hover:bg-[#008cc0] text-white rounded-xl text-sm font-bold shadow-sm hover:shadow-md transition-all duration-200 group">
                                <span class="material-symbols-outlined text-lg group-hover:translate-y-0.5 transition-transform">download</span>
                                <span>Unduh Publikasi</span>
                            </a>

                            <!-- Secondary Button: Baca Online (PDF) -->
                            <a href="{{ $pdfUrl }}" target="_blank"
                               class="w-full sm:w-auto flex-1 flex items-center justify-center gap-2 py-3 px-6 bg-white hover:bg-slate-50 border border-[#00A3E0] text-[#00A3E0] rounded-xl text-sm font-bold shadow-2xs hover:shadow-xs transition-all duration-200">
                                <span class="material-symbols-outlined text-lg">menu_book</span>
                                <span>Baca Online (PDF)</span>
                            </a>
                        @else
                            <!-- Primary Button: Unduh Publikasi (Belum Ada File) -->
                            <button type="button" onclick="alert('File dokumen PDF untuk e-book ini belum diunggah oleh Admin.')"
                               class="w-full sm:w-auto flex-1 flex items-center justify-center gap-2 py-3 px-6 bg-slate-200 hover:bg-slate-300 text-slate-600 rounded-xl text-sm font-bold shadow-2xs transition-all duration-200 cursor-pointer">
                                <span class="material-symbols-outlined text-lg">download</span>
                                <span>Unduh Publikasi</span>
                            </button>

                            <!-- Secondary Button: Baca Online (PDF) (Belum Ada File) -->
                            <button type="button" onclick="alert('File dokumen PDF untuk e-book ini belum diunggah oleh Admin.')"
                               class="w-full sm:w-auto flex-1 flex items-center justify-center gap-2 py-3 px-6 bg-slate-100 hover:bg-slate-200 border border-slate-300 text-slate-600 rounded-xl text-sm font-bold shadow-2xs transition-all duration-200 cursor-pointer">
                                <span class="material-symbols-outlined text-lg">menu_book</span>
                                <span>Baca Online (PDF)</span>
                            </button>
                        @endif
                    </div>

                </div>

            </div>

        </div>

    </main>

    <!-- FOOTER -->
    @include('partials.footer')


    <!-- Toast Notification for Share Link -->
    <div id="toast-share" class="fixed bottom-6 right-6 z-50 translate-y-20 opacity-0 transition-all duration-300 pointer-events-none">
        <div class="bg-slate-900 text-white px-4 py-3 rounded-2xl shadow-xl flex items-center gap-3 text-xs font-bold border border-slate-700">
            <span class="material-symbols-outlined text-green-400 text-base">check_circle</span>
            <span>Tautan berhasil disalin ke papan klip!</span>
        </div>
    </div>

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

        // Share E-Book Functionality
        function shareEbook() {
            if (navigator.clipboard) {
                navigator.clipboard.writeText(window.location.href).then(() => {
                    showToast();
                }).catch(() => {
                    fallbackShare();
                });
            } else {
                fallbackShare();
            }
        }

        function fallbackShare() {
            const dummy = document.createElement('input');
            document.body.appendChild(dummy);
            dummy.value = window.location.href;
            dummy.select();
            document.execCommand('copy');
            document.body.removeChild(dummy);
            showToast();
        }

        function showToast() {
            const toast = document.getElementById('toast-share');
            toast.classList.remove('translate-y-20', 'opacity-0');
            toast.classList.add('translate-y-0', 'opacity-100');
            setTimeout(() => {
                toast.classList.remove('translate-y-0', 'opacity-100');
                toast.classList.add('translate-y-20', 'opacity-0');
            }, 3000);
        }
    </script>
</body>

</html>
