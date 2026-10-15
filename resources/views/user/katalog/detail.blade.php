<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $item->nama_alat }} - Detail Alat TTG Kota Tasikmalaya</title>
    <!-- Favicon Logo Tasikmalaya -->
    <link rel="icon" type="image/png" href="{{ asset('storage/images/favicon_tasik.png') }}?v=3">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=3">
    <link rel="apple-touch-icon" href="{{ asset('storage/images/favicon_tasik.png') }}?v=3">

    <!-- Google Fonts: Inter & Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Material Symbols -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* Hide scrollbar completely for all browsers */
        html,
        body {
            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            /* Firefox */
        }

        html::-webkit-scrollbar,
        body::-webkit-scrollbar {
            display: none;
            /* Chrome, Safari, Opera */
            width: 0;
            height: 0;
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-800 antialiased min-h-screen flex flex-col justify-between">

    <!-- 1. NAVBAR / HEADER -->
    <header class="sticky top-0 z-40 bg-white/90 backdrop-blur-md border-b border-slate-100 shadow-sm transition-all">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">

            <!-- Logo & Brand Name -->
            <a href="/" class="flex items-center gap-3 group">
                <img src="{{ asset('storage/images/logo_tasik.png') }}" alt="Logo Kota Tasikmalaya"
                    class="h-10 w-auto object-contain group-hover:scale-105 transition-transform">
                <span class="text-xl sm:text-2xl font-black text-[#00A3E0] tracking-tight">
                    SI RINOVA
                </span>
            </a>

            <!-- Desktop Navigation Links -->
            <nav class="hidden md:flex items-center gap-8 font-medium text-sm text-slate-600">
                <a href="/" class="hover:text-[#00A3E0] transition-colors py-2">Beranda</a>
                <a href="{{ route('public.indikator-makro') }}" class="hover:text-[#00A3E0] transition-colors py-2">Indikator Makro</a>
                
                <!-- Dropdown Katalog -->
                <div class="relative group py-5">
                    <button class="flex items-center gap-1 text-[#00A3E0] font-bold border-b-2 border-[#00A3E0] pb-1 transition-colors font-bold text-sm focus:outline-none">
                        <span>Katalog TTG</span>
                        <span class="material-symbols-outlined text-base transition-transform group-hover:rotate-180">expand_more</span>
                    </button>
                    <div class="absolute left-0 top-full w-52 bg-white rounded-xl shadow-xl border border-slate-100 py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                        <a href="{{ route('katalog.index') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-xs font-bold text-[#00A3E0] bg-sky-50/70 transition-colors">
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

                <a href="{{ route('public.ebook') }}" class="hover:text-[#00A3E0] transition-colors py-2">E-Book Kajian</a>
                <a href="{{ route('public.telaahan-staf') }}" class="hover:text-[#00A3E0] transition-colors py-2">Telaahan Staf</a>
                <a href="{{ route('public.galeri') }}" class="hover:text-[#00A3E0] transition-colors py-2">Galeri</a>
                <a href="{{ route('lomba.info') }}" class="text-amber-500 hover:text-amber-600 transition-colors py-2 flex items-center gap-1 font-bold">
                    <span class="material-symbols-outlined text-base">emoji_events</span>
                    <span>Lomba TTG</span>
                </a>
                <a href="{{ route('public.tentang') }}" class="hover:text-[#00A3E0] transition-colors py-2">Tentang</a>
            </nav>

            <!-- Mobile Menu Toggle Button -->
            <button id="mobile-menu-btn" class="md:hidden text-slate-700 hover:text-[#00A3E0] p-2 focus:outline-none">
                <span class="material-symbols-outlined text-2xl">menu</span>
            </button>
        </div>

        <!-- Mobile Nav Menu Dropdown -->
        <div id="mobile-nav"
            class="hidden md:hidden bg-white border-b border-slate-200 px-6 py-4 space-y-3 font-semibold text-sm">
            <a href="/" class="block text-slate-600">Beranda</a>
            <a href="{{ route('public.indikator-makro') }}" class="block text-slate-600 hover:text-[#00A3E0]">Indikator Makro</a>
            <div class="py-0.5">
                <button id="mobile-katalog-btn" type="button" class="w-full flex items-center justify-between text-xs font-bold text-[#00A3E0] uppercase tracking-wider focus:outline-none transition-colors py-1">
                    <span>Katalog TTG</span>
                    <span id="mobile-katalog-icon" class="material-symbols-outlined text-base transition-transform duration-200">expand_more</span>
                </button>
                <div id="mobile-katalog-sub" class="hidden space-y-2 pt-1.5 pl-3">
                    <a href="{{ route('katalog.index') }}" class="block text-[#00A3E0] font-bold">Alat TTG</a>
                    <a href="{{ route('public.kategori') }}" class="block text-slate-600 hover:text-[#00A3E0]">Kategori Sektor</a>
                    <a href="{{ route('public.wilayah') }}" class="block text-slate-600 hover:text-[#00A3E0]">Sebaran Wilayah</a>
                </div>
            </div>
            <a href="{{ route('public.ebook') }}" class="block text-slate-600">E-Book Kajian</a>
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
    <main class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-5 sm:py-8 flex-1 w-full">

        <!-- BREADCRUMB -->
        <nav class="flex items-center gap-2 text-xs font-semibold text-slate-500 mb-4 sm:mb-6">
            <a href="{{ route('katalog.index') }}" class="hover:text-[#00A3E0] transition-colors">Katalog TTG</a>
            <span class="text-slate-300">&rsaquo;</span>
            <span class="text-slate-900 font-bold">Detail Alat</span>
        </nav>

        <!-- MAIN CARD CONTAINER (TWO COLUMNS COMPACT) -->
        <div
            class="bg-white rounded-3xl border border-slate-100 shadow-[0_10px_30px_rgba(0,0,0,0.03)] p-5 sm:p-7 lg:p-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-center">

                <!-- LEFT COLUMN: PRODUCT IMAGE -->
                <div class="lg:col-span-6 w-full">
                    <div
                        class="relative w-full h-[280px] sm:h-[360px] lg:h-[380px] bg-slate-100 rounded-2xl sm:rounded-3xl overflow-hidden border border-slate-100 shadow-sm group">
                        @if($item->foto)
                            <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama_alat }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                onerror="this.src='https://placehold.co/800x800?text=Detail+Alat+TTG'">
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center text-slate-400 gap-2">
                                <span class="material-symbols-outlined text-5xl text-slate-300">inventory_2</span>
                                <span class="text-xs font-semibold text-slate-400">Tidak ada foto alat</span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- RIGHT COLUMN: DETAILS & SPECS -->
                <div class="lg:col-span-6 w-full space-y-4">

                    <!-- Category Badge & Title -->
                    <div class="space-y-1.5">
                        <span
                            class="inline-block px-3 py-1 bg-sky-50 text-[#00A3E0] text-[11px] font-bold rounded-full">
                            {{ $item->kategori->nama_kategori ?? 'Teknologi Tepat Guna' }}
                        </span>
                        <h1
                            class="text-xl sm:text-2xl lg:text-3xl font-extrabold text-slate-900 tracking-tight leading-snug">
                            {{ $item->nama_alat }}
                        </h1>
                    </div>

                    <!-- Specs Metadata List Card (Compact Rows) -->
                    <div
                        class="bg-slate-50/50 rounded-2xl border border-slate-100 divide-y divide-slate-100 text-xs shadow-xs overflow-hidden">

                        <!-- Row 1: Inovator -->
                        <div class="py-2.5 px-4 sm:px-5 flex items-center justify-between">
                            <div class="flex items-center gap-2 text-slate-500 font-medium">
                                <span class="material-symbols-outlined text-base text-slate-400">person</span>
                                <span>Inovator</span>
                            </div>
                            <span class="font-bold text-slate-900 text-right">
                                {{ $item->inovator->nama_inovator ?? 'Inovator Mandiri' }}
                            </span>
                        </div>

                        <!-- Row 2: Harga -->
                        <div class="py-2.5 px-4 sm:px-5 flex items-center justify-between">
                            <div class="flex items-center gap-2 text-slate-500 font-medium">
                                <span class="material-symbols-outlined text-base text-slate-400">payments</span>
                                <span>Harga</span>
                            </div>
                            <span class="font-extrabold text-[#00A3E0] text-xs sm:text-sm text-right">
                                @if($item->estimasi_harga)
                                    {{ is_numeric($item->estimasi_harga) ? 'Rp ' . number_format($item->estimasi_harga, 0, ',', '.') : (str_contains(strtolower($item->estimasi_harga), 'rp') ? $item->estimasi_harga : 'Rp ' . $item->estimasi_harga) }}
                                @else
                                    Hubungi Inovator
                                @endif
                            </span>
                        </div>

                        <!-- Row 3: Wilayah -->
                        <div class="py-2.5 px-4 sm:px-5 flex items-center justify-between">
                            <div class="flex items-center gap-2 text-slate-500 font-medium">
                                <span class="material-symbols-outlined text-base text-slate-400">location_on</span>
                                <span>Wilayah</span>
                            </div>
                            <span class="font-bold text-slate-900 text-right">
                                Kecamatan {{ $item->wilayah->nama_kecamatan ?? 'Tasikmalaya' }}
                            </span>
                        </div>

                        <!-- Row 4: Tahun -->
                        <div class="py-2.5 px-4 sm:px-5 flex items-center justify-between">
                            <div class="flex items-center gap-2 text-slate-500 font-medium">
                                <span class="material-symbols-outlined text-base text-slate-400">calendar_today</span>
                                <span>Tahun</span>
                            </div>
                            <span class="font-bold text-slate-900 text-right">
                                {{ $item->tahun_produksi ?? date('Y') }}
                            </span>
                        </div>

                        <!-- Row 5: Status -->
                        <div class="py-2.5 px-4 sm:px-5 flex items-center justify-between">
                            <div class="flex items-center gap-2 text-slate-500 font-medium">
                                <span class="material-symbols-outlined text-base text-slate-400">inventory</span>
                                <span>Status</span>
                            </div>
                            <span
                                class="px-2.5 py-0.5 bg-emerald-50 text-emerald-600 font-bold text-[11px] rounded-full">
                                {{ $item->status_publikasi == 'Publik' ? 'Tersedia' : $item->status_publikasi }}
                            </span>
                        </div>

                        <!-- Row 6: Alamat Lengkap -->
                        <div class="py-2.5 px-4 sm:px-5 space-y-1">
                            <div class="flex items-center gap-2 text-slate-500 font-medium">
                                <span class="material-symbols-outlined text-base text-slate-400">map</span>
                                <span>Alamat Lengkap</span>
                            </div>
                            <p class="font-semibold text-slate-800 leading-relaxed pl-6 text-left">
                                {{ $item->alamat_lengkap ?? '-' }}
                            </p>
                        </div>

                    </div>

                    <!-- Action Buttons (Compact) -->
                    <div class="flex items-center gap-3 pt-1">
                        @php
                            $rawPhone = $item->nomor_telepon ?? $item->inovator->nomor_telepon ?? '';
                            $cleanPhone = preg_replace('/[^0-9]/', '', $rawPhone);
                            if (str_starts_with($cleanPhone, '0')) {
                                $cleanPhone = '62' . substr($cleanPhone, 1);
                            }
                            $waUrl = $cleanPhone ? "https://wa.me/{$cleanPhone}?text=" . urlencode("Halo, saya tertarik dengan inovator alat TTG '{$item->nama_alat}' di SI RINOVA Kota Tasikmalaya.") : "#";
                        @endphp

                        <!-- Primary WhatsApp CTA -->
                        <a href="{{ $waUrl }}" target="_blank"
                            class="flex-1 bg-[#00A3E0] hover:bg-[#008bc0] text-white py-3 px-5 rounded-xl font-bold text-xs sm:text-sm transition-all shadow-sm hover:shadow-md flex items-center justify-center gap-2 text-center">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                <path
                                    d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                            </svg>
                            Hubungi Inovator
                        </a>

                        <!-- Secondary Back CTA -->
                        <a href="{{ route('katalog.index') }}"
                            class="flex-1 bg-white border border-[#00A3E0] text-[#00A3E0] hover:bg-sky-50 py-3 px-5 rounded-xl font-bold text-xs sm:text-sm transition-all text-center">
                            Kembali ke Katalog
                        </a>
                    </div>

                </div>

            </div>
        </div>

        <!-- BOTTOM SECTION: FULL DESCRIPTION & DETAILS CARD -->
        <div
            class="mt-6 bg-white rounded-3xl border border-slate-100 shadow-[0_10px_30px_rgba(0,0,0,0.03)] p-6 sm:p-8 space-y-3">
            <div class="flex items-center gap-2.5 text-slate-900 border-b border-slate-100 pb-3">
                <span class="material-symbols-outlined text-[#00A3E0] text-xl">description</span>
                <h2 class="text-base sm:text-lg font-extrabold tracking-tight">Deskripsi & Manfaat Alat</h2>
            </div>
            <p class="text-slate-600 text-xs sm:text-sm leading-relaxed whitespace-pre-line text-justify">
                {{ $item->deskripsi ?? 'Tidak ada deskripsi rinci untuk alat teknologi ini.' }}
            </p>
        </div>

    </main>

    <!-- FOOTER -->
    @include('partials.footer')


    <!-- LIGHTBOX MODAL FOR FULL RESOLUTION PHOTO VIEWING -->
    <div id="image-lightbox-modal" onclick="if(event.target === this) closeImageLightbox()"
        class="fixed inset-0 z-50 bg-slate-950/85 backdrop-blur-md hidden items-center justify-center p-4 sm:p-6 transition-all duration-300">
        <div class="relative max-w-5xl w-full max-h-[90vh] flex flex-col items-center justify-center">

            <!-- Close Button -->
            <button onclick="closeImageLightbox()"
                class="absolute -top-12 right-0 text-white/80 hover:text-white p-2 rounded-full hover:bg-white/10 transition-all flex items-center gap-1 text-xs font-bold cursor-pointer">
                <span class="material-symbols-outlined text-2xl">close</span>
                <span>Tutup</span>
            </button>

            <!-- Lightbox Image -->
            <img id="lightbox-img" src="" alt="Full Photo"
                class="max-w-full max-h-[80vh] object-contain rounded-2xl shadow-2xl border border-white/10 bg-slate-900/50">

            <!-- Caption Title -->
            <p id="lightbox-caption" class="text-white/90 text-sm sm:text-base font-semibold mt-4 text-center"></p>
        </div>
    </div>

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

        // Lightbox Functions
        function openImageLightbox(src, title) {
            const modal = document.getElementById('image-lightbox-modal');
            const img = document.getElementById('lightbox-img');
            const caption = document.getElementById('lightbox-caption');

            img.src = src;
            caption.textContent = title;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closeImageLightbox() {
            const modal = document.getElementById('image-lightbox-modal');
            modal.classList.remove('flex');
            modal.classList.add('hidden');
            document.body.style.overflow = '';
        }

        // Close Lightbox on Escape Key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeImageLightbox();
        });
    </script>
</body>

</html>