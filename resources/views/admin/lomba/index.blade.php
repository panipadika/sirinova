<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Pendaftaran Lomba TTG - Admin Panel</title>
    <!-- Favicon Logo Tasikmalaya -->
    <link rel="icon" type="image/png" href="{{ asset('storage/images/favicon_tasik.png') }}?v=3">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=3">
    <link rel="apple-touch-icon" href="{{ asset('storage/images/favicon_tasik.png') }}?v=3">
    
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Public+Sans:wght@600;700;800&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f4f7f6; }
        h1, h2, h3, h4, h5, h6 { font-family: 'Public Sans', sans-serif; }
        * { -ms-overflow-style: none !important; scrollbar-width: none !important; }
        *::-webkit-scrollbar { display: none !important; width: 0 !important; height: 0 !important; }
    </style>
</head>

<body class="text-gray-800 min-h-screen antialiased flex overflow-hidden">

    <!-- SIDEBAR -->
    @include('partials.sidebar')

    <!-- MAIN CONTENT -->
    <div class="flex-1 flex flex-col h-screen md:ml-[260px] w-full md:w-[calc(100%-260px)] overflow-y-auto">

        <!-- Mobile Header -->
        <header class="md:hidden bg-white border-b flex justify-between items-center h-14 px-4 sticky top-0 z-40">
            <button class="p-2 text-gray-500 rounded hover:bg-gray-100" id="menu-btn" onclick="document.getElementById('sidebar').classList.toggle('-translate-x-full')">
                <span class="material-symbols-outlined">menu</span>
            </button>
            <span class="text-lg font-bold text-gray-900">Pendaftaran Lomba TTG</span>
        </header>

        <div class="p-4 sm:p-6 lg:p-8 space-y-6">

            <!-- Top Page Title & Quick Actions -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-black text-gray-900 tracking-tight flex items-center gap-2.5">
                        <span class="material-symbols-outlined text-[#29abe2] text-3xl">emoji_events</span>
                        <span>Pendaftaran Lomba Alat TTG</span>
                    </h1>
                    <p class="text-xs text-gray-500 mt-1">
                        Pusat verifikasi berkas, penilaian, dan rekapitulasi data pendaftar lomba teknologi tepat guna Kota Tasikmalaya.
                    </p>
                </div>

                <div class="flex items-center gap-2.5">
                    <a href="{{ route('admin.lomba.print', request()->query()) }}" target="_blank" class="px-4 py-2.5 bg-white hover:bg-gray-50 border border-gray-200 text-gray-700 font-bold text-xs rounded-xl shadow-sm transition-all flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-base">print</span>
                        <span>Cetak Rekap</span>
                    </a>
                </div>
            </div>

            <!-- Flash Alert -->
            @if(session('success'))
            <div class="p-4 bg-emerald-50 rounded-2xl border border-emerald-200 flex items-center gap-3">
                <span class="material-symbols-outlined text-emerald-600 shrink-0">check_circle</span>
                <p class="text-xs font-bold text-emerald-800">{{ session('success') }}</p>
            </div>
            @endif

            <!-- STATS CARDS (Compact) -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                <!-- Total -->
                <div class="bg-white p-3.5 sm:p-4 rounded-xl border border-gray-100 shadow-xs space-y-0.5">
                    <span class="text-gray-400 text-[11px] font-medium block">Total Pendaftar</span>
                    <div class="flex items-center justify-between">
                        <span class="text-xl sm:text-2xl font-black text-gray-900">{{ $stats['total'] }}</span>
                        <span class="p-1.5 bg-sky-50 text-[#00A3E0] rounded-lg material-symbols-outlined text-lg">folder_shared</span>
                    </div>
                </div>

                <!-- Menunggu Verifikasi -->
                <div class="bg-white p-3.5 sm:p-4 rounded-xl border border-gray-100 shadow-xs space-y-0.5">
                    <span class="text-amber-500 text-[11px] font-bold block">Menunggu Verifikasi</span>
                    <div class="flex items-center justify-between">
                        <span class="text-xl sm:text-2xl font-black text-amber-600">{{ $stats['menunggu'] }}</span>
                        <span class="p-1.5 bg-amber-50 text-amber-500 rounded-lg material-symbols-outlined text-lg">pending</span>
                    </div>
                </div>

                <!-- Lolos Administrasi -->
                <div class="bg-white p-3.5 sm:p-4 rounded-xl border border-gray-100 shadow-xs space-y-0.5">
                    <span class="text-emerald-600 text-[11px] font-bold block">Lolos Administrasi</span>
                    <div class="flex items-center justify-between">
                        <span class="text-xl sm:text-2xl font-black text-emerald-600">{{ $stats['lolos'] }}</span>
                        <span class="p-1.5 bg-emerald-50 text-emerald-600 rounded-lg material-symbols-outlined text-lg">verified</span>
                    </div>
                </div>

                <!-- Ditolak / Revisi -->
                <div class="bg-white p-3.5 sm:p-4 rounded-xl border border-gray-100 shadow-xs space-y-0.5">
                    <span class="text-rose-500 text-[11px] font-bold block">Ditolak / Perbaikan</span>
                    <div class="flex items-center justify-between">
                        <span class="text-xl sm:text-2xl font-black text-rose-600">{{ $stats['ditolak'] + $stats['perlu_perbaikan'] }}</span>
                        <span class="p-1.5 bg-rose-50 text-rose-500 rounded-lg material-symbols-outlined text-lg">rule</span>
                    </div>
                </div>
            </div>

            <!-- STATUS AKSES & JADWAL PENDAFTARAN LOMBA PER KATEGORI -->
            <div class="bg-white rounded-xl border border-gray-100 shadow-xs p-3.5 sm:p-4 space-y-3">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1.5 border-b border-gray-100 pb-2.5">
                    <div class="space-y-0.5">
                        <h2 class="text-xs sm:text-sm font-black text-gray-900 flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-[#00A3E0] text-base sm:text-lg">tune</span>
                            <span>Status Akses & Jadwal Pendaftaran per Kategori</span>
                        </h2>
                        <p class="text-[10px] sm:text-[11px] text-gray-500">
                            Atur status akses untuk membuka atau menutup pendaftaran serta jadwal otomatis per kategori.
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                    @foreach($jadwalLomba as $jadwal)
                    @php
                        $isBuka = $jadwal->is_buka;
                        $isOperasionalBuka = $jadwal->isPendaftaranDibuka();
                    @endphp
                    <div class="p-3 rounded-lg border transition-all space-y-2.5 flex flex-col justify-between {{ $isBuka ? ($isOperasionalBuka ? 'bg-gradient-to-b from-sky-50/40 to-white border-sky-200/70 shadow-2xs' : 'bg-gradient-to-b from-amber-50/30 to-white border-amber-200/70') : 'bg-gradient-to-b from-rose-50/30 to-slate-50 border-rose-200/70' }}">
                        <div class="space-y-2">
                            <!-- Category Header & Status Akses Badge -->
                            <div class="flex items-start justify-between gap-1.5">
                                <div class="space-y-0.5">
                                    <span class="text-[9px] font-black uppercase tracking-wider text-gray-400">Kategori {{ $loop->iteration }}</span>
                                    <h3 class="text-xs sm:text-sm font-extrabold text-gray-900 leading-tight">{{ $jadwal->judul_tampilan }}</h3>
                                </div>
                                <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded-md text-[9px] font-bold border shrink-0 {{ $jadwal->status_badge }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $jadwal->dot_color }}"></span>
                                    <span>{{ $jadwal->badge_label }}</span>
                                </span>
                            </div>

                            <!-- Status Operasional Real-time -->
                            <div class="bg-white/95 p-2 rounded-md border border-gray-100 space-y-1 text-xs">
                                <div class="flex items-center justify-between text-[10px]">
                                    <span class="text-gray-400">Akses Pendaftaran:</span>
                                    @if(!$isBuka)
                                    <span class="font-bold text-rose-600 flex items-center gap-1">
                                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span> Ditutup Manual
                                    </span>
                                    @elseif($jadwal->tanggal_buka && now()->lt($jadwal->tanggal_buka))
                                    <span class="font-bold text-amber-600 flex items-center gap-1">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Belum Dimulai
                                    </span>
                                    @elseif($jadwal->tanggal_tutup && now()->gt($jadwal->tanggal_tutup))
                                    <span class="font-bold text-slate-600 flex items-center gap-1">
                                        <span class="w-1.5 h-1.5 rounded-full bg-slate-500"></span> Sudah Berakhir
                                    </span>
                                    @else
                                    <span class="font-bold text-emerald-600 flex items-center gap-1">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span> Dibuka
                                    </span>
                                    @endif
                                </div>
                                
                                <div class="flex items-center justify-between text-[10px] pt-1 border-t border-gray-100">
                                    <span class="text-gray-400">Periode:</span>
                                    <span class="font-semibold text-gray-700 text-right truncate ml-2 text-[9px]">{{ $jadwal->periode_teks }}</span>
                                </div>

                                @if($jadwal->keterangan)
                                <div class="pt-1 border-t border-gray-100 text-[9px] text-gray-500 italic truncate">
                                    "{{ $jadwal->keterangan }}"
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Action Buttons: Toggle Akses & Atur Jadwal -->
                        <div class="pt-0.5 flex items-center gap-1.5">
                            <!-- Toggle Akses Form -->
                            <form action="{{ route('admin.lomba.jadwal.toggle', $jadwal->id) }}" method="POST" class="flex-1">
                                @csrf
                                <button type="submit" 
                                        class="w-full py-1.5 px-2 rounded-lg text-xs font-bold transition-all flex items-center justify-center gap-1 shadow-2xs cursor-pointer {{ $isBuka ? 'bg-rose-600 hover:bg-rose-700 text-white' : 'bg-emerald-600 hover:bg-emerald-700 text-white' }}"
                                        title="{{ $isBuka ? 'Klik untuk Menutup Akses Pendaftaran' : 'Klik untuk Membuka Akses Pendaftaran' }}">
                                    <span class="material-symbols-outlined text-[15px]">{{ $isBuka ? 'block' : 'check_circle' }}</span>
                                    <span>{{ $isBuka ? 'Tutup Pendaftaran' : 'Buka Pendaftaran' }}</span>
                                </button>
                            </form>

                            <!-- Edit Schedule Button (Opens Modal) -->
                            <button type="button" 
                                    onclick="openEditJadwalModal({{ $jadwal->id }}, '{{ addslashes($jadwal->judul_tampilan) }}', '{{ $jadwal->tanggal_buka ? $jadwal->tanggal_buka->format('Y-m-d\TH:i') : '' }}', '{{ $jadwal->tanggal_tutup ? $jadwal->tanggal_tutup->format('Y-m-d\TH:i') : '' }}', {{ $jadwal->is_buka ? '1' : '0' }}, '{{ addslashes($jadwal->keterangan ?? '') }}')"
                                    class="py-1.5 px-2 bg-white hover:bg-gray-100 border border-gray-200 text-gray-700 font-bold text-xs rounded-lg transition-colors flex items-center justify-center gap-1 shadow-2xs cursor-pointer hover:border-[#00A3E0]"
                                    title="Atur Periode & Jadwal Pendaftaran">
                                <span class="material-symbols-outlined text-[15px] text-[#00A3E0]">calendar_month</span>
                                <span>Atur Jadwal</span>
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- LINK TEMPLATE PROPOSAL & KETENTUAN LOMBA (GOOGLE DRIVE) -->
            <div class="bg-white rounded-xl border border-gray-100 shadow-xs p-3.5 sm:p-4 space-y-3">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-xl bg-sky-50 border border-sky-100 flex items-center justify-center shrink-0">
                            <!-- Google Drive Colorful Icon -->
                            <svg class="w-5 h-5 shrink-0" viewBox="0 0 87.3 78" xmlns="http://www.w3.org/2000/svg">
                                <path d="m6.6 66.85 3.85 6.65c.8 1.4 1.95 2.5 3.3 3.3l13.75-23.8h-27.5c0 1.55.4 3.1 1.2 4.5z" fill="#0066da"/>
                                <path d="m43.65 25-13.75-23.8c-1.35.8-2.5 1.9-3.3 3.3l-25.4 44c-.8 1.4-1.2 2.95-1.2 4.5h27.5z" fill="#00ac47"/>
                                <path d="m73.55 76.8c1.35-.8 2.5-1.9 3.3-3.3l1.6-2.75 7.65-13.25c.8-1.4 1.2-2.95 1.2-4.5h-27.502l5.852 11.5z" fill="#ea4335"/>
                                <path d="m43.65 25 13.75-23.8c-1.35-.8-2.9-1.2-4.5-1.2h-18.5c-1.6 0-3.15.45-4.5 1.2z" fill="#00832d"/>
                                <path d="m59.8 53h-32.3l-13.75 23.8c1.35.8 2.9 1.2 4.5 1.2h50.8c1.6 0 3.15-.45 4.5-1.2z" fill="#2684fc"/>
                                <path d="m73.4 26.5-12.7-22c-.8-1.4-1.95-2.5-3.3-3.3l-13.75 23.8 16.15 28h27.45c0-1.55-.4-3.1-1.2-4.5z" fill="#ffba00"/>
                            </svg>
                        </div>
                        <div class="space-y-0.5">
                            <div class="flex items-center gap-2">
                                <h2 class="text-xs sm:text-sm font-black text-gray-900">Link Template Proposal & Ketentuan Lomba (Google Drive)</h2>
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[9px] font-bold bg-sky-50 text-[#00A3E0] border border-sky-200">
                                    <span class="material-symbols-outlined text-[11px]">public</span> Publik
                                </span>
                            </div>
                            <p class="text-[10px] sm:text-[11px] text-gray-500">
                                Tautan Google Drive ini yang dibuka oleh peserta di halaman Informasi Lomba dan Formulir Pendaftaran untuk mengunduh template proposal resmi.
                            </p>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-2 shrink-0">
                        <!-- Tombol Uji Buka Link -->
                        <a href="{{ $linkTemplateProposal }}" target="_blank" rel="noopener noreferrer" 
                           class="px-3 py-1.5 bg-slate-50 hover:bg-slate-100 border border-slate-200 text-slate-700 font-bold text-xs rounded-lg transition-colors flex items-center gap-1 shadow-2xs cursor-pointer hover:border-slate-300"
                           title="Buka link Google Drive saat ini di tab baru">
                            <span class="material-symbols-outlined text-sm text-[#00A3E0]">open_in_new</span>
                            <span>Uji Buka Link</span>
                        </a>

                        <!-- Tombol Ganti Link (Modal) -->
                        <button type="button" 
                                onclick="openEditTemplateModal('{{ addslashes($linkTemplateProposal) }}')" 
                                class="px-3.5 py-1.5 bg-[#00A3E0] hover:bg-[#008cc0] active:scale-[0.99] text-white font-bold text-xs rounded-lg shadow-2xs transition-all flex items-center gap-1.5 cursor-pointer">
                            <span class="material-symbols-outlined text-sm">edit</span>
                            <span>Ganti Link Template</span>
                        </button>
                    </div>
                </div>

                <!-- Box URL Aktif -->
                <div class="p-2.5 rounded-lg bg-slate-50 border border-slate-200/80 flex items-center justify-between gap-3 text-xs">
                    <div class="flex items-center gap-2 min-w-0 flex-1">
                        <span class="material-symbols-outlined text-base text-slate-400 shrink-0">link</span>
                        <span class="text-gray-400 text-[11px] shrink-0 font-medium">URL Aktif:</span>
                        <a href="{{ $linkTemplateProposal }}" target="_blank" rel="noopener noreferrer" class="font-mono text-xs text-[#00A3E0] hover:underline truncate" title="{{ $linkTemplateProposal }}">
                            {{ $linkTemplateProposal }}
                        </a>
                    </div>
                    <span class="text-[10px] text-slate-400 shrink-0 hidden sm:inline-flex items-center gap-1">
                        <span class="material-symbols-outlined text-[13px] text-emerald-500">check_circle</span>
                        <span>Aktif Digunakan Peserta</span>
                    </span>
                </div>
            </div>

            <!-- FILTER & SEARCH BAR (Compact & Clean - Arrow Overlap Fixed) -->
            <div class="bg-white p-2.5 sm:p-3 rounded-xl border border-gray-100 shadow-xs">
                <form action="{{ route('admin.lomba.index') }}" method="GET" class="flex flex-col md:flex-row gap-2 items-stretch md:items-center">
                    <!-- Search Input -->
                    <div class="relative flex-1">
                        <span class="absolute inset-y-0 left-0 pl-2.5 flex items-center pointer-events-none material-symbols-outlined text-gray-400 text-base">search</span>
                        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama alat, inovator, instansi, atau no registrasi..." 
                               class="w-full pl-8 pr-3 py-1.5 text-xs bg-slate-50 border border-slate-200 rounded-lg focus:bg-white focus:ring-2 focus:ring-[#00A3E0]/20 focus:border-[#00A3E0] outline-none transition-all">
                    </div>

                    <!-- Filter Kategori (Clean Custom Arrow - No Overlap) -->
                    <div class="relative shrink-0">
                        <select name="kategori" onchange="this.form.submit()" class="appearance-none w-full md:w-auto min-w-[195px] text-xs bg-slate-50 border border-slate-200 rounded-lg pl-3 pr-8 py-1.5 font-medium text-slate-700 focus:bg-white focus:ring-2 focus:ring-[#00A3E0]/20 focus:border-[#00A3E0] outline-none cursor-pointer transition-all">
                            <option value="">Semua Kategori ({{ $stats['total'] }})</option>
                            <option value="SMA/SMK Sederajat" {{ request('kategori') == 'SMA/SMK Sederajat' ? 'selected' : '' }}>SMA/SMK Sederajat ({{ $stats['sma'] }})</option>
                            <option value="Perguruan Tinggi" {{ request('kategori') == 'Perguruan Tinggi' ? 'selected' : '' }}>Perguruan Tinggi ({{ $stats['pt'] }})</option>
                            <option value="Umum" {{ request('kategori') == 'Umum' ? 'selected' : '' }}>Umum ({{ $stats['umum'] }})</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2 text-slate-400">
                            <span class="material-symbols-outlined text-[18px]">expand_more</span>
                        </div>
                    </div>

                    <!-- Filter Status (Clean Custom Arrow) -->
                    <div class="relative shrink-0">
                        <select name="status" onchange="this.form.submit()" class="appearance-none w-full md:w-auto min-w-[155px] text-xs bg-slate-50 border border-slate-200 rounded-lg pl-3 pr-8 py-1.5 font-medium text-slate-700 focus:bg-white focus:ring-2 focus:ring-[#00A3E0]/20 focus:border-[#00A3E0] outline-none cursor-pointer transition-all">
                            <option value="">Semua Status</option>
                            <option value="Menunggu Verifikasi" {{ request('status') == 'Menunggu Verifikasi' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                            <option value="Lolos Administrasi" {{ request('status') == 'Lolos Administrasi' ? 'selected' : '' }}>Lolos Administrasi</option>
                            <option value="Perlu Perbaikan" {{ request('status') == 'Perlu Perbaikan' ? 'selected' : '' }}>Perlu Perbaikan</option>
                            <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2 text-slate-400">
                            <span class="material-symbols-outlined text-[18px]">expand_more</span>
                        </div>
                    </div>

                    <!-- Hidden submit button for Enter key support in search input -->
                    <button type="submit" class="hidden"></button>

                    <!-- Tombol Reset Filter -->
                    <a href="{{ route('admin.lomba.index') }}" class="px-3.5 py-1.5 bg-[#00A3E0] hover:bg-[#008cc0] active:scale-[0.99] text-white font-bold text-xs rounded-lg shadow-2xs transition-all flex items-center justify-center gap-1 cursor-pointer whitespace-nowrap shrink-0" title="Reset Semua Filter">
                        <span class="material-symbols-outlined text-[16px]">restart_alt</span>
                        <span>Reset</span>
                    </a>
                </form>
            </div>

            <!-- TABLE DAFTAR PESERTA LOMBA (Ultra Compact & Elegant) -->
            <div class="bg-white rounded-xl border border-gray-100 shadow-xs overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead class="bg-slate-50/90 border-b border-slate-100 text-slate-500 font-bold uppercase tracking-wider text-[10px]">
                            <tr>
                                <th class="py-2 px-3 whitespace-nowrap">No. Registrasi</th>
                                <th class="py-2 px-2.5 text-center whitespace-nowrap">Foto</th>
                                <th class="py-2 px-3 whitespace-nowrap">Nama Alat TTG</th>
                                <th class="py-2 px-2.5 whitespace-nowrap">Kategori</th>
                                <th class="py-2 px-3 whitespace-nowrap">Inovator & Instansi</th>
                                <th class="py-2 px-3 whitespace-nowrap">Biaya & Harga</th>
                                <th class="py-2 px-2.5 text-center whitespace-nowrap">Status</th>
                                <th class="py-2 px-2.5 text-center whitespace-nowrap">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($pendaftar as $item)
                            <tr class="hover:bg-slate-50/70 transition-colors">
                                <!-- No. Registrasi -->
                                <td class="py-2 px-3 whitespace-nowrap align-middle">
                                    <span class="font-mono font-bold text-slate-800 bg-slate-100/90 border border-slate-200/80 px-1.5 py-0.5 rounded text-[10px] inline-block tracking-tight">
                                        {{ $item->nomor_registrasi }}
                                    </span>
                                    <span class="block text-[9px] text-slate-400 mt-0.5 font-medium leading-none">
                                        {{ $item->dibuat_pada ? $item->dibuat_pada->translatedFormat('d M Y, H:i') : '-' }}
                                    </span>
                                </td>

                                <!-- Foto Alat -->
                                <td class="py-2 px-2.5 whitespace-nowrap text-center align-middle">
                                    @if($item->foto_alat)
                                        <button type="button" 
                                                onclick="openAdminPhotoModal('{{ asset('storage/' . $item->foto_alat) }}', '{{ addslashes($item->nama_alat) }}', '{{ $item->nomor_registrasi }}', '{{ addslashes($item->nama_inovator) }}')" 
                                                class="inline-block group relative cursor-pointer focus:outline-none" 
                                                title="Klik untuk Pratinjau Foto">
                                            <img src="{{ asset('storage/' . $item->foto_alat) }}" alt="{{ $item->nama_alat }}" class="w-8.5 h-8.5 object-cover rounded-md border border-slate-200 shadow-2xs group-hover:scale-105 group-hover:border-[#00A3E0] transition-all">
                                            <span class="absolute inset-0 bg-black/35 rounded-md opacity-0 group-hover:opacity-100 flex items-center justify-center transition-opacity text-white">
                                                <span class="material-symbols-outlined text-xs">zoom_in</span>
                                            </span>
                                        </button>
                                    @else
                                        <div class="w-8.5 h-8.5 rounded-md bg-slate-50 border border-dashed border-slate-200 flex items-center justify-center text-slate-300 mx-auto" title="Tidak ada foto">
                                            <span class="material-symbols-outlined text-sm">image_not_supported</span>
                                        </div>
                                    @endif
                                </td>

                                <!-- Nama Alat -->
                                <td class="py-2 px-3 max-w-[200px] align-middle">
                                    <a href="{{ route('admin.lomba.show', $item->id) }}" class="font-bold text-slate-900 hover:text-[#00A3E0] transition-colors line-clamp-1 block text-xs leading-snug">
                                        {{ $item->nama_alat }}
                                    </a>
                                    <span class="text-[10px] text-slate-400 line-clamp-1 mt-0.5 leading-none">
                                        {{ $item->fungsi }}
                                    </span>
                                </td>

                                <!-- Kategori -->
                                <td class="py-2 px-2.5 whitespace-nowrap align-middle">
                                    <span class="px-2 py-0.5 bg-sky-50 text-[#00A3E0] font-bold rounded-md text-[10px] border border-sky-100/80 inline-block leading-tight">
                                        {{ $item->kategori_peserta }}
                                    </span>
                                </td>

                                <!-- Inovator & Instansi -->
                                <td class="py-2 px-3 align-middle">
                                    <strong class="text-slate-800 block font-bold text-xs leading-snug truncate max-w-[140px]">{{ $item->nama_inovator }}</strong>
                                    <span class="text-slate-500 text-[10px] block truncate max-w-[140px] leading-tight mt-0.5">{{ $item->asal_instansi }}</span>
                                    <span class="text-slate-400 text-[9px] block font-mono leading-none mt-0.5">{{ $item->nomor_wa }}</span>
                                </td>

                                <!-- Biaya & Harga -->
                                <td class="py-2 px-3 whitespace-nowrap align-middle">
                                    <span class="text-slate-500 block text-[10px] leading-tight">Biaya: <span class="text-slate-700 font-medium">Rp {{ number_format($item->biaya_pembuatan, 0, ',', '.') }}</span></span>
                                    <span class="text-emerald-600 font-bold block text-[10px] leading-tight mt-0.5">Jual: Rp {{ number_format($item->estimasi_harga_jual, 0, ',', '.') }}</span>
                                </td>

                                <!-- Status Badge -->
                                <td class="py-2 px-2.5 whitespace-nowrap text-center align-middle">
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full font-bold text-[10px] border leading-tight {{ $item->status_badge }}">
                                        <span class="material-symbols-outlined text-[13px] leading-none">{{ $item->status_icon }}</span>
                                        <span>{{ $item->status }}</span>
                                    </span>
                                </td>

                                <!-- Aksi -->
                                <td class="py-2 px-2.5 whitespace-nowrap text-center align-middle">
                                    <div class="flex items-center justify-center gap-1">
                                        <a href="{{ route('admin.lomba.show', $item->id) }}" class="p-1 bg-sky-50 hover:bg-[#00A3E0] text-[#00A3E0] hover:text-white rounded-md transition-colors" title="Lihat Detail & Verifikasi">
                                            <span class="material-symbols-outlined text-base">visibility</span>
                                        </a>
                                        <a href="{{ route('lomba.proposal.download', $item->id) }}" target="_blank" rel="noopener noreferrer" class="p-1 bg-slate-50 hover:bg-[#00A3E0] text-slate-600 hover:text-white rounded-md transition-colors" title="Buka Link Proposal (Google Drive)">
                                            <span class="material-symbols-outlined text-base">link</span>
                                        </a>
                                        <form action="{{ route('admin.lomba.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pendaftaran karya ini?')" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-1 bg-rose-50 hover:bg-rose-600 text-rose-600 hover:text-white rounded-md transition-colors cursor-pointer" title="Hapus">
                                                <span class="material-symbols-outlined text-base">delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="py-8 text-center text-gray-400">
                                    <span class="material-symbols-outlined text-2xl mb-1 block">folder_off</span>
                                    <p class="font-bold text-gray-500 text-xs">Tidak ada data pendaftaran ditemukan.</p>
                                    <p class="text-[10px]">Belum ada peserta yang mendaftar atau sesuaikan kata kunci pencarian Anda.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($pendaftar->hasPages())
                <div class="p-2.5 border-t border-gray-100 bg-gray-50/50">
                    {{ $pendaftar->links() }}
                </div>
                @endif
            </div>

        </div>

    </div>

    <!-- MODAL PRATINJAU FOTO ALAT ADMIN -->
    <div id="admin-photo-modal" class="fixed inset-0 z-[9999] hidden items-center justify-center bg-slate-900/75 backdrop-blur-sm p-4">
        <div class="bg-white rounded-3xl shadow-2xl max-w-2xl w-full overflow-hidden border border-slate-100 flex flex-col max-h-[90vh]">
            <!-- Header Modal -->
            <div class="p-4 sm:p-5 border-b border-gray-100 flex items-center justify-between bg-slate-50">
                <div>
                    <span id="modal-photo-reg" class="text-[10px] font-mono font-bold bg-sky-100 text-[#00A3E0] px-2 py-0.5 rounded-md">REG-NO</span>
                    <h3 id="modal-photo-title" class="text-sm sm:text-base font-extrabold text-gray-900 mt-1 line-clamp-1">Nama Alat TTG</h3>
                    <p id="modal-photo-inovator" class="text-xs text-gray-500">Inovator: -</p>
                </div>
                <button type="button" onclick="closeAdminPhotoModal()" class="p-2 text-gray-400 hover:text-gray-700 hover:bg-gray-200/60 rounded-xl transition-colors cursor-pointer">
                    <span class="material-symbols-outlined text-xl">close</span>
                </button>
            </div>

            <!-- Image View Area -->
            <div class="p-4 bg-slate-950 flex items-center justify-center overflow-auto max-h-[60vh]">
                <img id="modal-photo-img" src="" alt="Pratinjau Foto Alat" class="max-h-[55vh] max-w-full object-contain rounded-lg shadow-md">
            </div>

            <!-- Modal Footer -->
            <div class="p-4 border-t border-gray-100 flex items-center justify-between bg-white">
                <span class="text-xs text-gray-400 flex items-center gap-1">
                    <span class="material-symbols-outlined text-sm text-emerald-600">verified</span>
                    Dokumentasi Resmi Lomba TTG
                </span>
                <div class="flex items-center gap-2">
                    <a id="modal-photo-link" href="" target="_blank" class="px-3.5 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs rounded-xl transition-colors flex items-center gap-1">
                        <span class="material-symbols-outlined text-sm">open_in_new</span>
                        <span>Tab Baru</span>
                    </a>
                    <button type="button" onclick="closeAdminPhotoModal()" class="px-4 py-2 bg-[#29abe2] hover:bg-[#1f96c8] text-white font-bold text-xs rounded-xl shadow-sm transition-colors cursor-pointer">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openAdminPhotoModal(imgUrl, title, regNo, inovator) {
            document.getElementById('modal-photo-img').src = imgUrl;
            document.getElementById('modal-photo-title').textContent = title;
            document.getElementById('modal-photo-reg').textContent = regNo;
            document.getElementById('modal-photo-inovator').textContent = 'Inovator: ' + inovator;
            document.getElementById('modal-photo-link').href = imgUrl;

            const modal = document.getElementById('admin-photo-modal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeAdminPhotoModal() {
            const modal = document.getElementById('admin-photo-modal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        // Close when clicking backdrop
        document.getElementById('admin-photo-modal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeAdminPhotoModal();
            }
        });
    </script>

    <!-- MODAL EDIT JADWAL & AKSES PENDAFTARAN ADMIN -->
    <div id="modal-edit-jadwal" class="fixed inset-0 z-[9999] hidden items-center justify-center bg-slate-900/60 backdrop-blur-sm p-4">
        <div class="bg-white rounded-3xl shadow-2xl max-w-lg w-full overflow-hidden border border-slate-100 flex flex-col transform transition-all">
            <!-- Modal Header -->
            <div class="p-5 border-b border-gray-100 flex items-center justify-between bg-gradient-to-r from-slate-50 to-sky-50/30">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-2xl bg-[#00A3E0]/10 text-[#00A3E0] flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-2xl">edit_calendar</span>
                    </div>
                    <div>
                        <h3 class="text-sm sm:text-base font-extrabold text-gray-900 leading-tight" id="modal-jadwal-title">Atur Jadwal & Akses Pendaftaran</h3>
                        <p class="text-xs text-gray-500 mt-0.5">Tentukan periode waktu dan status akses pendaftaran</p>
                    </div>
                </div>
                <button type="button" onclick="closeEditJadwalModal()" class="w-8 h-8 rounded-full flex items-center justify-center text-gray-400 hover:text-gray-700 hover:bg-gray-200/60 transition-colors cursor-pointer">
                    <span class="material-symbols-outlined text-lg">close</span>
                </button>
            </div>

            <form id="form-edit-jadwal" action="" method="POST" class="p-5 sm:p-6 space-y-5">
                @csrf
                @method('PUT')

                <!-- Status Akses Pendaftaran (Interactive Segmented Cards) -->
                <div class="p-4 bg-slate-50 rounded-2xl border border-slate-200/70 space-y-2.5">
                    <div class="flex items-center justify-between">
                        <div>
                            <label class="block text-xs font-bold text-slate-800">Status Akses Pendaftaran</label>
                            <p class="text-[11px] text-slate-500 mt-0.5">Jika ditutup manual, pendaftaran dinonaktifkan terlepas dari jadwal.</p>
                        </div>
                    </div>

                    <input type="hidden" name="is_buka" id="modal-input-is-buka" value="1">

                    <div class="grid grid-cols-2 gap-2 pt-1">
                        <button type="button" id="btn-status-buka" onclick="setStatusAkses(1)" 
                                class="py-2.5 px-3 rounded-xl border text-xs font-bold flex items-center justify-center gap-2 transition-all cursor-pointer">
                            <span class="material-symbols-outlined text-base">check_circle</span>
                            <span>Buka Pendaftaran</span>
                        </button>
                        <button type="button" id="btn-status-tutup" onclick="setStatusAkses(0)" 
                                class="py-2.5 px-3 rounded-xl border text-xs font-bold flex items-center justify-center gap-2 transition-all cursor-pointer">
                            <span class="material-symbols-outlined text-base">block</span>
                            <span>Tutup Pendaftaran</span>
                        </button>
                    </div>
                </div>

                <!-- Periode Tanggal Buka & Tutup (Grid 2 Kolom) -->
                <div class="space-y-2.5">
                    <div class="flex items-center gap-1.5 text-xs font-bold text-slate-700">
                        <span class="material-symbols-outlined text-base text-[#00A3E0]">date_range</span>
                        <span>Periode Waktu Pendaftaran (Opsional)</span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                        <!-- Tanggal Buka -->
                        <div class="space-y-1.5">
                            <label for="modal-input-tanggal-buka" class="block text-[11px] font-semibold text-slate-600">
                                Waktu Dibuka
                            </label>
                            <input type="datetime-local" name="tanggal_buka" id="modal-input-tanggal-buka" 
                                   class="w-full text-xs rounded-xl border border-slate-200 bg-slate-50/60 focus:bg-white focus:ring-2 focus:ring-[#00A3E0]/20 focus:border-[#00A3E0] px-3 py-2.5 transition-all outline-none">
                            <span class="block text-[10px] text-slate-400 leading-tight">Kosongkan jika pendaftaran dibuka langsung tanpa batas awal.</span>
                        </div>

                        <!-- Tanggal Tutup -->
                        <div class="space-y-1.5">
                            <label for="modal-input-tanggal-tutup" class="block text-[11px] font-semibold text-slate-600">
                                Waktu Ditutup
                            </label>
                            <input type="datetime-local" name="tanggal_tutup" id="modal-input-tanggal-tutup" 
                                   class="w-full text-xs rounded-xl border border-slate-200 bg-slate-50/60 focus:bg-white focus:ring-2 focus:ring-[#00A3E0]/20 focus:border-[#00A3E0] px-3 py-2.5 transition-all outline-none">
                            <span class="block text-[10px] text-slate-400 leading-tight">Kosongkan jika dibuka seterusnya hingga ditutup manual.</span>
                        </div>
                    </div>
                </div>

                <!-- Keterangan Tambahan -->
                <div class="space-y-1.5">
                    <label for="modal-input-keterangan" class="block text-xs font-bold text-slate-700 flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-base text-slate-400">notes</span>
                        <span>Catatan / Keterangan untuk Peserta (Opsional)</span>
                    </label>
                    <textarea name="keterangan" id="modal-input-keterangan" rows="2" 
                              placeholder="Contoh: Pendaftaran dibuka hingga 31 Oktober 2026."
                              class="w-full text-xs rounded-xl border border-slate-200 bg-slate-50/60 focus:bg-white focus:ring-2 focus:ring-[#00A3E0]/20 focus:border-[#00A3E0] px-3.5 py-2.5 resize-none transition-all outline-none"></textarea>
                </div>

                <!-- Modal Actions -->
                <div class="pt-3 border-t border-gray-100 flex items-center justify-end gap-2.5">
                    <button type="button" onclick="closeEditJadwalModal()" class="px-4 py-2.5 text-xs font-bold text-gray-500 hover:text-gray-800 hover:bg-gray-100 rounded-xl transition-colors cursor-pointer">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2.5 bg-[#00A3E0] hover:bg-[#008cc0] active:scale-[0.99] text-white font-bold text-xs rounded-xl shadow-md shadow-sky-500/20 transition-all cursor-pointer flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-base">save</span>
                        <span>Simpan Pengaturan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL EDIT LINK TEMPLATE PROPOSAL (GOOGLE DRIVE) -->
    <div id="modal-edit-template" class="fixed inset-0 z-50 bg-slate-900/50 backdrop-blur-xs hidden items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-lg w-full overflow-hidden border border-slate-100 animate-in fade-in zoom-in-95 duration-150">
            <!-- Header Modal -->
            <div class="p-4 sm:p-5 border-b border-gray-100 flex items-center justify-between bg-gradient-to-r from-sky-50/70 to-white">
                <div class="flex items-center gap-2.5">
                    <div class="w-9 h-9 rounded-xl bg-sky-100 text-[#00A3E0] flex items-center justify-center">
                        <span class="material-symbols-outlined text-xl">link</span>
                    </div>
                    <div>
                        <h3 class="text-sm sm:text-base font-black text-gray-900">Ganti Link Template Proposal</h3>
                        <p class="text-[10px] sm:text-[11px] text-gray-500">Ubah tautan Google Drive dokumen template proposal & pedoman lomba TTG</p>
                    </div>
                </div>
                <button type="button" onclick="closeEditTemplateModal()" class="w-8 h-8 rounded-lg flex items-center justify-center text-gray-400 hover:text-gray-700 hover:bg-gray-100 transition-colors cursor-pointer">
                    <span class="material-symbols-outlined text-lg">close</span>
                </button>
            </div>

            <!-- Form Edit Link Template -->
            <form action="{{ route('admin.lomba.template.update') }}" method="POST" class="p-5 space-y-4">
                @csrf
                @method('PUT')

                <div class="space-y-1.5">
                    <label for="modal-input-template-url" class="block text-xs font-bold text-slate-700 flex items-center justify-between">
                        <span>Link Google Drive Template Proposal</span>
                        <span class="text-[10px] font-semibold text-rose-500">*Wajib URL valid</span>
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                            <span class="material-symbols-outlined text-lg text-[#00A3E0]">link</span>
                        </span>
                        <input type="url" name="link_template_proposal" id="modal-input-template-url" 
                               required
                               placeholder="https://drive.google.com/drive/folders/... atau https://drive.google.com/file/d/..." 
                               class="w-full pl-9 pr-3.5 py-2.5 text-xs font-mono bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#00A3E0]/20 focus:border-[#00A3E0] outline-none transition-all">
                    </div>
                    <span class="block text-[10px] text-slate-400 leading-tight">Tempelkan link folder atau dokumen template proposal dari Google Drive Anda.</span>
                </div>

                <!-- Catatan Peringatan Izin Akses Google Drive -->
                <div class="p-3 bg-amber-50 border border-amber-200 rounded-xl text-xs text-amber-800 space-y-1">
                    <div class="flex items-center gap-1.5 font-bold text-amber-900">
                        <span class="material-symbols-outlined text-base text-amber-600">info</span>
                        <span>Pastikan Akses Tautan Bersifat Publik</span>
                    </div>
                    <p class="text-[11px] text-amber-700 leading-relaxed">
                        Di Google Drive, klik kanan folder/file template &rarr; pilih <strong>Bagikan (Share)</strong> &rarr; ubah Akses Umum menjadi <strong>"Siapa saja yang memiliki link" (Anyone with the link can view)</strong> agar peserta dapat mengunduh tanpa meminta izin akses.
                    </p>
                </div>

                <!-- Modal Actions -->
                <div class="pt-3 border-t border-gray-100 flex items-center justify-end gap-2.5">
                    <button type="button" onclick="closeEditTemplateModal()" class="px-4 py-2.5 text-xs font-bold text-gray-500 hover:text-gray-800 hover:bg-gray-100 rounded-xl transition-colors cursor-pointer">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2.5 bg-[#00A3E0] hover:bg-[#008cc0] active:scale-[0.99] text-white font-bold text-xs rounded-xl shadow-md shadow-sky-500/20 transition-all cursor-pointer flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-base">save</span>
                        <span>Simpan & Terapkan Link</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function setStatusAkses(val) {
            document.getElementById('modal-input-is-buka').value = val;
            const btnBuka = document.getElementById('btn-status-buka');
            const btnTutup = document.getElementById('btn-status-tutup');
            if (val == 1) {
                btnBuka.className = 'py-2.5 px-3 rounded-xl border text-xs font-bold flex items-center justify-center gap-2 transition-all cursor-pointer bg-emerald-600 text-white border-emerald-600 shadow-sm shadow-emerald-600/20';
                btnTutup.className = 'py-2.5 px-3 rounded-xl border text-xs font-bold flex items-center justify-center gap-2 transition-all cursor-pointer bg-white text-slate-600 border-slate-200 hover:bg-slate-50';
            } else {
                btnBuka.className = 'py-2.5 px-3 rounded-xl border text-xs font-bold flex items-center justify-center gap-2 transition-all cursor-pointer bg-white text-slate-600 border-slate-200 hover:bg-slate-50';
                btnTutup.className = 'py-2.5 px-3 rounded-xl border text-xs font-bold flex items-center justify-center gap-2 transition-all cursor-pointer bg-rose-600 text-white border-rose-600 shadow-sm shadow-rose-600/20';
            }
        }

        function openEditJadwalModal(id, title, tanggalBuka, tanggalTutup, isBuka, keterangan) {
            document.getElementById('modal-jadwal-title').textContent = 'Atur Jadwal & Akses: ' + title;
            document.getElementById('form-edit-jadwal').action = '/admin/lomba/jadwal/' + id;
            document.getElementById('modal-input-tanggal-buka').value = tanggalBuka;
            document.getElementById('modal-input-tanggal-tutup').value = tanggalTutup;
            document.getElementById('modal-input-keterangan').value = keterangan;
            setStatusAkses(isBuka ? 1 : 0);

            const modal = document.getElementById('modal-edit-jadwal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeEditJadwalModal() {
            const modal = document.getElementById('modal-edit-jadwal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        document.getElementById('modal-edit-jadwal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeEditJadwalModal();
            }
        });

        // Handler Modal Edit Template Proposal (Google Drive)
        function openEditTemplateModal(currentUrl) {
            document.getElementById('modal-input-template-url').value = currentUrl;
            const modal = document.getElementById('modal-edit-template');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            setTimeout(() => {
                document.getElementById('modal-input-template-url').focus();
            }, 100);
        }

        function closeEditTemplateModal() {
            const modal = document.getElementById('modal-edit-template');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        document.getElementById('modal-edit-template').addEventListener('click', function(e) {
            if (e.target === this) {
                closeEditTemplateModal();
            }
        });

        // Close modals on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeEditJadwalModal();
                closeEditTemplateModal();
            }
        });
    </script>

</body>
</html>
