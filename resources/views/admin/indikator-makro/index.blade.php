<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Indikator Makro - Admin Panel</title>
    <!-- Favicon Logo Tasikmalaya -->
    <link rel="icon" type="image/png" href="{{ asset('storage/images/favicon_tasik.png') }}?v=3">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=3">
    <link rel="apple-touch-icon" href="{{ asset('storage/images/favicon_tasik.png') }}?v=3">
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Public+Sans:wght@600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f7f6;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Public Sans', sans-serif;
        }

        /* Hide scrollbar completely across all elements & browsers */
        html, body, div, main, table, ul, nav, * {
            -ms-overflow-style: none !important;
            scrollbar-width: none !important;
        }

        ::-webkit-scrollbar,
        *::-webkit-scrollbar,
        html::-webkit-scrollbar,
        body::-webkit-scrollbar,
        div::-webkit-scrollbar {
            display: none !important;
            width: 0 !important;
            height: 0 !important;
        }

        /* Hide number input spinners/arrows */
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        input[type=number] {
            -moz-appearance: textfield;
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
            <span class="text-lg font-bold text-gray-900">Indikator Makro</span>
        </header>

        <main class="flex-1 p-5 md:p-6 space-y-5">
            <!-- Alert Messages -->
            @if(session('success'))
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl text-sm flex items-center justify-between shadow-sm">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-emerald-500">check_circle</span>
                        <span>{{ session('success') }}</span>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700">
                        <span class="material-symbols-outlined text-base">close</span>
                    </button>
                </div>
            @endif

            <!-- Top Header & Filter -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white p-5 rounded-xl border border-gray-100 shadow-[0_2px_8px_rgba(0,0,0,0.03)]">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Kelola Indikator Makro</h2>
                    <p class="text-xs text-gray-500 mt-1">Kelola jenis indikator makro dan kelola data perbandingan 27 Kota/Kabupaten Jawa Barat.</p>
                </div>
                <div class="flex flex-row items-center justify-end gap-2.5 shrink-0">
                    <!-- Filter Tahun & Button Tambah Tahun -->
                    <form method="GET" action="{{ route('admin.indikator-makro.index') }}" class="flex items-center gap-2 m-0">
                        <span class="text-xs font-semibold text-gray-600 whitespace-nowrap">Tahun Data:</span>
                        <select name="tahun" onchange="this.form.submit()" class="text-xs font-bold text-gray-700 bg-white border border-gray-200 rounded-lg pl-3 pr-7 py-1.5 focus:ring-2 focus:ring-[#29abe2] focus:border-[#29abe2] cursor-pointer shadow-xs transition-all outline-none w-auto">
                            @foreach($tahunList as $th)
                                <option value="{{ $th }}" {{ $selectedTahun == $th ? 'selected' : '' }}>{{ $th }}</option>
                            @endforeach
                        </select>
                    </form>

                    <!-- Tombol Tambah Tahun Data Baru -->
                    <button onclick="openModal('modal-tambah-tahun')" class="bg-gray-100 hover:bg-gray-200 text-gray-700 border border-gray-200 px-3 py-2 rounded-lg text-xs font-semibold flex items-center justify-center gap-1.5 transition-colors shadow-2xs whitespace-nowrap" title="Buka Pendataan Tahun Baru">
                        <span class="material-symbols-outlined text-[16px] text-[#29abe2]">calendar_add_on</span> + Tambah Tahun
                    </button>

                    <!-- Tombol Tambah Master Indikator -->
                    <button onclick="openModal('modal-tambah')" class="bg-[#29abe2] hover:bg-[#1a95c9] text-white px-4 py-2 rounded-lg text-xs font-semibold flex items-center justify-center gap-1.5 transition-colors shadow-sm whitespace-nowrap">
                        <span class="material-symbols-outlined text-[18px]">add</span> Tambah Master Indikator
                    </button>
                </div>
            </div>

            <!-- Master Indikator Table -->
            <div class="bg-white rounded-xl border border-gray-100 shadow-[0_2px_8px_rgba(0,0,0,0.03)] overflow-hidden">
                <div class="p-4 border-b border-gray-100 flex items-center justify-between bg-white">
                    <h3 class="text-sm font-bold text-gray-900 flex items-center gap-2">
                        <span class="material-symbols-outlined text-[#29abe2]">equalizer</span>
                        Daftar Indikator Makro & Status Data (Tahun {{ $selectedTahun }})
                    </h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-[#f8fafc] text-gray-500 text-[11px] font-bold uppercase tracking-wider border-b border-gray-200">
                                <th class="py-3 px-4 w-[6%] text-center">Urutan</th>
                                <th class="py-3 px-4 w-[28%]">Nama Indikator</th>
                                <th class="py-3 px-4 w-[12%] text-center">Satuan</th>
                                <th class="py-3 px-4 w-[18%] text-center">Status Data ({{ $selectedTahun }})</th>
                                <th class="py-3 px-4 w-[16%] text-center">Nilai Kota Tasik</th>
                                <th class="py-3 px-4 w-[20%] text-center">Aksi / Kelola</th>
                            </tr>
                        </thead>
                        <tbody class="text-xs text-gray-700 divide-y divide-gray-100">
                            @forelse($indikatorList as $item)
                                @php
                                    $info = $rekapData[$item->id] ?? ['total_daerah' => 0, 'nilai_tasik' => null];
                                @endphp
                                <tr class="hover:bg-gray-50/60 transition-colors">
                                    <td class="py-3 px-4 text-center font-bold text-gray-500">{{ $item->urutan }}</td>
                                    <td class="py-3 px-4">
                                        <div class="font-bold text-gray-900">{{ $item->nama_indikator }}</div>
                                        @if($item->deskripsi)
                                            <div class="text-[11px] text-gray-400 mt-0.5">{{ Str::limit($item->deskripsi, 60) }}</div>
                                        @endif
                                    </td>
                                    <td class="py-3 px-4 text-center">
                                        <span class="inline-flex px-2.5 py-1 rounded-full text-[10px] font-bold bg-blue-50 text-[#0284c7] border border-blue-100">
                                            {{ $item->satuan }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-4 text-center">
                                        @if($info['total_daerah'] > 0)
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[11px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                                Terisi {{ $info['total_daerah'] }} Daerah
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[11px] font-semibold bg-amber-50 text-amber-700 border border-amber-200">
                                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                                Belum Ada Data
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-4 text-center">
                                        @if($info['nilai_tasik'] !== null)
                                            <span class="font-bold text-gray-900 bg-[#fed000]/25 px-2.5 py-1 rounded-md text-xs border border-[#fed000]/60 shadow-2xs">
                                                {{ str_replace('.', ',', $info['nilai_tasik']) }} {{ $item->satuan }}
                                            </span>
                                        @else
                                            <span class="text-gray-400 italic text-[11px]">-</span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-4 text-center">
                                        <div class="flex items-center justify-center gap-1.5">
                                            <!-- Tombol Input Batch Data -->
                                            <a href="{{ route('admin.indikator-makro.input', ['indikator_id' => $item->id, 'tahun' => $selectedTahun]) }}"
                                               class="bg-[#29abe2] hover:bg-[#1a95c9] text-white px-2.5 py-1.5 rounded-lg text-[11px] font-semibold flex items-center gap-1 shadow-xs transition-colors"
                                               title="Input/Edit Data 27 Daerah">
                                                <span class="material-symbols-outlined text-sm">edit_note</span> Input Data
                                            </a>

                                            <!-- Tombol Edit Master -->
                                            <button onclick="editModal('{{ $item->id }}', '{{ addslashes($item->nama_indikator) }}', '{{ addslashes($item->satuan) }}', '{{ addslashes($item->deskripsi ?? '') }}', '{{ $item->urutan }}')"
                                                    class="p-1.5 text-amber-600 hover:bg-amber-50 rounded-md transition-colors" title="Edit Master Indikator">
                                                <span class="material-symbols-outlined text-base">edit</span>
                                            </button>

                                            <!-- Tombol Hapus Master -->
                                            <button type="button" onclick="openDeleteModal('{{ $item->id }}')" class="p-1.5 text-rose-600 hover:bg-rose-50 rounded-md transition-colors" title="Hapus Master Indikator">
                                                <span class="material-symbols-outlined text-base">delete</span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-8 text-center text-gray-400 text-xs">
                                        Belum ada data master indikator makro. Silakan klik <strong>"Tambah Master Indikator"</strong>.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <!-- MODAL TAMBAH MASTER INDIKATOR -->
    <div id="modal-tambah" class="fixed inset-0 bg-black/40 backdrop-blur-xs z-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-2xl p-6 w-full max-w-md shadow-2xl border border-gray-100 animate-in fade-in zoom-in duration-200">
            <div class="flex items-center justify-between border-b border-gray-100 pb-3 mb-4">
                <h3 class="text-base font-bold text-gray-900 flex items-center gap-2">
                    <span class="material-symbols-outlined text-[#29abe2]">add_chart</span>
                    Tambah Master Indikator Makro
                </h3>
                <button onclick="closeModal('modal-tambah')" class="text-gray-400 hover:text-gray-600">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>

            <form action="{{ route('admin.indikator-makro.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Nama Indikator <span class="text-rose-500">*</span></label>
                    <input type="text" name="nama_indikator" required placeholder="Contoh: Laju Pertumbuhan Ekonomi (LPE)" class="w-full text-xs rounded-lg border-gray-200 focus:ring-[#29abe2] focus:border-[#29abe2]">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Satuan Nilai <span class="text-rose-500">*</span></label>
                    <input type="text" name="satuan" required placeholder="Contoh: Persen atau Point atau Rp" class="w-full text-xs rounded-lg border-gray-200 focus:ring-[#29abe2] focus:border-[#29abe2]">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Urutan Tampil</label>
                    <input type="number" name="urutan" value="1" min="1" class="w-full text-xs rounded-lg border-gray-200 focus:ring-[#29abe2] focus:border-[#29abe2]">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Deskripsi / Keterangan Singkat</label>
                    <textarea name="deskripsi" rows="3" placeholder="Penjelasan mengenai indikator ini..." class="w-full text-xs rounded-lg border-gray-200 focus:ring-[#29abe2] focus:border-[#29abe2]"></textarea>
                </div>

                <div class="flex justify-end gap-2 pt-3 border-t border-gray-100">
                    <button type="button" onclick="closeModal('modal-tambah')" class="px-4 py-2 text-xs font-semibold text-gray-600 hover:bg-gray-100 rounded-lg">Batal</button>
                    <button type="submit" class="px-4 py-2 text-xs font-semibold text-white bg-[#29abe2] hover:bg-[#1a95c9] rounded-lg shadow-sm">Simpan Indikator</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL TAMBAH TAHUN PENDATAAN BARU -->
    <div id="modal-tambah-tahun" class="fixed inset-0 bg-black/40 backdrop-blur-xs z-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-2xl p-6 w-full max-w-sm shadow-2xl border border-gray-100 animate-in fade-in zoom-in duration-200">
            <div class="flex items-center justify-between border-b border-gray-100 pb-3 mb-4">
                <h3 class="text-base font-bold text-gray-900 flex items-center gap-2">
                    <span class="material-symbols-outlined text-[#29abe2]">calendar_add_on</span>
                    Tambah Tahun Pendataan Baru
                </h3>
                <button onclick="closeModal('modal-tambah-tahun')" class="text-gray-400 hover:text-gray-600">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>

            <form method="GET" action="{{ route('admin.indikator-makro.index') }}" class="space-y-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1.5">Masukkan Tahun Data Baru <span class="text-rose-500">*</span></label>
                    <input type="number" name="tahun" value="{{ (int)max($tahunList) + 1 }}" min="2000" max="2100" required class="w-full text-sm font-bold text-center rounded-lg border-gray-200 focus:ring-[#29abe2] focus:border-[#29abe2] py-2 bg-gray-50">
                    <p class="text-[11px] text-gray-400 mt-1.5">Setelah memilih tahun, Anda dapat mulai menginput nilai 27 Kabupaten/Kota untuk tahun tersebut.</p>
                </div>

                <div class="flex justify-end gap-2 pt-3 border-t border-gray-100">
                    <button type="button" onclick="closeModal('modal-tambah-tahun')" class="px-4 py-2 text-xs font-semibold text-gray-600 hover:bg-gray-100 rounded-lg">Batal</button>
                    <button type="submit" class="px-4 py-2 text-xs font-semibold text-white bg-[#29abe2] hover:bg-[#1a95c9] rounded-lg shadow-sm">Buka Pendataan Tahun Ini</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL EDIT MASTER INDIKATOR -->
    <div id="modal-edit" class="fixed inset-0 bg-black/40 backdrop-blur-xs z-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-2xl p-6 w-full max-w-md shadow-2xl border border-gray-100 animate-in fade-in zoom-in duration-200">
            <div class="flex items-center justify-between border-b border-gray-100 pb-3 mb-4">
                <h3 class="text-base font-bold text-gray-900 flex items-center gap-2">
                    <span class="material-symbols-outlined text-[#fed000]">edit_square</span>
                    Edit Master Indikator Makro
                </h3>
                <button onclick="closeModal('modal-edit')" class="text-gray-400 hover:text-gray-600">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>

            <form id="form-edit" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Nama Indikator <span class="text-rose-500">*</span></label>
                    <input type="text" id="edit-nama" name="nama_indikator" required class="w-full text-xs rounded-lg border-gray-200 focus:ring-[#29abe2] focus:border-[#29abe2]">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Satuan Nilai <span class="text-rose-500">*</span></label>
                    <input type="text" id="edit-satuan" name="satuan" required class="w-full text-xs rounded-lg border-gray-200 focus:ring-[#29abe2] focus:border-[#29abe2]">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Urutan Tampil</label>
                    <input type="number" id="edit-urutan" name="urutan" min="1" class="w-full text-xs rounded-lg border-gray-200 focus:ring-[#29abe2] focus:border-[#29abe2]">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Deskripsi / Keterangan Singkat</label>
                    <textarea id="edit-deskripsi" name="deskripsi" rows="3" class="w-full text-xs rounded-lg border-gray-200 focus:ring-[#29abe2] focus:border-[#29abe2]"></textarea>
                </div>

                <div class="flex justify-end gap-2 pt-3 border-t border-gray-100">
                    <button type="button" onclick="closeModal('modal-edit')" class="px-4 py-2 text-xs font-semibold text-gray-600 hover:bg-gray-100 rounded-lg">Batal</button>
                    <button type="submit" class="px-4 py-2 text-xs font-bold text-gray-900 bg-[#fed000] hover:bg-[#e6bc00] rounded-lg shadow-sm">Update Master</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Hapus -->
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-xs hidden opacity-0 transition-opacity duration-300"
        id="delete-modal">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-sm mx-4 p-6 transform scale-95 transition-transform duration-300"
            id="delete-modal-content">
            <div class="flex items-center gap-3 text-red-600 mb-4">
                <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center flex-shrink-0">
                    <span class="material-symbols-outlined text-red-600">warning</span>
                </div>
                <h3 class="text-lg font-bold text-gray-900">Hapus Indikator Makro?</h3>
            </div>
            <p class="text-sm text-gray-600 mb-6">Apakah Anda yakin ingin menghapus indikator ini?</p>
            <form id="delete-form" method="POST" action="">
                @csrf
                @method('DELETE')
                <div class="flex items-center justify-end gap-2 mt-4">
                    <button type="button" onclick="closeDeleteModal()"
                        class="px-4 py-2 border border-gray-300 text-gray-700 text-sm rounded-md hover:bg-gray-50 font-medium">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 bg-red-600 text-white text-sm rounded-md hover:bg-red-700 shadow-sm font-medium">Hapus</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
        }

        function editModal(id, nama, satuan, deskripsi, urutan) {
            document.getElementById('form-edit').action = `/admin/indikator-makro/master/${id}`;
            document.getElementById('edit-nama').value = nama;
            document.getElementById('edit-satuan').value = satuan;
            document.getElementById('edit-urutan').value = urutan;
            document.getElementById('edit-deskripsi').value = deskripsi;
            openModal('modal-edit');
        }

        function openDeleteModal(id) {
            document.getElementById('delete-form').action = `/admin/indikator-makro/master/${id}`;
            const modal = document.getElementById('delete-modal');
            const modalContent = document.getElementById('delete-modal-content');
            modal.classList.remove('hidden');
            void modal.offsetWidth;
            modal.classList.remove('opacity-0');
            modalContent.classList.remove('scale-95');
        }

        function closeDeleteModal() {
            const modal = document.getElementById('delete-modal');
            const modalContent = document.getElementById('delete-modal-content');
            modal.classList.add('opacity-0');
            modalContent.classList.add('scale-95');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }

        // Close delete modal on backdrop click
        document.getElementById('delete-modal')?.addEventListener('click', (e) => {
            if (e.target === document.getElementById('delete-modal')) closeDeleteModal();
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
