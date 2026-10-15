<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $dokumen->judul }} - Telaahan Staf SI RINOVA</title>
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
            -ms-overflow-style: none !important;
            scrollbar-width: none !important;
        }
        html::-webkit-scrollbar,
        body::-webkit-scrollbar {
            display: none !important;
            width: 0 !important;
            height: 0 !important;
        }

        /* Reveal animation */
        .reveal-up {
            opacity: 0;
            transform: translateY(15px);
            transition: opacity 0.4s ease-out, transform 0.4s ease-out;
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

        <!-- Breadcrumb Navigation -->
        <nav class="flex items-center gap-2 text-xs font-semibold text-slate-500 reveal-up">
            <a href="/" class="hover:text-[#29abe2] transition-colors">Beranda</a>
            <span class="material-symbols-outlined text-sm text-slate-400">chevron_right</span>
            <a href="{{ route('public.telaahan-staf') }}" class="hover:text-[#29abe2] transition-colors">Telaahan Staf</a>
            <span class="material-symbols-outlined text-sm text-slate-400">chevron_right</span>
            <span class="text-slate-800 font-semibold">Detail Telaahan</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

            <!-- LEFT & CENTER COLUMN: MAIN DOCUMENT CONTENT (2 Cols) -->
            <div class="lg:col-span-2 space-y-6">

                <!-- Header Document Card -->
                <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-100 shadow-[0_4px_20px_rgba(0,0,0,0.03)] space-y-4 reveal-up">
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="px-3 py-1 bg-sky-50 text-[#29abe2] text-xs font-extrabold rounded-lg uppercase tracking-wider flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-sm">corporate_fare</span>
                            {{ $dokumen->pembuat_bidang }}
                        </span>
                        <span class="px-3 py-1 bg-green-50 text-green-700 text-xs font-extrabold rounded-lg uppercase tracking-wider flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm">verified</span>
                            Dipublikasikan
                        </span>
                    </div>

                    <h1 class="text-2xl sm:text-3xl font-black text-slate-900 leading-snug tracking-tight">
                        {{ $dokumen->judul }}
                    </h1>

                    <div class="flex flex-wrap items-center gap-y-2 gap-x-6 text-xs text-slate-500 font-medium pt-2 border-t border-slate-100">
                        <div class="flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-base text-slate-400">calendar_today</span>
                            <span>{{ $dokumen->tahun_dokumen ?? '-' }}</span>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-base text-slate-400">corporate_fare</span>
                            <span>{{ $dokumen->pembuat_bidang }}</span>
                        </div>
                    </div>
                </div>

                <!-- Section: Ringkasan Dokumen -->
                @if(!empty($dokumen->ringkasan))
                    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-100 shadow-xs space-y-3 reveal-up">
                        <h3 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                            <span class="material-symbols-outlined text-[#29abe2]">summarize</span>
                            Ringkasan / Latar Belakang
                        </h3>
                        <div class="text-sm text-slate-600 leading-relaxed space-y-2 whitespace-pre-line text-justify">
                            {{ $dokumen->ringkasan }}
                        </div>
                    </div>
                @endif

                <!-- Section: Document PDF Embed / Previewer -->
                <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-100 shadow-xs space-y-4 reveal-up">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                        <h3 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                            <span class="material-symbols-outlined text-red-500">picture_as_pdf</span>
                            Preview Dokumen Resmi PDF
                        </h3>

                        @if(!empty($dokumen->file_pdf))
                            <div class="flex items-center gap-2">
                                <a href="{{ asset($dokumen->file_pdf) }}" download
                                   class="px-4 py-2 bg-[#29abe2] hover:bg-[#1a95c9] text-white text-xs font-bold rounded-xl shadow-xs transition-all flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-base">download</span>
                                    Unduh PDF
                                </a>
                                <a href="{{ asset($dokumen->file_pdf) }}" target="_blank"
                                   class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold rounded-xl transition-all flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-base">open_in_new</span>
                                    Buka Full
                                </a>
                            </div>
                        @endif
                    </div>

                    @if(!empty($dokumen->file_pdf))
                        <div class="relative w-full overflow-hidden rounded-2xl border border-slate-200 bg-slate-900 shadow-inner">
                            <iframe src="{{ asset($dokumen->file_pdf) }}#toolbar=1" 
                                    class="w-full h-[650px] rounded-2xl" 
                                    title="PDF Preview Dokumen {{ $dokumen->judul }}" 
                                    type="application/pdf">
                            </iframe>
                        </div>
                    @else
                        <div class="py-12 px-4 text-center bg-slate-50 rounded-2xl border border-dashed border-slate-200 space-y-2">
                            <span class="material-symbols-outlined text-4xl text-slate-300">find_in_page</span>
                            <h4 class="text-sm font-bold text-slate-600">Dokumen PDF Belum Diunggah</h4>
                            <p class="text-xs text-slate-400">Berkas digital belum tersedia untuk diunduh langsung saat ini.</p>
                        </div>
                    @endif
                </div>

            </div>

            <!-- RIGHT COLUMN: SIDEBAR METADATA & RELATED DOCUMENTS (1 Col) -->
            <div class="space-y-6">

                <!-- Metadata Card -->
                <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-xs space-y-4 reveal-up">
                    <h4 class="text-base font-bold text-slate-900 pb-3 border-b border-slate-100 flex items-center gap-2">
                        <span class="material-symbols-outlined text-[#29abe2]">info</span>
                        Informasi Dokumen
                    </h4>

                    <dl class="space-y-3 text-xs">
                        <div>
                            <dt class="text-slate-400 font-medium">Bidang Pembuat</dt>
                            <dd class="text-slate-800 font-semibold mt-0.5">{{ $dokumen->pembuat_bidang }}</dd>
                        </div>
                        <div>
                            <dt class="text-slate-400 font-medium">Tahun Rilis Dokumen</dt>
                            <dd class="text-slate-800 font-semibold mt-0.5">
                                {{ $dokumen->tahun_dokumen ?? '-' }}
                            </dd>
                        </div>
                        <div>
                            <dt class="text-slate-400 font-medium">Status Dokumen</dt>
                            <dd class="mt-0.5 inline-flex items-center gap-1 px-2.5 py-0.5 rounded bg-green-50 text-green-700 font-bold">
                                <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                {{ $dokumen->status }}
                            </dd>
                        </div>
                    </dl>

                    <div class="pt-4 border-t border-slate-100">
                        <a href="{{ route('public.telaahan-staf') }}"
                           class="w-full py-3 px-4 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl text-xs font-bold transition-all text-center flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-base">arrow_back</span>
                            <span>Kembali ke Daftar Dokumen</span>
                        </a>
                    </div>
                </div>

                <!-- Related Telaahan Staf Card -->
                @if(isset($terkait) && count($terkait) > 0)
                    <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-xs space-y-4 reveal-up">
                        <h4 class="text-base font-bold text-slate-900 pb-3 border-b border-slate-100 flex items-center gap-2">
                            <span class="material-symbols-outlined text-[#29abe2]">auto_awesome_motion</span>
                            Telaahan Staf Terkait
                        </h4>

                        <div class="space-y-3">
                            @foreach($terkait as $rel)
                                <a href="{{ route('public.telaahan-staf.detail', $rel->id) }}" 
                                   class="block p-3 rounded-2xl hover:bg-slate-50 border border-transparent hover:border-slate-100 transition-all group">
                                    <span class="px-2 py-0.5 bg-sky-50 text-[#29abe2] text-[9px] font-extrabold rounded uppercase flex items-center gap-1 w-fit">
                                        <span class="material-symbols-outlined text-[11px]">corporate_fare</span>
                                        {{ $rel->pembuat_bidang }}
                                    </span>
                                    <h5 class="text-xs font-bold text-slate-800 group-hover:text-[#29abe2] transition-colors mt-1.5 line-clamp-2">
                                        {{ $rel->judul }}
                                    </h5>
                                    <p class="text-[11px] text-slate-400 font-medium mt-1">
                                        {{ $rel->tahun_dokumen ?? '' }}
                                    </p>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>

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
    </script>

</body>
</html>
