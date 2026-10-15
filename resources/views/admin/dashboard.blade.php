<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Dashboard - Admin Panel</title>
    <!-- Favicon Logo Tasikmalaya -->
    <link rel="icon" type="image/png" href="{{ asset('storage/images/favicon_tasik.png') }}?v=3">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=3">
    <link rel="apple-touch-icon" href="{{ asset('storage/images/favicon_tasik.png') }}?v=3">
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Public+Sans:wght@600;700&display=swap"
        rel="stylesheet">

    <!-- ApexCharts CDN -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f7f6;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Public Sans', sans-serif;
        }

        /* Hide scrollbar completely */
        * {
            -ms-overflow-style: none !important;
            scrollbar-width: none !important;
        }

        *::-webkit-scrollbar {
            display: none !important;
            width: 0 !important;
            height: 0 !important;
        }
    </style>
</head>

<body class="text-gray-800 min-h-screen antialiased flex overflow-hidden">

    <!-- SIDEBAR -->
    @include('partials.sidebar')

    <!-- MAIN CONTENT -->
    <div class="flex-1 flex flex-col h-screen md:ml-[260px] w-full md:w-[calc(100%-260px)] overflow-y-auto">

        <!-- Header Mobile Toggle -->
        <header class="md:hidden bg-white border-b flex justify-between items-center h-14 px-4 sticky top-0 z-40">
            <button class="p-2 text-gray-500 rounded hover:bg-gray-100" id="menu-btn">
                <span class="material-symbols-outlined">menu</span>
            </button>
            <span class="text-lg font-bold text-gray-900">Dashboard Admin</span>
        </header>

        <main class="flex-1 p-5 md:p-6 space-y-5">

            <!-- Header Title & Quick Actions -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white p-4.5 sm:p-5 rounded-2xl border border-gray-100 shadow-[0_2px_10px_rgba(0,0,0,0.03)]">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Dashboard Overview</h2>
                    <p class="text-xs text-gray-500 mt-1">Ringkasan data, Indikator Makro, dan sebaran Teknologi Tepat Guna Kota Tasikmalaya hari ini.</p>
                </div>
                <div class="flex items-center gap-2 sm:gap-2.5 flex-wrap sm:flex-nowrap shrink-0">
                    <a href="/admin/indikator-makro"
                        class="bg-white border border-gray-200/90 text-gray-700 hover:text-gray-900 px-3.5 py-2.5 rounded-xl hover:bg-gray-50 hover:border-gray-300 transition-all flex items-center gap-1.5 font-semibold text-xs shadow-2xs whitespace-nowrap">
                        <span class="material-symbols-outlined text-[#29abe2] text-[18px]">equalizer</span>
                        <span>Kelola Indikator</span>
                    </a>
                    <a href="{{ route('admin.lomba.index') }}"
                        class="bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white px-3.5 py-2.5 rounded-xl transition-all flex items-center gap-1.5 font-semibold text-xs shadow-sm shadow-amber-500/20 whitespace-nowrap">
                        <span class="material-symbols-outlined text-[18px]">emoji_events</span>
                        <span>Pendaftar Lomba</span>
                        @if($lombaMenunggu > 0)
                            <span class="ml-1 min-w-[18px] h-[18px] px-1.5 bg-rose-600 text-white font-bold rounded-full text-[10px] inline-flex items-center justify-center shadow-xs">
                                {{ $lombaMenunggu }}
                            </span>
                        @endif
                    </a>
                    <a href="/admin/alat/create"
                        class="bg-[#29abe2] hover:bg-[#1a95c9] text-white px-3.5 py-2.5 rounded-xl transition-all flex items-center gap-1.5 font-semibold text-xs shadow-sm shadow-cyan-500/20 whitespace-nowrap">
                        <span class="material-symbols-outlined text-[18px]">add</span>
                        <span>Tambah Alat TTG</span>
                    </a>
                </div>
            </div>

            <!-- Refined Metric Cards (9 Grid Layout) -->
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-5 xl:grid-cols-9 gap-3">

                <!-- Card 1: Total Alat -->
                <a href="/admin/alat"
                    class="bg-white rounded-xl p-3.5 border border-gray-100 shadow-[0_2px_8px_rgba(0,0,0,0.03)] hover:border-[#29abe2] hover:shadow-md transition-all group cursor-pointer flex flex-col justify-between">
                    <div class="flex items-start justify-between gap-1">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider group-hover:text-[#29abe2] transition-colors truncate" title="Total Alat TTG">Total Alat TTG</p>
                        <div class="w-8 h-8 rounded-lg bg-blue-50 text-[#29abe2] flex items-center justify-center group-hover:scale-105 transition-transform shrink-0">
                            <span class="material-symbols-outlined text-[18px]">inventory_2</span>
                        </div>
                    </div>
                    <div class="mt-2">
                        <p class="text-2xl font-bold text-gray-900 leading-none">{{ $totalAlat }}</p>
                        <span class="text-[10px] text-emerald-600 font-semibold flex items-center gap-1 mt-1.5 whitespace-nowrap truncate">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 shrink-0"></span> {{ $statusPublik }} Publik
                        </span>
                    </div>
                </a>

                <!-- Card 2: Indikator Makro -->
                <a href="/admin/indikator-makro"
                    class="bg-white rounded-xl p-3.5 border border-gray-100 shadow-[0_2px_8px_rgba(0,0,0,0.03)] hover:border-sky-400 hover:shadow-md transition-all group cursor-pointer flex flex-col justify-between">
                    <div class="flex items-start justify-between gap-1">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider group-hover:text-sky-500 transition-colors truncate" title="Indikator Makro">Indikator Makro</p>
                        <div class="w-8 h-8 rounded-lg bg-sky-50 text-sky-600 flex items-center justify-center group-hover:scale-105 transition-transform shrink-0">
                            <span class="material-symbols-outlined text-[18px]">equalizer</span>
                        </div>
                    </div>
                    <div class="mt-2">
                        <p class="text-2xl font-bold text-gray-900 leading-none">{{ $totalIndikator }}</p>
                        <span class="text-[10px] text-sky-600 font-semibold flex items-center gap-1 mt-1.5 whitespace-nowrap truncate">
                            <span class="material-symbols-outlined text-[13px] shrink-0">bar_chart</span> Data 27 Daerah
                        </span>
                    </div>
                </a>

                <!-- Card 3: Inovator -->
                <a href="/admin/inovator"
                    class="bg-white rounded-xl p-3.5 border border-gray-100 shadow-[0_2px_8px_rgba(0,0,0,0.03)] hover:border-amber-400 hover:shadow-md transition-all group cursor-pointer flex flex-col justify-between">
                    <div class="flex items-start justify-between gap-1">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider group-hover:text-amber-500 transition-colors truncate" title="Inovator">Inovator</p>
                        <div class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center group-hover:scale-105 transition-transform shrink-0">
                            <span class="material-symbols-outlined text-[18px]">groups</span>
                        </div>
                    </div>
                    <div class="mt-2">
                        <p class="text-2xl font-bold text-gray-900 leading-none">{{ $totalInovator }}</p>
                        <span class="text-[10px] text-amber-600 font-semibold flex items-center gap-1 mt-1.5 whitespace-nowrap truncate">
                            <span class="material-symbols-outlined text-[13px] shrink-0">verified</span> Mitra & Sekolah
                        </span>
                    </div>
                </a>

                <!-- Card 4: Kategori -->
                <a href="/admin/kategori"
                    class="bg-white rounded-xl p-3.5 border border-gray-100 shadow-[0_2px_8px_rgba(0,0,0,0.03)] hover:border-purple-400 hover:shadow-md transition-all group cursor-pointer flex flex-col justify-between">
                    <div class="flex items-start justify-between gap-1">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider group-hover:text-purple-500 transition-colors truncate" title="Kategori">Kategori</p>
                        <div class="w-8 h-8 rounded-lg bg-purple-50 text-purple-600 flex items-center justify-center group-hover:scale-105 transition-transform shrink-0">
                            <span class="material-symbols-outlined text-[18px]">category</span>
                        </div>
                    </div>
                    <div class="mt-2">
                        <p class="text-2xl font-bold text-gray-900 leading-none">{{ $totalKategori }}</p>
                        <span class="text-[10px] text-purple-600 font-semibold flex items-center gap-1 mt-1.5 whitespace-nowrap truncate">
                            <span class="material-symbols-outlined text-[13px] shrink-0">category</span> Terklasifikasi
                        </span>
                    </div>
                </a>

                <!-- Card 5: Wilayah -->
                <a href="/admin/wilayah"
                    class="bg-white rounded-xl p-3.5 border border-gray-100 shadow-[0_2px_8px_rgba(0,0,0,0.03)] hover:border-[#29abe2] hover:shadow-md transition-all group cursor-pointer flex flex-col justify-between">
                    <div class="flex items-start justify-between gap-1">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider group-hover:text-[#29abe2] transition-colors truncate" title="Wilayah">Wilayah</p>
                        <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center group-hover:scale-105 transition-transform shrink-0">
                            <span class="material-symbols-outlined text-[18px]">map</span>
                        </div>
                    </div>
                    <div class="mt-2">
                        <p class="text-2xl font-bold text-gray-900 leading-none">{{ $totalWilayah }} <span class="text-xs font-normal text-gray-400">Kec.</span></p>
                        <span class="text-[10px] text-emerald-600 font-semibold flex items-center gap-1 mt-1.5 whitespace-nowrap truncate">
                            <span class="material-symbols-outlined text-[13px] shrink-0">location_on</span> Kota Tasikmalaya
                        </span>
                    </div>
                </a>

                <!-- Card 6: E-Book Kajian -->
                <a href="/admin/ebook"
                    class="bg-white rounded-xl p-3.5 border border-gray-100 shadow-[0_2px_8px_rgba(0,0,0,0.03)] hover:border-cyan-400 hover:shadow-md transition-all group cursor-pointer flex flex-col justify-between">
                    <div class="flex items-start justify-between gap-1">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider group-hover:text-cyan-500 transition-colors truncate" title="E-Book Kajian">E-Book Kajian</p>
                        <div class="w-8 h-8 rounded-lg bg-cyan-50 text-cyan-600 flex items-center justify-center group-hover:scale-105 transition-transform shrink-0">
                            <span class="material-symbols-outlined text-[18px]">menu_book</span>
                        </div>
                    </div>
                    <div class="mt-2">
                        <p class="text-2xl font-bold text-gray-900 leading-none">{{ $totalEbook }}</p>
                        <span class="text-[10px] text-cyan-600 font-semibold flex items-center gap-1 mt-1.5 whitespace-nowrap truncate">
                            <span class="material-symbols-outlined text-[13px] shrink-0">menu_book</span> Dokumen Kajian
                        </span>
                    </div>
                </a>

                <!-- Card 7: Telaahan Staf -->
                <a href="/admin/telaahan-staf"
                    class="bg-white rounded-xl p-3.5 border border-gray-100 shadow-[0_2px_8px_rgba(0,0,0,0.03)] hover:border-indigo-400 hover:shadow-md transition-all group cursor-pointer flex flex-col justify-between">
                    <div class="flex items-start justify-between gap-1">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider group-hover:text-indigo-500 transition-colors truncate" title="Telaahan Staf">Telaahan Staf</p>
                        <div class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center group-hover:scale-105 transition-transform shrink-0">
                            <span class="material-symbols-outlined text-[18px]">description</span>
                        </div>
                    </div>
                    <div class="mt-2">
                        <p class="text-2xl font-bold text-gray-900 leading-none">{{ $totalTelaahan }}</p>
                        <span class="text-[10px] text-indigo-600 font-semibold flex items-center gap-1 mt-1.5 whitespace-nowrap truncate">
                            <span class="material-symbols-outlined text-[13px] shrink-0">description</span> Dokumen Resmi
                        </span>
                    </div>
                </a>

                <!-- Card 8: Galeri Kegiatan -->
                <a href="/admin/galeri"
                    class="bg-white rounded-xl p-3.5 border border-gray-100 shadow-[0_2px_8px_rgba(0,0,0,0.03)] hover:border-rose-400 hover:shadow-md transition-all group cursor-pointer flex flex-col justify-between">
                    <div class="flex items-start justify-between gap-1">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider group-hover:text-rose-500 transition-colors truncate" title="Galeri Kegiatan">Galeri Kegiatan</p>
                        <div class="w-8 h-8 rounded-lg bg-rose-50 text-rose-600 flex items-center justify-center group-hover:scale-105 transition-transform shrink-0">
                            <span class="material-symbols-outlined text-[18px]">photo_library</span>
                        </div>
                    </div>
                    <div class="mt-2">
                        <p class="text-2xl font-bold text-gray-900 leading-none">{{ $totalGaleri }}</p>
                        <span class="text-[10px] text-rose-600 font-semibold flex items-center gap-1 mt-1.5 whitespace-nowrap truncate">
                            <span class="material-symbols-outlined text-[13px] shrink-0">photo_library</span> Dokumentasi
                        </span>
                    </div>
                </a>

                <!-- Card 9: Lomba TTG -->
                <a href="{{ route('admin.lomba.index') }}"
                    class="bg-white rounded-xl p-3.5 border border-gray-100 shadow-[0_2px_8px_rgba(0,0,0,0.03)] hover:border-amber-400 hover:shadow-md transition-all group cursor-pointer flex flex-col justify-between">
                    <div class="flex items-start justify-between gap-1">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider group-hover:text-amber-500 transition-colors truncate" title="Lomba TTG">Lomba TTG</p>
                        <div class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center group-hover:scale-105 transition-transform shrink-0">
                            <span class="material-symbols-outlined text-[18px]">emoji_events</span>
                        </div>
                    </div>
                    <div class="mt-2">
                        <p class="text-2xl font-bold text-gray-900 leading-none">{{ $totalLomba }}</p>
                        <span class="text-[10px] {{ $lombaMenunggu > 0 ? 'text-amber-600 font-bold' : 'text-slate-500 font-semibold' }} flex items-center gap-1 mt-1.5 whitespace-nowrap truncate">
                            <span class="w-1.5 h-1.5 rounded-full {{ $lombaMenunggu > 0 ? 'bg-amber-500' : 'bg-slate-400' }} shrink-0"></span> {{ $lombaMenunggu }} Menunggu
                        </span>
                    </div>
                </a>
            </div>

            <!-- Analytics Charts (Sebaran Wilayah & Distribusi Kategori) -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-5">

                <!-- Bar Chart: Sebaran Wilayah (7 Cols) -->
                <div class="lg:col-span-7 bg-white rounded-xl p-4 border border-gray-100 shadow-[0_2px_8px_rgba(0,0,0,0.03)] flex flex-col justify-between">
                    <div class="border-b border-gray-100 pb-3 mb-3">
                        <h3 class="text-sm font-bold text-gray-900 flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-[#29abe2] text-[18px]">bar_chart</span>
                            Sebaran Alat TTG per Kecamatan
                        </h3>
                    </div>
                    
                    <div id="chart-wilayah" class="w-full min-h-[230px]"></div>
                </div>

                <!-- Donut Chart: Distribusi Kategori (5 Cols) -->
                <div class="lg:col-span-5 bg-white rounded-xl p-4 border border-gray-100 shadow-[0_2px_8px_rgba(0,0,0,0.03)] flex flex-col justify-between">
                    <div class="border-b border-gray-100 pb-3 mb-3">
                        <h3 class="text-sm font-bold text-gray-900 flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-purple-600 text-[18px]">pie_chart</span>
                            Distribusi Kategori Sektor
                        </h3>
                    </div>

                    <div id="chart-kategori" class="w-full flex justify-center items-center py-1"></div>

                    <!-- Mini Footer Status -->
                    <div class="mt-2 pt-2.5 border-t border-gray-100 flex justify-around text-center text-xs">
                        <div>
                            <span class="text-gray-400 text-[10px] uppercase font-bold block">Publik</span>
                            <span class="font-bold text-emerald-600 text-sm">{{ $statusPublik }}</span>
                        </div>
                        <div class="w-px bg-gray-100"></div>
                        <div>
                            <span class="text-gray-400 text-[10px] uppercase font-bold block">Draft</span>
                            <span class="font-bold text-gray-600 text-sm">{{ $statusDraft }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Grafik Perbandingan Indikator Makro (Replacing Inovasi Alat TTG Terbaru Table) -->
            <div class="bg-white rounded-xl p-5 border border-gray-100 shadow-[0_2px_8px_rgba(0,0,0,0.03)] flex flex-col justify-between">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between border-b border-gray-100 pb-3.5 mb-3 gap-2">
                    <div>
                        <h3 class="text-base font-bold text-gray-900 flex items-center gap-2">
                            <span class="material-symbols-outlined text-[#29abe2] text-[20px]">equalizer</span>
                            Grafik Perbandingan Indikator Makro Jawa Barat
                        </h3>
                        <p class="text-xs text-gray-500 mt-0.5">Komparasi nilai Kota Tasikmalaya dibanding 26 Kabupaten / Kota se-Jawa Barat</p>
                    </div>
                    <div class="flex flex-wrap items-center gap-2">
                        <!-- Filter Indikator -->
                        <div class="relative">
                            <select id="dashboard-filter-indikator" onchange="updateDashboardIndikatorChart()"
                                class="text-xs font-semibold rounded-lg border border-gray-200 focus:ring-2 focus:ring-[#29abe2] focus:border-[#29abe2] py-2 pl-3.5 pr-9 bg-gray-50 text-gray-700 shadow-2xs hover:bg-gray-100/70 transition-colors cursor-pointer appearance-none">
                                @foreach($indikatorList as $ind)
                                    <option value="{{ $ind->id }}">{{ $ind->nama_indikator }}</option>
                                @endforeach
                            </select>
                            <span class="material-symbols-outlined text-gray-400 text-[18px] absolute right-2.5 top-1/2 -translate-y-1/2 pointer-events-none">expand_more</span>
                        </div>

                        <!-- Filter Tahun -->
                        <div class="relative">
                            <select id="dashboard-filter-tahun" onchange="updateDashboardIndikatorChart()"
                                class="text-xs font-semibold rounded-lg border border-gray-200 focus:ring-2 focus:ring-[#29abe2] focus:border-[#29abe2] py-2 pl-3.5 pr-8 bg-gray-50 text-gray-700 shadow-2xs hover:bg-gray-100/70 transition-colors cursor-pointer appearance-none min-w-[100px]">
                                @foreach($tahunList as $th)
                                    <option value="{{ $th }}">{{ $th }}</option>
                                @endforeach
                            </select>
                            <span class="material-symbols-outlined text-gray-400 text-[18px] absolute right-2.5 top-1/2 -translate-y-1/2 pointer-events-none">expand_more</span>
                        </div>
                    </div>
                </div>
                
                <div id="chart-indikator-dashboard" class="w-full min-h-[350px]"></div>

                <!-- Footer Highlight Status Kota Tasikmalaya -->
                <div class="mt-4 pt-3 border-t border-gray-100 flex items-center justify-between text-xs bg-gray-50/60 -mx-5 -mb-5 px-5 py-3 rounded-b-xl">
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-[#00A3E0] inline-block shadow-xs"></span>
                        <span class="font-bold text-gray-900 text-xs sm:text-sm" id="dash-tasik-info">Kota Tasikmalaya: -</span>
                    </div>
                </div>
            </div>

        </main>
    </div>

    <!-- ApexCharts Script Initialization -->
    <script>
        // 1. Data & Chart: Sebaran Wilayah (Bar Chart Compact)
        const wilayahLabels = @json($wilayahLabels);
        const wilayahCounts = @json($wilayahCounts);

        const optionsWilayah = {
            series: [{
                name: 'Jumlah Alat TTG',
                data: wilayahCounts
            }],
            chart: {
                type: 'bar',
                height: 230,
                toolbar: { show: false },
                fontFamily: 'Inter, sans-serif'
            },
            colors: ['#29abe2'],
            plotOptions: {
                bar: {
                    borderRadius: 4,
                    columnWidth: '45%',
                    dataLabels: { position: 'top' }
                }
            },
            dataLabels: {
                enabled: true,
                offsetY: -18,
                style: {
                    fontSize: '10px',
                    colors: ['#475569'],
                    fontWeight: 600
                }
            },
            xaxis: {
                categories: wilayahLabels,
                labels: {
                    rotate: -30,
                    rotateAlways: true,
                    hideOverlappingLabels: false,
                    trim: false,
                    style: { fontSize: '10px', colors: '#64748b' }
                },
                axisBorder: { show: false },
                axisTicks: { show: false }
            },
            yaxis: {
                labels: { style: { colors: '#64748b', fontSize: '10px' } }
            },
            grid: {
                borderColor: '#f1f5f9',
                strokeDashArray: 3
            },
            tooltip: {
                theme: 'light',
                y: {
                    formatter: function (val) {
                        return val + " Alat TTG";
                    }
                }
            }
        };

        const chartWilayah = new ApexCharts(document.querySelector("#chart-wilayah"), optionsWilayah);
        chartWilayah.render();


        // 2. Data & Chart: Distribusi Kategori (Donut Chart Compact)
        const kategoriLabels = @json($kategoriLabels);
        const kategoriCounts = @json($kategoriCounts);

        const optionsKategori = {
            series: kategoriCounts,
            labels: kategoriLabels,
            chart: {
                type: 'donut',
                height: 220,
                fontFamily: 'Inter, sans-serif'
            },
            colors: ['#29abe2', '#10b981', '#8b5cf6', '#f59e0b', '#ef4444', '#06b6d4'],
            legend: {
                position: 'bottom',
                fontSize: '11px',
                labels: { colors: '#475569' }
            },
            dataLabels: {
                enabled: true,
                style: { fontSize: '10px' },
                formatter: function (val) {
                    return Math.round(val) + "%";
                }
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: '60%',
                        labels: {
                            show: true,
                            total: {
                                show: true,
                                label: 'Total',
                                fontSize: '11px',
                                color: '#64748b',
                                formatter: function (w) {
                                    return w.globals.seriesTotals.reduce((a, b) => a + b, 0);
                                }
                            }
                        }
                    }
                }
            },
            stroke: { width: 2, colors: ['#ffffff'] }
        };

        const chartKategori = new ApexCharts(document.querySelector("#chart-kategori"), optionsKategori);
        chartKategori.render();


        // 3. Data & Chart: Grafik Perbandingan Indikator Makro (Kota Tasik vs 26 Daerah Jabar)
        const dashboardChartMap = @json($indikatorChartMap);
        let dashboardIndikatorChart = null;

        function highlightTasikDashboard() {
            const container = document.querySelector("#chart-indikator-dashboard");
            if (!container) return;

            const indId = document.getElementById('dashboard-filter-indikator')?.value;
            const thVal = document.getElementById('dashboard-filter-tahun')?.value;
            if (!indId || !thVal || !dashboardChartMap[indId] || !dashboardChartMap[indId][thVal]) return;

            const isTasik = dashboardChartMap[indId][thVal].isTasik;
            const tasikIndex = isTasik.findIndex(t => t === true);
            if (tasikIndex === -1) return;

            // 1. Y-Axis label highlight for Kota Tasikmalaya
            const yAxisLabels = container.querySelectorAll('.apexcharts-yaxis-label');
            if (yAxisLabels[tasikIndex]) {
                yAxisLabels[tasikIndex].style.fontSize = '13px';
                yAxisLabels[tasikIndex].style.fontWeight = '900';
                yAxisLabels[tasikIndex].style.fill = '#00A3E0';
                const tspan = yAxisLabels[tasikIndex].querySelector('tspan');
                if (tspan) {
                    tspan.style.fontSize = '13px';
                    tspan.style.fontWeight = '900';
                    tspan.style.fill = '#00A3E0';
                }
            }

            // 2. DataLabel (Angka Utama) highlight for Kota Tasikmalaya (Bigger & Bolder 18px!)
            const dataLabels = container.querySelectorAll('.apexcharts-datalabels-group text, .apexcharts-data-labels text, .apexcharts-datalabels text');
            if (dataLabels[tasikIndex]) {
                dataLabels[tasikIndex].style.fontSize = '18px';
                dataLabels[tasikIndex].style.fontWeight = '900';
                dataLabels[tasikIndex].style.fill = '#00A3E0';
                const tspan = dataLabels[tasikIndex].querySelector('tspan');
                if (tspan) {
                    tspan.style.fontSize = '18px';
                    tspan.style.fontWeight = '900';
                    tspan.style.fill = '#00A3E0';
                }
            }
        }

        function renderDashboardIndikatorChart() {
            const indSelect = document.getElementById('dashboard-filter-indikator');
            const thSelect = document.getElementById('dashboard-filter-tahun');
            if (!indSelect || !thSelect) return;

            const indId = indSelect.value;
            const thVal = thSelect.value;

            if (!dashboardChartMap[indId] || !dashboardChartMap[indId][thVal]) {
                if (dashboardIndikatorChart) {
                    dashboardIndikatorChart.destroy();
                    dashboardIndikatorChart = null;
                }
                document.getElementById('chart-indikator-dashboard').innerHTML = '<div class="flex items-center justify-center h-52 text-xs text-gray-400 font-semibold">Data belum terisi untuk indikator/tahun ini</div>';
                document.getElementById('dash-tasik-info').innerText = 'Kota Tasikmalaya: -';
                return;
            }

            const dataObj = dashboardChartMap[indId][thVal];
            const labels = dataObj.labels;
            const values = dataObj.values;
            const isTasik = dataObj.isTasik;

            // Highlight Kota Tasikmalaya dengan warna biru #00A3E0
            const colors = isTasik.map(t => t ? '#00A3E0' : '#cbd5e1');

            // Set nilai footer Kota Tasikmalaya
            const tasikIndex = isTasik.findIndex(t => t === true);
            if (tasikIndex !== -1) {
                document.getElementById('dash-tasik-info').innerText = `Kota Tasikmalaya: ${values[tasikIndex]} ${dataObj.satuan}`;
            } else {
                document.getElementById('dash-tasik-info').innerText = `Kota Tasikmalaya: -`;
            }

            const maxVal = Math.max(...values.map(v => parseFloat(v) || 0));

            const options = {
                series: [{
                    name: dataObj.nama,
                    data: values
                }],
                chart: {
                    type: 'bar',
                    height: Math.max(350, labels.length * 19),
                    toolbar: { show: false },
                    fontFamily: 'Inter, sans-serif',
                    events: {
                        mounted: function() { setTimeout(highlightTasikDashboard, 100); },
                        updated: function() { setTimeout(highlightTasikDashboard, 100); }
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: true,
                        barHeight: '70%',
                        borderRadius: 4,
                        distributed: true,
                        dataLabels: {
                            position: 'top',
                            hideOverflowingLabels: false
                        }
                    }
                },
                colors: colors,
                dataLabels: {
                    enabled: true,
                    textAnchor: 'start',
                    style: {
                        fontSize: '10px',
                        fontWeight: 600,
                        colors: isTasik.map(t => t ? '#00A3E0' : '#64748b')
                    },
                    formatter: function (val) {
                        return val;
                    },
                    offsetX: 5
                },
                xaxis: {
                    categories: labels,
                    max: maxVal > 0 ? maxVal * 1.18 : undefined,
                    labels: {
                        style: { fontSize: '10px', colors: '#64748b' }
                    },
                    axisBorder: { show: false },
                    axisTicks: { show: false }
                },
                yaxis: {
                    labels: {
                        minWidth: 130,
                        maxWidth: 170,
                        style: {
                            fontSize: '11px',
                            fontWeight: 600,
                            colors: isTasik.map(t => t ? '#00A3E0' : '#475569')
                        }
                    }
                },
                legend: { show: false },
                grid: {
                    borderColor: '#f1f5f9',
                    strokeDashArray: 3,
                    xaxis: { lines: { show: true } },
                    yaxis: { lines: { show: false } },
                    padding: { right: 50, left: 15 }
                },
                tooltip: {
                    theme: 'light',
                    y: {
                        formatter: function (val) {
                            return val + " " + dataObj.satuan;
                        }
                    }
                }
            };

            if (dashboardIndikatorChart) {
                dashboardIndikatorChart.destroy();
            }

            document.getElementById('chart-indikator-dashboard').innerHTML = '';
            dashboardIndikatorChart = new ApexCharts(document.querySelector("#chart-indikator-dashboard"), options);
            dashboardIndikatorChart.render();
            setTimeout(highlightTasikDashboard, 100);
            setTimeout(highlightTasikDashboard, 300);
            setTimeout(highlightTasikDashboard, 600);
        }

        function updateDashboardIndikatorChart() {
            renderDashboardIndikatorChart();
        }

        // Render Indikator Chart On Initial Load
        document.addEventListener('DOMContentLoaded', () => {
            renderDashboardIndikatorChart();
        });

        // Mobile Sidebar Toggle
        const menuBtn = document.getElementById('menu-btn');
        const sidebar = document.getElementById('sidebar');
        menuBtn?.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });
    </script>
</body>

</html>
