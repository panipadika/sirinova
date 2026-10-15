<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Edit Alat TTG - Admin Panel</title>
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

<body class="bg-[#f4f7f6] text-gray-900 min-h-screen antialiased relative">

    <!-- SIDEBAR -->
    @include('partials.sidebar')

    <!-- Main Content Area -->
    <div class="flex flex-col min-h-screen md:ml-[260px] w-full md:w-[calc(100%-260px)]">
        <main class="flex-1 p-6 md:p-8 overflow-y-auto">

            <div class="mb-5">
                <a href="/admin/alat"
                    class="text-[#29abe2] flex items-center gap-1 text-xs font-medium hover:underline mb-1 w-max">
                    <span class="material-symbols-outlined text-sm">arrow_back</span> Kembali ke Data Alat
                </a>
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900">Edit Alat TTG</h2>
            </div>

            @if ($errors->any())
                <div class="bg-red-50 text-red-700 p-3 rounded-lg mb-5 border border-red-200 text-sm">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form Edit dengan method PUT -->
            <form action="/admin/alat/{{ $alat->id }}" method="POST" enctype="multipart/form-data"
                class="flex flex-col lg:flex-row gap-5">
                @csrf
                @method('PUT')

                <div class="flex-1 flex flex-col gap-5">
                    <!-- Basic Info -->
                    <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm">
                        <h3 class="text-base font-bold mb-3 text-gray-800 flex items-center gap-2">
                            <span class="material-symbols-outlined text-[#29abe2] text-[20px]">info</span> Informasi
                            Dasar
                        </h3>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-xs font-semibold text-gray-700 mb-1">Nama Alat</label>
                                <input type="text" name="nama_alat" value="{{ old('nama_alat', $alat->nama_alat) }}"
                                    class="w-full px-3 py-1.5 text-sm border border-gray-300 rounded-md focus:ring-1 focus:ring-[#29abe2] outline-none"
                                    required>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-xs font-semibold text-gray-700 mb-1">Kategori</label>
                                    <select name="id_kategori"
                                        class="w-full px-3 py-1.5 text-sm border border-gray-300 rounded-md focus:ring-1 focus:ring-[#29abe2] outline-none"
                                        required>
                                        <option value="">Pilih Kategori</option>
                                        @foreach ($kategori as $kat)
                                            <option value="{{ $kat->id }}"
                                                {{ old('id_kategori', $alat->id_kategori) == $kat->id ? 'selected' : '' }}>
                                                {{ $kat->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-gray-700 mb-1">Tahun Inovasi</label>
                                    <input type="number" name="tahun_produksi"
                                        value="{{ old('tahun_produksi', $alat->tahun_produksi) }}"
                                        class="w-full px-3 py-1.5 text-sm border border-gray-300 rounded-md focus:ring-1 focus:ring-[#29abe2] outline-none"
                                        required>
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-700 mb-1">Deskripsi Singkat</label>
                                <textarea name="deskripsi" rows="3"
                                    class="w-full px-3 py-1.5 text-sm border border-gray-300 rounded-md focus:ring-1 focus:ring-[#29abe2] outline-none resize-none"
                                    required>{{ old('deskripsi', $alat->deskripsi) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Inovator Info -->
                    <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm">
                        <h3 class="text-base font-bold mb-3 text-gray-800 flex items-center gap-2">
                            <span class="material-symbols-outlined text-yellow-500 text-[20px]">groups</span> Data
                            Inovator
                        </h3>
                        <div class="grid grid-cols-1 gap-3">
                            <div>
                                <label class="block text-xs font-semibold text-gray-700 mb-1">Inovator /
                                    Pencipta</label>
                                <select name="id_inovator"
                                    class="w-full px-3 py-1.5 text-sm border border-gray-300 rounded-md focus:ring-1 focus:ring-[#29abe2] outline-none"
                                    required>
                                    <option value="">Pilih Inovator</option>
                                    @foreach ($inovator as $inv)
                                        <option value="{{ $inv->id }}"
                                            {{ old('id_inovator', $alat->id_inovator) == $inv->id ? 'selected' : '' }}>
                                            {{ $inv->nama_inovator }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-700 mb-1">Estimasi Harga
                                    (Rp)</label>
                                <input type="text" name="estimasi_harga"
                                    value="{{ old('estimasi_harga', $alat->estimasi_harga) }}"
                                    class="w-full px-3 py-1.5 text-sm border border-gray-300 rounded-md focus:ring-1 focus:ring-[#29abe2] outline-none"
                                    required>
                            </div>
                            <!-- === INI ADALAH TAMBAHAN INPUT NO TELEPON === -->
                            <div>
                                <label class="block text-xs font-semibold text-gray-700 mb-1">No.Telepon / WhatsApp</label>
                                <input type="text" name="nomor_telepon"
                                    value="{{ old('nomor_telepon', $alat->nomor_telepon) }}"
                                    class="w-full px-3 py-1.5 text-sm border border-gray-300 rounded-md focus:ring-1 focus:ring-[#29abe2] outline-none">
                            </div>
                            <!-- ============================================ -->
                            <div>
                                <label class="block text-xs font-semibold text-gray-700 mb-1">Alamat Lengkap</label>
                                <textarea name="alamat_lengkap" rows="2"
                                    class="w-full px-3 py-1.5 text-sm border border-gray-300 rounded-md focus:ring-1 focus:ring-[#29abe2] outline-none resize-none"
                                    required>{{ old('alamat_lengkap', $alat->alamat_lengkap) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-full lg:w-[350px] xl:w-[400px] flex flex-col gap-5">
                    <!-- Media & Lokasi -->
                    <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm flex-1 flex flex-col">
                        <h3 class="text-base font-bold mb-3 text-gray-800 flex items-center gap-2">
                            <span class="material-symbols-outlined text-green-500 text-[20px]">image</span> Lokasi &
                            Media
                        </h3>

                        <div class="space-y-4 flex-1">
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-xs font-semibold text-gray-700 mb-1">Wilayah / Kec</label>
                                    <select name="id_wilayah"
                                        class="w-full px-3 py-1.5 text-sm border border-gray-300 rounded-md focus:ring-1 focus:ring-[#29abe2] outline-none"
                                        required>
                                        <option value="">Pilih</option>
                                        @foreach ($wilayah as $wil)
                                            <option value="{{ $wil->id }}"
                                                {{ old('id_wilayah', $alat->id_wilayah) == $wil->id ? 'selected' : '' }}>
                                                {{ $wil->nama_kecamatan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-gray-700 mb-1">Publikasi</label>
                                    <select name="status_publikasi"
                                        class="w-full px-3 py-1.5 text-sm border border-gray-300 rounded-md focus:ring-1 focus:ring-[#29abe2] outline-none"
                                        required>
                                        <option value="Publik"
                                            {{ old('status_publikasi', $alat->status_publikasi) == 'Publik' ? 'selected' : '' }}>
                                            Publik</option>
                                        <option value="Draft"
                                            {{ old('status_publikasi', $alat->status_publikasi) == 'Draft' ? 'selected' : '' }}>
                                            Draft</option>
                                    </select>
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-gray-700 mb-2">Ganti Foto Alat
                                    (Opsional)</label>
                                <!-- Tampilkan Foto Lama -->
                                <div
                                    class="mb-3 w-full h-32 bg-gray-100 rounded-lg overflow-hidden border border-gray-200">
                                    <img src="{{ asset('storage/' . $alat->foto) }}"
                                        class="w-full h-full object-cover"
                                        onerror="this.src='https://placehold.co/300x200?text=No+Foto'">
                                </div>
                                <div class="flex flex-col items-center justify-center p-3 border-2 border-dashed border-gray-300 rounded-lg hover:bg-blue-50 transition cursor-pointer bg-gray-50"
                                    onclick="document.getElementById('file-upload').click()">
                                    <span class="text-sm font-medium text-[#29abe2]">Pilih Foto Baru...</span>
                                    <input id="file-upload" name="foto" type="file" class="sr-only"
                                        accept="image/*">
                                </div>
                                <p id="file-name" class="text-xs font-medium text-green-600 mt-2 text-center hidden">
                                </p>
                            </div>
                        </div>

                        <div class="mt-6 pt-4 border-t border-gray-100 flex gap-2">
                            <a href="/admin/alat"
                                class="flex-1 py-2 bg-gray-100 text-gray-700 text-sm rounded-md font-semibold text-center hover:bg-gray-200 transition">Batal</a>
                            <button type="submit"
                                class="flex-1 py-2 bg-yellow-500 text-white text-sm rounded-md font-semibold hover:bg-yellow-600 transition flex justify-center items-center gap-1 shadow-sm">
                                <span class="material-symbols-outlined text-[18px]">update</span> Update
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </main>
    </div>

    <script>
        document.getElementById('file-upload').addEventListener('change', function(e) {
            const fileNameDisplay = document.getElementById('file-name');
            if (e.target.files[0]) {
                fileNameDisplay.textContent = '✔️ File baru: ' + e.target.files[0].name;
                fileNameDisplay.classList.remove('hidden');
            }
        });
    </script>
</body>

</html>
