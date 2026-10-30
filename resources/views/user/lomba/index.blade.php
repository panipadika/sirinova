<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Lomba Teknologi Tepat Guna (TTG) - SI RINOVA Kota Tasikmalaya</title>
    <meta name="description" content="Informasi dan Pendaftaran Resmi Lomba Inovasi Alat Teknologi Tepat Guna (TTG) Bappelitbangda Kota Tasikmalaya. Kategori Pelajar SMA/SMK, Perguruan Tinggi, dan Umum.">

    <!-- Favicon Logo Tasikmalaya -->
    <link rel="icon" type="image/png" href="{{ asset('storage/images/favicon_tasik.png') }}?v=3">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=3">
    <link rel="apple-touch-icon" href="{{ asset('storage/images/favicon_tasik.png') }}?v=3">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts & Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@600;700;800;900&display=swap" rel="stylesheet">

    <style>
        html, body {
            margin: 0 !important;
            padding: 0 !important;
        }
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, h4, h5, h6 { font-family: 'Plus Jakarta Sans', sans-serif; }
        
        /* Hide scrollbar completely for all elements */
        html, body, * {
            -ms-overflow-style: none !important;
            scrollbar-width: none !important;
        }
        html::-webkit-scrollbar,
        body::-webkit-scrollbar,
        *::-webkit-scrollbar {
            display: none !important;
            width: 0 !important;
            height: 0 !important;
        }

        .circuit-pattern {
            background-image: radial-gradient(circle at 2px 2px, rgba(255, 255, 255, 0.18) 1px, transparent 0);
            background-size: 24px 24px;
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased selection:bg-[#00A3E0] selection:text-white overflow-x-hidden">

    <!-- 1. NAVBAR / HEADER -->
    <header class="bg-white/95 backdrop-blur-md sticky top-0 z-50 border-b border-slate-100 shadow-sm transition-all m-0" style="top: 0; margin-top: 0;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between gap-4">

            <!-- Logo & Brand Name -->
            <a href="/" class="flex items-center gap-3 shrink-0 group">
                <img src="{{ asset('storage/images/logo_tasik.png') }}"
                     alt="Logo Kota Tasikmalaya" class="h-10 w-auto object-contain group-hover:scale-105 transition-transform">
                <span class="text-xl sm:text-2xl font-black text-[#00A3E0] tracking-tight">
                    SI RINOVA
                </span>
            </a>

            <!-- Desktop Navigation Links -->
            <nav class="hidden md:flex items-center gap-6 xl:gap-8 font-semibold text-sm whitespace-nowrap">
                @if(!Auth::guard('peserta')->check())
                <a href="/" class="text-slate-600 hover:text-[#00A3E0] transition-colors py-1 whitespace-nowrap">Beranda</a>
                @endif
                <a href="{{ route('public.indikator-makro') }}" class="text-slate-600 hover:text-[#00A3E0] transition-colors py-1 whitespace-nowrap">Indikator Makro</a>
                
                <!-- Dropdown Katalog TTG -->
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
                <a href="{{ route('lomba.info') }}" class="text-amber-500 border-b-2 border-amber-500 pb-1 flex items-center gap-1 font-bold whitespace-nowrap transition-colors">
                    <span class="material-symbols-outlined text-base text-amber-500">emoji_events</span>
                    <span>Lomba TTG</span>
                </a>
                <a href="{{ route('public.tentang') }}" class="text-slate-600 hover:text-[#00A3E0] transition-colors py-1 whitespace-nowrap">Tentang</a>

                <!-- Profile Badge & Dropdown Peserta (Desktop) -->
                @if(Auth::guard('peserta')->check())
                @php
                    $pesertaUser = Auth::guard('peserta')->user();
                    $namaPanggilan = explode(' ', trim($pesertaUser->name))[0] ?? 'Peserta';
                    $initials = strtoupper(substr($pesertaUser->name ?? 'P', 0, 1));
                @endphp
                <div class="relative group ml-1 lg:ml-2 pl-3 lg:pl-4 border-l border-slate-200">
                    <button type="button" class="flex items-center gap-2 py-1 px-2.5 rounded-full bg-slate-50 hover:bg-sky-50 border border-slate-200/90 hover:border-sky-300 text-slate-700 hover:text-[#00A3E0] transition-all shadow-2xs cursor-pointer group-hover:bg-sky-50 group-hover:border-sky-300">
                        <div class="w-7 h-7 rounded-full bg-gradient-to-tr from-[#00A3E0] to-sky-400 text-white font-black text-xs flex items-center justify-center shadow-xs uppercase">
                            {{ $initials }}
                        </div>
                        <div class="text-left hidden lg:block">
                            <span class="block text-xs font-bold leading-tight max-w-[90px] xl:max-w-[120px] truncate text-slate-800">{{ $namaPanggilan }}</span>
                            <span class="block text-[9px] font-semibold text-emerald-600 leading-none">{{ $pesertaUser->kategori ?? 'Peserta TTG' }}</span>
                        </div>
                        <span class="material-symbols-outlined text-base text-slate-400 group-hover:text-[#00A3E0] transition-transform duration-200 group-hover:rotate-180">expand_more</span>
                    </button>

                    <!-- Dropdown Card -->
                    <div class="absolute right-0 top-full pt-2 w-64 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                        <div class="bg-white rounded-2xl shadow-xl border border-slate-100 py-1.5 overflow-hidden">
                            <!-- User Info Header -->
                            <div class="px-4 py-3 border-b border-slate-100 bg-slate-50/70">
                                <div class="flex items-center justify-between gap-1 mb-0.5">
                                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Akun Peserta Lomba</span>
                                    @if($pesertaUser->kategori)
                                    <span class="text-[9px] font-bold px-1.5 py-0.5 rounded bg-[#00A3E0]/10 text-[#00A3E0] border border-[#00A3E0]/20">{{ $pesertaUser->kategori }}</span>
                                    @endif
                                </div>
                                <p class="text-xs font-bold text-slate-800 truncate">{{ $pesertaUser->name }}</p>
                                <p class="text-[11px] text-slate-500 truncate">{{ $pesertaUser->email }}</p>
                            </div>

                            <!-- Menu Items -->
                            <div class="p-1.5 space-y-0.5">
                                <a href="{{ route('lomba.status') }}" 
                                   class="flex items-center gap-2.5 px-3 py-2 text-xs font-semibold rounded-xl transition-colors {{ request()->routeIs('lomba.status') ? 'bg-sky-50 text-[#00A3E0] font-bold' : 'text-slate-700 hover:bg-slate-50 hover:text-[#00A3E0]' }}">
                                    <span class="material-symbols-outlined text-base text-[#00A3E0]">history_edu</span>
                                    <span class="flex-1">Status & Riwayat Karya</span>
                                    @if(request()->routeIs('lomba.status'))
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#00A3E0]"></span>
                                    @endif
                                </a>

                                <a href="{{ route('lomba.daftar') }}" 
                                   class="flex items-center gap-2.5 px-3 py-2 text-xs font-semibold rounded-xl transition-colors {{ request()->routeIs('lomba.daftar') ? 'bg-sky-50 text-[#00A3E0] font-bold' : 'text-slate-700 hover:bg-slate-50 hover:text-[#00A3E0]' }}">
                                    <span class="material-symbols-outlined text-base text-[#00A3E0]">app_registration</span>
                                    <span class="flex-1">Formulir Pendaftaran</span>
                                    @if(request()->routeIs('lomba.daftar'))
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#00A3E0]"></span>
                                    @endif
                                </a>

                                <a href="{{ route('lomba.info') }}" 
                                   class="flex items-center gap-2.5 px-3 py-2 text-xs font-semibold rounded-xl transition-colors {{ request()->routeIs('lomba.info') ? 'bg-amber-50 text-amber-600 font-bold' : 'text-slate-700 hover:bg-slate-50 hover:text-amber-600' }}">
                                    <span class="material-symbols-outlined text-base text-amber-500">emoji_events</span>
                                    <span class="flex-1">Informasi Lomba TTG</span>
                                    @if(request()->routeIs('lomba.info'))
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                    @endif
                                </a>
                            </div>

                            <!-- Logout Item -->
                            <div class="p-1.5 pt-1 border-t border-slate-100 mt-1">
                                <form action="{{ route('peserta.logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" 
                                            class="w-full flex items-center gap-2.5 px-3 py-2 text-xs font-bold text-rose-600 hover:bg-rose-50 rounded-xl transition-colors text-left cursor-pointer">
                                        <span class="material-symbols-outlined text-base">logout</span>
                                        <span>Keluar Akun</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </nav>

            <!-- Mobile Menu Toggle Button -->
            <button id="mobile-menu-btn" class="md:hidden text-slate-700 hover:text-[#00A3E0] p-2 focus:outline-none">
                <span class="material-symbols-outlined text-2xl">menu</span>
            </button>
        </div>

        <!-- Mobile Nav Menu Dropdown -->
        <div id="mobile-nav" class="hidden md:hidden bg-white border-b border-slate-200 px-6 py-4 space-y-3 font-semibold text-sm">
            @if(!Auth::guard('peserta')->check())
            <a href="/" class="block text-slate-600 hover:text-[#00A3E0]">Beranda</a>
            @endif
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
            <a href="{{ route('public.ebook') }}" class="block text-slate-600">E-Book Kajian</a>
            <a href="{{ route('public.telaahan-staf') }}" class="block text-slate-600">Telaahan Staf</a>
            <a href="{{ route('public.galeri') }}" class="block text-slate-600">Galeri</a>
            <a href="{{ route('lomba.info') }}" class="flex items-center gap-1.5 text-amber-500 font-bold">
                <span class="material-symbols-outlined text-base text-amber-500">emoji_events</span>
                <span>Lomba TTG</span>
            </a>
            <a href="{{ route('public.tentang') }}" class="block text-slate-600">Tentang</a>
            @if(Auth::guard('peserta')->check())
            @php
                $pesertaUserMobile = Auth::guard('peserta')->user();
                $mobileInitials = strtoupper(substr($pesertaUserMobile->name ?? 'P', 0, 1));
            @endphp
            <div class="pt-3 border-t border-slate-100 space-y-2">
                <!-- User Profile Card in Drawer -->
                <div class="p-3 bg-slate-50 rounded-2xl border border-slate-200/80 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-[#00A3E0] to-sky-400 text-white font-black text-sm flex items-center justify-center shrink-0 shadow-xs uppercase">
                        {{ $mobileInitials }}
                    </div>
                    <div class="min-w-0 flex-1">
                        <span class="text-xs font-bold text-slate-800 block truncate">{{ $pesertaUserMobile->name }}</span>
                        <span class="text-[11px] text-slate-400 block truncate">{{ $pesertaUserMobile->email }}</span>
                    </div>
                </div>

                <div class="space-y-1">
                    <a href="{{ route('lomba.status') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-xs font-bold {{ request()->routeIs('lomba.status') ? 'bg-sky-50 text-[#00A3E0]' : 'text-slate-700 hover:bg-slate-50' }}">
                        <span class="material-symbols-outlined text-base text-[#00A3E0]">history_edu</span>
                        <span>Status & Riwayat Karya</span>
                    </a>
                    <a href="{{ route('lomba.daftar') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-xs font-bold {{ request()->routeIs('lomba.daftar') ? 'bg-sky-50 text-[#00A3E0]' : 'text-slate-700 hover:bg-slate-50' }}">
                        <span class="material-symbols-outlined text-base text-[#00A3E0]">app_registration</span>
                        <span>Formulir Pendaftaran</span>
                    </a>
                    <form action="{{ route('peserta.logout') }}" method="POST" class="pt-1">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-center gap-2 py-2.5 text-rose-600 rounded-xl font-bold text-xs bg-rose-50 hover:bg-rose-100 transition-colors">
                            <span class="material-symbols-outlined text-base">logout</span>
                            <span>Keluar Akun</span>
                        </button>
                    </form>
                </div>
            </div>
            @else
                <div class="pt-2 border-t border-slate-100 flex flex-col gap-2">
                    <a href="{{ route('peserta.login') }}" class="block text-center py-2 border border-slate-200 rounded-xl font-bold text-xs text-slate-700">Login Peserta</a>
                    <a href="{{ route('peserta.register') }}" class="block text-center py-2 bg-[#00A3E0] text-white rounded-xl font-bold text-xs">Daftar Akun Baru</a>
                </div>
            @endif
        </div>
    </header>

    <!-- HERO SECTION -->
    <section class="relative bg-gradient-to-b from-[#00A3E0] via-[#0284c7] to-[#0369a1] text-white overflow-hidden py-16 sm:py-20 lg:py-24">
        <!-- Soft Background Accents (Clean & Simple) -->
        <div class="absolute inset-0 opacity-15 pointer-events-none circuit-pattern"></div>
        <div class="absolute -top-24 -left-24 w-80 h-80 bg-white/15 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -right-24 w-80 h-80 bg-cyan-300/20 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center space-y-6">

            <!-- Title with Persuasive Call to Action -->
            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight text-white max-w-4xl mx-auto leading-tight sm:leading-[1.15]">
                Punya Ide Alat Inovatif?<br class="hidden sm:inline">
                <span class="text-cyan-200">Yuk, Daftarkan Karyamu Sekarang!</span>
            </h1>

            <!-- Subtitle / Invitation sentence -->
            <p class="text-sm sm:text-lg text-cyan-50/95 max-w-2xl mx-auto font-normal leading-relaxed">
                Jangan simpan ide hebatmu sendiri! Tunjukkan karya teknologi tepat guna buatan timmu, raih penghargaan bergengsi, dan bawa manfaat nyata bagi masyarakat Kota Tasikmalaya.
            </p>

            @php
                $semuaKategoriTutup = $jadwalKategori->every(fn($j) => !$j->isPendaftaranDibuka());
            @endphp

            <!-- CTA Buttons -->
            <div class="pt-2 flex flex-wrap items-center justify-center gap-3 sm:gap-4">
                @if(Auth::guard('peserta')->check())
                    @if($semuaKategoriTutup)
                        <button type="button" disabled class="inline-flex items-center gap-2 px-6 py-3.5 bg-white/20 text-white/80 font-bold text-sm rounded-xl cursor-not-allowed border border-white/30 backdrop-blur-md">
                            <span class="material-symbols-outlined text-xl">lock</span>
                            <span>Pendaftaran Saat Ini Ditutup</span>
                        </button>
                    @else
                        <a href="{{ route('lomba.daftar') }}" class="inline-flex items-center gap-2 px-7 py-3.5 bg-white text-[#00A3E0] hover:bg-cyan-50 hover:shadow-xl hover:scale-[1.02] active:scale-[0.98] font-black text-sm rounded-xl shadow-lg shadow-sky-950/20 transition-all">
                            <span class="material-symbols-outlined text-xl">edit_document</span>
                            <span>Isi Formulir Pendaftaran</span>
                        </a>
                    @endif
                    <a href="{{ route('lomba.status') }}" class="inline-flex items-center gap-2 px-6 py-3.5 bg-white/15 hover:bg-white/25 border border-white/30 text-white font-bold text-sm rounded-xl backdrop-blur-md transition-all hover:scale-[1.02] active:scale-[0.98]">
                        <span class="material-symbols-outlined text-xl">dashboard</span>
                        <span>Lihat Status Karya Saya</span>
                    </a>
                @else
                    @if($semuaKategoriTutup)
                        <button type="button" disabled class="inline-flex items-center gap-2 px-6 py-3.5 bg-white/20 text-white/80 font-bold text-sm rounded-xl cursor-not-allowed border border-white/30 backdrop-blur-md">
                            <span class="material-symbols-outlined text-xl">lock</span>
                            <span>Pendaftaran Saat Ini Ditutup</span>
                        </button>
                    @else
                        <a href="{{ route('lomba.daftar') }}" class="inline-flex items-center gap-2.5 px-7 py-3.5 bg-white text-[#00A3E0] hover:bg-cyan-50 hover:shadow-xl hover:scale-[1.02] active:scale-[0.98] font-black text-sm rounded-xl shadow-lg shadow-sky-950/20 transition-all">
                            <span class="material-symbols-outlined text-xl">rocket_launch</span>
                            <span>Daftar Lomba Sekarang</span>
                        </a>
                    @endif
                    <a href="{{ route('peserta.login') }}" class="inline-flex items-center gap-2 px-6 py-3.5 bg-white/15 hover:bg-white/25 border border-white/30 text-white font-bold text-sm rounded-xl backdrop-blur-md transition-all hover:scale-[1.02] active:scale-[0.98]">
                        <span class="material-symbols-outlined text-xl">login</span>
                        <span>Masuk Akun Peserta</span>
                    </a>
                @endif
            </div>

            <!-- Highlights / Mini Benefits -->
            <div class="pt-3 flex flex-wrap items-center justify-center gap-x-6 gap-y-2 text-xs font-semibold text-cyan-100">
                <span class="flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-emerald-300 text-base">check_circle</span>
                    <span>100% Gratis Pendaftaran</span>
                </span>
                <span class="flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-emerald-300 text-base">check_circle</span>
                    <span>Piala & Piagam Penghargaan</span>
                </span>
            </div>  
        </div>
    </section>

    <!-- SECTION: 3 KATEGORI PESERTA -->
    <section class="py-16 bg-white border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
            <div class="text-center space-y-2 max-w-2xl mx-auto">
                <span class="text-xs font-black uppercase tracking-wider text-[#00A3E0]">Kategori Perlombaan</span>
                <h2 class="text-2xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                    Pilih Kategori Tim Kamu
                </h2>
                <p class="text-sm text-slate-500 leading-relaxed">
                    Pilih kategori yang sesuai dan daftarkan alat inovasi teknologi tepat guna Anda.
                </p>
            </div>

            @php
                $jadwalSMA = $jadwalKategori->get('SMA/SMK Sederajat');
                $isSMABuka = $jadwalSMA ? $jadwalSMA->isPendaftaranDibuka() : true;

                $jadwalPT = $jadwalKategori->get('Perguruan Tinggi');
                $isPTBuka = $jadwalPT ? $jadwalPT->isPendaftaranDibuka() : true;

                $jadwalUmum = $jadwalKategori->get('Umum');
                $isUmumBuka = $jadwalUmum ? $jadwalUmum->isPendaftaranDibuka() : true;
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Kategori 1: SMA/SMK Sederajat -->
                <div class="relative bg-gradient-to-b from-sky-50/60 to-white p-7 rounded-2xl border border-sky-100 shadow-sm hover:shadow-md transition-all space-y-5 flex flex-col justify-between">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="w-14 h-14 rounded-2xl bg-[#00A3E0] text-white flex items-center justify-center shadow-md shadow-sky-500/20">
                                <span class="material-symbols-outlined text-3xl">school</span>
                            </div>
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 text-[11px] font-bold rounded-xl border {{ $isSMABuka ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : 'bg-rose-50 text-rose-700 border-rose-200' }}">
                                <span class="material-symbols-outlined text-sm">{{ $isSMABuka ? 'lock_open' : 'lock' }}</span>
                                <span>{{ $isSMABuka ? 'Dibuka' : 'Ditutup' }}</span>
                            </span>
                        </div>
                        <div class="space-y-1.5">
                            <span class="text-[11px] font-extrabold text-[#00A3E0] uppercase tracking-wider">Kategori 01</span>
                            <h3 class="text-xl font-extrabold text-slate-900">SMA / SMK Sederajat</h3>
                            <p class="text-xs text-slate-600 leading-relaxed">
                                Ditujukan bagi siswa/siswi aktif SMA, SMK, atau MA di wilayah Kota Tasikmalaya yang memiliki karya alat terapan kreatif dan aplikatif.
                            </p>
                        </div>

                        <!-- Jadwal Pelaksanaan -->
                        @if($jadwalSMA)
                        <div class="p-2.5 bg-slate-50 rounded-xl border border-slate-100 text-[11px] space-y-1">
                            <span class="text-slate-400 block text-[10px] uppercase font-bold">Jadwal Pendaftaran:</span>
                            <p class="font-bold text-slate-700 flex items-center gap-1">
                                <span class="material-symbols-outlined text-xs text-[#00A3E0]">calendar_today</span>
                                <span>{{ $jadwalSMA->periode_teks }}</span>
                            </p>
                        </div>
                        @endif

                        <ul class="text-xs text-slate-600 space-y-2 pt-2 border-t border-slate-100">
                            <li class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-emerald-600 text-base">check_circle</span>
                                <span>Perorangan atau Tim (Maks. 3-5 siswa)</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-emerald-600 text-base">check_circle</span>
                                <span>Didampingi guru pembimbing</span>
                            </li>
                        </ul>
                    </div>

                    @if(!empty($lockedKategori) && $lockedKategori !== 'SMA/SMK Sederajat')
                    <button type="button" disabled class="w-full py-2.5 px-4 bg-slate-100 text-slate-400 font-bold text-xs rounded-xl text-center cursor-not-allowed flex items-center justify-center gap-1.5 border border-slate-200" title="Akun Anda terdaftar di kategori {{ $lockedKategori }}">
                        <span class="material-symbols-outlined text-sm">lock</span>
                        <span>Akun Terdaftar di {{ $lockedKategori }}</span>
                    </button>
                    @elseif($isSMABuka)
                    <a href="{{ route('lomba.daftar') }}?kategori=SMA/SMK Sederajat" class="w-full py-2.5 px-4 bg-sky-100 hover:bg-[#00A3E0] text-[#00A3E0] hover:text-white font-bold text-xs rounded-xl text-center transition-colors block">
                        {{ !empty($lockedKategori) && $lockedKategori === 'SMA/SMK Sederajat' ? '+ Daftarkan Karya Baru →' : 'Daftar Kategori Ini →' }}
                    </a>
                    @else
                    <button type="button" disabled class="w-full py-2.5 px-4 bg-slate-100 text-slate-400 font-bold text-xs rounded-xl text-center cursor-not-allowed flex items-center justify-center gap-1.5 border border-slate-200">
                        <span class="material-symbols-outlined text-sm">lock</span>
                        <span>Pendaftaran Ditutup</span>
                    </button>
                    @endif
                </div>

                <!-- Kategori 2: Perguruan Tinggi -->
                <div class="relative bg-gradient-to-b from-indigo-50/60 to-white p-7 rounded-2xl border border-indigo-100 shadow-sm hover:shadow-md transition-all space-y-5 flex flex-col justify-between">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="w-14 h-14 rounded-2xl bg-indigo-600 text-white flex items-center justify-center shadow-md shadow-indigo-500/20">
                                <span class="material-symbols-outlined text-3xl">account_balance</span>
                            </div>
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 text-[11px] font-bold rounded-xl border {{ $isPTBuka ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : 'bg-rose-50 text-rose-700 border-rose-200' }}">
                                <span class="material-symbols-outlined text-sm">{{ $isPTBuka ? 'lock_open' : 'lock' }}</span>
                                <span>{{ $isPTBuka ? 'Dibuka' : 'Ditutup' }}</span>
                            </span>
                        </div>
                        <div class="space-y-1.5">
                            <span class="text-[11px] font-extrabold text-indigo-600 uppercase tracking-wider">Kategori 02</span>
                            <h3 class="text-xl font-extrabold text-slate-900">Perguruan Tinggi</h3>
                            <p class="text-xs text-slate-600 leading-relaxed">
                                Terbuka untuk mahasiswa aktif Diploma maupun Sarjana dari universitas, institut, politeknik, atau sekolah tinggi.
                            </p>
                        </div>

                        <!-- Jadwal Pelaksanaan -->
                        @if($jadwalPT)
                        <div class="p-2.5 bg-slate-50 rounded-xl border border-slate-100 text-[11px] space-y-1">
                            <span class="text-slate-400 block text-[10px] uppercase font-bold">Jadwal Pendaftaran:</span>
                            <p class="font-bold text-slate-700 flex items-center gap-1">
                                <span class="material-symbols-outlined text-xs text-indigo-600">calendar_today</span>
                                <span>{{ $jadwalPT->periode_teks }}</span>
                            </p>
                        </div>
                        @endif

                        <ul class="text-xs text-slate-600 space-y-2 pt-2 border-t border-slate-100">
                            <li class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-emerald-600 text-base">check_circle</span>
                                <span>Karya berbasis riset & sains terapan</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-emerald-600 text-base">check_circle</span>
                                <span>Memiliki potensi hilirisasi industri</span>
                            </li>
                        </ul>
                    </div>

                    @if(!empty($lockedKategori) && $lockedKategori !== 'Perguruan Tinggi')
                    <button type="button" disabled class="w-full py-2.5 px-4 bg-slate-100 text-slate-400 font-bold text-xs rounded-xl text-center cursor-not-allowed flex items-center justify-center gap-1.5 border border-slate-200" title="Akun Anda terdaftar di kategori {{ $lockedKategori }}">
                        <span class="material-symbols-outlined text-sm">lock</span>
                        <span>Akun Terdaftar di {{ $lockedKategori }}</span>
                    </button>
                    @elseif($isPTBuka)
                    <a href="{{ route('lomba.daftar') }}?kategori=Perguruan Tinggi" class="w-full py-2.5 px-4 bg-indigo-100 hover:bg-indigo-600 text-indigo-700 hover:text-white font-bold text-xs rounded-xl text-center transition-colors block">
                        {{ !empty($lockedKategori) && $lockedKategori === 'Perguruan Tinggi' ? '+ Daftarkan Karya Baru →' : 'Daftar Kategori Ini →' }}
                    </a>
                    @else
                    <button type="button" disabled class="w-full py-2.5 px-4 bg-slate-100 text-slate-400 font-bold text-xs rounded-xl text-center cursor-not-allowed flex items-center justify-center gap-1.5 border border-slate-200">
                        <span class="material-symbols-outlined text-sm">lock</span>
                        <span>Pendaftaran Ditutup</span>
                    </button>
                    @endif
                </div>

                <!-- Kategori 3: Umum -->
                <div class="relative bg-gradient-to-b from-amber-50/60 to-white p-7 rounded-2xl border border-amber-100 shadow-sm hover:shadow-md transition-all space-y-5 flex flex-col justify-between">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="w-14 h-14 rounded-2xl bg-amber-500 text-white flex items-center justify-center shadow-md shadow-amber-500/20">
                                <span class="material-symbols-outlined text-3xl">groups</span>
                            </div>
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 text-[11px] font-bold rounded-xl border {{ $isUmumBuka ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : 'bg-rose-50 text-rose-700 border-rose-200' }}">
                                <span class="material-symbols-outlined text-sm">{{ $isUmumBuka ? 'lock_open' : 'lock' }}</span>
                                <span>{{ $isUmumBuka ? 'Dibuka' : 'Ditutup' }}</span>
                            </span>
                        </div>
                        <div class="space-y-1.5">
                            <span class="text-[11px] font-extrabold text-amber-600 uppercase tracking-wider">Kategori 03</span>
                            <h3 class="text-xl font-extrabold text-slate-900">Masyarakat Umum</h3>
                            <p class="text-xs text-slate-600 leading-relaxed">
                                Untuk praktisi, bengkel inovasi, pegiat UMKM, komunitas rekayasa, dan masyarakat luas yang menghasilkan alat tepat guna solutif.
                            </p>
                        </div>

                        <!-- Jadwal Pelaksanaan -->
                        @if($jadwalUmum)
                        <div class="p-2.5 bg-slate-50 rounded-xl border border-slate-100 text-[11px] space-y-1">
                            <span class="text-slate-400 block text-[10px] uppercase font-bold">Jadwal Pendaftaran:</span>
                            <p class="font-bold text-slate-700 flex items-center gap-1">
                                <span class="material-symbols-outlined text-xs text-amber-600">calendar_today</span>
                                <span>{{ $jadwalUmum->periode_teks }}</span>
                            </p>
                        </div>
                        @endif

                        <ul class="text-xs text-slate-600 space-y-2 pt-2 border-t border-slate-100">
                            <li class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-emerald-600 text-base">check_circle</span>
                                <span>Alat siap pakai di masyarakat/UMKM</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-emerald-600 text-base">check_circle</span>
                                <span>Bahan baku lokal & hemat energi</span>
                            </li>
                        </ul>
                    </div>

                    @if(!empty($lockedKategori) && $lockedKategori !== 'Umum')
                    <button type="button" disabled class="w-full py-2.5 px-4 bg-slate-100 text-slate-400 font-bold text-xs rounded-xl text-center cursor-not-allowed flex items-center justify-center gap-1.5 border border-slate-200" title="Akun Anda terdaftar di kategori {{ $lockedKategori }}">
                        <span class="material-symbols-outlined text-sm">lock</span>
                        <span>Akun Terdaftar di {{ $lockedKategori }}</span>
                    </button>
                    @elseif($isUmumBuka)
                    <a href="{{ route('lomba.daftar') }}?kategori=Umum" class="w-full py-2.5 px-4 bg-amber-100 hover:bg-amber-600 text-amber-700 hover:text-white font-bold text-xs rounded-xl text-center transition-colors block">
                        {{ !empty($lockedKategori) && $lockedKategori === 'Umum' ? '+ Daftarkan Karya Baru →' : 'Daftar Kategori Ini →' }}
                    </a>
                    @else
                    <button type="button" disabled class="w-full py-2.5 px-4 bg-slate-100 text-slate-400 font-bold text-xs rounded-xl text-center cursor-not-allowed flex items-center justify-center gap-1.5 border border-slate-200">
                        <span class="material-symbols-outlined text-sm">lock</span>
                        <span>Pendaftaran Ditutup</span>
                    </button>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION: ALUR PENDAFTARAN & PERSYARATAN -->
    <section class="py-16 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
            <div class="text-center space-y-3 max-w-2xl mx-auto">
                <span class="text-xs font-black uppercase tracking-wider text-[#00A3E0]">Tahapan Partisipasi</span>
                <h2 class="text-2xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                    Alur Pendaftaran Lomba TTG
                </h2>
                <p class="text-sm text-slate-500">
                    Empat langkah mudah untuk mendaftarkan alat inovasi teknologi tepat guna Anda.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Step 1 -->
                <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm relative space-y-3">
                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-[#00A3E0] text-white font-black text-sm">1</span>
                    <h3 class="text-base font-bold text-slate-900">Buat Akun Peserta</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Lakukan registrasi akun menggunakan email aktif, nomor WhatsApp, dan asal instansi/sekolah Anda.
                    </p>
                </div>

                <!-- Step 2 -->
                <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm relative space-y-3">
                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-[#00A3E0] text-white font-black text-sm">2</span>
                    <h3 class="text-base font-bold text-slate-900">Isi Data Alat TTG</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Lengkapi nama alat, estimasi biaya pembuatan, harga jual, fungsi alat, spesifikasi teknis, dan bahan.
                    </p>
                </div>

                <!-- Step 3 -->
                <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm relative space-y-3">
                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-[#00A3E0] text-white font-black text-sm">3</span>
                    <h3 class="text-base font-bold text-slate-900">Tautan Proposal Google Drive</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Sertakan tautan Google Drive dokumen proposal karya dan unggah foto dokumentasi prototipe alat TTG.
                    </p>
                </div>

                <!-- Step 4 -->
                <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm relative space-y-3">
                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-emerald-600 text-white font-black text-sm">4</span>
                    <h3 class="text-base font-bold text-slate-900">Verifikasi & Penilaian</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Pantau status administrasi dan evaluasi dewan juri Bappelitbangda langsung dari dashboard status Anda.
                    </p>
                </div>
            </div>

            <!-- Box Info Kelengkapan Formulir -->
            <div class="bg-gradient-to-r from-sky-900 to-cyan-900 text-white p-8 rounded-2xl shadow-xl space-y-6">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 border-b border-white/15 pb-6">
                    <div class="space-y-1">
                        <span class="text-xs uppercase font-extrabold tracking-wider text-cyan-300">Persyaratan Berkas</span>
                        <h3 class="text-xl sm:text-2xl font-black text-white">Kelengkapan Isian Formulir Lomba</h3>
                        <p class="text-xs text-cyan-100/90">Unduh format proposal resmi dan pelajari seluruh pedoman ketentuan lomba.</p>
                    </div>
                    <div class="flex flex-col items-stretch gap-2.5 shrink-0 w-full sm:w-auto">
                        <!-- Tombol Link Google Drive: Template Proposal & Ketentuan Syarat -->
                        <a href="{{ $linkTemplateProposal ?? \App\Models\PengaturanLomba::getTemplateUrl() }}" 
                           target="_blank" 
                           rel="noopener noreferrer" 
                           class="w-full inline-flex items-center justify-center gap-2.5 px-5 py-3 bg-white text-[#00A3E0] hover:bg-cyan-50 font-black text-xs rounded-xl shadow-lg transition-all hover:scale-[1.02] active:scale-[0.98] text-center">
                            <svg class="w-4 h-4 shrink-0" viewBox="0 0 87.3 78" xmlns="http://www.w3.org/2000/svg">
                                <path d="m6.6 66.85 3.85 6.65c.8 1.4 1.95 2.5 3.3 3.3l13.75-23.8h-27.5c0 1.55.4 3.1 1.2 4.5z" fill="#0066da"/>
                                <path d="m43.65 25-13.75-23.8c-1.35.8-2.5 1.9-3.3 3.3l-25.4 44c-.8 1.4-1.2 2.95-1.2 4.5h27.5z" fill="#00ac47"/>
                                <path d="m73.55 76.8c1.35-.8 2.5-1.9 3.3-3.3l1.6-2.75 7.65-13.25c.8-1.4 1.2-2.95 1.2-4.5h-27.502l5.852 11.5z" fill="#ea4335"/>
                                <path d="m43.65 25 13.75-23.8c-1.35-.8-2.9-1.2-4.5-1.2h-18.5c-1.6 0-3.15.45-4.5 1.2z" fill="#00832d"/>
                                <path d="m59.8 53h-32.3l-13.75 23.8c1.35.8 2.9 1.2 4.5 1.2h50.8c1.6 0 3.15-.45 4.5-1.2z" fill="#2684fc"/>
                                <path d="m73.4 26.5-12.7-22c-.8-1.4-1.95-2.5-3.3-3.3l-13.75 23.8 16.15 28h27.45c0-1.55-.4-3.1-1.2-4.5z" fill="#ffba00"/>
                            </svg>
                            <span>Unduh Template & Ketentuan (Google Drive)</span>
                            <span class="material-symbols-outlined text-sm">open_in_new</span>
                        </a>

                        <!-- Tombol Buka Formulir Pendaftaran (Samakan Panjangnya) -->
                        <a href="{{ route('lomba.daftar') }}" class="w-full inline-flex items-center justify-center gap-2 px-5 py-3 bg-[#00A3E0] hover:bg-[#008cc0] text-white font-bold text-xs rounded-xl shadow-md transition-all hover:scale-[1.02] active:scale-[0.98] text-center">
                            <span class="material-symbols-outlined text-base">edit_document</span>
                            <span>Buka Formulir Pendaftaran</span>
                        </a>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 text-xs">
                    <div class="bg-white/10 p-4 rounded-xl border border-white/10 space-y-2 flex flex-col justify-between">
                        <div class="space-y-1">
                            <strong class="text-white block font-bold">1. Link Proposal (Google Drive)</strong>
                            <span class="text-cyan-100 block leading-relaxed">Tautan dokumen proposal dari Google Drive sesuai template resmi (pastikan akses link tidak di-private).</span>
                        </div>
                        <a href="{{ $linkTemplateProposal ?? \App\Models\PengaturanLomba::getTemplateUrl() }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1 text-[11px] font-bold text-cyan-200 hover:text-white underline pt-1">
                            <span>Unduh Template di Google Drive</span>
                            <span class="material-symbols-outlined text-xs">open_in_new</span>
                        </a>
                    </div>
                    <div class="bg-white/10 p-4 rounded-xl border border-white/10 space-y-1">
                        <strong class="text-white block font-bold">2. Nama & Inovator</strong>
                        <span class="text-cyan-100">Identitas ketua inovator, anggota tim, serta nama alat teknologi tepat guna.</span>
                    </div>
                    <div class="bg-white/10 p-4 rounded-xl border border-white/10 space-y-1">
                        <strong class="text-white block font-bold">3. Analisis Biaya</strong>
                        <span class="text-cyan-100">Biaya pembuatan alat dan estimasi harga jual yang realistis serta terjangkau.</span>
                    </div>
                    <div class="bg-white/10 p-4 rounded-xl border border-white/10 space-y-1">
                        <strong class="text-white block font-bold">4. Spesifikasi & Bahan</strong>
                        <span class="text-cyan-100">Deskripsi fungsi, dimensi, daya, komponen, serta keunggulan bahan baku yang digunakan.</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    @include('partials.footer')

    <!-- Mobile Navigation Toggle Script -->
    <script>
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
    </script>
</body>
</html>
