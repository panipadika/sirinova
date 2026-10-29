<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Tambah Alat TTG - Admin Panel</title>
    <!-- Favicon Logo Tasikmalaya -->
    <link rel="icon" type="image/png" href="{{ asset('storage/images/favicon_tasik.png') }}?v=3">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=3">
    <link rel="apple-touch-icon" href="{{ asset('storage/images/favicon_tasik.png') }}?v=3">
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Public+Sans:wght@600;700&display=swap" rel="stylesheet">
    <!-- Tom Select CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f4f7f6; }
        h1, h2, h3 { font-family: 'Public Sans', sans-serif; }
        .ts-control { padding: 0.5rem 0.75rem !important; border-radius: 0.375rem !important; border-color: #e5e7eb !important; background-color: #f9fafb !important; }
        .ts-control.focus { background-color: #ffffff !important; border-color: #29abe2 !important; box-shadow: 0 0 0 1px #29abe2 !important; }

        /* Hide scrollbar completely */
        * { -ms-overflow-style: none !important; scrollbar-width: none !important; }
        *::-webkit-scrollbar { display: none !important; width: 0 !important; height: 0 !important; }
    </style>
</head>
<body class="text-gray-800 min-h-screen antialiased flex overflow-hidden">

    <!-- SIDEBAR -->
    @include('partials.sidebar')

    <!-- MAIN CONTENT -->
    <div class="flex-1 flex flex-col h-screen md:ml-[260px] w-full md:w-[calc(100%-260px)]">
        <main class="flex-1 p-6 md:p-8 overflow-y-auto">

            <div class="mb-5">
                <a href="/admin/alat" class="text-[#29abe2] flex items-center gap-1 text-xs font-semibold hover:underline mb-1 w-max">
                    <span class="material-symbols-outlined text-[14px]">arrow_back</span> Kembali ke Data Alat TTG
                </a>
                <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Tambah Alat TTG</h2>
            </div>

            @if (session('error'))
                <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-5 shadow-sm text-sm flex items-start gap-3">
                    <span class="material-symbols-outlined text-red-500 text-xl">error</span>
                    <div>
                        <p class="font-semibold">Terjadi Kesalahan</p>
                        <p class="text-xs mt-0.5">{{ session('error') }}</p>
                    </div>
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-50 text-red-700 p-3 rounded-lg mb-5 border border-red-200 text-xs">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <form action="{{ route('admin.alat.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-12 gap-4">

                        <!-- Nama Alat & Kategori -->
                        <div class="md:col-span-8">
                            <label class="block text-xs font-semibold text-gray-800 mb-1">Nama Alat / Inovasi <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_alat" value="{{ old('nama_alat') }}" placeholder="Contoh: Mesin Pencacah Kompos" class="w-full px-3 py-2 text-sm bg-gray-50 border border-gray-200 rounded-md focus:bg-white focus:ring-1 focus:ring-[#29abe2] outline-none" required>
                        </div>
                        <div class="md:col-span-4">
                            <label class="block text-xs font-semibold text-gray-800 mb-1">Kategori <span class="text-red-500">*</span></label>
                            <select name="id_kategori" class="w-full px-3 py-2 text-sm bg-gray-50 border border-gray-200 rounded-md focus:bg-white focus:ring-1 focus:ring-[#29abe2] outline-none" required>
                                <option value="">Pilih Kategori...</option>
                                @foreach ($kategori as $kat)
                                    <option value="{{ $kat->id }}" {{ old('id_kategori') == $kat->id ? 'selected' : '' }}>{{ $kat->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Inovator & Tahun Produksi -->
                        <div class="md:col-span-8">
                            <div class="flex justify-between items-end mb-1">
                                <label class="block text-xs font-semibold text-gray-800">Inovator / Pencipta <span class="text-red-500">*</span></label>
                                <div class="flex gap-3">
                                    <button type="button" id="refresh-inovator" class="text-[11px] text-green-600 hover:text-green-700 font-medium flex items-center gap-1" title="Segarkan data">
                                        <span class="material-symbols-outlined text-[12px]">sync</span> Segarkan
                                    </button>
                                    <a href="/admin/inovator/create" target="_blank" class="text-[11px] text-[#29abe2] hover:underline font-medium flex items-center gap-1">
                                        <span class="material-symbols-outlined text-[12px]">add_circle</span> Inovator Baru
                                    </a>
                                </div>
                            </div>
                            <select name="id_inovator" id="inovator-select" class="w-full text-sm outline-none" required>
                                <option value="">Ketik untuk mencari...</option>
                                @foreach ($inovator as $inv)
                                    <!-- PERBAIKAN: Pemanggilan data telepon sekarang akurat -->
                                    <option value="{{ $inv->id }}"
                                        data-wilayah="{{ $inv->id_wilayah ?? '' }}"
                                        data-alamat="{{ $inv->alamat ?? $inv->alamat_lengkap ?? '' }}"
                                        data-status="{{ $inv->status_publikasi ?? 'Publik' }}"
                                        data-telepon="{{ $inv->no_telepon ?? $inv->nomor_telepon ?? $inv->kontak ?? '' }}"
                                        {{ old('id_inovator') == $inv->id ? 'selected' : '' }}>
                                        {{ $inv->nama_inovator }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="md:col-span-4">
                            <label class="block text-xs font-semibold text-gray-800 mb-1">Tahun Produksi <span class="text-red-500">*</span></label>
                            <input type="number" name="tahun_produksi" value="{{ old('tahun_produksi') }}" placeholder="Contoh: 2026" class="w-full px-3 py-2 text-sm bg-gray-50 border border-gray-200 rounded-md focus:bg-white focus:ring-1 focus:ring-[#29abe2] outline-none" required>
                        </div>

                        <!-- Wilayah & Alamat Lengkap -->
                        <div class="md:col-span-4">
                            <label class="block text-xs font-semibold text-gray-800 mb-1">Wilayah / Kecamatan <span class="text-red-500">*</span></label>
                            <select name="id_wilayah" id="input-wilayah" class="w-full px-3 py-2 text-sm bg-gray-50 border border-gray-200 rounded-md focus:bg-white focus:ring-1 focus:ring-[#29abe2] outline-none transition-colors" required>
                                <option value="">Pilih Wilayah...</option>
                                @foreach ($wilayah as $wil)
                                    <option value="{{ $wil->id }}" {{ old('id_wilayah') == $wil->id ? 'selected' : '' }}>{{ $wil->nama_kecamatan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="md:col-span-8">
                            <label class="block text-xs font-semibold text-gray-800 mb-1">Alamat Lengkap <span class="text-red-500">*</span></label>
                            <input type="text" name="alamat_lengkap" id="input-alamat" value="{{ old('alamat_lengkap') }}" placeholder="Otomatis terisi atau ketik manual..." class="w-full px-3 py-2 text-sm bg-gray-50 border border-gray-200 rounded-md focus:bg-white focus:ring-1 focus:ring-[#29abe2] outline-none transition-colors">
                        </div>

                        <!-- No Telp, Harga, Status Publikasi -->
                        <div class="md:col-span-4">
                            <!-- PERBAIKAN: Menghapus bintang merah karena ini opsional -->
                            <label class="block text-xs font-semibold text-gray-800 mb-1">No. Telepon / WhatsApp <span class="text-red-500">*</span></label>
                            <input type="text" name="nomor_telepon" id="input-telepon" value="{{ old('nomor_telepon') }}" placeholder="Contoh : 08123456789" class="w-full px-3 py-2 text-sm bg-gray-50 border border-gray-200 rounded-md focus:bg-white focus:ring-1 focus:ring-[#29abe2] outline-none transition-colors">
                        </div>
                        <div class="md:col-span-4">
                            <label class="block text-xs font-semibold text-gray-800 mb-1">Estimasi Harga <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-xs">Rp</span>
                                <input type="number" name="estimasi_harga" value="{{ old('estimasi_harga') }}" placeholder="1500000" class="w-full pl-8 pr-3 py-2 text-sm bg-gray-50 border border-gray-200 rounded-md focus:bg-white focus:ring-1 focus:ring-[#29abe2] outline-none" required>
                            </div>
                        </div>
                        <div class="md:col-span-4">
                            <label class="block text-xs font-semibold text-gray-800 mb-1">Status Publikasi <span class="text-red-500">*</span></label>
                            <select name="status_publikasi" id="input-status" class="w-full px-3 py-2 text-sm bg-gray-50 border border-gray-200 rounded-md focus:bg-white focus:ring-1 focus:ring-[#29abe2] outline-none transition-colors" required>
                                <option value="Publik" {{ old('status_publikasi') == 'Publik' ? 'selected' : '' }}>Publik</option>
                                <option value="Draft" {{ old('status_publikasi') == 'Draft' ? 'selected' : '' }}>Draft</option>
                            </select>
                        </div>
                    </div>

                    <!-- BARIS BAWAH: Deskripsi & Foto Modern -->
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-4 border-t border-gray-100 pt-4 mt-2">
                        <div class="md:col-span-8">
                            <label class="block text-xs font-semibold text-gray-800 mb-1">Deskripsi Singkat</label>
                            <textarea name="deskripsi" rows="5" placeholder="Jelaskan fungsi utama, keunggulan, dan cara kerja alat ini..." class="w-full px-3 py-2 text-sm bg-gray-50 border border-gray-200 rounded-md focus:bg-white focus:ring-1 focus:ring-[#29abe2] outline-none resize-none">{{ old('deskripsi') }}</textarea>
                        </div>

                        <!-- Area Unggah Foto Interaktif -->
                        <div class="md:col-span-4 flex flex-col">
                            <label class="block text-xs font-semibold text-gray-800 mb-1">Foto Alat</label>
                            <div class="flex-1 flex justify-center items-center px-4 py-4 border-2 border-gray-300 border-dashed rounded-xl hover:border-[#29abe2] hover:bg-sky-50 transition-all group relative cursor-pointer" onclick="document.getElementById('file-upload').click()">
                                <div class="text-center">
                                    <span class="material-symbols-outlined text-3xl text-gray-400 group-hover:text-[#29abe2] mb-1">cloud_upload</span>
                                    <div class="text-xs text-gray-600 font-medium">
                                        <span class="text-[#29abe2]">Pilih Foto</span> atau seret file
                                    </div>
                                    <p class="text-[10px] text-gray-400 mt-1" id="file-name-preview">Maks. 2MB (JPG, PNG)</p>
                                </div>
                                <input id="file-upload" name="foto" type="file" class="hidden" accept="image/*" onchange="previewFileName(this)">
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex justify-end gap-2 pt-4 mt-2">
                        <a href="/admin/alat" class="px-5 py-2 border border-gray-300 text-gray-700 text-sm rounded-md hover:bg-gray-50 font-medium">Batal</a>
                        <button type="submit" class="px-5 py-2 bg-[#29abe2] text-white text-sm rounded-md hover:bg-[#1a95c9] font-medium shadow-sm flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-[16px]">save</span> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    <script>
        // Fitur Preview Nama Foto
        function previewFileName(input) {
            const preview = document.getElementById('file-name-preview');
            if (input.files && input.files[0]) {
                preview.textContent = "File: " + input.files[0].name;
                preview.classList.add('text-[#29abe2]', 'font-semibold');
            } else {
                preview.textContent = "Maks. 2MB (JPG, PNG)";
                preview.classList.remove('text-[#29abe2]', 'font-semibold');
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            let selectInovator;

            function initInovatorSelect() {
                selectInovator = new TomSelect('#inovator-select', {
                    create: false,
                    sortField: { field: "text", direction: "asc" },
                    placeholder: 'Ketik nama inovator...',
                    maxOptions: null,
                    onChange: function(value) {
                        if(!value) return;

                        const option = document.querySelector(`#inovator-select option[value="${value}"]`);
                        if (option) {
                            const idWilayah = option.getAttribute('data-wilayah');
                            const alamat = option.getAttribute('data-alamat');
                            const status = option.getAttribute('data-status');
                            const telepon = option.getAttribute('data-telepon');

                            const inputWilayah = document.getElementById('input-wilayah');
                            if (idWilayah && inputWilayah) {
                                inputWilayah.value = idWilayah;
                                flashBackground(inputWilayah);
                            }

                            const inputAlamat = document.getElementById('input-alamat');
                            if (alamat && inputAlamat) {
                                inputAlamat.value = alamat;
                                flashBackground(inputAlamat);
                            }

                            const inputTelepon = document.getElementById('input-telepon');
                            if (telepon && inputTelepon) {
                                inputTelepon.value = telepon;
                                flashBackground(inputTelepon);
                            }

                            const inputStatus = document.getElementById('input-status');
                            if (status && inputStatus) {
                                inputStatus.value = status;
                                flashBackground(inputStatus);
                            }
                        }
                    }
                });
            }

            function flashBackground(element) {
                element.classList.add('bg-yellow-50');
                setTimeout(() => element.classList.remove('bg-yellow-50'), 800);
            }

            initInovatorSelect();

            const refreshBtn = document.getElementById('refresh-inovator');
            refreshBtn.addEventListener('click', function() {
                const originalHtml = refreshBtn.innerHTML;
                refreshBtn.innerHTML = '<span class="material-symbols-outlined text-[12px] animate-spin">sync</span> Memuat...';
                refreshBtn.classList.add('opacity-50', 'cursor-not-allowed');

                fetch(window.location.href)
                    .then(response => response.text())
                    .then(html => {
                        const doc = new DOMParser().parseFromString(html, 'text/html');
                        const newSelect = doc.getElementById('inovator-select');

                        if (newSelect) {
                            selectInovator.destroy();
                            document.getElementById('inovator-select').innerHTML = newSelect.innerHTML;
                            initInovatorSelect();
                        }

                        refreshBtn.innerHTML = '<span class="material-symbols-outlined text-[12px]">check</span> Terkini!';
                        refreshBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                        setTimeout(() => { refreshBtn.innerHTML = originalHtml; }, 2000);
                    })
                    .catch(err => {
                        refreshBtn.innerHTML = originalHtml;
                        refreshBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                    });
            });
        });
    </script>
</body>
</html>
