<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Data Alat TTG - Admin Panel</title>
    <!-- Favicon Logo Tasikmalaya -->
    <link rel="icon" type="image/png" href="{{ asset('storage/images/favicon_tasik.png') }}?v=3">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=3">
    <link rel="apple-touch-icon" href="{{ asset('storage/images/favicon_tasik.png') }}?v=3">
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Public+Sans:wght@600;700&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f7f6;
        }

        h1,
        h2,
        h3 {
            font-family: 'Public Sans', sans-serif;
        }

        nav[aria-label="Pagination"] {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
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

        <!-- Header Mobile Toggle -->
        <header class="md:hidden bg-white border-b flex justify-between items-center h-16 px-4">
            <button class="p-2 text-gray-500 rounded hover:bg-gray-100" id="menu-btn">
                <span class="material-symbols-outlined">menu</span>
            </button>
            <span class="text-xl font-bold">SI RINOVA</span>
        </header>

        <main class="flex-1 p-6 md:p-8 overflow-y-auto">

            <!-- Alert Sukses -->
            @if (session('success'))
                <div
                    class="mb-4 p-3 bg-green-50 text-green-700 border border-green-200 rounded-lg flex items-center gap-3 text-sm">
                    <span class="material-symbols-outlined text-lg">check_circle</span>
                    {{ session('success') }}
                </div>
            @endif

            <!-- Judul & Tombol Tambah -->
            <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 gap-4">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Data Alat TTG</h2>
                    <p class="text-sm text-gray-600 mt-1">Kelola data alat Teknologi Tepat Guna.</p>
                </div>

                <!-- BUNGKUSAN KANAN: Semua Tombol Disatukan Di Sini -->
                <div class="flex flex-wrap items-center gap-2">
                    <!-- Tombol PDF -->
                    <a href="{{ route('alat.pdf') }}"
                        class="px-3 py-2 bg-red-600 text-white text-xs rounded shadow-sm hover:bg-red-700 flex items-center gap-1">
                        <span class="material-symbols-outlined text-[16px]">picture_as_pdf</span> PDF
                    </a>
                    <!-- Tombol Excel -->
                    <a href="{{ route('alat.excel') }}"
                        class="px-3 py-2 bg-green-600 text-white text-xs rounded shadow-sm hover:bg-green-700 flex items-center gap-1">
                        <span class="material-symbols-outlined text-[16px]">table</span> Excel
                    </a>
                    <!-- Tombol Tambah Alat -->
                    <a href="/admin/alat/create"
                        class="ml-2 bg-[#29abe2] text-white px-5 py-2.5 rounded-md hover:bg-[#1a95c9] transition-colors flex items-center justify-center gap-2 font-medium text-sm shadow-sm">
                        <span class="material-symbols-outlined text-[18px]">add</span> Tambah Alat TTG
                    </a>
                </div>
            </div>

            <!-- Kontainer Utama Tabel -->
            <div
                class="bg-white rounded-xl shadow-[0_2px_10px_rgba(0,0,0,0.04)] border border-gray-100 overflow-hidden flex flex-col">

                <!-- Filter Bar dengan ID "filter-form" -->
                <form method="GET" action="/admin/alat" id="filter-form"
                    class="p-4 border-b border-gray-100 bg-white">
                    <div class="flex flex-col xl:flex-row gap-3">
                        <!-- Search Bar dengan ID "search-input" -->
                        <div class="relative flex-1">
                            <span
                                class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-[18px]">search</span>
                            <input name="search" id="search-input" value="{{ request('search') }}"
                                class="w-full pl-9 pr-3 py-2 bg-white border border-gray-200 rounded-md focus:ring-1 focus:ring-[#29abe2] outline-none text-sm"
                                placeholder="Cari nama alat atau inovator..." type="text" autocomplete="off">
                        </div>

                        <!-- Dropdowns -->
                        <div class="flex flex-wrap md:flex-nowrap gap-2">
                            <!-- Filter Kategori -->
                            <select name="kategori" onchange="document.getElementById('filter-form').submit()"
                                class="px-3 py-2 pr-9 bg-white border border-gray-200 rounded-lg text-sm text-gray-600 outline-none focus:ring-1 focus:ring-[#29abe2] cursor-pointer transition-all min-w-[150px]">
                                <option value="">Semua Kategori</option>
                                @foreach ($kategoriList as $kat)
                                    <option value="{{ $kat->id }}"
                                        {{ request('kategori') == $kat->id ? 'selected' : '' }}>
                                        {{ $kat->nama_kategori }}</option>
                                @endforeach
                            </select>

                            <!-- Filter Wilayah -->
                            <select name="wilayah" onchange="document.getElementById('filter-form').submit()"
                                class="px-3 py-2 pr-9 bg-white border border-gray-200 rounded-lg text-sm text-gray-600 outline-none focus:ring-1 focus:ring-[#29abe2] cursor-pointer transition-all min-w-[140px]">
                                <option value="">Semua Wilayah</option>
                                @foreach ($wilayahList as $wil)
                                    <option value="{{ $wil->id }}"
                                        {{ request('wilayah') == $wil->id ? 'selected' : '' }}>
                                        {{ $wil->nama_kecamatan }}</option>
                                @endforeach
                            </select>

                            <!-- Filter Tahun -->
                            <select name="tahun" onchange="document.getElementById('filter-form').submit()"
                                class="px-3 py-2 pr-9 bg-white border border-gray-200 rounded-lg text-sm text-gray-600 outline-none focus:ring-1 focus:ring-[#29abe2] cursor-pointer transition-all min-w-[100px]">
                                <option value="">Tahun</option>
                                @foreach ($tahunList as $thn)
                                    <option value="{{ $thn }}"
                                        {{ request('tahun') == $thn ? 'selected' : '' }}>{{ $thn }}</option>
                                @endforeach
                            </select>

                            <!-- Filter Status -->
                            <select name="status" onchange="document.getElementById('filter-form').submit()"
                                class="px-3 py-2 pr-9 bg-white border border-gray-200 rounded-lg text-sm text-gray-600 outline-none focus:ring-1 focus:ring-[#29abe2] cursor-pointer transition-all min-w-[100px]">
                                <option value="">Status</option>
                                <option value="Publik" {{ request('status') == 'Publik' ? 'selected' : '' }}>Publik</option>
                                <option value="Draft" {{ request('status') == 'Draft' ? 'selected' : '' }}>Draft</option>
                            </select>

                            <!-- Tombol Reset Filter Warna Biru -->
                            <a href="/admin/alat"
                                class="bg-[#29abe2] hover:bg-[#1a95c9] text-white px-5 py-2 rounded-lg text-sm font-semibold transition-colors flex items-center justify-center gap-1.5 shadow-sm whitespace-nowrap">
                                <span class="material-symbols-outlined text-base">restart_alt</span> Reset
                            </a>
                        </div>
                    </div>
                </form>

                <!-- Area Tabel Pas di Layar -->
                <div class="w-full overflow-x-auto">
                    <table class="w-full text-left border-collapse table-fixed min-w-[900px]">
                        <thead>
                            <tr
                                class="bg-[#f0f2f5] text-gray-500 text-[11px] font-bold uppercase tracking-wider border-b border-gray-200">
                                <th class="py-3 px-3 w-[5%]">No</th>
                                <th class="py-3 px-3 w-[7%]">Foto</th>
                                <th class="py-3 px-3 w-[23%]">Nama Alat</th>
                                <th class="py-3 px-3 w-[12%]">Kategori</th>
                                <th class="py-3 px-3 w-[14%]">Inovator</th>
                                <th class="py-3 px-3 w-[10%]">Wilayah</th>
                                <th class="py-3 px-3 w-[7%]">Tahun</th>
                                <th class="py-3 px-3 w-[8%]">Status</th>
                                <th class="py-3 px-2 w-[14%] text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-[12px] text-gray-700 divide-y divide-gray-100">

                            @forelse($alat as $index => $item)
                                <tr class="hover:bg-gray-50/50 transition-colors group">
                                    <td class="py-3 px-3 text-gray-500">{{ $alat->firstItem() + $index }}</td>
                                    <td class="py-3 px-3">
                                        <div
                                            class="w-10 h-10 rounded-md bg-gray-100 flex items-center justify-center overflow-hidden border border-gray-200">
                                            <img alt="{{ $item->nama_alat }}" class="w-full h-full object-cover"
                                                src="{{ asset('storage/' . $item->foto) }}"
                                                onerror="this.onerror=null; this.src='data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'60\' height=\'60\' viewBox=\'0 0 24 24\' fill=\'%23f3f4f6\' stroke=\'%239ca3af\' stroke-width=\'1.5\'><rect width=\'18\' height=\'18\' x=\'3\' y=\'3\' rx=\'2\'/><circle cx=\'8.5\' cy=\'8.5\' r=\'1.5\'/><path d=\'m21 15-5-5L5 21\'/></svg>'">
                                        </div>
                                    </td>
                                    <td class="py-3 px-3 font-medium text-[#29abe2] leading-tight pr-2">
                                        {{ $item->nama_alat }}</td>
                                    <td class="py-3 px-3">
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded bg-[#e0f2fe] text-[#0369a1] font-medium text-[10px]">
                                            {{ $item->kategori->nama_kategori ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-3 leading-tight">{{ $item->inovator->nama_inovator ?? '-' }}
                                    </td>
                                    <td class="py-3 px-3 text-gray-500">{{ $item->wilayah->nama_kecamatan ?? '-' }}
                                    </td>
                                    <td class="py-3 px-3 text-gray-500">{{ $item->tahun_produksi }}</td>
                                    <td class="py-3 px-3">
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium
                                        {{ $item->status_publikasi == 'Publik' ? 'bg-[#fef9c3] text-[#b45309]' : 'bg-gray-100 text-gray-600' }}">
                                            <!-- MENGUBAH TAMPILAN JIKA DATANYA 'Publik' MENJADI 'Publik' -->
                                            {{ $item->status_publikasi == 'Publik' ? 'Publik' : $item->status_publikasi }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-2">
                                        <div class="flex items-center justify-center gap-1.5">
                                            <a href="/admin/alat/{{ $item->id }}"
                                                class="p-1.5 bg-sky-50 text-sky-600 hover:bg-sky-100 rounded-lg transition-colors"
                                                title="Lihat">
                                                <span class="material-symbols-outlined text-[18px]">visibility</span>
                                            </a>
                                            <a href="/admin/alat/{{ $item->id }}/edit"
                                                class="p-1.5 bg-amber-50 text-amber-600 hover:bg-amber-100 rounded-lg transition-colors"
                                                title="Edit">
                                                <span class="material-symbols-outlined text-[18px]">edit</span>
                                            </a>
                                            <button type="button" onclick="openModal('{{ $item->id }}')"
                                                class="p-1.5 bg-red-50 text-red-600 hover:bg-red-100 rounded-lg transition-colors"
                                                title="Hapus">
                                                <span class="material-symbols-outlined text-[18px]">delete</span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="py-8 px-6 text-center text-gray-500 text-sm">
                                        Belum ada data alat TTG. Silakan tambah data baru.
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>

                <!-- Bagian Bawah Tabel -->
                <div class="p-4 border-t border-gray-100 bg-white">
                    @include('partials.pagination', ['paginator' => $alat])
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
                <h3 class="text-lg font-bold text-gray-900">Hapus Alat TTG?</h3>
            </div>
            <p class="text-sm text-gray-600 mb-6">
                Apakah Anda yakin ingin menghapus data ini? Data yang terhapus tidak dapat dikembalikan.
            </p>
            <form id="delete-form" method="POST" action="">
                @csrf
                @method('DELETE')
                <div class="flex items-center justify-end gap-2 mt-4">
                    <button type="button"
                        class="px-4 py-2 border border-gray-300 text-gray-700 text-sm rounded-md hover:bg-gray-50 outline-none font-medium"
                        id="cancel-delete">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-4 py-2 bg-red-600 text-white text-sm rounded-md hover:bg-red-700 shadow-sm flex items-center gap-1 font-medium">
                        Hapus
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // 1. Live Search dengan Debounce & Pengunci Fokus Kursor
        const searchInput = document.getElementById('search-input');
        const filterForm = document.getElementById('filter-form');
        let searchTimeout;

        searchInput?.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                filterForm.submit();
            }, 700);
        });

        window.addEventListener('DOMContentLoaded', () => {
            if (searchInput && searchInput.value.length > 0) {
                searchInput.focus();
                searchInput.setSelectionRange(searchInput.value.length, searchInput.value.length);
            }
        });

        // 2. Skrip Modal Hapus
        const modal = document.getElementById('delete-modal');
        const modalContent = document.getElementById('delete-modal-content');
        const cancelBtn = document.getElementById('cancel-delete');
        const deleteForm = document.getElementById('delete-form');

        function openModal(id) {
            deleteForm.action = '/admin/alat/' + id;
            modal.classList.remove('hidden');
            void modal.offsetWidth;
            modal.classList.remove('opacity-0');
            modalContent.classList.remove('scale-95');
        }

        function closeModal() {
            modal.classList.add('opacity-0');
            modalContent.classList.add('scale-95');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }

        cancelBtn.addEventListener('click', closeModal);
        modal.addEventListener('click', (e) => {
            if (e.target === modal) closeModal();
        });

        // 3. Skrip Sidebar Mobile Toggle
        const menuBtn = document.getElementById('menu-btn');
        const sidebar = document.getElementById('sidebar');
        menuBtn.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });
    </script>
</body>

</html>
