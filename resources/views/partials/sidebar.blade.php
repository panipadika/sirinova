<nav class="bg-[#29abe2] text-white w-[260px] h-screen fixed left-0 top-0 z-50 flex flex-col transition-transform transform -translate-x-full md:translate-x-0" id="sidebar">
    <!-- Header Logo & Title -->
    <div class="p-4 sm:p-5 flex items-center gap-3">
        <img alt="SI RINOVA Logo" class="h-9 w-auto object-contain" src="{{ asset('storage/images/logo_tasik.png') }}">
        <div>
            <h1 class="text-base font-bold leading-tight" style="font-family: 'Public Sans', sans-serif;">SI RINOVA</h1>
            <p class="text-[11px] text-white/80">Admin Panel</p>
        </div>
    </div>

    <!-- Navigation Menu List -->
    <ul class="flex-1 px-3 space-y-1 mt-1 text-xs font-medium overflow-y-auto">
        <!-- Dashboard -->
        <li class="{{ request()->is('admin/dashboard*') ? 'relative' : '' }}">
            @if(request()->is('admin/dashboard*'))
                <div class="absolute left-[-12px] top-0 bottom-0 w-1 bg-[#fed000] rounded-r-md"></div>
            @endif
            <a class="flex items-center gap-2.5 px-3 py-2 {{ request()->is('admin/dashboard*') ? 'bg-white/20 font-semibold' : 'hover:bg-white/10' }} rounded-lg transition-colors" href="/admin/dashboard">
                <span class="material-symbols-outlined text-[20px]">dashboard</span> Dashboard
            </a>
        </li>

        <!-- Indikator Makro -->
        <li class="{{ request()->is('admin/indikator-makro*') ? 'relative' : '' }}">
            @if(request()->is('admin/indikator-makro*'))
                <div class="absolute left-[-12px] top-0 bottom-0 w-1 bg-[#fed000] rounded-r-md"></div>
            @endif
            <a class="flex items-center gap-2.5 px-3 py-2 {{ request()->is('admin/indikator-makro*') ? 'bg-white/20 font-semibold' : 'hover:bg-white/10' }} rounded-lg transition-colors" href="/admin/indikator-makro">
                <span class="material-symbols-outlined text-[20px]">equalizer</span> Indikator Makro
            </a>
        </li>

        <!-- Dropdown Katalog TTG -->
        @php
            $isKatalogActive = request()->is('admin/alat*') || request()->is('admin/inovator*') || request()->is('admin/kategori*') || request()->is('admin/wilayah*');
        @endphp
        <li class="{{ $isKatalogActive ? 'relative' : '' }}">
            @if($isKatalogActive)
                <div class="absolute left-[-12px] top-0 bottom-0 w-1 bg-[#fed000] rounded-r-md"></div>
            @endif
            <button type="button" onclick="toggleSubmenu('katalog-submenu', 'katalog-chevron')"
                class="flex w-full items-center justify-between px-3 py-2 {{ $isKatalogActive ? 'bg-white/20 font-semibold' : 'hover:bg-white/10' }} rounded-lg transition-colors text-left focus:outline-none cursor-pointer">
                <div class="flex items-center gap-2.5">
                    <span class="material-symbols-outlined text-[20px]">storefront</span>
                    <span>Katalog TTG</span>
                </div>
                <span id="katalog-chevron" class="material-symbols-outlined text-base transition-transform duration-200 {{ $isKatalogActive ? 'rotate-180' : '' }}">
                    expand_more
                </span>
            </button>

            <!-- Submenu Items -->
            <ul id="katalog-submenu" class="{{ $isKatalogActive ? 'block' : 'hidden' }} pl-3 pt-1 space-y-1 border-l border-white/20 ml-4 my-1">
                <!-- Alat TTG -->
                <li>
                    <a class="flex items-center gap-2 px-2.5 py-1.5 {{ request()->is('admin/alat*') ? 'bg-white/30 font-bold' : 'hover:bg-white/10' }} rounded-md transition-colors text-[11px]" href="/admin/alat">
                        <span class="material-symbols-outlined text-base">inventory_2</span>
                        <span>Alat TTG</span>
                    </a>
                </li>
                <!-- Inovator -->
                <li>
                    <a class="flex items-center gap-2 px-2.5 py-1.5 {{ request()->is('admin/inovator*') ? 'bg-white/30 font-bold' : 'hover:bg-white/10' }} rounded-md transition-colors text-[11px]" href="/admin/inovator">
                        <span class="material-symbols-outlined text-base">groups</span>
                        <span>Inovator</span>
                    </a>
                </li>
                <!-- Kategori -->
                <li>
                    <a class="flex items-center gap-2 px-2.5 py-1.5 {{ request()->is('admin/kategori*') ? 'bg-white/30 font-bold' : 'hover:bg-white/10' }} rounded-md transition-colors text-[11px]" href="/admin/kategori">
                        <span class="material-symbols-outlined text-base">category</span>
                        <span>Kategori Sektor</span>
                    </a>
                </li>
                <!-- Wilayah -->
                <li>
                    <a class="flex items-center gap-2 px-2.5 py-1.5 {{ request()->is('admin/wilayah*') ? 'bg-white/30 font-bold' : 'hover:bg-white/10' }} rounded-md transition-colors text-[11px]" href="/admin/wilayah">
                        <span class="material-symbols-outlined text-base">map</span>
                        <span>Sebaran Wilayah</span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- E-Book Kajian -->
        <li class="{{ request()->is('admin/ebook*') ? 'relative' : '' }}">
            @if(request()->is('admin/ebook*'))
                <div class="absolute left-[-12px] top-0 bottom-0 w-1 bg-[#fed000] rounded-r-md"></div>
            @endif
            <a class="flex items-center gap-2.5 px-3 py-2 {{ request()->is('admin/ebook*') ? 'bg-white/20 font-semibold' : 'hover:bg-white/10' }} rounded-lg transition-colors" href="/admin/ebook">
                <span class="material-symbols-outlined text-[20px]">menu_book</span> E-Book Kajian
            </a>
        </li>

        <!-- Telaahan Staf -->
        <li class="{{ request()->is('admin/telaahan-staf*') ? 'relative' : '' }}">
            @if(request()->is('admin/telaahan-staf*'))
                <div class="absolute left-[-12px] top-0 bottom-0 w-1 bg-[#fed000] rounded-r-md"></div>
            @endif
            <a class="flex items-center gap-2.5 px-3 py-2 {{ request()->is('admin/telaahan-staf*') ? 'bg-white/20 font-semibold' : 'hover:bg-white/10' }} rounded-lg transition-colors" href="/admin/telaahan-staf">
                <span class="material-symbols-outlined text-[20px]">description</span> Telaahan Staf
            </a>
        </li>

        <!-- Galeri Kegiatan -->
        <li class="{{ request()->is('admin/galeri*') ? 'relative' : '' }}">
            @if(request()->is('admin/galeri*'))
                <div class="absolute left-[-12px] top-0 bottom-0 w-1 bg-[#fed000] rounded-r-md"></div>
            @endif
            <a class="flex items-center gap-2.5 px-3 py-2 {{ request()->is('admin/galeri*') ? 'bg-white/20 font-semibold' : 'hover:bg-white/10' }} rounded-lg transition-colors" href="/admin/galeri">
                <span class="material-symbols-outlined text-[20px]">photo_library</span> Galeri Kegiatan
            </a>
        </li>

        <!-- Pendaftaran Lomba TTG -->
        @php
            $isLombaKaryaActive = request()->is('admin/lomba') || (request()->is('admin/lomba/*') && !request()->is('admin/lomba/akun*'));
            $isLombaAkunActive = request()->is('admin/lomba/akun*');
            $lombaMenunggu = \App\Models\PendaftaranLomba::where('status', 'Menunggu Verifikasi')->count();
        @endphp
        <li class="{{ $isLombaKaryaActive ? 'relative' : '' }}">
            @if($isLombaKaryaActive)
                <div class="absolute left-[-12px] top-0 bottom-0 w-1 bg-[#fed000] rounded-r-md"></div>
            @endif
            <a class="flex items-center gap-2.5 px-3 py-2 {{ $isLombaKaryaActive ? 'bg-white/20 font-semibold' : 'hover:bg-white/10' }} rounded-lg transition-colors" href="/admin/lomba">
                <span class="material-symbols-outlined text-[20px]">emoji_events</span> Pendaftaran Lomba
                @if($lombaMenunggu > 0)
                    <span class="ml-auto bg-red-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full leading-none shadow-sm">{{ $lombaMenunggu }}</span>
                @endif
            </a>
        </li>

        <!-- Akun Peserta Lomba -->
        <li class="{{ $isLombaAkunActive ? 'relative' : '' }}">
            @if($isLombaAkunActive)
                <div class="absolute left-[-12px] top-0 bottom-0 w-1 bg-[#fed000] rounded-r-md"></div>
            @endif
            <a class="flex items-center gap-2.5 px-3 py-2 {{ $isLombaAkunActive ? 'bg-white/20 font-semibold' : 'hover:bg-white/10' }} rounded-lg transition-colors" href="/admin/lomba/akun">
                <span class="material-symbols-outlined text-[20px]">group</span> Akun Peserta Lomba
            </a>
        </li>

        <!-- Pesan Masuk -->
        @php
            $pesanBelumDibaca = \App\Models\Pesan::where('is_dibaca', false)->count();
        @endphp
        <li class="{{ request()->is('admin/pesan*') ? 'relative' : '' }}">
            @if(request()->is('admin/pesan*'))
                <div class="absolute left-[-12px] top-0 bottom-0 w-1 bg-[#fed000] rounded-r-md"></div>
            @endif
            <a class="flex items-center gap-2.5 px-3 py-2 {{ request()->is('admin/pesan*') ? 'bg-white/20 font-semibold' : 'hover:bg-white/10' }} rounded-lg transition-colors" href="/admin/pesan">
                <span class="material-symbols-outlined text-[20px]">inbox</span> Pesan Masuk
                @if($pesanBelumDibaca > 0)
                    <span class="ml-auto bg-red-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full leading-none shadow-sm">{{ $pesanBelumDibaca }}</span>
                @endif
            </a>
        </li>

        <!-- Pengaturan Admin -->
        <li class="{{ request()->is('admin/pengaturan*') ? 'relative' : '' }}">
            @if(request()->is('admin/pengaturan*'))
                <div class="absolute left-[-12px] top-0 bottom-0 w-1 bg-[#fed000] rounded-r-md"></div>
            @endif
            <a class="flex items-center gap-2.5 px-3 py-2 {{ request()->is('admin/pengaturan*') ? 'bg-white/20 font-semibold' : 'hover:bg-white/10' }} rounded-lg transition-colors" href="{{ route('admin.pengaturan') }}">
                <span class="material-symbols-outlined text-[20px]">settings</span> Pengaturan Admin
            </a>
        </li>
    </ul>

    <!-- Logout Footer -->
    <div class="p-3.5 mt-auto border-t border-white/15">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="flex w-full items-center gap-2.5 px-3 py-2 hover:bg-white/10 rounded-lg transition-colors text-xs font-medium">
                <span class="material-symbols-outlined text-[20px]">logout</span> Logout
            </button>
        </form>
    </div>
</nav>

<script>
    function toggleSubmenu(menuId, chevronId) {
        const menu = document.getElementById(menuId);
        const chevron = document.getElementById(chevronId);
        if (menu) {
            menu.classList.toggle('hidden');
        }
        if (chevron) {
            chevron.classList.toggle('rotate-180');
        }
    }
</script>
