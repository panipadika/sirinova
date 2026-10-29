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

        <div class="p-3 sm:p-5 lg:p-6 space-y-5">

            <!-- SEGMENTED NAVIGATION TABS (Modul Lomba TTG) -->
            <div class="flex items-center gap-2 border-b border-gray-200/80 pb-3">
                <!-- Tab 1: Karya Pendaftar (Aktif) -->
                <a href="{{ route('admin.lomba.index') }}" 
                   class="px-4 py-2 rounded-xl text-xs font-bold transition-all flex items-center gap-2 bg-[#00A3E0] text-white shadow-xs">
                    <span class="material-symbols-outlined text-[18px]">emoji_events</span>
                    <span>Data Karya Inovasi</span>
                    <span class="px-2 py-0.5 rounded-full text-[10px] bg-white/20 text-white font-extrabold">{{ $pendaftar->total() }}</span>
                </a>

                <!-- Tab 2: Akun Peserta -->
                <a href="{{ route('admin.lomba.akun.index') }}" 
                   class="px-4 py-2 rounded-xl text-xs font-bold transition-all flex items-center gap-2 bg-white text-slate-600 hover:bg-slate-100 hover:text-slate-900 border border-slate-200 shadow-2xs">
                    <span class="material-symbols-outlined text-[18px] text-slate-400">group</span>
                    <span>Daftar Akun Peserta</span>
                    <span class="px-2 py-0.5 rounded-full text-[10px] bg-slate-100 text-slate-600 font-extrabold">{{ \App\Models\User::count() }}</span>
                </a>
            </div>

            <!-- Top Page Title & Quick Actions (Sejajar & Rapi) -->
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-3 sm:gap-4">
                <div class="min-w-0">
                    <h1 class="text-xl sm:text-2xl font-black text-gray-900 tracking-tight flex items-center gap-2.5">
                        <span class="material-symbols-outlined text-[#29abe2] text-2xl sm:text-3xl shrink-0">emoji_events</span>
                        <span class="truncate">Pendaftaran Lomba Alat TTG</span>
                    </h1>
                    <p class="text-xs text-gray-500 mt-1 max-w-2xl">
                        Pusat verifikasi berkas, penilaian, dan rekapitulasi data pendaftar lomba teknologi tepat guna Kota Tasikmalaya.
                    </p>
                </div>

                <!-- 3 Action Buttons (Sejajar Satu Baris - No Wrap) -->
                <div class="flex items-center gap-2 shrink-0 flex-nowrap overflow-x-auto pb-1 lg:pb-0">
                    <!-- Cetak Rekap (Print View) -->
                    <a href="{{ route('admin.lomba.print', request()->query()) }}" target="_blank" 
                       class="px-3.5 py-2 bg-white hover:bg-slate-50 border border-slate-200 text-slate-700 font-bold text-xs rounded-xl shadow-2xs transition-all flex items-center gap-1.5 cursor-pointer whitespace-nowrap shrink-0" 
                       title="Cetak Rekapitulasi (Tampilan Cetak)">
                        <span class="material-symbols-outlined text-[17px] text-slate-500">print</span>
                        <span>Cetak Rekap</span>
                    </a>

                    <!-- Download PDF -->
                    <a href="{{ route('admin.lomba.export.pdf', request()->query()) }}" 
                       class="px-3.5 py-2 bg-rose-50 hover:bg-rose-100 border border-rose-200 text-rose-700 font-bold text-xs rounded-xl shadow-2xs transition-all flex items-center gap-1.5 cursor-pointer whitespace-nowrap shrink-0" 
                       title="Unduh Laporan Format PDF">
                        <span class="material-symbols-outlined text-[17px] text-rose-600">picture_as_pdf</span>
                        <span>Download PDF</span>
                    </a>

                    <!-- Download Excel -->
                    <a href="{{ route('admin.lomba.export.excel', request()->query()) }}" 
                       class="px-3.5 py-2 bg-emerald-50 hover:bg-emerald-100 border border-emerald-200 text-emerald-700 font-bold text-xs rounded-xl shadow-2xs transition-all flex items-center gap-1.5 cursor-pointer whitespace-nowrap shrink-0" 
                       title="Unduh Rekap Data Format Excel (.xlsx)">
                        <span class="material-symbols-outlined text-[17px] text-emerald-600">table_view</span>
                        <span>Download Excel</span>
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

            <!-- STATS CARDS (Clickable Interactive Filter Cards) -->
            @php
                $currentStatus = request('status');
                $baseQuery = request()->except(['status', 'page']);
                $isTotalActive = empty($currentStatus);
                $isMenungguActive = $currentStatus === 'Menunggu Verifikasi';
                $isLolosActive = $currentStatus === 'Lolos Administrasi';
                $isDitolakActive = in_array($currentStatus, ['Ditolak / Perbaikan', 'ditolak_perbaikan', 'Ditolak', 'Perlu Perbaikan'], true);
            @endphp
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                <!-- Total -->
                <a href="{{ route('admin.lomba.index', $baseQuery) }}" 
                   class="p-3.5 sm:p-4 rounded-xl border shadow-xs space-y-0.5 transition-all block group cursor-pointer hover:shadow-md hover:-translate-y-0.5 {{ $isTotalActive ? 'bg-sky-50/60 border-[#00A3E0] ring-2 ring-[#00A3E0]/20' : 'bg-white border-gray-100 hover:border-slate-300' }}"
                   title="Klik untuk melihat Semua Data Pendaftar ({{ $stats['total'] }})">
                    <div class="flex items-center justify-between">
                        <span class="text-[11px] font-bold block {{ $isTotalActive ? 'text-[#00A3E0]' : 'text-gray-400' }}">Total Pendaftar</span>
                        @if($isTotalActive)
                        <span class="w-1.5 h-1.5 rounded-full bg-[#00A3E0]"></span>
                        @endif
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-xl sm:text-2xl font-black text-gray-900">{{ $stats['total'] }}</span>
                        <span class="p-1.5 rounded-lg material-symbols-outlined text-lg transition-transform group-hover:scale-110 {{ $isTotalActive ? 'bg-[#00A3E0] text-white shadow-xs' : 'bg-sky-50 text-[#00A3E0]' }}">folder_shared</span>
                    </div>
                </a>

                <!-- Menunggu Verifikasi -->
                <a href="{{ route('admin.lomba.index', array_merge($baseQuery, ['status' => 'Menunggu Verifikasi'])) }}" 
                   class="p-3.5 sm:p-4 rounded-xl border shadow-xs space-y-0.5 transition-all block group cursor-pointer hover:shadow-md hover:-translate-y-0.5 {{ $isMenungguActive ? 'bg-amber-50/60 border-amber-500 ring-2 ring-amber-500/20' : 'bg-white border-gray-100 hover:border-amber-200' }}"
                   title="Klik untuk filter: Menunggu Verifikasi ({{ $stats['menunggu'] }})">
                    <div class="flex items-center justify-between">
                        <span class="text-amber-500 text-[11px] font-bold block">Menunggu Verifikasi</span>
                        @if($isMenungguActive)
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                        @endif
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-xl sm:text-2xl font-black text-amber-600">{{ $stats['menunggu'] }}</span>
                        <span class="p-1.5 rounded-lg material-symbols-outlined text-lg transition-transform group-hover:scale-110 {{ $isMenungguActive ? 'bg-amber-500 text-white shadow-xs' : 'bg-amber-50 text-amber-500' }}">pending</span>
                    </div>
                </a>

                <!-- Lolos Administrasi -->
                <a href="{{ route('admin.lomba.index', array_merge($baseQuery, ['status' => 'Lolos Administrasi'])) }}" 
                   class="p-3.5 sm:p-4 rounded-xl border shadow-xs space-y-0.5 transition-all block group cursor-pointer hover:shadow-md hover:-translate-y-0.5 {{ $isLolosActive ? 'bg-emerald-50/60 border-emerald-500 ring-2 ring-emerald-500/20' : 'bg-white border-gray-100 hover:border-emerald-200' }}"
                   title="Klik untuk filter: Lolos Administrasi ({{ $stats['lolos'] }})">
                    <div class="flex items-center justify-between">
                        <span class="text-emerald-600 text-[11px] font-bold block">Lolos Administrasi</span>
                        @if($isLolosActive)
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                        @endif
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-xl sm:text-2xl font-black text-emerald-600">{{ $stats['lolos'] }}</span>
                        <span class="p-1.5 rounded-lg material-symbols-outlined text-lg transition-transform group-hover:scale-110 {{ $isLolosActive ? 'bg-emerald-600 text-white shadow-xs' : 'bg-emerald-50 text-emerald-600' }}">verified</span>
                    </div>
                </a>

                <!-- Ditolak / Perbaikan -->
                <a href="{{ route('admin.lomba.index', array_merge($baseQuery, ['status' => 'Ditolak / Perbaikan'])) }}" 
                   class="p-3.5 sm:p-4 rounded-xl border shadow-xs space-y-0.5 transition-all block group cursor-pointer hover:shadow-md hover:-translate-y-0.5 {{ $isDitolakActive ? 'bg-rose-50/60 border-rose-500 ring-2 ring-rose-500/20' : 'bg-white border-gray-100 hover:border-rose-200' }}"
                   title="Klik untuk filter: Ditolak / Perbaikan ({{ $stats['ditolak'] + $stats['perlu_perbaikan'] }})">
                    <div class="flex items-center justify-between">
                        <span class="text-rose-500 text-[11px] font-bold block">Ditolak / Perbaikan</span>
                        @if($isDitolakActive)
                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                        @endif
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-xl sm:text-2xl font-black text-rose-600">{{ $stats['ditolak'] + $stats['perlu_perbaikan'] }}</span>
                        <span class="p-1.5 rounded-lg material-symbols-outlined text-lg transition-transform group-hover:scale-110 {{ $isDitolakActive ? 'bg-rose-500 text-white shadow-xs' : 'bg-rose-50 text-rose-500' }}">rule</span>
                    </div>
                </a>
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
                        <select name="status" onchange="this.form.submit()" class="appearance-none w-full md:w-auto min-w-[170px] text-xs bg-slate-50 border border-slate-200 rounded-lg pl-3 pr-8 py-1.5 font-medium text-slate-700 focus:bg-white focus:ring-2 focus:ring-[#00A3E0]/20 focus:border-[#00A3E0] outline-none cursor-pointer transition-all">
                            <option value="">Semua Status ({{ $stats['total'] }})</option>
                            <option value="Menunggu Verifikasi" {{ request('status') == 'Menunggu Verifikasi' ? 'selected' : '' }}>Menunggu Verifikasi ({{ $stats['menunggu'] }})</option>
                            <option value="Lolos Administrasi" {{ request('status') == 'Lolos Administrasi' ? 'selected' : '' }}>Lolos Administrasi ({{ $stats['lolos'] }})</option>
                            <option value="Ditolak / Perbaikan" {{ in_array(request('status'), ['Ditolak / Perbaikan', 'ditolak_perbaikan']) ? 'selected' : '' }}>Ditolak / Perbaikan ({{ $stats['ditolak'] + $stats['perlu_perbaikan'] }})</option>
                            <option value="Perlu Perbaikan" {{ request('status') == 'Perlu Perbaikan' ? 'selected' : '' }}>- Perlu Perbaikan ({{ $stats['perlu_perbaikan'] }})</option>
                            <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>- Ditolak ({{ $stats['ditolak'] }})</option>
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

            <!-- TABLE DAFTAR PESERTA LOMBA (Ultra Compact, Responsive & Non-Truncated Actions) -->
            <div class="bg-white rounded-xl border border-gray-100 shadow-xs overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs border-collapse min-w-[895px]">
                        <thead class="bg-slate-50/90 border-b border-slate-200/80 text-slate-500 font-bold uppercase tracking-wider text-[10px]">
                            <tr>
                                <th class="py-2.5 px-3 whitespace-nowrap w-[110px]">No. Registrasi</th>
                                <th class="py-2.5 px-3 min-w-[150px] max-w-[210px]">Nama Alat TTG</th>
                                <th class="py-2.5 px-2 text-center whitespace-nowrap w-[130px]">Kategori</th>
                                <th class="py-2.5 px-3 min-w-[130px] max-w-[170px]">Inovator & Instansi</th>
                                <th class="py-2.5 px-3 whitespace-nowrap w-[125px]">Biaya & Harga</th>
                                <th class="py-2.5 px-3 text-center whitespace-nowrap min-w-[145px] w-[145px]">Status</th>
                                <th class="py-2.5 px-3 text-center whitespace-nowrap w-[105px] sticky right-0 z-20 bg-slate-50 shadow-[-3px_0_6px_-2px_rgba(0,0,0,0.06)]">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($pendaftar as $item)
                            <tr class="hover:bg-slate-50/80 transition-colors group">
                                <!-- No. Registrasi -->
                                <td class="py-2.5 px-3 whitespace-nowrap align-middle">
                                    <span class="font-mono font-bold text-slate-800 bg-slate-100/90 border border-slate-200/80 px-1.5 py-0.5 rounded text-[10px] inline-block tracking-tight">
                                        {{ $item->nomor_registrasi }}
                                    </span>
                                    <span class="block text-[9px] text-slate-400 mt-0.5 font-medium leading-none">
                                        {{ $item->dibuat_pada ? $item->dibuat_pada->translatedFormat('d M Y, H:i') : '-' }}
                                    </span>
                                </td>

                                <!-- Nama Alat -->
                                <td class="py-2.5 px-3 min-w-[150px] max-w-[210px] align-middle">
                                    <a href="{{ route('admin.lomba.show', $item->id) }}" class="font-bold text-slate-900 hover:text-[#00A3E0] transition-colors truncate block text-xs leading-snug" title="{{ $item->nama_alat }}">
                                        {{ $item->nama_alat }}
                                    </a>
                                    @if($item->fungsi)
                                    <span class="text-[10px] text-slate-400 truncate block mt-0.5 leading-none" title="{{ $item->fungsi }}">
                                        {{ $item->fungsi }}
                                    </span>
                                    @endif
                                </td>

                                <!-- Kategori (Uniform Width & Symmetrical) -->
                                <td class="py-2.5 px-2 whitespace-nowrap text-center align-middle">
                                    <span class="inline-flex items-center justify-center min-w-[125px] py-1 px-2.5 bg-sky-50 text-[#00A3E0] font-bold rounded-lg text-[10px] border border-sky-200/80 shadow-2xs leading-tight tracking-tight text-center whitespace-nowrap">
                                        {{ $item->kategori_peserta }}
                                    </span>
                                </td>

                                <!-- Inovator & Instansi -->
                                <td class="py-2.5 px-3 min-w-[130px] max-w-[170px] align-middle">
                                    <strong class="text-slate-800 block font-bold text-xs leading-snug truncate" title="{{ $item->nama_inovator }}">{{ $item->nama_inovator }}</strong>
                                    <span class="text-slate-500 text-[10px] block truncate leading-tight mt-0.5" title="{{ $item->asal_instansi }}">{{ $item->asal_instansi }}</span>
                                    @if($item->nomor_wa)
                                    <span class="text-slate-400 text-[9px] block font-mono leading-none mt-0.5">{{ $item->nomor_wa }}</span>
                                    @endif
                                </td>

                                <!-- Biaya & Harga -->
                                <td class="py-2.5 px-3 whitespace-nowrap align-middle">
                                    <span class="text-slate-500 block text-[10px] leading-tight">Biaya: <span class="text-slate-700 font-medium">Rp {{ number_format($item->biaya_pembuatan, 0, ',', '.') }}</span></span>
                                    <span class="text-emerald-600 font-bold block text-[10px] leading-tight mt-0.5">Jual: Rp {{ number_format($item->estimasi_harga_jual, 0, ',', '.') }}</span>
                                </td>

                                <!-- Status Badge (Full Visibility & Never Truncated) -->
                                <td class="py-2.5 px-3 whitespace-nowrap text-center align-middle min-w-[145px] w-[145px]">
                                    <span class="inline-flex items-center justify-center gap-1.5 min-w-[135px] px-2.5 py-1 rounded-full font-bold text-[10px] border leading-tight {{ $item->status_badge }} shadow-2xs whitespace-nowrap">
                                        <span class="material-symbols-outlined text-[13px] leading-none shrink-0">{{ $item->status_icon }}</span>
                                        <span class="whitespace-nowrap">{{ $item->status }}</span>
                                    </span>
                                </td>

                                <!-- Aksi (Sticky Right - Always Accessible) -->
                                <td class="py-2.5 px-3 whitespace-nowrap text-center align-middle sticky right-0 z-10 bg-white group-hover:bg-slate-50 transition-colors shadow-[-3px_0_6px_-2px_rgba(0,0,0,0.06)]">
                                    <div class="flex items-center justify-center gap-1">
                                        <a href="{{ route('admin.lomba.show', $item->id) }}" class="p-1.5 bg-sky-50 hover:bg-[#00A3E0] text-[#00A3E0] hover:text-white rounded-lg transition-all shadow-2xs" title="Lihat Detail & Foto Dokumentasi">
                                            <span class="material-symbols-outlined text-[17px]">visibility</span>
                                        </a>
                                        <a href="{{ route('lomba.proposal.download', $item->id) }}" target="_blank" rel="noopener noreferrer" class="p-1.5 bg-slate-50 hover:bg-[#00A3E0] text-slate-600 hover:text-white rounded-lg transition-all shadow-2xs" title="Unduh / Buka Berkas Proposal">
                                            <span class="material-symbols-outlined text-[17px]">description</span>
                                        </a>
                                        <button type="button" 
                                                onclick="openDeleteModal('{{ route('admin.lomba.destroy', $item->id) }}', '{{ addslashes($item->nama_alat) }}', this)"
                                                class="p-1.5 bg-rose-50 hover:bg-rose-600 text-rose-600 hover:text-white rounded-lg transition-all cursor-pointer shadow-2xs" 
                                                title="Hapus Data Pendaftaran">
                                            <span class="material-symbols-outlined text-[17px]">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="py-8 text-center text-gray-400">
                                    <span class="material-symbols-outlined text-2xl mb-1 block">folder_off</span>
                                    <p class="font-bold text-gray-500 text-xs">Tidak ada data pendaftaran ditemukan.</p>
                                    <p class="text-[10px]">Belum ada peserta yang mendaftar atau sesuaikan kata kunci pencarian Anda.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Bagian Bawah Tabel: Standardized Pagination Partial -->
                <div class="p-3 sm:p-4 border-t border-slate-100 bg-white">
                    @include('partials.pagination', ['paginator' => $pendaftar, 'itemLabel' => 'Pendaftar'])
                </div>
            </div>

        </div>

    </div>

    <!-- MODAL HAPUS PENDAFTARAN LOMBA (Sesuai Desain Sistem SI-RINOVA) -->
    <div id="delete-modal" class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/40 backdrop-blur-sm hidden opacity-0 transition-opacity duration-300">
        <div id="delete-modal-content" class="bg-white rounded-xl shadow-2xl w-full max-w-sm mx-4 p-6 transform scale-95 transition-transform duration-300 border border-gray-100">
            <div class="flex items-center gap-3 text-red-600 mb-4">
                <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center shrink-0">
                    <span class="material-symbols-outlined text-red-600 text-xl">warning</span>
                </div>
                <h3 class="text-lg font-bold text-gray-900">Hapus Data Pendaftaran?</h3>
            </div>
            <p class="text-sm text-gray-600 mb-6 leading-relaxed">
                Apakah Anda yakin ingin menghapus data pendaftaran karya <span id="delete-item-title" class="font-bold text-gray-900"></span>? Tindakan ini tidak dapat dibatalkan.
            </p>
            <form id="delete-form" method="POST" action="">
                @csrf
                @method('DELETE')
                <div class="flex items-center justify-end gap-2 mt-4">
                    <button type="button"
                        id="cancel-delete"
                        class="px-4 py-2 border border-gray-300 text-gray-700 text-sm rounded-md hover:bg-gray-50 font-medium cursor-pointer transition-colors">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-4 py-2 bg-red-600 text-white text-sm rounded-md hover:bg-red-700 shadow-sm font-medium cursor-pointer transition-colors">
                        Hapus
                    </button>
                </div>
            </form>
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

        // Handler Modal Hapus Pendaftaran Lomba (Custom SI-RINOVA - In-Place Delete & No Scroll Jump)
        const deleteModal = document.getElementById('delete-modal');
        const deleteModalContent = document.getElementById('delete-modal-content');
        const cancelDeleteBtn = document.getElementById('cancel-delete');
        const deleteForm = document.getElementById('delete-form');
        const deleteItemTitle = document.getElementById('delete-item-title');
        let currentDeletingRow = null;

        function openDeleteModal(actionUrl, itemTitle, triggerBtn = null) {
            if (deleteForm) deleteForm.action = actionUrl;
            if (deleteItemTitle) {
                deleteItemTitle.textContent = itemTitle ? `"${itemTitle}"` : 'ini';
            }
            currentDeletingRow = triggerBtn ? triggerBtn.closest('tr') : null;

            if (deleteModal && deleteModalContent) {
                deleteModal.classList.remove('hidden');
                void deleteModal.offsetWidth;
                deleteModal.classList.remove('opacity-0');
                deleteModalContent.classList.remove('scale-95');
            }
        }

        function closeDeleteModal() {
            if (!deleteModal || !deleteModalContent) return;
            deleteModal.classList.add('opacity-0');
            deleteModalContent.classList.add('scale-95');
            setTimeout(() => {
                deleteModal.classList.add('hidden');
            }, 300);
        }

        cancelDeleteBtn?.addEventListener('click', closeDeleteModal);
        deleteModal?.addEventListener('click', function(e) {
            if (e.target === this) {
                closeDeleteModal();
            }
        });

        // Submit Delete Form via AJAX (Tanpa Refresh Lompat ke Awal / Refresh di Tempat)
        deleteForm?.addEventListener('submit', function(e) {
            e.preventDefault();

            const submitBtn = deleteForm.querySelector('button[type="submit"]');
            const originalBtnHtml = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="inline-block animate-spin mr-1.5">&#9696;</span>Menghapus...';

            // Simpan posisi scroll saat ini sebagai antisipasi
            sessionStorage.setItem('admin_lomba_scroll', window.scrollY);

            fetch(deleteForm.action, {
                method: 'POST',
                body: new FormData(deleteForm),
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Gagal menghapus data.');
                }
                return response.json();
            })
            .then(data => {
                closeDeleteModal();
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalBtnHtml;

                // Animasi penghapusan baris tabel di tempat
                if (currentDeletingRow) {
                    currentDeletingRow.style.transition = 'all 0.35s ease-out';
                    currentDeletingRow.style.backgroundColor = '#fee2e2';
                    currentDeletingRow.style.opacity = '0';
                    currentDeletingRow.style.transform = 'scale(0.97)';
                    
                    setTimeout(() => {
                        currentDeletingRow.remove();
                        currentDeletingRow = null;

                        // Periksa apakah tabel kosong
                        const tableBody = document.querySelector('table tbody');
                        if (tableBody && tableBody.querySelectorAll('tr').length === 0) {
                            tableBody.innerHTML = `
                                <tr>
                                    <td colspan="7" class="py-8 text-center text-gray-400">
                                        <span class="material-symbols-outlined text-2xl mb-1 block">folder_off</span>
                                        <p class="font-bold text-gray-500 text-xs">Tidak ada data pendaftaran ditemukan.</p>
                                        <p class="text-[10px]">Data pendaftaran berhasil dihapus.</p>
                                    </td>
                                </tr>
                            `;
                        }
                    }, 350);
                }

                // Tampilkan floating toast notifikasi sukses
                showToast(data.message || 'Data pendaftaran berhasil dihapus.');
            })
            .catch(error => {
                console.error(error);
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalBtnHtml;
                // Jika AJAX error, fallback submit form normal dengan posisi scroll tersimpan
                deleteForm.submit();
            });
        });

        // Floating Toast Notification Function
        function showToast(message) {
            const toast = document.getElementById('toast-notification');
            const toastMsg = document.getElementById('toast-message');
            if (!toast || !toastMsg) return;

            toastMsg.textContent = message;
            toast.classList.remove('translate-y-[-100px]', 'opacity-0', 'pointer-events-none');
            toast.classList.add('translate-y-0', 'opacity-100');

            setTimeout(() => {
                toast.classList.remove('translate-y-0', 'opacity-100');
                toast.classList.add('translate-y-[-100px]', 'opacity-0', 'pointer-events-none');
            }, 3500);
        }

        // Restore scroll position jika terjadi page reload
        window.addEventListener('DOMContentLoaded', function() {
            const savedScroll = sessionStorage.getItem('admin_lomba_scroll');
            if (savedScroll !== null) {
                window.scrollTo({ top: parseInt(savedScroll, 10), behavior: 'instant' });
                sessionStorage.removeItem('admin_lomba_scroll');
            }
        });

        // Close modals on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeEditJadwalModal();
                closeEditTemplateModal();
                closeAdminPhotoModal();
                closeDeleteModal();
            }
        });
    </script>

    <!-- Floating Toast Notification (In-Place Feedback) -->
    <div id="toast-notification" class="fixed top-5 right-5 z-[10000] flex items-center gap-2.5 px-4 py-3 bg-emerald-600 text-white text-xs font-bold rounded-xl shadow-2xl transition-all duration-300 transform translate-y-[-100px] opacity-0 pointer-events-none">
        <span class="material-symbols-outlined text-lg leading-none">check_circle</span>
        <span id="toast-message">Data berhasil diperbarui.</span>
    </div>

</body>
</html>
