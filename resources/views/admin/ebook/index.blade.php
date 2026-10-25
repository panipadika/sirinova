<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Data E-Book Kajian - Admin Panel</title>
    <!-- Favicon Logo Tasikmalaya -->
    <link rel="icon" type="image/png" href="{{ asset('storage/images/favicon_tasik.png') }}?v=3">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=3">
    <link rel="apple-touch-icon" href="{{ asset('storage/images/favicon_tasik.png') }}?v=3">
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Public+Sans:wght@600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f7f6;
        }

        h1, h2, h3 {
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
    <div class="flex-1 flex flex-col h-screen md:ml-[260px] w-full md:w-[calc(100%-260px)]">

        <!-- Mobile Header Toggle -->
        <header class="md:hidden bg-white border-b flex justify-between items-center h-16 px-4">
            <button class="p-2 text-gray-500 rounded hover:bg-gray-100" id="menu-btn">
                <span class="material-symbols-outlined">menu</span>
            </button>
            <span class="text-xl font-bold">SI RINOVA</span>
        </header>

        <main class="flex-1 p-6 md:p-8 overflow-y-auto">

            <!-- Alert Sukses -->
            @if (session('success'))
                <div class="mb-4 p-3 bg-green-50 text-green-700 border border-green-200 rounded-lg flex items-center gap-3 text-sm">
                    <span class="material-symbols-outlined text-lg">check_circle</span>
                    {{ session('success') }}
                </div>
            @endif

            <!-- Judul & Tombol Tambah -->
            <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 gap-4">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 tracking-tight">E-Book Kajian</h2>
                    <p class="text-sm text-gray-600 mt-1">Kelola data e-book dan publikasi hasil kajian Bapperida.</p>
                </div>
                <a href="{{ route('admin.ebook.create') }}"
                    class="bg-[#29abe2] text-white px-5 py-2.5 rounded-md hover:bg-[#1a95c9] transition-colors flex items-center justify-center gap-2 font-medium text-sm shadow-sm">
                    <span class="material-symbols-outlined text-[18px]">add</span> Tambah E-Book
                </a>
            </div>

            <!-- Card Container -->
            <div class="bg-white rounded-xl shadow-[0_2px_10px_rgba(0,0,0,0.04)] border border-gray-100 overflow-hidden flex flex-col">

                <!-- Search & Filter Form -->
                <form method="GET" action="{{ route('admin.ebook.index') }}" id="filter-form"
                    class="p-4 border-b border-gray-100 flex flex-col sm:flex-row justify-between items-center gap-3">
                    <div class="flex flex-col sm:flex-row items-center gap-3 w-full sm:w-auto flex-1">
                        <!-- Live Search Input -->
                        <div class="relative w-full sm:w-80">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-[18px]">search</span>
                            <input type="text" name="search" id="search-input" value="{{ $search ?? '' }}"
                                placeholder="Cari e-book..." autocomplete="off"
                                class="w-full pl-9 pr-4 py-2 bg-white border border-gray-200 rounded-lg text-sm focus:ring-1 focus:ring-[#29abe2] outline-none transition-all">
                        </div>

                        <!-- Dropdown Filter Kategori -->
                        <select name="kategori" onchange="document.getElementById('filter-form').submit()"
                            class="w-full sm:w-auto px-3 py-2 pr-9 bg-white border border-gray-200 rounded-lg text-sm text-gray-600 outline-none focus:ring-1 focus:ring-[#29abe2] cursor-pointer transition-all">
                            <option value="Semua" {{ ($kategori ?? '') == 'Semua' ? 'selected' : '' }}>Semua Kategori</option>
                            @if(isset($listKategori) && count($listKategori) > 0)
                                @foreach($listKategori as $cat)
                                    <option value="{{ $cat }}" {{ ($kategori ?? '') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                @endforeach
                            @else
                                <option value="Kajian Teknis" {{ ($kategori ?? '') == 'Kajian Teknis' ? 'selected' : '' }}>Kajian Teknis</option>
                                <option value="Perencanaan" {{ ($kategori ?? '') == 'Perencanaan' ? 'selected' : '' }}>Perencanaan</option>
                                <option value="Inovasi Daerah" {{ ($kategori ?? '') == 'Inovasi Daerah' ? 'selected' : '' }}>Inovasi Daerah</option>
                                <option value="Sosial Ekonomi" {{ ($kategori ?? '') == 'Sosial Ekonomi' ? 'selected' : '' }}>Sosial Ekonomi</option>
                            @endif
                        </select>

                        <!-- Dropdown Filter Tahun -->
                        <select name="tahun" onchange="document.getElementById('filter-form').submit()"
                            class="w-full sm:w-auto px-3 py-2 pr-9 bg-white border border-gray-200 rounded-lg text-sm text-gray-600 outline-none focus:ring-1 focus:ring-[#29abe2] cursor-pointer transition-all">
                            <option value="Semua" {{ ($tahun ?? '') == 'Semua' ? 'selected' : '' }}>Semua Tahun</option>
                            @if(isset($listTahun) && count($listTahun) > 0)
                                @foreach($listTahun as $t)
                                    <option value="{{ $t }}" {{ ($tahun ?? '') == $t ? 'selected' : '' }}>{{ $t }}</option>
                                @endforeach
                            @else
                                <option value="2026" {{ ($tahun ?? '') == '2026' ? 'selected' : '' }}>2026</option>
                                <option value="2025" {{ ($tahun ?? '') == '2025' ? 'selected' : '' }}>2025</option>
                                <option value="2024" {{ ($tahun ?? '') == '2024' ? 'selected' : '' }}>2024</option>
                                <option value="2023" {{ ($tahun ?? '') == '2023' ? 'selected' : '' }}>2023</option>
                            @endif
                        </select>
                    </div>

                    <!-- Tombol Reset Filter Warna Biru -->
                    <a href="{{ route('admin.ebook.index') }}" class="w-full sm:w-auto bg-[#29abe2] hover:bg-[#1a95c9] text-white px-5 py-2 rounded-lg text-sm font-semibold transition-colors flex items-center justify-center gap-1.5 shadow-sm whitespace-nowrap">
                        <span class="material-symbols-outlined text-base">restart_alt</span> Reset
                    </a>
                </form>

                <!-- Table -->
                <div class="w-full overflow-x-auto">
                    <table class="w-full text-left border-collapse min-w-[800px]">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                <th class="py-3 px-4 text-center w-12">No</th>
                                <th class="py-3 px-4 w-20 text-center">Cover</th>
                                <th class="py-3 px-6">Judul E-Book</th>
                                <th class="py-3 px-4">Kategori</th>
                                <th class="py-3 px-4 text-center">Tahun</th>
                                <th class="py-3 px-4 text-center">File Dokumen</th>
                                <th class="py-3 px-3 text-center w-32">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-sm">
                            @forelse($ebooks as $index => $item)
                                <tr class="hover:bg-gray-50/70 transition-colors">
                                    <td class="py-3 px-4 text-center font-medium text-gray-400">
                                        {{ $ebooks->firstItem() + $index }}
                                    </td>
                                    <td class="py-3 px-4 text-center">
                                        @if($item->cover_image)
                                            <img src="{{ asset($item->cover_image) }}" alt="Cover" class="w-10 h-14 object-cover rounded border border-gray-200 mx-auto shadow-2xs">
                                        @else
                                            <div class="w-10 h-14 bg-slate-800 rounded border border-gray-200 flex items-center justify-center text-white/40 mx-auto shadow-2xs">
                                                <span class="material-symbols-outlined text-lg">menu_book</span>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="py-3 px-6">
                                        <a href="{{ route('public.ebook.detail', $item->id) }}" target="_blank" class="font-bold text-gray-900 hover:text-[#29abe2] transition-colors line-clamp-2">
                                            {{ $item->judul }}
                                        </a>
                                    </td>
                                    <td class="py-3 px-4">
                                        <span class="px-2.5 py-1 bg-blue-50 text-[#29abe2] border border-blue-200/60 rounded-md font-bold text-xs">
                                            {{ $item->kategori }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-4 text-center font-semibold text-gray-700">
                                        {{ $item->tahun }}
                                    </td>
                                    <td class="py-3 px-4 text-center">
                                        @if($item->file_url && $item->file_url !== '#')
                                            <a href="{{ asset($item->file_url) }}" target="_blank" class="inline-flex items-center gap-1 text-xs font-bold text-emerald-600 hover:text-emerald-700 bg-emerald-50 border border-emerald-200/60 px-2.5 py-1 rounded-md transition-colors">
                                                <span class="material-symbols-outlined text-sm">picture_as_pdf</span>
                                                <span>PDF</span>
                                            </a>
                                        @else
                                            <span class="text-gray-400 italic text-xs">Belum diunggah</span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-3 text-center">
                                        <div class="flex items-center justify-center gap-1.5">
                                            <a href="{{ route('admin.ebook.edit', $item->id) }}" class="p-1.5 bg-amber-50 text-amber-600 hover:bg-amber-100 rounded-lg transition-colors" title="Edit">
                                                <span class="material-symbols-outlined text-[18px]">edit</span>
                                            </a>
                                            <button type="button" onclick="openDeleteModal('{{ route('admin.ebook.destroy', $item->id) }}')" class="p-1.5 bg-red-50 text-red-600 hover:bg-red-100 rounded-lg transition-colors" title="Hapus">
                                                <span class="material-symbols-outlined text-[18px]">delete</span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="py-12 text-center text-gray-400">
                                        <span class="material-symbols-outlined text-4xl block mb-2 text-gray-300">menu_book</span>
                                        <p class="font-medium text-sm">Belum ada data E-Book Kajian</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Bagian Bawah Tabel -->
                <div class="p-4 border-t border-gray-100 bg-white">
                    @include('partials.pagination', ['paginator' => $ebooks, 'itemLabel' => 'E-Book Kajian'])
                </div>
            </div>
        </main>
    </div>

    <!-- Modal Hapus -->
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm hidden opacity-0 transition-opacity duration-300"
        id="delete-modal">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-sm mx-4 p-6 transform scale-95 transition-transform duration-300"
            id="delete-modal-content">
            <div class="flex items-center gap-3 text-red-600 mb-4">
                <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center flex-shrink-0">
                    <span class="material-symbols-outlined text-red-600">warning</span>
                </div>
                <h3 class="text-lg font-bold text-gray-900">Hapus E-Book Kajian?</h3>
            </div>
            <p class="text-sm text-gray-600 mb-6">Apakah Anda yakin ingin menghapus e-book kajian ini?</p>
            <form id="delete-form" method="POST" action="">
                @csrf
                @method('DELETE')
                <div class="flex items-center justify-end gap-2 mt-4">
                    <button type="button"
                        class="px-4 py-2 border border-gray-300 text-gray-700 text-sm rounded-md hover:bg-gray-50 font-medium"
                        id="cancel-delete">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 bg-red-600 text-white text-sm rounded-md hover:bg-red-700 shadow-sm font-medium">Hapus</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Script Hamburger Menu Mobile & Modal -->
    <script>
        // Toggle Sidebar Mobile
        const menuBtn = document.getElementById('menu-btn');
        const sidebar = document.getElementById('sidebar');

        if (menuBtn && sidebar) {
            menuBtn.addEventListener('click', () => {
                sidebar.classList.toggle('-translate-x-full');
            });
        }

        // Live Search Handler
        const searchInput = document.getElementById('search-input');
        const filterForm = document.getElementById('filter-form');
        let searchTimeout;

        if (searchInput && filterForm) {
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    filterForm.submit();
                }, 100);
            });

            window.addEventListener('DOMContentLoaded', () => {
                if (searchInput.value.length > 0) {
                    searchInput.focus();
                    searchInput.setSelectionRange(searchInput.value.length, searchInput.value.length);
                }
            });
        }

        // Modal Hapus Handler
        const deleteModal = document.getElementById('delete-modal');
        const deleteModalContent = document.getElementById('delete-modal-content');
        const cancelDeleteBtn = document.getElementById('cancel-delete');
        const deleteForm = document.getElementById('delete-form');

        function openDeleteModal(actionUrl) {
            deleteForm.action = actionUrl;
            deleteModal.classList.remove('hidden');
            void deleteModal.offsetWidth;
            deleteModal.classList.remove('opacity-0');
            deleteModalContent.classList.remove('scale-95');
        }

        function closeDeleteModal() {
            deleteModal.classList.add('opacity-0');
            deleteModalContent.classList.add('scale-95');
            setTimeout(() => {
                deleteModal.classList.add('hidden');
            }, 300);
        }

        cancelDeleteBtn?.addEventListener('click', closeDeleteModal);
        deleteModal?.addEventListener('click', (e) => {
            if (e.target === deleteModal) closeDeleteModal();
        });
    </script>
</body>

</html>
