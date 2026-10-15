<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Tambah Inovator - Admin Panel</title>
    <!-- Favicon Logo Tasikmalaya -->
    <link rel="icon" type="image/png" href="{{ asset('storage/images/favicon_tasik.png') }}?v=3">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=3">
    <link rel="apple-touch-icon" href="{{ asset('storage/images/favicon_tasik.png') }}?v=3">
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Public+Sans:wght@600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #fcf9f8; }
        h1, h2, h3, h4, h5, h6 { font-family: 'Public Sans', sans-serif; }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
    </style>
</head>

<body class="bg-[#fcf9f8] text-gray-900 antialiased flex h-screen overflow-hidden">

    <!-- SIDEBAR -->
    @include('partials.sidebar')

    <!-- MAIN CONTENT -->
    <div class="flex-1 flex flex-col md:ml-[260px] h-screen w-full md:w-[calc(100%-260px)]">

        <!-- Header Mobile -->
        <header class="md:hidden bg-white border-b border-gray-200 flex justify-between items-center h-14 px-4 shrink-0">
            <button class="p-2 text-gray-500 rounded hover:bg-gray-100" id="menu-btn">
                <span class="material-symbols-outlined">menu</span>
            </button>
            <span class="text-lg font-bold">SI RINOVA</span>
        </header>

        <main class="flex-1 overflow-y-auto p-4 md:p-6 lg:p-8">

            <div class="mb-5 max-w-5xl mx-auto">
                <a href="/admin/inovator" class="text-[#29abe2] flex items-center gap-1 text-xs font-semibold hover:underline mb-1 w-max">
                    <span class="material-symbols-outlined text-sm">arrow_back</span> Kembali ke Data Inovator
                </a>
                <h2 class="text-2xl font-bold text-gray-900">Tambah Inovator Baru</h2>
                <p class="text-xs text-gray-500 mt-1">Masukkan data diri inovator atau kelompok pembuat teknologi.</p>
            </div>

            <!-- Pesan Error -->
            @if ($errors->any())
                <div class="max-w-5xl mx-auto bg-red-50 text-red-700 p-3 rounded-lg mb-5 border border-red-200">
                    <ul class="list-disc list-inside text-xs">
                        @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form Layout Compact (Kiri - Kanan) -->
            <form action="/admin/inovator" method="POST" class="flex flex-col lg:flex-row gap-5 max-w-5xl mx-auto">
                @csrf

                <!-- KOLOM KIRI (Informasi Utama) -->
                <div class="flex-1 flex flex-col gap-5">

                    <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm">
                        <h3 class="text-sm font-bold mb-4 flex items-center gap-2 border-b border-gray-100 pb-2">
                            <span class="material-symbols-outlined text-[#29abe2] text-[18px]">person</span> Informasi Kontak & Profil
                        </h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-xs font-semibold text-gray-700 mb-1">Nama Inovator / Kelompok</label>
                                <input type="text" name="nama_inovator" value="{{ old('nama_inovator') }}" placeholder="Contoh: Budi Santoso" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-1 focus:ring-[#29abe2] outline-none" required>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-gray-700 mb-1">Nomor Telepon / WhatsApp</label>
                                <input type="text" name="nomor_telepon" value="{{ old('nomor_telepon') }}" placeholder="Contoh: 08123456789" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-1 focus:ring-[#29abe2] outline-none" required>
                            </div>

                            <!-- Catatan: Anda bisa menyesuaikan atau menghapus field ini jika di database tidak ada -->
                            <div>
                                <label class="block text-xs font-semibold text-gray-700 mb-1">Alamat Lengkap</label>
                                <textarea name="alamat_lengkap" rows="3" placeholder="Masukkan alamat lengkap" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-1 focus:ring-[#29abe2] outline-none resize-none">{{ old('alamat_lengkap') }}</textarea>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- KOLOM KANAN (Pengaturan Wilayah & Status) -->
                <div class="w-full lg:w-[320px] xl:w-[350px] flex flex-col gap-5">

                    <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm flex-1 flex flex-col">
                        <h3 class="text-sm font-bold mb-4 flex items-center gap-2 border-b border-gray-100 pb-2">
                            <span class="material-symbols-outlined text-green-500 text-[18px]">map</span> Area & Status
                        </h3>

                        <div class="space-y-4 flex-1">
                            <div>
                                <label class="block text-xs font-semibold text-gray-700 mb-1">Wilayah / Kecamatan</label>
                                <select name="id_wilayah" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-1 focus:ring-[#29abe2] outline-none" required>
                                    <option value="">Pilih Wilayah</option>
                                    @foreach ($wilayah as $wil)
                                        <option value="{{ $wil->id }}" {{ old('id_wilayah') == $wil->id ? 'selected' : '' }}>{{ $wil->nama_kecamatan }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-gray-700 mb-1">Status Inovator</label>
                                <select name="status" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-1 focus:ring-[#29abe2] outline-none" required>
                                    <option value="Aktif" {{ old('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="Non-Aktif" {{ old('status') == 'Non-Aktif' ? 'selected' : '' }}>Non-Aktif</option>
                                </select>
                                <p class="text-[10px] text-gray-500 mt-1">*Jika "Non-Aktif", inovator ini tidak akan muncul di pilihan tambah alat.</p>
                            </div>
                        </div>

                        <!-- Tombol Aksi di Bawah -->
                        <div class="mt-6 pt-4 border-t border-gray-100 flex gap-2">
                            <a href="/admin/inovator" class="flex-1 py-2 border border-gray-300 text-gray-700 text-sm rounded-md font-semibold text-center hover:bg-gray-50 transition">Batal</a>
                            <button type="submit" class="flex-1 py-2 bg-[#29abe2] text-white text-sm rounded-md font-semibold hover:opacity-90 transition flex justify-center items-center gap-1 shadow-sm">
                                <span class="material-symbols-outlined text-[18px]">save</span> Simpan
                            </button>
                        </div>
                    </div>
                </div>

            </form>
        </main>
    </div>

    <!-- Script Sidebar Toggle (Mobile) -->
    <script>
        const menuBtn = document.getElementById('menu-btn');
        const sidebar = document.getElementById('sidebar');
        menuBtn?.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });
    </script>
</body>

</html>
