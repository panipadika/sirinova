<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Data Inovator - Admin Panel</title>
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

            <!-- Alert Gagal / Error -->
            @if (session('error'))
                <div
                    class="mb-4 p-3 bg-red-50 text-red-700 border border-red-200 rounded-lg flex items-center gap-3 text-sm">
                    <span class="material-symbols-outlined text-lg">error</span>
                    {{ session('error') }}
                </div>
            @endif


            <!-- Judul & Tombol Tambah -->
            <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 gap-4">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Data Inovator</h2>
                    <p class="text-sm text-gray-600 mt-1">Kelola data inovator dan kelompok pemilik teknologi tepat
                        guna.</p>
                </div>
                <a href="/admin/inovator/create"
                    class="bg-[#29abe2] text-white px-5 py-2.5 rounded-md hover:bg-[#1a95c9] transition-colors flex items-center justify-center gap-2 font-medium text-sm shadow-sm">
                    <span class="material-symbols-outlined text-[18px]">add</span> Tambah Inovator
                </a>
            </div>

            <!-- Kontainer Utama Tabel -->
            <div
                class="bg-white rounded-xl shadow-[0_2px_10px_rgba(0,0,0,0.04)] border border-gray-100 overflow-hidden flex flex-col">

                <!-- Perbarui tag form dan input pencarian dengan ID -->
                <form method="GET" action="/admin/inovator" id="filter-form" class="p-4 border-b border-gray-100">
                    <div class="flex flex-col xl:flex-row gap-3">
                        <!-- Input Pencarian -->
                        <div class="relative flex-1">
                            <span
                                class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-[18px]">search</span>
                            <input name="search" id="search-input" value="{{ request('search') }}"
                                class="w-full pl-9 pr-3 py-2 bg-white border border-gray-200 rounded-md focus:ring-1 focus:ring-[#29abe2] outline-none text-sm"
                                placeholder="Cari nama inovator..." type="text" autocomplete="off">
                        </div>

                        <div class="flex flex-wrap md:flex-nowrap gap-2">
                            <!-- Dropdown Wilayah & Status tetap ada di sini -->
                            <select name="wilayah" onchange="document.getElementById('filter-form').submit()"
                                class="px-2 py-2 pr-8 bg-white border border-gray-200 rounded-md text-sm text-gray-600 outline-none focus:ring-1 focus:ring-[#29abe2]">
                                <option value="">Semua Wilayah</option>
                                @foreach ($wilayahList as $wil)
                                    <option value="{{ $wil->id }}"
                                        {{ request('wilayah') == $wil->id ? 'selected' : '' }}>
                                        {{ $wil->nama_kecamatan }}</option>
                                @endforeach
                            </select>

                            <select name="status" onchange="document.getElementById('filter-form').submit()"
                                class="px-2 py-2 pr-8 bg-white border border-gray-200 rounded-md text-sm text-gray-600 outline-none focus:ring-1 focus:ring-[#29abe2]">
                                <option value="">Semua Status</option>
                                <option value="Aktif" {{ request('status') == 'Aktif' ? 'selected' : '' }}>Aktif
                                </option>
                                <option value="Non-Aktif" {{ request('status') == 'Non-Aktif' ? 'selected' : '' }}>
                                    Non-Aktif</option>
                            </select>
                        </div>
                    </div>
                </form>

                <!-- Area Tabel Compact (Tanpa Scroll Samping) -->
                <div class="w-full overflow-x-auto">
                    <table class="w-full text-left border-collapse table-fixed min-w-[850px]">
                        <thead>
                            <tr
                                class="bg-[#f0f2f5] text-gray-500 text-[11px] font-bold uppercase tracking-wider border-b border-gray-200">
                                <th class="py-3 px-4 w-[6%]">No</th>
                                <th class="py-3 px-4 w-[24%]">Nama Inovator</th>
                                <th class="py-3 px-4 w-[18%]">Nomor Telepon</th>
                                <th class="py-3 px-4 w-[15%]">Wilayah</th>
                                <th class="py-3 px-4 w-[12%] text-center">Jumlah Alat</th>
                                <th class="py-3 px-4 w-[10%]">Status</th>
                                <th class="py-3 px-2 w-[15%] text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-[12px] text-gray-700 divide-y divide-gray-100">

                            @forelse($inovator as $index => $item)
                                <tr class="hover:bg-gray-50/50 transition-colors group">
                                    <td class="py-3 px-4 text-gray-500">{{ $inovator->firstItem() + $index }}</td>

                                    <!-- Kolom Nama Inovator (Tanpa No HP di bawahnya) -->
                                    <td class="py-3 px-4 font-semibold text-[#29abe2]">{{ $item->nama_inovator }}</td>

                                    <!-- Kolom Baru: No Telepon -->
                                    <td class="py-3 px-4 text-gray-600">{{ $item->nomor_telepon ?? '-' }}</td>
                                    <td class="py-3 px-4 text-gray-600">{{ $item->wilayah->nama_kecamatan ?? '-' }}
                                    </td>

                                    <!-- Lingkaran Jumlah Alat (Sesuai Desain) -->
                                    <td class="py-3 px-4 text-center">
                                        <span
                                            class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-[#e0f2fe] text-[#0369a1] font-bold text-[11px]">
                                            {{ $item->alat_ttg_count ?? 0 }}
                                        </span>
                                    </td>

                                    <!-- Status (Hijau & Abu-abu) -->
                                    <td class="py-3 px-4">
                                        @if ($item->status == 'Aktif')
                                            <span
                                                class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium bg-[#dcfce7] text-[#166534]">Aktif</span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium bg-gray-100 text-gray-600">Non-Aktif</span>
                                        @endif
                                    </td>

                                    <td class="py-3 px-2">
                                        <div class="flex items-center justify-center gap-1.5">
                                            <a href="/admin/inovator/{{ $item->id }}"
                                                class="p-1.5 bg-sky-50 text-sky-600 hover:bg-sky-100 rounded-lg transition-colors"
                                                title="Lihat">
                                                <span class="material-symbols-outlined text-[18px]">visibility</span>
                                            </a>
                                            <a href="/admin/inovator/{{ $item->id }}/edit"
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
                                    <td colspan="7" class="py-8 px-6 text-center text-gray-500 text-sm">
                                        Belum ada data inovator. Silakan tambah data baru.
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>

                <!-- Bagian Bawah Tabel -->
                <div class="px-6 py-4 border-t border-slate-200/70 bg-white">
                    @include('partials.pagination', ['paginator' => $inovator])
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
                <h3 class="text-lg font-bold text-gray-900">Hapus Inovator?</h3>
            </div>
            <p class="text-sm text-gray-600 mb-6">
                Apakah Anda yakin ingin menghapus data ini?
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
        // --- 1. FITUR LIVE SEARCH & FOCUS RESTORATION ---
        const searchInput = document.getElementById('search-input');
        const filterForm = document.getElementById('filter-form');
        let searchTimeout;

        searchInput?.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            // Tunggu 100ms setelah admin berhenti mengetik, baru submit form otomatis
            searchTimeout = setTimeout(() => {
                filterForm.submit();
            }, 100);
        });

        // Mengembalikan kursor ke kotak pencarian otomatis setelah halaman reload
        window.addEventListener('DOMContentLoaded', () => {
            if (searchInput && searchInput.value.length > 0) {
                searchInput.focus();
                searchInput.setSelectionRange(searchInput.value.length, searchInput.value.length);
            }
        });


        // --- 2. SKRIP MODAL HAPUS ---
        const modal = document.getElementById('delete-modal');
        const modalContent = document.getElementById('delete-modal-content');
        const cancelBtn = document.getElementById('cancel-delete');
        const deleteForm = document.getElementById('delete-form');

        function openModal(id) {
            deleteForm.action = '/admin/inovator/' + id;
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

        cancelBtn?.addEventListener('click', closeModal);
        modal?.addEventListener('click', (e) => {
            if (e.target === modal) closeModal();
        });


        // --- 3. SKRIP SIDEBAR MOBILE TOGGLE ---
        const menuBtn = document.getElementById('menu-btn');
        const sidebar = document.getElementById('sidebar');
        menuBtn?.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });
    </script>
</body>

</html>
