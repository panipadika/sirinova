<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Status Pendaftaran Lomba TTG - SI RINOVA</title>

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

    <main class="max-w-6xl mx-auto px-4 sm:px-6 pt-8 space-y-6">

        <!-- Top Profile & Welcome Card -->
        <div class="bg-white p-6 sm:p-7 rounded-3xl border border-slate-200/80 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-[#00A3E0] to-cyan-400 text-white flex items-center justify-center font-black text-xl shadow-md shadow-sky-500/20">
                    {{ strtoupper(substr($user->name, 0, 2)) }}
                </div>
                <div class="space-y-0.5">
                    <span class="text-[11px] font-bold text-[#00A3E0] uppercase tracking-wider">Akun Peserta Lomba TTG</span>
                    <h2 class="text-xl font-black text-slate-900">{{ $user->name }}</h2>
                    <p class="text-xs text-slate-500 flex items-center gap-3 flex-wrap">
                        <span class="flex items-center gap-1"><span class="material-symbols-outlined text-sm">mail</span> {{ $user->email }}</span>
                        @if($user->no_wa)
                        <span class="flex items-center gap-1"><span class="material-symbols-outlined text-sm">call</span> {{ $user->no_wa }}</span>
                        @endif
                        @if($user->asal_instansi)
                        <span class="flex items-center gap-1"><span class="material-symbols-outlined text-sm">business</span> {{ $user->asal_instansi }}</span>
                        @endif
                    </p>
                </div>
            </div>

            <div class="flex items-center gap-2">
                <span class="px-3 py-1.5 bg-sky-50 text-[#00A3E0] border border-sky-100 rounded-xl text-xs font-bold">
                    {{ $pendaftaran->count() }} Karya Terdaftar
                </span>
            </div>
        </div>



        <!-- List Pendaftaran -->
        <div class="space-y-4">
            <div class="flex items-center justify-between flex-wrap gap-3">
                <h3 class="text-base sm:text-lg font-extrabold text-slate-900 flex items-center gap-2">
                    <span class="material-symbols-outlined text-[#00A3E0]">inventory</span>
                    <span>Daftar Karya Inovasi yang Diajukan</span>
                </h3>
                @if(!$pendaftaran->isEmpty())
                <a href="{{ route('lomba.daftar') }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-[#00A3E0] hover:bg-[#008cc0] text-white rounded-xl text-xs font-bold transition-all shadow-sm shadow-sky-500/20 active:scale-[0.99]">
                    <span class="material-symbols-outlined text-base">add_circle</span>
                    <span>Daftarkan Karya Baru</span>
                </a>
                @endif
            </div>

            @if($pendaftaran->isEmpty())
            <!-- Empty State -->
            <div class="bg-white rounded-3xl border border-slate-200 p-12 text-center space-y-4 shadow-sm">
                <div class="w-16 h-16 rounded-3xl bg-sky-50 text-[#00A3E0] flex items-center justify-center mx-auto">
                    <span class="material-symbols-outlined text-3xl">post_add</span>
                </div>
                <div class="space-y-1 max-w-sm mx-auto">
                    <h4 class="text-base font-extrabold text-slate-900">Belum Ada Karya yang Didaftarkan</h4>
                    <p class="text-xs text-slate-500">Anda belum mengirimkan formulir pendaftaran karya lomba teknologi tepat guna.</p>
                </div>
                <a href="{{ route('lomba.daftar') }}" class="inline-flex items-center gap-2 px-5 py-3 bg-[#00A3E0] hover:bg-[#008cc0] text-white font-bold text-xs rounded-xl shadow-md transition-all">
                    <span class="material-symbols-outlined text-base">add</span>
                    <span>Daftarkan Karya Sekarang</span>
                </a>
            </div>
            @else

            <!-- Grid Items -->
            <div class="space-y-4">
                @foreach($pendaftaran as $item)
                <div class="bg-white rounded-3xl border border-slate-200/90 p-6 sm:p-7 shadow-sm hover:shadow-md transition-all space-y-5">
                    
                    <!-- Header Item: Nomor Reg, Kategori & Status Badge -->
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-slate-100 pb-4">
                        <div class="flex items-center gap-2.5 flex-wrap">
                            <span class="px-3 py-1 bg-slate-900 text-white rounded-xl text-xs font-mono font-bold tracking-wider">
                                {{ $item->nomor_registrasi }}
                            </span>
                            <span class="px-3 py-1 bg-sky-100 text-[#00A3E0] rounded-xl text-xs font-bold">
                                {{ $item->kategori_peserta }}
                            </span>
                            <span class="text-xs text-slate-400">
                                Diajukan pada: {{ $item->dibuat_pada ? $item->dibuat_pada->translatedFormat('d F Y, H:i') : '-' }}
                            </span>
                        </div>

                        <!-- Status Badge -->
                        <div>
                            <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full text-xs font-extrabold border {{ $item->status_badge }}">
                                <span class="material-symbols-outlined text-base">{{ $item->status_icon }}</span>
                                <span>{{ $item->status }}</span>
                            </span>
                        </div>
                    </div>

                    <!-- Body: Judul & Rincian -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <!-- Main Info -->
                        <div class="lg:col-span-2 space-y-3">
                            <div>
                                <h4 class="text-lg sm:text-xl font-black text-slate-900 leading-snug">{{ $item->nama_alat }}</h4>
                                <p class="text-xs text-slate-500 mt-1">Inovator: <strong class="text-slate-700">{{ $item->nama_inovator }}</strong> &bull; Instansi: <strong class="text-slate-700">{{ $item->asal_instansi }}</strong></p>
                                @if($item->nama_anggota)
                                <p class="text-[11px] text-slate-400 mt-0.5">Anggota Tim: {{ $item->nama_anggota }}</p>
                                @endif
                            </div>

                            <!-- Ringkasan Fungsi & Spesifikasi -->
                            <div class="space-y-2 bg-slate-50 p-4 rounded-2xl text-xs border border-slate-100">
                                <div>
                                    <strong class="text-slate-700 block font-bold mb-0.5">Fungsi & Manfaat Alat:</strong>
                                    <p class="text-slate-600 line-clamp-2 leading-relaxed">{{ $item->fungsi }}</p>
                                </div>
                                <div class="pt-2 border-t border-slate-200/60">
                                    <strong class="text-slate-700 block font-bold mb-0.5">Spesifikasi & Bahan Baku:</strong>
                                    <p class="text-slate-600 line-clamp-2 leading-relaxed">{{ $item->spesifikasi_bahan }}</p>
                                </div>
                            </div>

                            @if($item->foto_alat)
                            <div class="flex items-center gap-3 bg-slate-50/60 p-2.5 rounded-2xl border border-slate-100">
                                <a href="{{ asset('storage/' . $item->foto_alat) }}" target="_blank" class="block group shrink-0">
                                    <img src="{{ asset('storage/' . $item->foto_alat) }}" alt="{{ $item->nama_alat }}" class="w-14 h-14 object-cover rounded-xl border border-slate-200 group-hover:scale-105 transition-transform shadow-xs">
                                </a>
                                <div class="text-xs min-w-0">
                                    <span class="text-slate-400 block text-[11px] font-bold">Foto Dokumentasi Alat:</span>
                                    <a href="{{ asset('storage/' . $item->foto_alat) }}" target="_blank" class="text-[#00A3E0] font-bold hover:underline inline-flex items-center gap-1 mt-0.5">
                                        <span class="material-symbols-outlined text-sm">open_in_new</span> Lihat Foto Ukuran Penuh
                                    </a>
                                </div>
                            </div>
                            @endif
                        </div>

                        <!-- Right Info: Biaya & Dokumen -->
                        <div class="bg-gradient-to-br from-slate-50 to-sky-50/30 p-4 sm:p-5 rounded-2xl border border-slate-200/80 space-y-4 flex flex-col justify-between">
                            <div class="space-y-3 text-xs">
                                <div>
                                    <span class="text-slate-400 block text-[11px] font-bold">Biaya Pembuatan</span>
                                    <strong class="text-slate-900 text-sm font-extrabold">Rp {{ number_format($item->biaya_pembuatan, 0, ',', '.') }}</strong>
                                </div>
                                <div>
                                    <span class="text-slate-400 block text-[11px] font-bold">Estimasi Harga Jual</span>
                                    <strong class="text-emerald-700 text-sm font-extrabold">Rp {{ number_format($item->estimasi_harga_jual, 0, ',', '.') }}</strong>
                                </div>
                            </div>

                            <div class="pt-3 border-t border-slate-200 space-y-2">
                                <a href="{{ route('lomba.proposal.download', $item->id) }}" target="_blank" rel="noopener noreferrer" class="w-full py-2 px-3 bg-white hover:bg-sky-50 text-[#00A3E0] border border-sky-200 font-bold text-xs rounded-xl flex items-center justify-center gap-1.5 transition-colors shadow-sm">
                                    <span class="material-symbols-outlined text-base">open_in_new</span>
                                    <span>Buka Proposal (Google Drive)</span>
                                </a>

                                @if($item->link_video)
                                <a href="{{ $item->link_video }}" target="_blank" class="w-full py-2 px-3 text-slate-600 hover:text-slate-900 font-semibold text-xs flex items-center justify-center gap-1.5 transition-colors">
                                    <span class="material-symbols-outlined text-base text-red-500">play_circle</span>
                                    <span>Lihat Video Demo</span>
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Catatan Evaluasi Admin Jika Ada -->
                    @if($item->catatan_admin)
                    <div class="p-4 bg-amber-50 rounded-2xl border border-amber-200 space-y-1">
                        <div class="flex items-center gap-1.5 text-amber-800 font-extrabold text-xs">
                            <span class="material-symbols-outlined text-amber-600 text-base">rate_review</span>
                            <span>Catatan & Evaluasi Dewan Juri / Admin:</span>
                        </div>
                        <p class="text-xs text-amber-900 leading-relaxed pl-5">{{ $item->catatan_admin }}</p>
                    </div>
                    @endif

                </div>
                @endforeach
            </div>
            @endif

        </div>

    </main>

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

    <!-- POPUP MODAL PENDAFTARAN BERHASIL (Placed at document root to guarantee 100% full-screen coverage with 0 offset) -->
    @if(session('pendaftaran_berhasil'))
    @php
        $infoSukses = session('pendaftaran_berhasil');
    @endphp
    <div id="modal-pendaftaran-sukses" 
         onclick="closeSuccessModal()"
         class="fixed inset-0 top-0 left-0 right-0 bottom-0 m-0 z-[99999] flex items-center justify-center bg-slate-900/60 backdrop-blur-sm p-4 animate-in fade-in duration-200 cursor-pointer" 
         style="position: fixed; top: 0; left: 0; right: 0; bottom: 0; margin: 0; width: 100vw; height: 100vh;">
        <div onclick="event.stopPropagation()" 
             class="relative bg-white rounded-3xl shadow-2xl max-w-md w-full p-6 sm:p-8 text-center border border-slate-100 transform scale-100 transition-all cursor-default">
            
            <!-- Close Button (X) -->
            <button type="button" 
                    onclick="closeSuccessModal()" 
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
            <p class="text-xs text-slate-500 mt-1">Karya inovasi teknologi tepat guna Anda telah sukses diajukan ke panitia lomba.</p>

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
                @elseif(session('success'))
                <div class="pt-2.5 border-t border-slate-200/60">
                    <p class="text-xs font-semibold text-slate-700 leading-relaxed">{{ session('success') }}</p>
                </div>
                @endif

                @if(!empty($infoSukses['foto_alat']))
                <div class="pt-2.5 border-t border-slate-200/60 flex items-center gap-3">
                    <img src="{{ asset('storage/' . $infoSukses['foto_alat']) }}" alt="Foto Alat" class="w-12 h-12 object-cover rounded-xl border border-slate-200 shrink-0 shadow-2xs">
                    <div class="min-w-0">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Foto Dokumentasi</span>
                        <span class="text-xs font-bold text-emerald-600 flex items-center gap-1 mt-0.5">
                            <span class="material-symbols-outlined text-sm">check_circle</span> Foto Berhasil Terunggah
                        </span>
                    </div>
                </div>
                @endif
            </div>

            <!-- Footer Buttons -->
            <div class="space-y-2">
                <button type="button" onclick="closeSuccessModal()" 
                        class="w-full py-2.5 px-4 bg-[#00A3E0] hover:bg-[#008cc0] active:scale-[0.99] text-white font-bold text-xs rounded-xl shadow-md shadow-sky-500/20 transition-all flex items-center justify-center gap-2 cursor-pointer">
                    <span>Lihat Riwayat & Status Karya</span>
                    <span class="material-symbols-outlined text-base">arrow_forward</span>
                </button>
                <button type="button" onclick="closeSuccessModal()" 
                        class="w-full py-1.5 px-4 text-xs font-semibold text-slate-400 hover:text-slate-600 transition-colors cursor-pointer">
                    Tutup Pop-up
                </button>
            </div>
        </div>
    </div>

    <script>
        function closeSuccessModal() {
            const modal = document.getElementById('modal-pendaftaran-sukses');
            if (modal) {
                modal.classList.add('hidden');
                modal.style.display = 'none';
            }
        }

        // Close on ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeSuccessModal();
            }
        });
    </script>
    @endif
</body>
</html>
