<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Pesan Masuk - Admin Panel</title>
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

            <!-- Judul & Badge -->
            <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 gap-4">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 tracking-tight flex items-center gap-3">
                        Pesan Masuk
                        @if($totalBelumDibaca > 0)
                            <span class="bg-[#29abe2] text-white text-sm font-bold px-3 py-1 rounded-full">{{ $totalBelumDibaca }} baru</span>
                        @endif
                    </h2>
                    <p class="text-sm text-gray-600 mt-1">Kelola pesan dan pertanyaan dari pengunjung website SI RINOVA.</p>
                </div>
            </div>

            <!-- Card Container -->
            <div class="bg-white rounded-xl shadow-[0_2px_10px_rgba(0,0,0,0.04)] border border-gray-100 overflow-hidden flex flex-col">

                <!-- Search & Filter Form -->
                <form method="GET" action="{{ route('admin.pesan.index') }}" id="filter-form"
                    class="p-4 border-b border-gray-100 flex flex-col sm:flex-row justify-between items-center gap-3">
                    <div class="flex flex-col sm:flex-row items-center gap-3 w-full sm:w-auto flex-1">
                        <!-- Live Search Input -->
                        <div class="relative w-full sm:w-80">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-[18px]">search</span>
                            <input type="text" name="search" id="search-input" value="{{ $search }}"
                                placeholder="Cari nama, email, subjek..." autocomplete="off"
                                class="w-full pl-9 pr-4 py-2 bg-white border border-gray-200 rounded-lg text-sm focus:ring-1 focus:ring-[#29abe2] outline-none transition-all">
                        </div>

                        <!-- Dropdown Filter Status Baca -->
                        <select name="filter" onchange="document.getElementById('filter-form').submit()"
                            class="w-full sm:w-auto px-3 py-2 pr-9 bg-white border border-gray-200 rounded-lg text-sm text-gray-600 outline-none focus:ring-1 focus:ring-[#29abe2] cursor-pointer transition-all">
                            <option value="semua" {{ $filter == 'semua' ? 'selected' : '' }}>Semua Pesan</option>
                            <option value="belum_dibaca" {{ $filter == 'belum_dibaca' ? 'selected' : '' }}>Belum Dibaca</option>
                            <option value="sudah_dibaca" {{ $filter == 'sudah_dibaca' ? 'selected' : '' }}>Sudah Dibaca</option>
                        </select>
                    </div>

                    <!-- Tombol Reset Filter -->
                    <a href="{{ route('admin.pesan.index') }}"
                        class="w-full sm:w-auto bg-[#29abe2] hover:bg-[#1a95c9] text-white px-5 py-2 rounded-lg text-sm font-semibold transition-colors flex items-center justify-center gap-1.5 shadow-sm whitespace-nowrap">
                        <span class="material-symbols-outlined text-base">restart_alt</span> Reset
                    </a>
                </form>

                <!-- Tabel Data Pesan -->
                <div class="w-full overflow-x-auto">
                    <table class="w-full text-left border-collapse min-w-[700px]">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                <th class="p-4 w-10">#</th>
                                <th class="p-4">Pengirim</th>
                                <th class="p-4">Subjek</th>
                                <th class="p-4">Cuplikan Pesan</th>
                                <th class="p-4">Tanggal</th>
                                <th class="p-4">Status</th>
                                <th class="p-4 text-center w-36">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-sm">
                            @forelse($pesanList as $index => $item)
                                <tr class="hover:bg-gray-50/50 transition-colors {{ !$item->is_dibaca ? 'bg-sky-50/40' : '' }}">
                                    <!-- Nomor -->
                                    <td class="p-4 text-gray-400 text-xs">
                                        {{ $pesanList->firstItem() + $index }}
                                    </td>

                                    <!-- Pengirim (Nama, Email, No. WA) -->
                                    <td class="p-4">
                                        <p class="font-semibold text-gray-900 {{ !$item->is_dibaca ? 'font-bold' : '' }}">{{ $item->nama }}</p>
                                        <p class="text-xs text-gray-500 mt-0.5 flex items-center gap-1">
                                            <span class="material-symbols-outlined text-[13px] text-gray-400">mail</span> {{ $item->email }}
                                        </p>
                                        @if($item->no_wa)
                                            <p class="text-xs text-emerald-600 mt-0.5 flex items-center gap-1 font-medium">
                                                <span class="material-symbols-outlined text-[13px]">call</span> {{ $item->no_wa }}
                                            </p>
                                        @endif
                                    </td>

                                    <!-- Subjek -->
                                    <td class="p-4">
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded bg-sky-50 text-[11px] font-semibold text-[#29abe2] border border-sky-100">
                                            {{ $item->subjek }}
                                        </span>
                                    </td>

                                    <!-- Cuplikan Pesan -->
                                    <td class="p-4 text-gray-600 text-xs max-w-[200px]">
                                        <p class="line-clamp-2">{{ Str::limit($item->pesan, 80) }}</p>
                                    </td>

                                    <!-- Tanggal -->
                                    <td class="p-4 text-gray-500 text-xs whitespace-nowrap">
                                        {{ $item->dibuat_pada ? $item->dibuat_pada->format('d M Y') : '-' }}
                                        <br>
                                        <span class="text-gray-400">{{ $item->dibuat_pada ? $item->dibuat_pada->format('H:i') . ' WIB' : '' }}</span>
                                    </td>

                                    <!-- Status Badge -->
                                    <td class="p-4">
                                        @if($item->is_dibaca)
                                            <span class="inline-flex items-center gap-1 text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-full text-xs font-medium">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Dibaca
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 text-[#29abe2] bg-sky-50 px-2.5 py-1 rounded-full text-xs font-medium">
                                                <span class="w-1.5 h-1.5 rounded-full bg-[#29abe2] animate-pulse"></span> Baru
                                            </span>
                                        @endif
                                    </td>

                                    <!-- Tombol Aksi -->
                                    <td class="p-4 text-center">
                                        <div class="flex items-center justify-center gap-1.5">
                                            <!-- Lihat Detail -->
                                            <a href="{{ route('admin.pesan.show', $item->id) }}"
                                                class="p-1.5 bg-sky-50 text-[#29abe2] hover:bg-sky-100 rounded-lg transition-colors" title="Lihat Detail">
                                                <span class="material-symbols-outlined text-[18px]">visibility</span>
                                            </a>

                                            <!-- Toggle Dibaca -->
                                            <form method="POST" action="{{ route('admin.pesan.toggle-dibaca', $item->id) }}" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                    class="p-1.5 bg-amber-50 text-amber-600 hover:bg-amber-100 rounded-lg transition-colors" title="{{ $item->is_dibaca ? 'Tandai Belum Dibaca' : 'Tandai Sudah Dibaca' }}">
                                                    <span class="material-symbols-outlined text-[18px]">{{ $item->is_dibaca ? 'mark_email_read' : 'mark_email_unread' }}</span>
                                                </button>
                                            </form>

                                            <!-- Hapus -->
                                            <button type="button" onclick="openDeleteModal('{{ route('admin.pesan.destroy', $item->id) }}')"
                                                class="p-1.5 bg-red-50 text-red-600 hover:bg-red-100 rounded-lg transition-colors" title="Hapus">
                                                <span class="material-symbols-outlined text-[18px]">delete</span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="p-8 text-center text-gray-400">
                                        <div class="flex flex-col items-center justify-center gap-2">
                                            <span class="material-symbols-outlined text-4xl text-gray-300">inbox</span>
                                            <p class="font-medium text-gray-500 text-sm">Belum ada pesan masuk.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="p-4 border-t border-gray-100 bg-white">
                    @include('partials.pagination', ['paginator' => $pesanList, 'itemLabel' => 'Pesan'])
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
                <h3 class="text-lg font-bold text-gray-900">Hapus Pesan?</h3>
            </div>
            <p class="text-sm text-gray-600 mb-6">Apakah Anda yakin ingin menghapus pesan ini? Tindakan ini tidak dapat dibatalkan.</p>
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

    <!-- Scripts -->
    <script>
        const menuBtn = document.getElementById('menu-btn');
        const sidebar = document.getElementById('sidebar');
        menuBtn?.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });

        // Live Search Debounce
        let searchTimeout;
        const searchInput = document.getElementById('search-input');
        searchInput?.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                document.getElementById('filter-form').submit();
            }, 500);
        });

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
