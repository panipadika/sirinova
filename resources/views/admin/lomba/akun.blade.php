<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Daftar Akun Peserta Lomba TTG - Admin Panel</title>
    <!-- Favicon Logo Tasikmalaya -->
    <link rel="icon" type="image/png" href="{{ asset('storage/images/favicon_tasik.png') }}?v=3">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=3">
    
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
            <button class="p-2 text-gray-500 rounded hover:bg-gray-100 cursor-pointer" id="menu-btn" onclick="document.getElementById('sidebar').classList.toggle('-translate-x-full')">
                <span class="material-symbols-outlined">menu</span>
            </button>
            <span class="text-sm font-bold text-gray-900">Akun Peserta Lomba</span>
        </header>

        <div class="p-3 sm:p-5 lg:p-6 space-y-4">

            <!-- SEGMENTED NAVIGATION TABS (Modul Lomba TTG) -->
            <div class="flex items-center gap-2 border-b border-gray-200/80 pb-3">
                <!-- Tab 1: Karya Pendaftar -->
                <a href="{{ route('admin.lomba.index') }}" 
                   class="px-4 py-2 rounded-xl text-xs font-bold transition-all flex items-center gap-2 bg-white text-slate-600 hover:bg-slate-100 hover:text-slate-900 border border-slate-200 shadow-2xs">
                    <span class="material-symbols-outlined text-[18px] text-slate-400">emoji_events</span>
                    <span>Data Karya Inovasi</span>
                </a>

                <!-- Tab 2: Akun Peserta (Aktif) -->
                <a href="{{ route('admin.lomba.akun.index') }}" 
                   class="px-4 py-2 rounded-xl text-xs font-bold transition-all flex items-center gap-2 bg-[#00A3E0] text-white shadow-xs">
                    <span class="material-symbols-outlined text-[18px]">group</span>
                    <span>Daftar Akun Peserta</span>
                </a>
            </div>

            <!-- Top Page Title & Quick Actions -->
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-3 sm:gap-4">
                <div class="min-w-0">
                    <h1 class="text-xl sm:text-2xl font-black text-gray-900 tracking-tight flex items-center gap-2.5">
                        <span class="material-symbols-outlined text-[#00A3E0] text-2xl sm:text-3xl shrink-0">badge</span>
                        <span class="truncate">Daftar Akun Peserta Lomba TTG</span>
                    </h1>
                    <p class="text-xs text-gray-500 mt-1 max-w-2xl">
                        Data seluruh akun inovator dan peserta yang terdaftar pada sistem lomba inovasi teknologi tepat guna Kota Tasikmalaya.
                    </p>
                </div>

                <!-- 3 Action Buttons (Sejajar Satu Baris - No Wrap) -->
                <div class="flex items-center gap-2 shrink-0 flex-nowrap overflow-x-auto pb-1 lg:pb-0">
                    <!-- Cetak Rekap (Print View) -->
                    <a href="{{ route('admin.lomba.akun.print', request()->query()) }}" target="_blank" 
                       class="px-3.5 py-2 bg-white hover:bg-slate-50 border border-slate-200 text-slate-700 font-bold text-xs rounded-xl shadow-2xs transition-all flex items-center gap-1.5 cursor-pointer whitespace-nowrap shrink-0" 
                       title="Cetak Rekapitulasi (Tampilan Cetak)">
                        <span class="material-symbols-outlined text-[17px] text-slate-500">print</span>
                        <span>Cetak Rekap</span>
                    </a>

                    <!-- Download PDF -->
                    <a href="{{ route('admin.lomba.akun.export.pdf', request()->query()) }}" 
                       class="px-3.5 py-2 bg-rose-50 hover:bg-rose-100 border border-rose-200 text-rose-700 font-bold text-xs rounded-xl shadow-2xs transition-all flex items-center gap-1.5 cursor-pointer whitespace-nowrap shrink-0" 
                       title="Unduh Laporan Format PDF">
                        <span class="material-symbols-outlined text-[17px] text-rose-600">picture_as_pdf</span>
                        <span>Download PDF</span>
                    </a>

                    <!-- Download Excel -->
                    <a href="{{ route('admin.lomba.akun.export.excel', request()->query()) }}" 
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
                $currentKategori = request('kategori');
                $currentPartisipasi = request('partisipasi');
                $baseQuery = request()->except(['kategori', 'partisipasi', 'page']);
            @endphp
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                <!-- Total Akun -->
                <a href="{{ route('admin.lomba.akun.index', $baseQuery) }}" 
                   class="p-3.5 sm:p-4 rounded-xl border shadow-xs space-y-0.5 transition-all block group cursor-pointer hover:shadow-md hover:-translate-y-0.5 {{ empty($currentKategori) && empty($currentPartisipasi) ? 'bg-sky-50/60 border-[#00A3E0] ring-2 ring-[#00A3E0]/20' : 'bg-white border-gray-100 hover:border-slate-300' }}"
                   title="Semua Akun Peserta">
                    <div class="flex items-center justify-between">
                        <span class="text-[11px] font-bold block {{ empty($currentKategori) && empty($currentPartisipasi) ? 'text-[#00A3E0]' : 'text-gray-400' }}">Total Akun Peserta</span>
                        @if(empty($currentKategori) && empty($currentPartisipasi))
                        <span class="w-1.5 h-1.5 rounded-full bg-[#00A3E0]"></span>
                        @endif
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-xl sm:text-2xl font-black text-gray-900">{{ $stats['total'] }}</span>
                        <span class="p-1.5 rounded-lg material-symbols-outlined text-lg transition-transform group-hover:scale-110 {{ empty($currentKategori) && empty($currentPartisipasi) ? 'bg-[#00A3E0] text-white shadow-xs' : 'bg-sky-50 text-[#00A3E0]' }}">group</span>
                    </div>
                </a>

                <!-- SMA/SMK Sederajat -->
                <a href="{{ route('admin.lomba.akun.index', array_merge($baseQuery, ['kategori' => 'SMA/SMK Sederajat'])) }}" 
                   class="p-3.5 sm:p-4 rounded-xl border shadow-xs space-y-0.5 transition-all block group cursor-pointer hover:shadow-md hover:-translate-y-0.5 {{ $currentKategori === 'SMA/SMK Sederajat' ? 'bg-amber-50/60 border-amber-500 ring-2 ring-amber-500/20' : 'bg-white border-gray-100 hover:border-amber-200' }}"
                   title="Kategori Pelajar (SMA/SMK)">
                    <div class="flex items-center justify-between">
                        <span class="text-amber-500 text-[11px] font-bold block">SMA/SMK Sederajat</span>
                        @if($currentKategori === 'SMA/SMK Sederajat')
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                        @endif
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-xl sm:text-2xl font-black text-amber-600">{{ $stats['sma'] }}</span>
                        <span class="p-1.5 rounded-lg material-symbols-outlined text-lg transition-transform group-hover:scale-110 {{ $currentKategori === 'SMA/SMK Sederajat' ? 'bg-amber-500 text-white shadow-xs' : 'bg-amber-50 text-amber-500' }}">school</span>
                    </div>
                </a>

                <!-- Perguruan Tinggi -->
                <a href="{{ route('admin.lomba.akun.index', array_merge($baseQuery, ['kategori' => 'Perguruan Tinggi'])) }}" 
                   class="p-3.5 sm:p-4 rounded-xl border shadow-xs space-y-0.5 transition-all block group cursor-pointer hover:shadow-md hover:-translate-y-0.5 {{ $currentKategori === 'Perguruan Tinggi' ? 'bg-emerald-50/60 border-emerald-500 ring-2 ring-emerald-500/20' : 'bg-white border-gray-100 hover:border-emerald-200' }}"
                   title="Kategori Mahasiswa (Perguruan Tinggi)">
                    <div class="flex items-center justify-between">
                        <span class="text-emerald-600 text-[11px] font-bold block">Perguruan Tinggi</span>
                        @if($currentKategori === 'Perguruan Tinggi')
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                        @endif
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-xl sm:text-2xl font-black text-emerald-600">{{ $stats['pt'] }}</span>
                        <span class="p-1.5 rounded-lg material-symbols-outlined text-lg transition-transform group-hover:scale-110 {{ $currentKategori === 'Perguruan Tinggi' ? 'bg-emerald-600 text-white shadow-xs' : 'bg-emerald-50 text-emerald-600' }}">account_balance</span>
                    </div>
                </a>

                <!-- Masyarakat Umum -->
                <a href="{{ route('admin.lomba.akun.index', array_merge($baseQuery, ['kategori' => 'Umum'])) }}" 
                   class="p-3.5 sm:p-4 rounded-xl border shadow-xs space-y-0.5 transition-all block group cursor-pointer hover:shadow-md hover:-translate-y-0.5 {{ $currentKategori === 'Umum' ? 'bg-purple-50/60 border-purple-500 ring-2 ring-purple-500/20' : 'bg-white border-gray-100 hover:border-purple-200' }}"
                   title="Kategori Umum">
                    <div class="flex items-center justify-between">
                        <span class="text-purple-600 text-[11px] font-bold block">Masyarakat Umum</span>
                        @if($currentKategori === 'Umum')
                        <span class="w-1.5 h-1.5 rounded-full bg-purple-500"></span>
                        @endif
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-xl sm:text-2xl font-black text-purple-600">{{ $stats['umum'] }}</span>
                        <span class="p-1.5 rounded-lg material-symbols-outlined text-lg transition-transform group-hover:scale-110 {{ $currentKategori === 'Umum' ? 'bg-purple-600 text-white shadow-xs' : 'bg-purple-50 text-purple-600' }}">diversity_3</span>
                    </div>
                </a>
            </div>

            <!-- FILTER & SEARCH BAR -->
            <div class="bg-white p-2.5 sm:p-3 rounded-xl border border-gray-100 shadow-xs">
                <form action="{{ route('admin.lomba.akun.index') }}" method="GET" class="flex flex-col md:flex-row gap-2 items-stretch md:items-center">
                    <!-- Search Input -->
                    <div class="relative flex-1">
                        <span class="absolute inset-y-0 left-0 pl-2.5 flex items-center pointer-events-none material-symbols-outlined text-gray-400 text-base">search</span>
                        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama peserta, email, nomor WA, atau instansi..." 
                               class="w-full pl-8 pr-3 py-1.5 text-xs bg-slate-50 border border-slate-200 rounded-lg focus:bg-white focus:ring-2 focus:ring-[#00A3E0]/20 focus:border-[#00A3E0] outline-none transition-all">
                    </div>

                    <!-- Filter Kategori -->
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

                    <!-- Filter Status Partisipasi -->
                    <div class="relative shrink-0">
                        <select name="partisipasi" onchange="this.form.submit()" class="appearance-none w-full md:w-auto min-w-[185px] text-xs bg-slate-50 border border-slate-200 rounded-lg pl-3 pr-8 py-1.5 font-medium text-slate-700 focus:bg-white focus:ring-2 focus:ring-[#00A3E0]/20 focus:border-[#00A3E0] outline-none cursor-pointer transition-all">
                            <option value="">Semua Partisipasi</option>
                            <option value="sudah" {{ request('partisipasi') == 'sudah' ? 'selected' : '' }}>Sudah Mendaftar Karya ({{ $stats['sudah_daftar'] }})</option>
                            <option value="belum" {{ request('partisipasi') == 'belum' ? 'selected' : '' }}>Belum Mendaftar Karya ({{ $stats['belum_daftar'] }})</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2 text-slate-400">
                            <span class="material-symbols-outlined text-[18px]">expand_more</span>
                        </div>
                    </div>

                    <!-- Hidden submit button for Enter key -->
                    <button type="submit" class="hidden"></button>

                    <!-- Tombol Reset Filter -->
                    <a href="{{ route('admin.lomba.akun.index') }}" class="px-3.5 py-1.5 bg-[#00A3E0] hover:bg-[#008cc0] active:scale-[0.99] text-white font-bold text-xs rounded-lg shadow-2xs transition-all flex items-center justify-center gap-1 cursor-pointer whitespace-nowrap shrink-0" title="Reset Semua Filter">
                        <span class="material-symbols-outlined text-[16px]">restart_alt</span>
                        <span>Reset</span>
                    </a>
                </form>
            </div>

            <!-- TABLE DAFTAR AKUN PESERTA -->
            <div class="bg-white rounded-xl border border-gray-100 shadow-xs overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs border-collapse min-w-[900px]">
                        <thead class="bg-slate-50/90 border-b border-slate-200/80 text-slate-500 font-bold uppercase tracking-wider text-[10px]">
                            <tr>
                                <th class="py-2.5 px-3 whitespace-nowrap w-[45px] text-center">No</th>
                                <th class="py-2.5 px-3 min-w-[190px]">Nama Peserta & Akun</th>
                                <th class="py-2.5 px-2 text-center whitespace-nowrap w-[135px]">Kategori</th>
                                <th class="py-2.5 px-3 min-w-[160px]">Asal Instansi</th>
                                <th class="py-2.5 px-3 whitespace-nowrap w-[130px]">Kontak WhatsApp</th>
                                <th class="py-2.5 px-3 text-center whitespace-nowrap w-[140px]">Status Partisipasi</th>
                                <th class="py-2.5 px-3 text-center whitespace-nowrap w-[110px] sticky right-0 z-20 bg-slate-50 shadow-[-3px_0_6px_-2px_rgba(0,0,0,0.06)]">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($users as $index => $user)
                            <tr class="hover:bg-slate-50/80 transition-colors group">
                                <!-- No -->
                                <td class="py-2.5 px-3 whitespace-nowrap text-center align-middle font-mono text-slate-400 text-[11px]">
                                    {{ $users->firstItem() + $index }}
                                </td>

                                <!-- Nama & Email -->
                                <td class="py-2.5 px-3 min-w-[190px] align-middle">
                                    <strong class="text-slate-900 block font-bold text-xs truncate" title="{{ $user->name }}">
                                        {{ $user->name }}
                                    </strong>
                                    <span class="text-slate-400 text-[10px] block truncate font-mono mt-0.5" title="{{ $user->email }}">
                                        {{ $user->email }}
                                    </span>
                                </td>

                                <!-- Kategori -->
                                <td class="py-2.5 px-2 whitespace-nowrap text-center align-middle">
                                    <span class="inline-flex items-center justify-center min-w-[125px] py-1 px-2.5 bg-sky-50 text-[#00A3E0] font-bold rounded-lg text-[10px] border border-sky-200/80 shadow-2xs leading-tight tracking-tight text-center whitespace-nowrap">
                                        {{ $user->kategori ?? 'Umum' }}
                                    </span>
                                </td>

                                <!-- Asal Instansi -->
                                <td class="py-2.5 px-3 min-w-[160px] align-middle">
                                    <span class="text-slate-700 font-semibold text-xs block truncate" title="{{ $user->asal_instansi ?? '-' }}">
                                        {{ $user->asal_instansi ?? '-' }}
                                    </span>
                                </td>

                                <!-- Kontak WA -->
                                <td class="py-2.5 px-3 whitespace-nowrap align-middle">
                                    @if($user->no_wa)
                                    @php
                                        $cleanWa = preg_replace('/[^0-9]/', '', $user->no_wa);
                                        if (str_starts_with($cleanWa, '0')) {
                                            $cleanWa = '62' . substr($cleanWa, 1);
                                        }
                                    @endphp
                                    <a href="https://wa.me/{{ $cleanWa }}" target="_blank" rel="noopener noreferrer" 
                                       class="inline-flex items-center gap-1.5 text-emerald-600 hover:text-emerald-700 font-mono font-medium text-xs hover:underline"
                                       title="Chat WhatsApp Peserta">
                                        <span class="material-symbols-outlined text-[15px] text-emerald-500">chat</span>
                                        <span>{{ $user->no_wa }}</span>
                                    </a>
                                    @else
                                    <span class="text-slate-300 text-xs">-</span>
                                    @endif
                                </td>

                                <!-- Status Partisipasi / Jumlah Karya -->
                                <td class="py-2.5 px-3 whitespace-nowrap text-center align-middle">
                                    @if($user->pendaftaran_lomba_count > 0)
                                    <span class="inline-flex items-center justify-center gap-1 min-w-[125px] px-2.5 py-1 rounded-full font-bold text-[10px] border leading-tight bg-emerald-50 text-emerald-700 border-emerald-200 shadow-2xs">
                                        <span class="material-symbols-outlined text-[13px]">verified</span>
                                        <span>{{ $user->pendaftaran_lomba_count }} Karya Terdaftar</span>
                                    </span>
                                    @else
                                    <span class="inline-flex items-center justify-center gap-1 min-w-[125px] px-2.5 py-1 rounded-full font-bold text-[10px] border leading-tight bg-slate-50 text-slate-500 border-slate-200">
                                        <span class="material-symbols-outlined text-[13px]">hourglass_empty</span>
                                        <span>Belum Mengajukan</span>
                                    </span>
                                    @endif
                                </td>

                                <!-- Aksi (Sticky Right) -->
                                <td class="py-2.5 px-3 whitespace-nowrap text-center align-middle sticky right-0 z-10 bg-white group-hover:bg-slate-50 transition-colors shadow-[-3px_0_6px_-2px_rgba(0,0,0,0.06)]">
                                    <div class="flex items-center justify-center gap-1">
                                        <!-- Tombol Detail Akun -->
                                        <button type="button" 
                                                onclick="openDetailUserModal({{ $user->id }})"
                                                class="p-1.5 bg-sky-50 hover:bg-[#00A3E0] text-[#00A3E0] hover:text-white rounded-lg transition-all shadow-2xs cursor-pointer" 
                                                title="Lihat Detail Profil & Karya Inovasi">
                                            <span class="material-symbols-outlined text-[17px]">visibility</span>
                                        </button>

                                        <!-- Tombol Chat WA -->
                                        @if($user->no_wa)
                                        <a href="https://wa.me/{{ $cleanWa }}" target="_blank" rel="noopener noreferrer" 
                                           class="p-1.5 bg-emerald-50 hover:bg-emerald-600 text-emerald-600 hover:text-white rounded-lg transition-all shadow-2xs" 
                                           title="Kirim Pesan WhatsApp">
                                            <span class="material-symbols-outlined text-[17px]">chat</span>
                                        </a>
                                        @endif

                                        <!-- Tombol Hapus Akun -->
                                        <button type="button" 
                                                onclick="openDeleteAkunModal('{{ route('admin.lomba.akun.destroy', $user->id) }}', '{{ addslashes($user->name) }}', this)"
                                                class="p-1.5 bg-rose-50 hover:bg-rose-600 text-rose-600 hover:text-white rounded-lg transition-all cursor-pointer shadow-2xs" 
                                                title="Hapus Akun Peserta">
                                            <span class="material-symbols-outlined text-[17px]">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="py-12 text-center text-gray-400">
                                    <span class="material-symbols-outlined text-3xl mb-1 block">group_off</span>
                                    <p class="font-bold text-gray-500 text-xs">Tidak ada akun peserta ditemukan.</p>
                                    <p class="text-[10px] mt-0.5">Belum ada akun yang terdaftar atau sesuaikan kata kunci pencarian Anda.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="p-3 sm:p-4 border-t border-slate-100 bg-white">
                    @include('partials.pagination', ['paginator' => $users, 'itemLabel' => 'Akun Peserta'])
                </div>
            </div>

        </div>

    </div>

    <!-- MODAL DETAIL AKUN PESERTA -->
    <div id="modal-detail-user" class="fixed inset-0 z-[9999] hidden items-center justify-center bg-slate-900/60 backdrop-blur-sm p-4">
        <div class="bg-white rounded-3xl shadow-2xl max-w-xl w-full overflow-hidden border border-slate-100 flex flex-col max-h-[90vh]">
            <!-- Header Modal -->
            <div class="p-4 sm:p-5 border-b border-gray-100 flex items-center justify-between bg-gradient-to-r from-slate-50 to-sky-50/40">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-2xl bg-[#00A3E0]/10 text-[#00A3E0] flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-2xl">account_circle</span>
                    </div>
                    <div>
                        <h3 class="text-sm sm:text-base font-extrabold text-gray-900 leading-tight" id="detail-user-name">Nama Peserta</h3>
                        <p class="text-xs text-gray-500 mt-0.5" id="detail-user-email">email@example.com</p>
                    </div>
                </div>
                <button type="button" onclick="closeDetailUserModal()" class="w-8 h-8 rounded-full flex items-center justify-center text-gray-400 hover:text-gray-700 hover:bg-gray-200/60 transition-colors cursor-pointer">
                    <span class="material-symbols-outlined text-lg">close</span>
                </button>
            </div>

            <!-- Body Modal -->
            <div class="p-5 space-y-4 overflow-y-auto">
                <!-- Info Grid -->
                <div class="grid grid-cols-2 gap-3 p-3.5 bg-slate-50 rounded-2xl border border-slate-200/70 text-xs">
                    <div>
                        <span class="text-gray-400 text-[10px] block font-medium">Kategori Peserta</span>
                        <strong class="text-slate-800 text-xs" id="detail-user-kategori">-</strong>
                    </div>
                    <div>
                        <span class="text-gray-400 text-[10px] block font-medium">Nomor WhatsApp</span>
                        <strong class="text-slate-800 text-xs font-mono" id="detail-user-wa">-</strong>
                    </div>
                    <div class="col-span-2">
                        <span class="text-gray-400 text-[10px] block font-medium">Asal Instansi / Sekolah / Kampus</span>
                        <strong class="text-slate-800 text-xs" id="detail-user-instansi">-</strong>
                    </div>
                    <div>
                        <span class="text-gray-400 text-[10px] block font-medium">Terdaftar Sejak</span>
                        <span class="text-slate-700 font-medium text-[11px]" id="detail-user-created">-</span>
                    </div>
                    <div>
                        <span class="text-gray-400 text-[10px] block font-medium">Total Karya Diajukan</span>
                        <span class="text-emerald-700 font-bold text-[11px]" id="detail-user-karya-count">0 Karya</span>
                    </div>
                </div>

                <!-- Karya Inovasi Yang Diajukan -->
                <div class="space-y-2">
                    <h4 class="text-xs font-bold text-gray-800 flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-base text-[#00A3E0]">emoji_events</span>
                        <span>Daftar Karya Inovasi yang Diajukan</span>
                    </h4>
                    <div id="detail-user-karya-list" class="space-y-2">
                        <!-- Populated by JS -->
                    </div>
                </div>
            </div>

            <!-- Footer Modal -->
            <div class="p-4 border-t border-gray-100 flex items-center justify-end bg-slate-50">
                <button type="button" onclick="closeDetailUserModal()" class="px-4 py-2 bg-slate-200 hover:bg-slate-300 text-slate-700 font-bold text-xs rounded-xl transition-colors cursor-pointer">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <!-- MODAL HAPUS AKUN PESERTA (Custom SI-RINOVA) -->
    <div id="delete-akun-modal" class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/40 backdrop-blur-sm hidden opacity-0 transition-opacity duration-300">
        <div id="delete-akun-modal-content" class="bg-white rounded-xl shadow-2xl w-full max-w-sm mx-4 p-6 transform scale-95 transition-transform duration-300 border border-gray-100">
            <div class="flex items-center gap-3 text-red-600 mb-4">
                <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center shrink-0">
                    <span class="material-symbols-outlined text-red-600 text-xl">warning</span>
                </div>
                <h3 class="text-lg font-bold text-gray-900">Hapus Akun Peserta?</h3>
            </div>
            <p class="text-sm text-gray-600 mb-6 leading-relaxed">
                Apakah Anda yakin ingin menghapus akun peserta <span id="delete-akun-name" class="font-bold text-gray-900"></span>? Semua proposal dan data yang terhubung dengan akun ini akan ikut terhapus. Tindakan ini tidak dapat dibatalkan.
            </p>
            <form id="delete-akun-form" method="POST" action="">
                @csrf
                @method('DELETE')
                <div class="flex items-center justify-end gap-2 mt-4">
                    <button type="button"
                        id="cancel-delete-akun"
                        onclick="closeDeleteAkunModal()"
                        class="px-4 py-2 border border-gray-300 text-gray-700 text-sm rounded-md hover:bg-gray-50 font-medium cursor-pointer transition-colors">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-4 py-2 bg-red-600 text-white text-sm rounded-md hover:bg-red-700 shadow-sm font-medium cursor-pointer transition-colors">
                        Hapus Akun
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Floating Toast Notification -->
    <div id="toast-notification" class="fixed top-5 right-5 z-[10000] flex items-center gap-2.5 px-4 py-3 bg-emerald-600 text-white text-xs font-bold rounded-xl shadow-2xl transition-all duration-300 transform translate-y-[-100px] opacity-0 pointer-events-none">
        <span class="material-symbols-outlined text-lg leading-none">check_circle</span>
        <span id="toast-message">Data berhasil diperbarui.</span>
    </div>

    <!-- Scripts -->
    <script>
        // Modal Detail User
        function openDetailUserModal(userId) {
            const modal = document.getElementById('modal-detail-user');
            modal.classList.remove('hidden');
            modal.classList.add('flex');

            document.getElementById('detail-user-karya-list').innerHTML = `
                <div class="p-4 text-center text-gray-400 text-xs">
                    <span class="inline-block animate-spin mr-1">&#9696;</span> Memuat data profil & karya...
                </div>
            `;

            fetch(`/admin/lomba/akun/${userId}`, {
                headers: { 'Accept': 'application/json' }
            })
            .then(res => res.json())
            .then(data => {
                document.getElementById('detail-user-name').textContent = data.name;
                document.getElementById('detail-user-email').textContent = data.email;
                document.getElementById('detail-user-kategori').textContent = data.kategori || 'Umum';
                document.getElementById('detail-user-wa').textContent = data.no_wa || '-';
                document.getElementById('detail-user-instansi').textContent = data.asal_instansi || '-';
                document.getElementById('detail-user-created').textContent = data.created_at_formatted;
                document.getElementById('detail-user-karya-count').textContent = data.karya.length + ' Karya';

                const listContainer = document.getElementById('detail-user-karya-list');
                if (data.karya.length === 0) {
                    listContainer.innerHTML = `
                        <div class="p-3 bg-slate-50 border border-slate-200 rounded-xl text-center text-xs text-slate-400">
                            Peserta ini belum mengajukan karya inovasi pada kompetisi TTG.
                        </div>
                    `;
                } else {
                    let html = '';
                    data.karya.forEach(item => {
                        html += `
                            <div class="p-3 bg-slate-50 hover:bg-sky-50/50 border border-slate-200/80 rounded-xl transition-colors flex items-center justify-between gap-2">
                                <div class="min-w-0">
                                    <div class="flex items-center gap-2">
                                        <span class="font-mono text-[9px] bg-slate-200 text-slate-700 px-1 rounded">${item.nomor_registrasi}</span>
                                        <strong class="text-xs font-bold text-slate-900 truncate">${item.nama_alat}</strong>
                                    </div>
                                    <p class="text-[10px] text-slate-400 mt-0.5 truncate">${item.fungsi || '-'}</p>
                                </div>
                                <div class="flex items-center gap-1.5 shrink-0">
                                    <span class="text-[9px] font-bold px-2 py-0.5 rounded-full border ${item.status_badge}">${item.status}</span>
                                    <a href="/admin/lomba/${item.id}" class="p-1 bg-sky-100 text-[#00A3E0] hover:bg-[#00A3E0] hover:text-white rounded-md transition-colors" title="Buka Detail Karya">
                                        <span class="material-symbols-outlined text-[15px]">open_in_new</span>
                                    </a>
                                </div>
                            </div>
                        `;
                    });
                    listContainer.innerHTML = html;
                }
            })
            .catch(err => {
                console.error(err);
                document.getElementById('detail-user-karya-list').innerHTML = `
                    <div class="p-3 bg-rose-50 text-rose-600 text-xs text-center rounded-xl">
                        Gagal memuat detail karya peserta.
                    </div>
                `;
            });
        }

        function closeDetailUserModal() {
            const modal = document.getElementById('modal-detail-user');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        document.getElementById('modal-detail-user').addEventListener('click', function(e) {
            if (e.target === this) closeDetailUserModal();
        });

        // Modal Hapus Akun
        const deleteAkunModal = document.getElementById('delete-akun-modal');
        const deleteAkunModalContent = document.getElementById('delete-akun-modal-content');
        const deleteAkunForm = document.getElementById('delete-akun-form');
        const deleteAkunName = document.getElementById('delete-akun-name');
        let currentDeletingRow = null;

        function openDeleteAkunModal(actionUrl, userName, triggerBtn = null) {
            if (deleteAkunForm) deleteAkunForm.action = actionUrl;
            if (deleteAkunName) deleteAkunName.textContent = userName ? `"${userName}"` : '';
            currentDeletingRow = triggerBtn ? triggerBtn.closest('tr') : null;

            if (deleteAkunModal && deleteAkunModalContent) {
                deleteAkunModal.classList.remove('hidden');
                void deleteAkunModal.offsetWidth;
                deleteAkunModal.classList.remove('opacity-0');
                deleteAkunModalContent.classList.remove('scale-95');
            }
        }

        function closeDeleteAkunModal() {
            if (!deleteAkunModal || !deleteAkunModalContent) return;
            deleteAkunModal.classList.add('opacity-0');
            deleteAkunModalContent.classList.add('scale-95');
            setTimeout(() => {
                deleteAkunModal.classList.add('hidden');
            }, 300);
        }

        deleteAkunModal?.addEventListener('click', function(e) {
            if (e.target === this) closeDeleteAkunModal();
        });

        // AJAX Delete Akun (No Scroll Jump)
        deleteAkunForm?.addEventListener('submit', function(e) {
            e.preventDefault();
            const submitBtn = deleteAkunForm.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="inline-block animate-spin mr-1">&#9696;</span>Menghapus...';

            fetch(deleteAkunForm.action, {
                method: 'POST',
                body: new FormData(deleteAkunForm),
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(res => {
                if (!res.ok) throw new Error('Gagal menghapus akun.');
                return res.json();
            })
            .then(data => {
                closeDeleteAkunModal();
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;

                if (currentDeletingRow) {
                    currentDeletingRow.style.transition = 'all 0.35s ease';
                    currentDeletingRow.style.backgroundColor = '#fee2e2';
                    currentDeletingRow.style.opacity = '0';
                    currentDeletingRow.style.transform = 'scale(0.97)';
                    setTimeout(() => {
                        currentDeletingRow.remove();
                        currentDeletingRow = null;
                    }, 350);
                }

                showToast(data.message || 'Akun peserta berhasil dihapus.');
            })
            .catch(err => {
                console.error(err);
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
                deleteAkunForm.submit();
            });
        });

        // Toast
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

        // Escape Key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeDetailUserModal();
                closeDeleteAkunModal();
            }
        });
    </script>

</body>
</html>
