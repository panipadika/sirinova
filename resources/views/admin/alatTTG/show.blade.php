<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Detail Alat TTG - Admin Panel</title>
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

<body class="text-gray-800 min-h-screen antialiased flex">

    <!-- SIDEBAR -->
    @include('partials.sidebar')

    <!-- MAIN CONTENT -->
    <div class="flex-1 flex flex-col min-h-screen md:ml-[260px] w-full md:w-[calc(100%-260px)]">

        <!-- Header Mobile Toggle -->
        <header class="md:hidden bg-white border-b flex justify-between items-center h-16 px-4">
            <button class="p-2 text-gray-500 rounded hover:bg-gray-100" id="menu-btn">
                <span class="material-symbols-outlined">menu</span>
            </button>
            <span class="text-xl font-bold">SI RINOVA</span>
        </header>

        <main class="flex-1 p-6 md:p-8 overflow-y-auto">

            <!-- Tombol Kembali & Judul -->
            <div class="mb-8">
                <a href="/admin/alat"
                    class="text-[#29abe2] flex items-center gap-1 text-sm font-medium hover:underline mb-3 w-max">
                    <span class="material-symbols-outlined text-[18px]">arrow_back</span> Kembali ke Data Alat TTG
                </a>
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Detail Alat TTG</h2>

                    <!-- Tombol Edit di pojok kanan -->
                    <a href="/admin/alat/{{ $alat->id }}/edit"
                        class="bg-yellow-500 text-white px-5 py-2.5 rounded-md hover:bg-yellow-600 transition-colors flex items-center justify-center gap-2 font-medium text-sm shadow-sm h-fit w-fit">
                        <span class="material-symbols-outlined text-[18px]">edit</span> Edit Data Ini
                    </a>
                </div>
            </div>

            <!-- Kartu Detail Produk -->
            <div
                class="bg-white rounded-xl shadow-[0_2px_10px_rgba(0,0,0,0.04)] border border-gray-100 overflow-hidden">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-0">

                    <!-- Sisi Kiri: Foto Besar -->
                    <div
                        class="bg-gray-50 border-r border-gray-100 p-6 flex flex-col items-center justify-center md:col-span-1 min-h-[300px]">
                        <div
                            class="w-full max-w-sm rounded-lg overflow-hidden shadow-sm border border-gray-200 bg-white">
                            <img alt="{{ $alat->nama_alat }}" class="w-full h-auto object-cover aspect-square"
                                src="{{ asset('storage/' . $alat->foto) }}"
                                onerror="this.onerror=null; this.src='https://placehold.co/400x400/f3f4f6/9ca3af?text=Tidak+Ada+Foto'">
                        </div>

                        <div class="mt-6 flex flex-wrap justify-center gap-2">
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full bg-[#e0f2fe] text-[#0369a1] font-medium text-xs border border-blue-200">
                                Kategori: {{ $alat->kategori->nama_kategori ?? '-' }}
                            </span>
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium border
                                {{ $alat->status_publikasi == 'Publik' ? 'bg-[#fef9c3] text-[#b45309] border-yellow-200' : 'bg-gray-100 text-gray-600 border-gray-200' }}">
                                Status: {{ $alat->status_publikasi }}
                            </span>
                        </div>
                    </div>

                    <!-- Sisi Kanan: Detail Informasi -->
                    <div class="p-6 md:p-8 md:col-span-2">
                        <h3 class="text-2xl font-bold text-[#29abe2] mb-1">{{ $alat->nama_alat }}</h3>
                        <p class="text-sm text-gray-500 mb-6">Tahun Inovasi: <span
                                class="font-semibold text-gray-700">{{ $alat->tahun_produksi }}</span></p>

                        <div class="space-y-6">
                            <!-- Section: Informasi Inovator -->
                            <div>
                                <h4
                                    class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-3 flex items-center gap-1.5 border-b border-gray-100 pb-2">
                                    <span class="material-symbols-outlined text-[16px]">person</span> Profil Inovator
                                </h4>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                                    <div>
                                        <p class="text-gray-500 mb-0.5">Nama Inovator</p>
                                        <p class="font-semibold text-gray-800">
                                            {{ $alat->inovator->nama_inovator ?? '-' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-500 mb-0.5">Nomor Kontak / WA</p>
                                        <p class="font-semibold text-gray-800">
                                            {{ $alat->inovator->nomor_telepon ?? '-' }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Section: Lokasi & Komersil -->
                            <div>
                                <h4
                                    class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-3 flex items-center gap-1.5 border-b border-gray-100 pb-2">
                                    <span class="material-symbols-outlined text-[16px]">storefront</span> Lokasi & Harga
                                </h4>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                                    <div>
                                        <p class="text-gray-500 mb-0.5">Wilayah (Kecamatan)</p>
                                        <p class="font-semibold text-gray-800">
                                            {{ $alat->wilayah->nama_kecamatan ?? '-' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-500 mb-0.5">Estimasi Harga</p>
                                        <p class="font-semibold text-green-600">{{ $alat->estimasi_harga }}</p>
                                    </div>
                                    <div class="sm:col-span-2">
                                        <p class="text-gray-500 mb-0.5">Alamat Workshop</p>
                                        <p class="font-medium text-gray-800 leading-relaxed">
                                            {{ $alat->alamat_workshop }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Section: Deskripsi -->
                            <div>
                                <h4
                                    class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-3 flex items-center gap-1.5 border-b border-gray-100 pb-2">
                                    <span class="material-symbols-outlined text-[16px]">description</span> Deskripsi
                                    Lengkap
                                </h4>
                                <div
                                    class="text-sm text-gray-700 leading-relaxed bg-gray-50 p-4 rounded-lg border border-gray-100 text-justify">
                                    {{ $alat->deskripsi }}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </main>
    </div>

    <!-- Script Toggle Sidebar Mobile -->
    <script>
        const menuBtn = document.getElementById('menu-btn');
        const sidebar = document.getElementById('sidebar');
        menuBtn?.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });
    </script>
</body>

</html>
