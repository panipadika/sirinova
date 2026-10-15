<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Capaian Indikator Makro - SI RINOVA Kota Tasikmalaya</title>

    <!-- Favicon Logo Tasikmalaya -->
    <link rel="icon" type="image/png" href="{{ asset('storage/images/favicon_tasik.png') }}?v=3">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=3">
    <link rel="apple-touch-icon" href="{{ asset('storage/images/favicon_tasik.png') }}?v=3">

    <!-- Google Fonts: Inter & Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>

    <!-- ApexCharts CDN -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* Reveal animation (Identical to E-Book Kajian, Telaahan Staf, Galeri) */
        .reveal-up {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.5s ease-out, transform 0.5s ease-out;
        }
        .reveal-up.active {
            opacity: 1;
            transform: translateY(0);
        }

        /* Hide scrollbar completely for all elements */
        *, html, body, div {
            -ms-overflow-style: none !important;
            scrollbar-width: none !important;
        }

        *::-webkit-scrollbar,
        html::-webkit-scrollbar,
        body::-webkit-scrollbar,
        div::-webkit-scrollbar {
            display: none !important;
            width: 0 !important;
            height: 0 !important;
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-800 antialiased min-h-screen flex flex-col justify-between selection:bg-[#00A3E0] selection:text-white overflow-x-hidden">

    <!-- 1. NAVBAR / HEADER -->
    <header class="sticky top-0 z-40 bg-white/95 backdrop-blur-md border-b border-slate-100 shadow-xs transition-all">
        <div class="max-w-7xl 2xl:max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">

            <!-- Logo & Brand Name -->
            <a href="/" class="flex items-center gap-3 shrink-0 group">
                <img src="{{ asset('storage/images/logo_tasik.png') }}" alt="Logo Kota Tasikmalaya"
                    class="h-10 w-auto object-contain group-hover:scale-105 transition-transform">
                <span class="text-xl sm:text-2xl font-black text-[#00A3E0] tracking-tight">
                    SI RINOVA
                </span>
            </a>

            <!-- Desktop Navigation Links -->
            <nav class="hidden md:flex items-center gap-6 xl:gap-8 font-semibold text-sm whitespace-nowrap">
                <a href="/" class="text-slate-600 hover:text-[#00A3E0] transition-colors py-1 whitespace-nowrap">Beranda</a>
                <a href="{{ route('public.indikator-makro') }}" class="text-[#00A3E0] border-b-2 border-[#00A3E0] pb-1 transition-colors whitespace-nowrap">Indikator Makro</a>
                
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

            <!-- Mobile Menu Toggle Button -->
            <button id="mobile-menu-btn" class="md:hidden text-slate-700 hover:text-[#00A3E0] p-2 focus:outline-none">
                <span class="material-symbols-outlined text-2xl">menu</span>
            </button>
        </div>

        <!-- Mobile Nav Menu Dropdown -->
        <div id="mobile-nav" class="hidden md:hidden bg-white border-b border-slate-200 px-6 py-4 space-y-3 font-semibold text-sm">
            <a href="/" class="block text-slate-600">Beranda</a>
            <a href="{{ route('public.indikator-makro') }}" class="block text-[#00A3E0] font-bold">Indikator Makro</a>
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
            <a href="{{ route('public.ebook') }}" class="block text-slate-600 hover:text-[#00A3E0]">E-Book Kajian</a>
            <a href="{{ route('public.telaahan-staf') }}" class="block text-slate-600 hover:text-[#00A3E0]">Telaahan Staf</a>
            <a href="{{ route('public.galeri') }}" class="block text-slate-600 hover:text-[#00A3E0]">Galeri</a>
            <a href="{{ route('lomba.info') }}" class="flex items-center gap-1.5 text-amber-500 font-bold">
                <span class="material-symbols-outlined text-base">emoji_events</span>
                <span>Lomba TTG</span>
            </a>
            <a href="{{ route('public.tentang') }}" class="block text-slate-600 hover:text-[#00A3E0]">Tentang</a>
        </div>
    </header>

    <!-- MAIN CONTENT -->
    <main class="flex-1">

        <!-- HERO BANNER -->
        <section class="bg-gradient-to-b from-sky-50/60 via-white to-[#f8fafc] py-8 sm:py-10 border-b border-slate-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div class="max-w-3xl reveal-up">
                        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight text-slate-900 leading-tight">
                            Capaian Indikator <span class="text-[#00A3E0]">Makro</span>
                        </h1>
                        <p class="text-slate-500 text-sm sm:text-base mt-2 leading-relaxed">
                            Perbandingan Capaian Indikator Pembangunan Makro Kota Tasikmalaya dengan seluruh Kabupaten/Kota se-Provinsi Jawa Barat Tahun {{ $selectedTahun }}.
                        </p>
                    </div>

                    <!-- Filter Indikator & Tahun Side-by-Side (Matches Screenshot) -->
                    <div class="bg-white p-3 sm:p-3.5 rounded-2xl border border-slate-200/90 shadow-md flex flex-col gap-2 shrink-0 reveal-up">
                        <label class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-sm text-[#00A3E0]">tune</span> Filter Data Indikator
                        </label>
                        <form method="GET" action="{{ route('public.indikator-makro') }}" class="flex flex-col sm:flex-row items-center gap-2.5">
                            
                            <!-- Dropdown 1: Select Indikator (Identical to reference screenshot) -->
                            <div class="relative w-full sm:w-auto">
                                <select name="indikator" onchange="this.form.submit()"
                                        class="w-full sm:w-auto appearance-none bg-slate-50 border border-slate-200 text-slate-800 font-bold text-xs sm:text-sm pl-3.5 pr-8 py-2.5 rounded-xl cursor-pointer focus:outline-none focus:ring-2 focus:ring-[#00A3E0]/20 focus:border-[#00A3E0] hover:bg-slate-100 transition-all shadow-2xs">
                                    <option value="Semua" {{ (string)($selectedIndikator ?? 'Semua') === 'Semua' ? 'selected' : '' }}>Semua Indikator</option>
                                    @foreach($indikatorList as $ind)
                                        <option value="{{ $ind->id }}" {{ (string)($selectedIndikator ?? '') === (string)$ind->id ? 'selected' : '' }}>
                                            {{ $ind->nama_indikator }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="material-symbols-outlined absolute right-2.5 top-1/2 -translate-y-1/2 text-slate-500 text-base pointer-events-none">expand_more</span>
                            </div>

                            <!-- Dropdown 2: Select Tahun -->
                            <div class="relative w-full sm:w-auto">
                                <select name="tahun" onchange="this.form.submit()"
                                        class="w-full sm:w-auto appearance-none bg-slate-50 border border-slate-200 text-slate-800 font-bold text-xs sm:text-sm pl-3.5 pr-8 py-2.5 rounded-xl cursor-pointer focus:outline-none focus:ring-2 focus:ring-[#00A3E0]/20 focus:border-[#00A3E0] hover:bg-slate-100 transition-all shadow-2xs">
                                    @foreach($tahunList as $th)
                                        <option value="{{ $th }}" {{ (string)($selectedTahun ?? '') === (string)$th ? 'selected' : '' }}>{{ $th }}</option>
                                    @endforeach
                                </select>
                                <span class="material-symbols-outlined absolute right-2.5 top-1/2 -translate-y-1/2 text-slate-500 text-base pointer-events-none">expand_more</span>
                            </div>

                        </form>
                    </div>
                </div>

                <!-- Active Filter Pill Badges & Reset Button -->
                @if((string)($selectedIndikator ?? 'Semua') !== 'Semua')
                    <div class="reveal-up mt-4 inline-flex flex-wrap items-center gap-2 px-3.5 py-1.5 bg-white/90 backdrop-blur-md rounded-xl border border-slate-200/80 shadow-2xs text-xs text-slate-600">
                        <span class="flex items-center gap-1.5 font-medium">
                            <span class="material-symbols-outlined text-sm text-[#00A3E0]">filter_alt</span>
                            <span>Filter Aktif: <strong class="text-slate-900 font-bold">"{{ $activeIndikatorNama ?? 'Indikator Terpilih' }}"</strong></span>
                        </span>
                        <a href="{{ route('public.indikator-makro', ['tahun' => $selectedTahun]) }}"
                           class="inline-flex items-center gap-0.5 px-2.5 py-0.5 bg-rose-50 hover:bg-rose-100 text-rose-600 border border-rose-200/60 rounded-lg text-[11px] font-bold transition-all shadow-2xs hover:shadow-xs active:scale-95">
                            <span class="material-symbols-outlined text-xs">close</span>
                            <span>Tampilkan Semua Indikator</span>
                        </a>
                    </div>
                @endif
        </section>

        <!-- KOTA TASIKMALAYA METRIC SUMMARY CARDS -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6">
            <div class="grid grid-cols-2 sm:grid-cols-3 {{ count($chartsData) > 1 ? 'lg:grid-cols-5' : 'lg:grid-cols-3' }} gap-2.5 sm:gap-3.5">
                @foreach($chartsData as $chart)
                    @php
                        $ind = $chart['indikator'];
                        $tasik = $chart['tasikRecord'];
                    @endphp
                    <div class="reveal-up bg-white rounded-2xl p-3.5 sm:p-4 border border-slate-200/80 shadow-md flex flex-col justify-between hover:border-[#00A3E0] transition-all" style="transition-delay: {{ ($loop->index % 5) * 60 }}ms;">
                        <div class="flex items-start justify-between gap-1">
                            <p class="text-[10px] sm:text-[11px] font-bold text-slate-400 uppercase tracking-wider truncate" title="{{ $ind->nama_indikator }}">
                                {{ $ind->nama_indikator }}
                            </p>
                            <span class="w-2 h-2 rounded-full bg-[#00A3E0] shrink-0"></span>
                        </div>
                        <div class="mt-2 sm:mt-3">
                            <p class="text-2xl sm:text-3xl font-black text-[#00A3E0] leading-none">
                                {{ $tasik ? number_format($tasik->nilai, 2, ',', '.') : '-' }}
                            </p>
                            <span class="inline-flex items-center gap-1 text-[9px] sm:text-[10px] font-bold text-[#00A3E0] bg-sky-50 px-2 py-0.5 rounded-md mt-2">
                                <span class="material-symbols-outlined text-[11px] sm:text-[12px]">location_on</span> Kota Tasikmalaya
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- CHARTS SECTION -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-10 space-y-6 sm:space-y-8">
            <div class="reveal-up flex items-center justify-between border-b border-slate-200 pb-4">
                <div>
                    <h2 class="text-lg sm:text-xl font-bold text-slate-900 flex items-center gap-2">
                        <span class="material-symbols-outlined text-[#00A3E0]">bar_chart</span>
                        Grafik Perbandingan 27 Kabupaten / Kota Jawa Barat
                    </h2>
                    <p class="text-xs text-slate-500 mt-0.5">Batang berwarna biru muda menandakan posisi Kota Tasikmalaya.</p>
                </div>
            </div>

            <!-- Grid Charts -->
            <div class="grid grid-cols-1 {{ count($chartsData) > 1 ? 'lg:grid-cols-2' : '' }} gap-6 sm:gap-8">
                @foreach($chartsData as $index => $chart)
                    @php
                        $ind = $chart['indikator'];
                        $chartId = "chart-indikator-" . $ind->id;
                        $tasik = $chart['tasikRecord'];
                    @endphp
                    <div class="reveal-up bg-white rounded-3xl p-4 sm:p-6 border border-slate-100 shadow-[0_4px_20px_rgba(0,0,0,0.02)] flex flex-col justify-between hover:shadow-md transition-shadow" style="transition-delay: {{ ($index % 2) * 80 }}ms;">
                        <!-- Chart Header -->
                        <div class="flex flex-row items-start justify-between gap-3 border-b border-slate-100 pb-3 mb-3 sm:mb-4">
                            <div class="flex-1 min-w-0">
                                <h3 class="text-sm sm:text-base font-extrabold text-slate-900 uppercase tracking-tight leading-snug">
                                    {{ $ind->nama_indikator }} TAHUN {{ $selectedTahun }}
                                </h3>
                                <p class="text-xs text-slate-500 font-medium mt-0.5">Satuan: ({{ $ind->satuan }})</p>
                            </div>
                            @if($tasik)
                                <div class="bg-[#00A3E0] text-white px-3 py-1.5 sm:px-3.5 sm:py-1.5 rounded-xl text-center shadow-xs shrink-0">
                                    <span class="text-[9px] sm:text-[10px] uppercase font-bold block leading-none opacity-90">Kota Tasik</span>
                                    <span class="text-lg sm:text-xl font-black leading-tight">{{ number_format($tasik->nilai, 2, ',', '.') }}</span>
                                </div>
                            @endif
                        </div>

                        <!-- ApexChart Canvas -->
                        <div class="w-full overflow-x-auto [scrollbar-width:none] [-ms-overflow-style:none] [&::-webkit-scrollbar]:hidden">
                            <div id="{{ $chartId }}" class="w-full min-h-[460px]"></div>
                        </div>

                        <!-- Chart Footer Caption -->
                        <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-[10px] sm:text-[11px] text-slate-400">
                            <span>Sumber Data: Badan Pusat Statistik</span>
                            <span class="font-bold text-slate-600">Tahun {{ $selectedTahun }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

    </main>

    <!-- FOOTER -->
    @include('partials.footer')


    <!-- ApexCharts Initialization Scripts & Mobile Menu -->
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

        document.addEventListener("DOMContentLoaded", function () {
            const isMobile = window.innerWidth < 640;

            @foreach($chartsData as $chart)
                @php
                    $ind = $chart['indikator'];
                    $chartId = "chart-indikator-" . $ind->id;
                    $labels = $chart['labels'];
                    $values = $chart['values'];
                    $isTasik = $chart['isTasik'];
                @endphp

                (function() {
                    const labels = @json($labels);
                    const values = @json($values);
                    const isTasik = @json($isTasik);

                    // Colors setup: Primary Blue (#00A3E0) for Kota Tasikmalaya, slate for others
                    const colors = isTasik.map(t => t ? '#00A3E0' : '#cbd5e1');

                    // Calculate max value to prevent dataLabel overflow on the right
                    const maxVal = Math.max(...values.map(v => parseFloat(v) || 0));

                    const options = {
                        series: [{
                            name: '{{ addslashes($ind->nama_indikator) }}',
                            data: values
                        }],
                        chart: {
                            type: 'bar',
                            height: Math.max(isMobile ? 440 : 480, labels.length * (isMobile ? 18 : 20)),
                            toolbar: { show: false },
                            fontFamily: 'Inter, sans-serif',
                            events: {
                                mounted: function() { setTimeout(highlightTasik, 100); },
                                updated: function() { setTimeout(highlightTasik, 100); }
                            }
                        },
                        plotOptions: {
                            bar: {
                                horizontal: true,
                                barHeight: isMobile ? '76%' : '70%',
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
                                fontSize: isMobile ? '10px' : '11px',
                                fontWeight: 600,
                                colors: isTasik.map(t => t ? '#00A3E0' : '#64748b')
                            },
                            formatter: function (val, opt) {
                                if (val === null || val === undefined) return '';
                                return val.toString().replace('.', ',');
                            },
                            offsetX: isMobile ? 3 : 5
                        },
                        xaxis: {
                            categories: labels,
                            max: maxVal > 0 ? maxVal * (isMobile ? 1.25 : 1.18) : undefined,
                            labels: {
                                style: { fontSize: '10px', colors: '#64748b' }
                            },
                            axisBorder: { show: false },
                            axisTicks: { show: false }
                        },
                        yaxis: {
                            labels: {
                                minWidth: isMobile ? 100 : 140,
                                maxWidth: isMobile ? 120 : 180,
                                style: {
                                    fontSize: isMobile ? '10px' : '11px',
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
                            padding: {
                                right: isMobile ? 45 : 60,
                                left: isMobile ? 5 : 20
                            }
                        },
                        tooltip: {
                            theme: 'light',
                            y: {
                                formatter: function (val) {
                                    if (val === null || val === undefined) return '';
                                    return val.toString().replace('.', ',') + " {{ addslashes($ind->satuan) }}";
                                }
                            }
                        }
                    };

                    function highlightTasik() {
                        const tasikIndex = isTasik.findIndex(t => t === true);
                        if (tasikIndex === -1) return;

                        const container = document.querySelector("#{{ $chartId }}");
                        if (!container) return;

                        // Y-Axis label highlight for Kota Tasikmalaya
                        const yAxisLabels = container.querySelectorAll('.apexcharts-yaxis-label');
                        if (yAxisLabels[tasikIndex]) {
                            yAxisLabels[tasikIndex].style.fontSize = isMobile ? '11px' : '13px';
                            yAxisLabels[tasikIndex].style.fontWeight = '900';
                            yAxisLabels[tasikIndex].style.fill = '#00A3E0';
                            const tspan = yAxisLabels[tasikIndex].querySelector('tspan');
                            if (tspan) {
                                tspan.style.fontSize = isMobile ? '11px' : '13px';
                                tspan.style.fontWeight = '900';
                                tspan.style.fill = '#00A3E0';
                            }
                        }

                        // DataLabel highlight for Kota Tasikmalaya
                        const dataLabels = container.querySelectorAll('.apexcharts-datalabels-group text, .apexcharts-data-labels text');
                        if (dataLabels[tasikIndex]) {
                            dataLabels[tasikIndex].style.fontSize = isMobile ? '14px' : '18px';
                            dataLabels[tasikIndex].style.fontWeight = '900';
                            dataLabels[tasikIndex].style.fill = '#00A3E0';
                            const tspan = dataLabels[tasikIndex].querySelector('tspan');
                            if (tspan) {
                                tspan.style.fontSize = isMobile ? '14px' : '18px';
                                tspan.style.fontWeight = '900';
                                tspan.style.fill = '#00A3E0';
                            }
                        }
                    }

                    const chart = new ApexCharts(document.querySelector("#{{ $chartId }}"), options);
                    chart.render();
                    setTimeout(highlightTasik, 150);
                    setTimeout(highlightTasik, 500);
                })();
            @endforeach

            // Scroll Reveal Animation (Identical to E-Book Kajian, Telaahan Staf, Galeri)
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
