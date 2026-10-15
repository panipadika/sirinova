<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Formulir Pendaftaran Lomba Alat TTG - SI RINOVA</title>

    <!-- Favicon Logo Tasikmalaya -->
    <link rel="icon" type="image/png" href="{{ asset('storage/images/favicon_tasik.png') }}?v=3">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=3">
    <link rel="apple-touch-icon" href="{{ asset('storage/images/favicon_tasik.png') }}?v=3">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>

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
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased selection:bg-[#00A3E0] selection:text-white pb-16 overflow-x-hidden">

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
            @endif
        </div>
    </header>

    <!-- MAIN FORM CONTAINER -->
    <main class="max-w-4xl mx-auto px-4 sm:px-6 pt-8 space-y-6">

        <!-- Banner Header Form -->
        <div class="bg-gradient-to-r from-[#00A3E0] to-[#0369a1] text-white p-6 sm:p-8 rounded-3xl shadow-lg shadow-sky-500/15 relative overflow-hidden">
            <div class="absolute -right-8 -bottom-8 w-48 h-48 bg-white/10 rounded-full blur-2xl pointer-events-none"></div>
            
            <div class="relative z-10 space-y-2">
                <div class="inline-flex items-center gap-1.5 px-3 py-1 bg-white/20 rounded-full text-[11px] font-bold text-cyan-100 backdrop-blur-sm">
                    <span class="material-symbols-outlined text-sm">assignment</span>
                    <span>Formulir Pengajuan Inovasi TTG</span>
                </div>
                <h2 class="text-2xl sm:text-3xl font-black text-white">
                    Pendaftaran Karya Lomba TTG
                </h2>
                <p class="text-xs sm:text-sm text-cyan-50/90 leading-relaxed max-w-2xl">
                    Silakan isi seluruh data karya inovasi teknologi tepat guna dan unggah berkas proposal Anda. Pastikan data yang dimasukkan akurat dan dapat dipertanggungjawabkan.
                </p>

                <!-- Status User Login -->
                <div class="pt-2 flex items-center gap-2 text-xs text-white/90">
                    <span class="material-symbols-outlined text-sm text-cyan-200">account_circle</span>
                    <span>Terdaftar sebagai: <strong class="text-white">{{ $user->name }}</strong> ({{ $user->email }})</span>
                </div>
            </div>
        </div>

        @if(session('login_success') || (session('success') && !session('pendaftaran_berhasil')))
        <div class="p-3.5 bg-emerald-50 rounded-2xl border border-emerald-200 flex items-center gap-2.5 text-xs font-bold text-emerald-800">
            <span class="material-symbols-outlined text-emerald-600 text-lg shrink-0">check_circle</span>
            <span>{{ session('login_success') ?? session('success') }}</span>
        </div>
        @endif



        @if(isset($errors) && $errors->any())
        <div class="p-4 bg-rose-50 rounded-2xl border border-rose-200 space-y-1.5">
            <div class="flex items-center gap-2 text-rose-800 font-bold text-xs sm:text-sm">
                <span class="material-symbols-outlined text-rose-600">error</span>
                <span>Mohon periksa kembali isian formulir:</span>
            </div>
            <ul class="list-disc list-inside text-xs text-rose-700 pl-1 space-y-0.5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- FORMULIR PENDAFTARAN -->
        <form action="{{ route('lomba.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8" id="form-pendaftaran">
            @csrf

            <!-- SECTION 1: PILIHAN 3 KATEGORI LOMBA -->
            <div class="bg-white p-6 sm:p-8 rounded-3xl border border-slate-200 shadow-sm space-y-5">
                <div class="border-b border-slate-100 pb-4">
                    <div class="flex items-center gap-2 text-[#00A3E0]">
                        <span class="material-symbols-outlined text-xl">category</span>
                        <h3 class="text-base sm:text-lg font-extrabold text-slate-900">1. Kategori Peserta Lomba</h3>
                    </div>
                    <p class="text-xs text-slate-500 mt-0.5">
                        @if(!empty($lockedKategori))
                            Akun Anda terdaftar pada kategori <strong>{{ $lockedKategori }}</strong>. Anda dapat mendaftarkan karya inovasi baru pada kategori ini.
                        @else
                            Pilih salah satu dari 3 kategori peserta yang sesuai dengan identitas inovator/tim Anda. (Akun akan terkunci pada kategori yang pertama kali dipilih).
                        @endif
                    </p>
                </div>

                @php
                    $jadwalSMA = $jadwalKategori->get('SMA/SMK Sederajat');
                    $isSMABuka = $jadwalSMA ? $jadwalSMA->isPendaftaranDibuka() : true;

                    $jadwalPT = $jadwalKategori->get('Perguruan Tinggi');
                    $isPTBuka = $jadwalPT ? $jadwalPT->isPendaftaranDibuka() : true;

                    $jadwalUmum = $jadwalKategori->get('Umum');
                    $isUmumBuka = $jadwalUmum ? $jadwalUmum->isPendaftaranDibuka() : true;

                    $hasLockedKategori = !empty($lockedKategori);

                    $karyaSMA = isset($userRegistrations) ? $userRegistrations->where('kategori_peserta', 'SMA/SMK Sederajat') : collect();
                    $karyaPT = isset($userRegistrations) ? $userRegistrations->where('kategori_peserta', 'Perguruan Tinggi') : collect();
                    $karyaUmum = isset($userRegistrations) ? $userRegistrations->where('kategori_peserta', 'Umum') : collect();

                    $countSMA = $karyaSMA->count();
                    $countPT = $karyaPT->count();
                    $countUmum = $karyaUmum->count();

                    $isSMAAvailable = $isSMABuka && (!$hasLockedKategori || $lockedKategori === 'SMA/SMK Sederajat');
                    $isPTAvailable = $isPTBuka && (!$hasLockedKategori || $lockedKategori === 'Perguruan Tinggi');
                    $isUmumAvailable = $isUmumBuka && (!$hasLockedKategori || $lockedKategori === 'Umum');

                    if ($hasLockedKategori) {
                        $selectedKategori = $lockedKategori;
                    } else {
                        $preferred = old('kategori_peserta', request('kategori'));
                        $isPreferredAvailable = match($preferred) {
                            'SMA/SMK Sederajat' => $isSMAAvailable,
                            'Perguruan Tinggi' => $isPTAvailable,
                            'Umum' => $isUmumAvailable,
                            default => false,
                        };
                        if ($isPreferredAvailable) {
                            $selectedKategori = $preferred;
                        } elseif ($isSMAAvailable) {
                            $selectedKategori = 'SMA/SMK Sederajat';
                        } elseif ($isPTAvailable) {
                            $selectedKategori = 'Perguruan Tinggi';
                        } elseif ($isUmumAvailable) {
                            $selectedKategori = 'Umum';
                        } else {
                            $selectedKategori = null;
                        }
                    }

                    $semuaTutup = !$isSMABuka && !$isPTBuka && !$isUmumBuka;
                    $lockedKategoriTutup = $hasLockedKategori && (
                        ($lockedKategori === 'SMA/SMK Sederajat' && !$isSMABuka) ||
                        ($lockedKategori === 'Perguruan Tinggi' && !$isPTBuka) ||
                        ($lockedKategori === 'Umum' && !$isUmumBuka)
                    );
                @endphp

                @if($hasLockedKategori)
                <div class="p-4 bg-sky-50 rounded-2xl border border-sky-200 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 text-sky-900">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-2xl text-[#00A3E0] shrink-0">verified</span>
                        <div class="text-xs">
                            <strong class="font-extrabold block text-sm">Akun Terdaftar di Kategori {{ $lockedKategori }}</strong>
                            <span>Satu akun hanya diperbolehkan mendaftar pada 1 kategori dan tidak dapat mendaftar di kategori lain.@if($totalKaryaUser > 0) Anda dapat mendaftarkan <strong>lebih dari 1 karya</strong> pada kategori ini (Saat ini: <strong>{{ $totalKaryaUser }} karya terdaftar</strong>).@else Silakan daftarkan karya inovasi TTG Anda pada kategori ini.@endif</span>
                        </div>
                    </div>
                    @if($totalKaryaUser > 0)
                    <a href="{{ route('lomba.status') }}" class="px-3.5 py-2 bg-white border border-sky-200 text-[#00A3E0] hover:bg-sky-100 text-xs font-bold rounded-xl shrink-0 transition-colors flex items-center gap-1.5 shadow-2xs whitespace-nowrap">
                        <span class="material-symbols-outlined text-sm">inventory_2</span>
                        <span>Lihat Karya Saya ({{ $totalKaryaUser }})</span>
                    </a>
                    @endif
                </div>
                @elseif($semuaTutup)
                <div class="p-4 bg-rose-50 rounded-2xl border border-rose-200 flex items-center gap-3 text-rose-800">
                    <span class="material-symbols-outlined text-2xl text-rose-600 shrink-0">lock</span>
                    <div class="text-xs">
                        <strong class="font-extrabold block text-sm">Pendaftaran Seluruh Kategori Sedang Ditutup</strong>
                        <span>Panitia mengunci pendaftaran karya lomba TTG untuk saat ini. Silakan pantau pengumuman jadwal berikutnya.</span>
                    </div>
                </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Kategori SMA/SMK -->
                    @if($hasLockedKategori && $lockedKategori !== 'SMA/SMK Sederajat')
                    <div class="relative flex flex-col p-5 border-2 border-dashed border-slate-200 rounded-2xl bg-slate-50/70 opacity-60 cursor-not-allowed select-none space-y-2">
                        <div class="flex items-center justify-between mb-1">
                            <span class="w-10 h-10 rounded-xl bg-slate-200 text-slate-500 flex items-center justify-center material-symbols-outlined text-xl">school</span>
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md text-[10px] font-bold bg-slate-200 text-slate-600">
                                <span class="material-symbols-outlined text-xs">lock</span> Terkunci
                            </span>
                        </div>
                        <strong class="text-sm font-extrabold text-slate-700 block">SMA / SMK Sederajat</strong>
                        <span class="text-xs text-slate-500 font-medium">Akun Anda terdaftar di kategori <strong>{{ $lockedKategori }}</strong>. Tidak dapat mendaftar di kategori lain.</span>
                    </div>
                    @elseif($lockedKategori === 'SMA/SMK Sederajat')
                        @if($isSMABuka)
                        <label class="relative flex flex-col p-5 border-2 border-[#00A3E0] bg-sky-50/50 rounded-2xl cursor-pointer transition-all shadow-xs group">
                            <input type="radio" name="kategori_peserta" value="SMA/SMK Sederajat" class="sr-only" checked required>
                            <div class="flex items-center justify-between mb-3">
                                <span class="w-10 h-10 rounded-xl bg-sky-100 text-[#00A3E0] flex items-center justify-center material-symbols-outlined text-xl">school</span>
                                <div class="flex items-center gap-1.5">
                                    @if($countSMA > 0)
                                    <span class="text-[10px] font-bold text-sky-700 bg-sky-100 px-2 py-0.5 rounded-md border border-sky-200">{{ $countSMA }} Karya Terdaftar</span>
                                    @endif
                                    <span class="w-5 h-5 rounded-full border-2 border-[#00A3E0] bg-[#00A3E0] flex items-center justify-center">
                                        <span class="w-2 h-2 rounded-full bg-white"></span>
                                    </span>
                                </div>
                            </div>
                            <div class="space-y-1">
                                <div class="flex items-center justify-between">
                                    <strong class="text-sm font-extrabold text-slate-900 block">SMA / SMK Sederajat</strong>
                                    <span class="text-[10px] font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-md border border-emerald-200">Kategori Akun Anda</span>
                                </div>
                                <span class="text-xs text-slate-600 block">Pelajar SMA, SMK, atau MA aktif di Kota Tasikmalaya.</span>
                                <span class="text-[10px] font-bold text-[#00A3E0] block pt-1 border-t border-sky-100 flex items-center gap-1">
                                    <span class="material-symbols-outlined text-xs">check_circle</span> {{ $countSMA > 0 ? 'Mendaftarkan karya berikutnya' : 'Kategori akun Anda' }}
                                </span>
                            </div>
                        </label>
                        @else
                        <div class="relative flex flex-col p-5 border-2 border-dashed border-rose-200 rounded-2xl bg-rose-50/40 opacity-80 cursor-not-allowed select-none space-y-2">
                            <div class="flex items-center justify-between mb-1">
                                <span class="w-10 h-10 rounded-xl bg-rose-100 text-rose-600 flex items-center justify-center material-symbols-outlined text-xl">school</span>
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md text-[10px] font-bold bg-rose-100 text-rose-700">
                                    <span class="material-symbols-outlined text-xs">lock</span> Ditutup
                                </span>
                            </div>
                            <strong class="text-sm font-extrabold text-slate-700 block">SMA / SMK Sederajat</strong>
                            <span class="text-xs text-rose-600 font-medium">{{ $jadwalSMA ? $jadwalSMA->status_label : 'Pendaftaran Ditutup' }}</span>
                        </div>
                        @endif
                    @elseif($isSMABuka)
                    <label class="relative flex flex-col p-5 border-2 rounded-2xl cursor-pointer transition-all hover:border-[#00A3E0] has-[:checked]:border-[#00A3E0] has-[:checked]:bg-sky-50/50 border-slate-200 group">
                        <input type="radio" name="kategori_peserta" value="SMA/SMK Sederajat" class="sr-only" {{ $selectedKategori === 'SMA/SMK Sederajat' ? 'checked' : '' }} required>
                        <div class="flex items-center justify-between mb-3">
                            <span class="w-10 h-10 rounded-xl bg-sky-100 text-[#00A3E0] flex items-center justify-center material-symbols-outlined text-xl">school</span>
                            <span class="w-5 h-5 rounded-full border-2 border-slate-300 group-has-[:checked]:border-[#00A3E0] group-has-[:checked]:bg-[#00A3E0] flex items-center justify-center transition-all">
                                <span class="w-2 h-2 rounded-full bg-white opacity-0 group-has-[:checked]:opacity-100"></span>
                            </span>
                        </div>
                        <div class="space-y-1">
                            <div class="flex items-center justify-between">
                                <strong class="text-sm font-extrabold text-slate-900 block">SMA / SMK Sederajat</strong>
                                <span class="text-[10px] font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-md border border-emerald-200">Buka</span>
                            </div>
                            <span class="text-xs text-slate-500 block">Pelajar SMA, SMK, atau MA aktif di Kota Tasikmalaya.</span>
                            @if($jadwalSMA && ($jadwalSMA->tanggal_buka || $jadwalSMA->tanggal_tutup))
                            <span class="text-[10px] font-semibold text-slate-400 block pt-1 border-t border-slate-100">{{ $jadwalSMA->periode_teks }}</span>
                            @endif
                        </div>
                    </label>
                    @else
                    <div class="relative flex flex-col p-5 border-2 border-dashed border-rose-200 rounded-2xl bg-rose-50/40 opacity-70 cursor-not-allowed select-none space-y-2">
                        <div class="flex items-center justify-between mb-1">
                            <span class="w-10 h-10 rounded-xl bg-rose-100 text-rose-600 flex items-center justify-center material-symbols-outlined text-xl">school</span>
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md text-[10px] font-bold bg-rose-100 text-rose-700">
                                <span class="material-symbols-outlined text-xs">lock</span> Ditutup
                            </span>
                        </div>
                        <strong class="text-sm font-extrabold text-slate-700 block">SMA / SMK Sederajat</strong>
                        <span class="text-xs text-rose-600 font-medium">{{ $jadwalSMA ? $jadwalSMA->status_label : 'Pendaftaran Ditutup' }}</span>
                    </div>
                    @endif

                    <!-- Kategori Perguruan Tinggi -->
                    @if($hasLockedKategori && $lockedKategori !== 'Perguruan Tinggi')
                    <div class="relative flex flex-col p-5 border-2 border-dashed border-slate-200 rounded-2xl bg-slate-50/70 opacity-60 cursor-not-allowed select-none space-y-2">
                        <div class="flex items-center justify-between mb-1">
                            <span class="w-10 h-10 rounded-xl bg-slate-200 text-slate-500 flex items-center justify-center material-symbols-outlined text-xl">account_balance</span>
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md text-[10px] font-bold bg-slate-200 text-slate-600">
                                <span class="material-symbols-outlined text-xs">lock</span> Terkunci
                            </span>
                        </div>
                        <strong class="text-sm font-extrabold text-slate-700 block">Perguruan Tinggi</strong>
                        <span class="text-xs text-slate-500 font-medium">Akun Anda terdaftar di kategori <strong>{{ $lockedKategori }}</strong>. Tidak dapat mendaftar di kategori lain.</span>
                    </div>
                    @elseif($lockedKategori === 'Perguruan Tinggi')
                        @if($isPTBuka)
                        <label class="relative flex flex-col p-5 border-2 border-indigo-600 bg-indigo-50/50 rounded-2xl cursor-pointer transition-all shadow-xs group">
                            <input type="radio" name="kategori_peserta" value="Perguruan Tinggi" class="sr-only" checked required>
                            <div class="flex items-center justify-between mb-3">
                                <span class="w-10 h-10 rounded-xl bg-indigo-100 text-indigo-600 flex items-center justify-center material-symbols-outlined text-xl">account_balance</span>
                                <div class="flex items-center gap-1.5">
                                    @if($countPT > 0)
                                    <span class="text-[10px] font-bold text-indigo-700 bg-indigo-100 px-2 py-0.5 rounded-md border border-indigo-200">{{ $countPT }} Karya Terdaftar</span>
                                    @endif
                                    <span class="w-5 h-5 rounded-full border-2 border-indigo-600 bg-indigo-600 flex items-center justify-center">
                                        <span class="w-2 h-2 rounded-full bg-white"></span>
                                    </span>
                                </div>
                            </div>
                            <div class="space-y-1">
                                <div class="flex items-center justify-between">
                                    <strong class="text-sm font-extrabold text-slate-900 block">Perguruan Tinggi</strong>
                                    <span class="text-[10px] font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-md border border-emerald-200">Kategori Akun Anda</span>
                                </div>
                                <span class="text-xs text-slate-600 block">Mahasiswa Diploma / Sarjana perguruan tinggi.</span>
                                <span class="text-[10px] font-bold text-indigo-600 block pt-1 border-t border-indigo-100 flex items-center gap-1">
                                    <span class="material-symbols-outlined text-xs">check_circle</span> {{ $countPT > 0 ? 'Mendaftarkan karya berikutnya' : 'Kategori akun Anda' }}
                                </span>
                            </div>
                        </label>
                        @else
                        <div class="relative flex flex-col p-5 border-2 border-dashed border-rose-200 rounded-2xl bg-rose-50/40 opacity-80 cursor-not-allowed select-none space-y-2">
                            <div class="flex items-center justify-between mb-1">
                                <span class="w-10 h-10 rounded-xl bg-rose-100 text-rose-600 flex items-center justify-center material-symbols-outlined text-xl">account_balance</span>
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md text-[10px] font-bold bg-rose-100 text-rose-700">
                                    <span class="material-symbols-outlined text-xs">lock</span> Ditutup
                                </span>
                            </div>
                            <strong class="text-sm font-extrabold text-slate-700 block">Perguruan Tinggi</strong>
                            <span class="text-xs text-rose-600 font-medium">{{ $jadwalPT ? $jadwalPT->status_label : 'Pendaftaran Ditutup' }}</span>
                        </div>
                        @endif
                    @elseif($isPTBuka)
                    <label class="relative flex flex-col p-5 border-2 rounded-2xl cursor-pointer transition-all hover:border-indigo-600 has-[:checked]:border-indigo-600 has-[:checked]:bg-indigo-50/50 border-slate-200 group">
                        <input type="radio" name="kategori_peserta" value="Perguruan Tinggi" class="sr-only" {{ $selectedKategori === 'Perguruan Tinggi' ? 'checked' : '' }}>
                        <div class="flex items-center justify-between mb-3">
                            <span class="w-10 h-10 rounded-xl bg-indigo-100 text-indigo-600 flex items-center justify-center material-symbols-outlined text-xl">account_balance</span>
                            <span class="w-5 h-5 rounded-full border-2 border-slate-300 group-has-[:checked]:border-indigo-600 group-has-[:checked]:bg-indigo-600 flex items-center justify-center transition-all">
                                <span class="w-2 h-2 rounded-full bg-white opacity-0 group-has-[:checked]:opacity-100"></span>
                            </span>
                        </div>
                        <div class="space-y-1">
                            <div class="flex items-center justify-between">
                                <strong class="text-sm font-extrabold text-slate-900 block">Perguruan Tinggi</strong>
                                <span class="text-[10px] font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-md border border-emerald-200">Buka</span>
                            </div>
                            <span class="text-xs text-slate-500 block">Mahasiswa Diploma / Sarjana perguruan tinggi.</span>
                            @if($jadwalPT && ($jadwalPT->tanggal_buka || $jadwalPT->tanggal_tutup))
                            <span class="text-[10px] font-semibold text-slate-400 block pt-1 border-t border-slate-100">{{ $jadwalPT->periode_teks }}</span>
                            @endif
                        </div>
                    </label>
                    @else
                    <div class="relative flex flex-col p-5 border-2 border-dashed border-rose-200 rounded-2xl bg-rose-50/40 opacity-70 cursor-not-allowed select-none space-y-2">
                        <div class="flex items-center justify-between mb-1">
                            <span class="w-10 h-10 rounded-xl bg-rose-100 text-rose-600 flex items-center justify-center material-symbols-outlined text-xl">account_balance</span>
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md text-[10px] font-bold bg-rose-100 text-rose-700">
                                <span class="material-symbols-outlined text-xs">lock</span> Ditutup
                            </span>
                        </div>
                        <strong class="text-sm font-extrabold text-slate-700 block">Perguruan Tinggi</strong>
                        <span class="text-xs text-rose-600 font-medium">{{ $jadwalPT ? $jadwalPT->status_label : 'Pendaftaran Ditutup' }}</span>
                    </div>
                    @endif

                    <!-- Kategori Umum -->
                    @if($hasLockedKategori && $lockedKategori !== 'Umum')
                    <div class="relative flex flex-col p-5 border-2 border-dashed border-slate-200 rounded-2xl bg-slate-50/70 opacity-60 cursor-not-allowed select-none space-y-2">
                        <div class="flex items-center justify-between mb-1">
                            <span class="w-10 h-10 rounded-xl bg-slate-200 text-slate-500 flex items-center justify-center material-symbols-outlined text-xl">groups</span>
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md text-[10px] font-bold bg-slate-200 text-slate-600">
                                <span class="material-symbols-outlined text-xs">lock</span> Terkunci
                            </span>
                        </div>
                        <strong class="text-sm font-extrabold text-slate-700 block">Masyarakat Umum</strong>
                        <span class="text-xs text-slate-500 font-medium">Akun Anda terdaftar di kategori <strong>{{ $lockedKategori }}</strong>. Tidak dapat mendaftar di kategori lain.</span>
                    </div>
                    @elseif($lockedKategori === 'Umum')
                        @if($isUmumBuka)
                        <label class="relative flex flex-col p-5 border-2 border-amber-500 bg-amber-50/50 rounded-2xl cursor-pointer transition-all shadow-xs group">
                            <input type="radio" name="kategori_peserta" value="Umum" class="sr-only" checked required>
                            <div class="flex items-center justify-between mb-3">
                                <span class="w-10 h-10 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center material-symbols-outlined text-xl">groups</span>
                                <div class="flex items-center gap-1.5">
                                    @if($countUmum > 0)
                                    <span class="text-[10px] font-bold text-amber-700 bg-amber-100 px-2 py-0.5 rounded-md border border-amber-200">{{ $countUmum }} Karya Terdaftar</span>
                                    @endif
                                    <span class="w-5 h-5 rounded-full border-2 border-amber-500 bg-amber-500 flex items-center justify-center">
                                        <span class="w-2 h-2 rounded-full bg-white"></span>
                                    </span>
                                </div>
                            </div>
                            <div class="space-y-1">
                                <div class="flex items-center justify-between">
                                    <strong class="text-sm font-extrabold text-slate-900 block">Masyarakat Umum</strong>
                                    <span class="text-[10px] font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-md border border-emerald-200">Kategori Akun Anda</span>
                                </div>
                                <span class="text-xs text-slate-600 block">Praktisi, pegiat UMKM, inovator mandiri, & komunitas.</span>
                                <span class="text-[10px] font-bold text-amber-600 block pt-1 border-t border-amber-100 flex items-center gap-1">
                                    <span class="material-symbols-outlined text-xs">check_circle</span> {{ $countUmum > 0 ? 'Mendaftarkan karya berikutnya' : 'Kategori akun Anda' }}
                                </span>
                            </div>
                        </label>
                        @else
                        <div class="relative flex flex-col p-5 border-2 border-dashed border-rose-200 rounded-2xl bg-rose-50/40 opacity-80 cursor-not-allowed select-none space-y-2">
                            <div class="flex items-center justify-between mb-1">
                                <span class="w-10 h-10 rounded-xl bg-rose-100 text-rose-600 flex items-center justify-center material-symbols-outlined text-xl">groups</span>
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md text-[10px] font-bold bg-rose-100 text-rose-700">
                                    <span class="material-symbols-outlined text-xs">lock</span> Ditutup
                                </span>
                            </div>
                            <strong class="text-sm font-extrabold text-slate-700 block">Masyarakat Umum</strong>
                            <span class="text-xs text-rose-600 font-medium">{{ $jadwalUmum ? $jadwalUmum->status_label : 'Pendaftaran Ditutup' }}</span>
                        </div>
                        @endif
                    @elseif($isUmumBuka)
                    <label class="relative flex flex-col p-5 border-2 rounded-2xl cursor-pointer transition-all hover:border-amber-500 has-[:checked]:border-amber-500 has-[:checked]:bg-amber-50/50 border-slate-200 group">
                        <input type="radio" name="kategori_peserta" value="Umum" class="sr-only" {{ $selectedKategori === 'Umum' ? 'checked' : '' }}>
                        <div class="flex items-center justify-between mb-3">
                            <span class="w-10 h-10 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center material-symbols-outlined text-xl">groups</span>
                            <span class="w-5 h-5 rounded-full border-2 border-slate-300 group-has-[:checked]:border-amber-500 group-has-[:checked]:bg-amber-500 flex items-center justify-center transition-all">
                                <span class="w-2 h-2 rounded-full bg-white opacity-0 group-has-[:checked]:opacity-100"></span>
                            </span>
                        </div>
                        <div class="space-y-1">
                            <div class="flex items-center justify-between">
                                <strong class="text-sm font-extrabold text-slate-900 block">Masyarakat Umum</strong>
                                <span class="text-[10px] font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-md border border-emerald-200">Buka</span>
                            </div>
                            <span class="text-xs text-slate-500 block">Praktisi, pegiat UMKM, inovator mandiri, & komunitas.</span>
                            @if($jadwalUmum && ($jadwalUmum->tanggal_buka || $jadwalUmum->tanggal_tutup))
                            <span class="text-[10px] font-semibold text-slate-400 block pt-1 border-t border-slate-100">{{ $jadwalUmum->periode_teks }}</span>
                            @endif
                        </div>
                    </label>
                    @else
                    <div class="relative flex flex-col p-5 border-2 border-dashed border-rose-200 rounded-2xl bg-rose-50/40 opacity-70 cursor-not-allowed select-none space-y-2">
                        <div class="flex items-center justify-between mb-1">
                            <span class="w-10 h-10 rounded-xl bg-rose-100 text-rose-600 flex items-center justify-center material-symbols-outlined text-xl">groups</span>
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md text-[10px] font-bold bg-rose-100 text-rose-700">
                                <span class="material-symbols-outlined text-xs">lock</span> Ditutup
                            </span>
                        </div>
                        <strong class="text-sm font-extrabold text-slate-700 block">Masyarakat Umum</strong>
                        <span class="text-xs text-rose-600 font-medium">{{ $jadwalUmum ? $jadwalUmum->status_label : 'Pendaftaran Ditutup' }}</span>
                    </div>
                    @endif
                </div>
            </div>

            <!-- SECTION 2: DATA INOVATOR & ASAL INSTANSI -->
            <div class="bg-white p-6 sm:p-8 rounded-3xl border border-slate-200 shadow-sm space-y-5">
                <div class="border-b border-slate-100 pb-4">
                    <div class="flex items-center gap-2 text-[#00A3E0]">
                        <span class="material-symbols-outlined text-xl">badge</span>
                        <h3 class="text-base sm:text-lg font-extrabold text-slate-900">2. Data Inovator & Asal Instansi</h3>
                    </div>
                    <p class="text-xs text-slate-500 mt-0.5">Identitas ketua tim, anggota, dan lembaga yang diwakili.</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <!-- Nama Inovator / Ketua -->
                    <div class="space-y-1.5 sm:col-span-2">
                        <label for="nama_inovator" class="block text-xs font-bold text-slate-700">
                            Nama Inovator / Ketua Tim <span class="text-rose-500"></span>
                        </label>
                        <input type="text" name="nama_inovator" id="nama_inovator" 
                               value="{{ old('nama_inovator', $user->name) }}" 
                               placeholder="Nama lengkap ketua tim / inovator" 
                               class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#00A3E0] outline-none" required>
                    </div>

                    <!-- Nama Anggota Tim -->
                    <div class="space-y-1.5 sm:col-span-2">
                        <label for="nama_anggota" class="block text-xs font-bold text-slate-700">
                            Nama Anggota Tim 
                        </label>
                        <textarea name="nama_anggota" id="nama_anggota" rows="2" 
                                  placeholder="Contoh: 1. Ahmad Fauzi (Anggota 1), 2. Siti Rahma (Anggota 2) — Kosongkan jika individu" 
                                  class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#00A3E0] outline-none resize-none">{{ old('nama_anggota') }}</textarea>
                    </div>

                    <!-- Asal Instansi -->
                    <div class="space-y-1.5 sm:col-span-2">
                        <label for="asal_instansi" class="block text-xs font-bold text-slate-700">
                            Asal Sekolah / Kampus / Lembaga / Komunitas <span class="text-rose-500"></span>
                        </label>
                        <input type="text" name="asal_instansi" id="asal_instansi" 
                               value="{{ old('asal_instansi', $user->asal_instansi) }}" 
                               placeholder="Contoh: SMKN 1 Tasikmalaya / Universitas Siliwangi / Mandiri" 
                               class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#00A3E0] outline-none" required>
                    </div>

                    <!-- Nomor WhatsApp -->
                    <div class="space-y-1.5">
                        <label for="nomor_wa" class="block text-xs font-bold text-slate-700">
                            Nomor WhatsApp Aktif <span class="text-rose-500"></span>
                        </label>
                        <input type="text" name="nomor_wa" id="nomor_wa" 
                               value="{{ old('nomor_wa', $user->no_wa) }}" 
                               placeholder="Contoh: 08123456789" 
                               class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#00A3E0] outline-none" required>
                    </div>

                    <!-- Email -->
                    <div class="space-y-1.5">
                        <label for="email" class="block text-xs font-bold text-slate-700">
                            Alamat Email Aktif <span class="text-rose-500"></span>
                        </label>
                        <input type="email" name="email" id="email" 
                               value="{{ old('email', $user->email) }}" 
                               placeholder="nama@email.com" 
                               class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#00A3E0] outline-none" required>
                    </div>
                </div>
            </div>

            <!-- SECTION 3: RINCIAN ALAT TTG, BIAYA & SPESIFIKASI -->
            <div class="bg-white p-6 sm:p-8 rounded-3xl border border-slate-200 shadow-sm space-y-5">
                <div class="border-b border-slate-100 pb-4">
                    <div class="flex items-center gap-2 text-[#00A3E0]">
                        <span class="material-symbols-outlined text-xl">precision_manufacturing</span>
                        <h3 class="text-base sm:text-lg font-extrabold text-slate-900">3. Rincian Karya Inovasi Alat TTG</h3>
                    </div>
                    <p class="text-xs text-slate-500 mt-0.5">Spesifikasi teknis, fungsi, estimasi biaya pembuatan, dan harga jual produk.</p>
                </div>

                <div class="space-y-5">
                    <!-- Nama Alat -->
                    <div class="space-y-1.5">
                        <label for="nama_alat" class="block text-xs font-bold text-slate-700">
                            Nama Alat Teknologi Tepat Guna (TTG) <span class="text-rose-500"></span>
                        </label>
                        <input type="text" name="nama_alat" id="nama_alat" 
                               value="{{ old('nama_alat') }}" 
                               placeholder="Contoh: Mesin Pencacah Sampah Organik Otomatis Tenaga Surya" 
                               class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#00A3E0] outline-none" required>
                    </div>

                    <!-- Grid: Biaya Pembuatan & Estimasi Harga Jual -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <!-- Biaya Pembuatan -->
                        <div class="space-y-1.5">
                            <label for="biaya_pembuatan" class="block text-xs font-bold text-slate-700">
                                Biaya Pembuatan Alat (Rp) <span class="text-rose-500"></span>
                            </label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-xs font-bold text-slate-400">Rp</span>
                                <input type="number" name="biaya_pembuatan" id="biaya_pembuatan" 
                                       value="{{ old('biaya_pembuatan') }}" 
                                       placeholder="Contoh: 1500000" min="0" step="1000"
                                       class="w-full pl-10 pr-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#00A3E0] outline-none" required>
                            </div>
                            <span class="text-[11px] text-slate-400">Total biaya komponen / material perakitan.</span>
                        </div>

                        <!-- Estimasi Harga Jual -->
                        <div class="space-y-1.5">
                            <label for="estimasi_harga_jual" class="block text-xs font-bold text-slate-700">
                                Estimasi Harga Jual Pasar (Rp) <span class="text-rose-500"></span>
                            </label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-xs font-bold text-slate-400">Rp</span>
                                <input type="number" name="estimasi_harga_jual" id="estimasi_harga_jual" 
                                       value="{{ old('estimasi_harga_jual') }}" 
                                       placeholder="Contoh: 2200000" min="0" step="1000"
                                       class="w-full pl-10 pr-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#00A3E0] outline-none" required>
                            </div>
                            <span class="text-[11px] text-slate-400">Proyeksi harga jual wajar untuk masyarakat/UMKM.</span>
                        </div>
                    </div>

                    <!-- Fungsi Alat -->
                    <div class="space-y-1.5">
                        <label for="fungsi" class="block text-xs font-bold text-slate-700">
                            Fungsi & Manfaat Alat TTG <span class="text-rose-500"></span>
                        </label>
                        <textarea name="fungsi" id="fungsi" rows="4" 
                                  placeholder="Jelaskan kegunaan utama alat, bagaimana cara kerjanya, masalah apa yang diselesaikan di masyarakat, dan efisiensi yang dihasilkan..." 
                                  class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#00A3E0] outline-none resize-none" required>{{ old('fungsi') }}</textarea>
                    </div>

                    <!-- Spesifikasi Teknis & Bahan -->
                    <div class="space-y-1.5">
                        <label for="spesifikasi_bahan" class="block text-xs font-bold text-slate-700">
                            Spesifikasi Teknis & Bahan yang Digunakan <span class="text-rose-500"></span>
                        </label>
                        <textarea name="spesifikasi_bahan" id="spesifikasi_bahan" rows="4" 
                                  placeholder="Rincikan dimensi alat, kapasitas kerja per jam, sumber daya/energi (misal: listrik 200W, surya 100Wp), serta bahan baku pembuatan (besi hollow, stainless steel, komponen mikrokontroler, dll)..." 
                                  class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#00A3E0] outline-none resize-none" required>{{ old('spesifikasi_bahan') }}</textarea>
                    </div>

                    <!-- Link Video Demo -->
                    <div class="space-y-1.5">
                        <label for="link_video" class="block text-xs font-bold text-slate-700">
                            Tautan Video Demo / YouTube (Opsional)
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none material-symbols-outlined text-slate-400 text-xl">play_circle</span>
                            <input type="url" name="link_video" id="link_video" 
                                   value="{{ old('link_video') }}" 
                                   placeholder="https://www.youtube.com/watch?v=..." 
                                   class="w-full pl-11 pr-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#00A3E0] outline-none">
                        </div>
                    </div>
                </div>
            </div>

            <!-- SECTION 4: LINK PROPOSAL (GOOGLE DRIVE) & FOTO ALAT -->
            <div class="bg-white p-6 sm:p-8 rounded-3xl border border-slate-200 shadow-sm space-y-5">
                <div class="border-b border-slate-100 pb-4">
                    <div class="flex items-center gap-2 text-[#00A3E0]">
                        <span class="material-symbols-outlined text-xl">link</span>
                        <h3 class="text-base sm:text-lg font-extrabold text-slate-900">4. Tautan Proposal & Foto Dokumentasi Alat</h3>
                    </div>
                    <p class="text-xs text-slate-500 mt-0.5">Sertakan link Google Drive dokumen proposal karya dan unggah foto dokumentasi alat untuk kelengkapan administrasi serta penilaian dewan juri.</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 items-start">
                    <!-- Link Proposal (Google Drive) -->
                    <div class="space-y-2.5">
                        <div class="flex items-center justify-between flex-wrap gap-2">
                            <label for="file_proposal" class="block text-xs font-bold text-slate-700">
                                Link Proposal (Google Drive) <span class="text-rose-500">*</span>
                            </label>
                            <a href="{{ $linkTemplateProposal ?? \App\Models\PengaturanLomba::getTemplateUrl() }}" target="_blank" rel="noopener noreferrer" class="text-[11px] font-bold text-[#00A3E0] hover:underline inline-flex items-center gap-1">
                                <span class="material-symbols-outlined text-sm">download</span>
                                <span>Unduh Template Proposal</span>
                            </a>
                        </div>

                        <!-- Banner Peringatan Merah (Persis seperti Permintaan) -->
                        <div class="p-3 bg-[#c5221f] text-white rounded-xl text-xs font-bold flex items-center gap-2 shadow-xs">
                            <span class="material-symbols-outlined text-lg shrink-0">warning</span>
                            <span>Pastikan Link google drive anda tidak di private</span>
                        </div>

                        <!-- Input URL Link Google Drive -->
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <span class="material-symbols-outlined text-lg text-[#00A3E0]">link</span>
                            </span>
                            <input type="url" name="file_proposal" id="file_proposal" 
                                   value="{{ old('file_proposal') }}" 
                                   placeholder="https://drive.google.com/file/d/..." 
                                   class="w-full pl-10 pr-3.5 py-2.5 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#00A3E0] outline-none transition-all font-mono" 
                                   required>
                        </div>

                        <p class="text-[11px] text-slate-500 leading-relaxed bg-slate-50 p-2.5 rounded-xl border border-slate-200/80 flex items-start gap-1.5">
                            <span class="material-symbols-outlined text-sm text-[#00A3E0] shrink-0 mt-0.5">info</span>
                            <span>Unggah file proposal Anda ke Google Drive, ubah akses tautan menjadi <strong>"Siapa saja yang memiliki link" (Anyone with the link can view)</strong>, lalu tempelkan link-nya pada kolom di atas.</span>
                        </p>
                    </div>

                    <!-- Foto Alat TTG  -->
                    <div class="space-y-2.5">
                        <label class="block text-xs font-bold text-slate-700">
                            Foto Dokumentasi Alat TTG <span class="text-rose-500">*</span>
                        </label>
                        <div class="border-2 border-dashed border-slate-300 hover:border-[#00A3E0] rounded-2xl p-5 text-center transition-colors bg-slate-50/50 relative">
                            <div id="foto-preview-box" class="hidden mb-3">
                                <img id="foto-preview-img" src="" alt="Preview Foto" class="max-h-36 mx-auto rounded-xl object-contain border border-slate-200 shadow-sm">
                            </div>
                            <span id="foto-icon" class="material-symbols-outlined text-3xl text-[#00A3E0] mb-2 block">add_photo_alternate</span>
                            <p class="text-xs font-bold text-slate-700 mb-1">Pilih Foto Dokumentasi / Prototipe</p>
                            <p class="text-[11px] text-slate-400 mb-3">Format: JPG, PNG, WEBP (Maksimal 5 MB)</p>
                            <input type="file" name="foto_alat" id="foto_alat" accept="image/*" required 
                                   onchange="previewFotoAlat(this)"
                                   class="block w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-[#00A3E0] file:text-white hover:file:bg-[#008cc0] cursor-pointer">
                        </div>
                    </div>
                </div>
            </div>

            <!-- SUBMIT BUTTON & PERNYATAAN -->
            <div class="p-6 bg-slate-100 rounded-3xl border border-slate-200 space-y-4">
                <div class="flex items-start gap-3">
                    <input type="checkbox" id="setuju" required class="mt-1 h-4 w-4 rounded border-slate-300 text-[#00A3E0] focus:ring-[#00A3E0]">
                    <label for="setuju" class="text-xs text-slate-600 leading-relaxed cursor-pointer select-none">
                        Saya menyatakan bahwa karya inovasi teknologi tepat guna yang didaftarkan adalah karya asli tim kami, bebas dari plagiasi, dan bersedia mengikuti seluruh ketentuan perlombaan yang ditetapkan oleh Bappelitbangda Kota Tasikmalaya.
                    </label>
                </div>

                <div class="flex flex-col sm:flex-row items-center justify-between gap-3 pt-2 border-t border-slate-200">
                    <a href="{{ route('lomba.info') }}" class="text-xs font-bold text-slate-500 hover:text-slate-800 transition-colors">
                        Batal & Kembali
                    </a>
                    @if($semuaTutup || $lockedKategoriTutup)
                    <button type="button" disabled class="w-full sm:w-auto px-8 py-3.5 bg-slate-300 text-slate-500 font-extrabold text-sm rounded-xl transition-all flex items-center justify-center gap-2 cursor-not-allowed border border-slate-300 shadow-none">
                        <span class="material-symbols-outlined text-lg">block</span>
                        <span>{{ $lockedKategoriTutup ? 'Pendaftaran Kategori Anda Ditutup' : 'Pendaftaran Ditutup' }}</span>
                    </button>
                    @else
                    <button type="submit" id="btn-submit" class="w-full sm:w-auto px-8 py-3.5 bg-[#00A3E0] hover:bg-[#008cc0] active:scale-[0.99] text-white font-extrabold text-sm rounded-xl shadow-lg shadow-sky-500/20 transition-all flex items-center justify-center gap-2 cursor-pointer">
                        <span class="material-symbols-outlined text-lg">send</span>
                        <span>{{ $totalKaryaUser > 0 ? 'Kirim Pendaftaran Karya Baru' : 'Kirim Pendaftaran Lomba' }}</span>
                    </button>
                    @endif
                </div>
            </div>

        </form>

    </main>

    <!-- FOOTER -->
    @include('partials.footer')

    <script>
        document.getElementById('form-pendaftaran').addEventListener('submit', function() {
            const btn = document.getElementById('btn-submit');
            btn.disabled = true;
            btn.innerHTML = `<span class="material-symbols-outlined animate-spin text-lg">progress_activity</span> Mengunggah berkas...`;
        });

        function previewFotoAlat(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const previewBox = document.getElementById('foto-preview-box');
                    const previewImg = document.getElementById('foto-preview-img');
                    const fotoIcon = document.getElementById('foto-icon');
                    if (previewBox && previewImg) {
                        previewImg.src = e.target.result;
                        previewBox.classList.remove('hidden');
                        if (fotoIcon) fotoIcon.classList.add('hidden');
                    }
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Mobile Navigation Toggle Script
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

    @if(session('pendaftaran_berhasil'))
    @php
        $infoSukses = session('pendaftaran_berhasil');
    @endphp
    <!-- POPUP MODAL PENDAFTARAN BERHASIL (Placed at document root to guarantee 100% full-screen coverage with 0 offset) -->
    <div id="modal-pendaftaran-sukses-daftar" 
         onclick="closeSuccessModalDaftar()"
         class="fixed inset-0 top-0 left-0 right-0 bottom-0 m-0 z-[99999] flex items-center justify-center bg-slate-900/60 backdrop-blur-sm p-4 animate-in fade-in duration-200 cursor-pointer" 
         style="position: fixed; top: 0; left: 0; right: 0; bottom: 0; margin: 0; width: 100vw; height: 100vh;">
        <div onclick="event.stopPropagation()" 
             class="relative bg-white rounded-3xl shadow-2xl max-w-md w-full p-6 sm:p-8 text-center border border-slate-100 transform scale-100 transition-all cursor-default">
            
            <!-- Close Button (X) -->
            <button type="button" 
                    onclick="closeSuccessModalDaftar()" 
                    class="absolute top-4 right-4 w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-400 hover:text-slate-700 flex items-center justify-center transition-colors cursor-pointer" 
                    title="Tutup Pop-up">
                <span class="material-symbols-outlined text-base">close</span>
            </button>

            <!-- Success Animated Icon -->
            <div class="w-16 h-16 rounded-2xl bg-emerald-50 text-emerald-600 border border-emerald-200/60 flex items-center justify-center mx-auto mb-4 shadow-sm">
                <span class="material-symbols-outlined text-4xl">verified</span>
            </div>

            <!-- Title & Subtitle -->
            <h3 class="text-xl font-black text-slate-900 tracking-tight">Pendaftaran Berhasil Dikirim!</h3>
            <p class="text-xs text-slate-500 mt-1">Karya inovasi teknologi tepat guna Anda telah sukses diajukan ke panitia lomba Bappelitbangda.</p>

            <!-- Card Summary Info -->
            <div class="bg-slate-50/90 rounded-2xl p-4 my-5 border border-slate-200/70 text-left space-y-3">
                @if(isset($infoSukses['nomor_registrasi']))
                <div>
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Nomor Registrasi Resmi</span>
                    <div class="flex items-center justify-between gap-2 mt-0.5">
                        <span class="text-base font-black font-mono text-[#00A3E0]">{{ $infoSukses['nomor_registrasi'] }}</span>
                        <span class="px-2 py-0.5 bg-emerald-100 text-emerald-800 text-[10px] font-bold rounded-md">Tersimpan</span>
                    </div>
                </div>
                @endif

                @if(isset($infoSukses['nama_alat']))
                <div class="pt-2.5 border-t border-slate-200/60">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Nama Alat TTG</span>
                    <strong class="text-xs font-bold text-slate-800 block mt-0.5">{{ $infoSukses['nama_alat'] }}</strong>
                </div>
                @elseif($pesanSukses)
                <div class="pt-2.5 border-t border-slate-200/60">
                    <p class="text-xs font-semibold text-slate-700 leading-relaxed">{{ $pesanSukses }}</p>
                </div>
                @endif

                @if(!empty($infoSukses['foto_alat']))
                <div class="pt-2.5 border-t border-slate-200/60 flex items-center gap-3">
                    <img src="{{ asset('storage/' . $infoSukses['foto_alat']) }}" alt="Foto Alat" class="w-12 h-12 object-cover rounded-xl border border-slate-200 shrink-0 shadow-2xs">
                    <div class="min-w-0">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Foto Dokumentasi</span>
                        <span class="text-xs font-bold text-emerald-600 flex items-center gap-1 mt-0.5">
                            <span class="material-symbols-outlined text-sm">check_circle</span> Foto Wajib Terunggah
                        </span>
                    </div>
                </div>
                @endif
            </div>

            <!-- Footer Buttons -->
            <div class="space-y-2">
                <a href="{{ route('lomba.status') }}" 
                   class="w-full py-2.5 px-4 bg-[#00A3E0] hover:bg-[#008cc0] active:scale-[0.99] text-white font-bold text-xs rounded-xl shadow-md shadow-sky-500/20 transition-all flex items-center justify-center gap-2 cursor-pointer">
                    <span>Lihat Status Pendaftaran</span>
                    <span class="material-symbols-outlined text-base">arrow_forward</span>
                </a>
                <button type="button" onclick="closeSuccessModalDaftar()" 
                        class="w-full py-1.5 px-4 text-xs font-semibold text-slate-400 hover:text-slate-600 transition-colors cursor-pointer">
                    Tutup Pop-up
                </button>
            </div>
        </div>
    </div>

    <script>
        function closeSuccessModalDaftar() {
            const modal = document.getElementById('modal-pendaftaran-sukses-daftar');
            if (modal) {
                modal.classList.add('hidden');
                modal.style.display = 'none';
            }
        }

        // Close on ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeSuccessModalDaftar();
            }
        });
    </script>
    @endif
</body>
</html>
