@if (isset($paginator) && $paginator->total() > 0)
    @php
        $currentPerPage = (int) request('per_page', $paginator->perPage());
        if (isset($perPageOptions)) {
            $options = $perPageOptions;
        } elseif (request()->is('admin*')) {
            $options = [5, 10, 25, 50, 100];
        } elseif (request()->is('ebook*') || request()->routeIs('public.ebook*')) {
            $options = [10, 20, 30, 50, 100];
        } elseif (request()->is('katalog*') || request()->is('kategori/*') || request()->is('wilayah/*')) {
            $options = [8, 12, 16, 24, 48, 80];
        } elseif (request()->is('telaahan-staf*') || request()->is('galeri*')) {
            $options = [6, 12, 18, 24, 48];
        } else {
            $options = [5, 10, 25, 50, 100];
        }
    @endphp
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 w-full">
        <!-- Left Section: Item Count & Per Page Selector -->
        <div class="flex flex-wrap items-center gap-3">
            <p class="text-xs sm:text-sm font-semibold text-slate-500">
                Menampilkan <span class="font-extrabold text-slate-800">
                    @if($paginator->firstItem() == $paginator->lastItem())
                        {{ $paginator->firstItem() }}
                    @else
                        {{ $paginator->firstItem() }} - {{ $paginator->lastItem() }}
                    @endif
                </span> dari total <span class="font-extrabold text-[#00A3E0]">{{ $paginator->total() }}</span> {{ $itemLabel ?? 'Data' }}
            </p>

            <!-- Per Page Pill Select (Crisp & Clean Single Arrow UI) -->
            <div class="relative inline-flex items-center">
                <select onchange="changePerPage(this.value)" 
                        style="background-image: none !important; -webkit-appearance: none !important; -moz-appearance: none !important; appearance: none !important;"
                        class="bg-white border border-slate-200 hover:border-slate-300 text-slate-700 font-medium text-xs py-1.5 pl-4 pr-8 rounded-full shadow-2xs cursor-pointer focus:outline-none focus:ring-2 focus:ring-[#00A3E0]/30 transition-all">
                    @foreach ($options as $opt)
                        <option value="{{ $opt }}" {{ $currentPerPage == $opt ? 'selected' : '' }}>{{ $opt }} / page</option>
                    @endforeach
                </select>
                <span class="material-symbols-outlined text-slate-400 text-base absolute right-2.5 pointer-events-none select-none">keyboard_arrow_down</span>
            </div>
        </div>

        <!-- Right Section: Page Buttons (Rendered when > 1 page) -->
        @if ($paginator->hasPages())
            <div class="inline-flex items-center gap-1.5 bg-slate-50 p-1.5 rounded-2xl border border-slate-200/80 shadow-2xs">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <span class="w-9 h-9 flex items-center justify-center rounded-xl bg-slate-200/50 text-slate-300 text-xs font-bold cursor-not-allowed">
                        <span class="material-symbols-outlined text-sm">chevron_left</span>
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" 
                       class="w-9 h-9 flex items-center justify-center rounded-xl bg-white text-slate-700 hover:bg-[#00A3E0] hover:text-white border border-slate-200 hover:border-[#00A3E0] text-xs font-bold transition-all shadow-2xs">
                        <span class="material-symbols-outlined text-sm">chevron_left</span>
                    </a>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($paginator->getUrlRange(1, $paginator->lastPage()) as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="w-9 h-9 flex items-center justify-center rounded-xl bg-[#00A3E0] text-white text-xs font-extrabold shadow-md shadow-[#00A3E0]/30 scale-105">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}" 
                           class="w-9 h-9 flex items-center justify-center rounded-xl bg-white text-slate-700 hover:bg-sky-50 hover:text-[#00A3E0] border border-slate-200 hover:border-[#00A3E0]/40 text-xs font-bold transition-all">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" 
                       class="w-9 h-9 flex items-center justify-center rounded-xl bg-white text-slate-700 hover:bg-[#00A3E0] hover:text-white border border-slate-200 hover:border-[#00A3E0] text-xs font-bold transition-all shadow-2xs">
                        <span class="material-symbols-outlined text-sm">chevron_right</span>
                    </a>
                @else
                    <span class="w-9 h-9 flex items-center justify-center rounded-xl bg-slate-200/50 text-slate-300 text-xs font-bold cursor-not-allowed">
                        <span class="material-symbols-outlined text-sm">chevron_right</span>
                    </span>
                @endif
            </div>
        @endif
    </div>

    <script>
        if (typeof changePerPage !== 'function') {
            function changePerPage(value) {
                const url = new URL(window.location.href);
                url.searchParams.set('per_page', value);
                url.searchParams.set('page', '1');
                window.location.href = url.toString();
            }
        }
    </script>
@endif
