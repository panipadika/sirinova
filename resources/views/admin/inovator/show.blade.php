<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Detail Inovator - Admin Panel</title>
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
            background-color: #fcf9f8;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Public Sans', sans-serif;
        }

        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }
    </style>
</head>

<body class="bg-[#fcf9f8] text-gray-900 antialiased flex h-screen overflow-hidden">

    <!-- SIDEBAR -->
    @include('partials.sidebar')

    <!-- MAIN CONTENT -->
    <div class="flex-1 flex flex-col md:ml-[260px] h-screen w-full md:w-[calc(100%-260px)]">

        <header
            class="md:hidden bg-white border-b border-gray-200 flex justify-between items-center h-14 px-4 shrink-0">
            <button class="p-2 text-gray-500 rounded hover:bg-gray-100" id="menu-btn">
                <span class="material-symbols-outlined">menu</span>
            </button>
            <span class="text-lg font-bold">SI RINOVA</span>
        </header>

        <main class="flex-1 overflow-y-auto p-4 md:p-6 lg:p-8">

            <!-- Header & Navigasi Kembali -->
            <div class="mb-5 max-w-5xl mx-auto flex justify-between items-center">
                <div>
                    <a href="/admin/inovator"
                        class="text-[#29abe2] flex items-center gap-1 text-xs font-semibold hover:underline mb-1 w-max">
                        <span class="material-symbols-outlined text-sm">arrow_back</span> Kembali ke Data Inovator
                    </a>
                    <h2 class="text-2xl font-bold text-gray-900">Profil & Detail Inovator</h2>
                </div>
                <a href="/admin/inovator/{{ $inovator->id }}/edit"
                    class="bg-yellow-500 text-white px-4 py-2 rounded-md text-xs font-semibold hover:bg-yellow-600 transition flex items-center gap-1.5 shadow-sm">
                    <span class="material-symbols-outlined text-[16px]">edit</span> Edit Data
                </a>
            </div>

            <!-- Layout Compact (2 Kolom: Info Profil di Kiri, Daftar Alat di Kanan/Bawah) -->
            <div class="max-w-5xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-5">

                <!-- KARTU INFORMASI UTAMA (1 Kolom di Kiri) -->
                <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm flex flex-col gap-4 h-max">
                    <div class="flex items-center gap-3 border-b border-gray-100 pb-3">
                        <div
                            class="w-12 h-12 rounded-full bg-blue-50 text-[#29abe2] flex items-center justify-center font-bold text-lg">
                            {{ strtoupper(substr($inovator->nama_inovator, 0, 1)) }}
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-gray-900 leading-tight">{{ $inovator->nama_inovator }}
                            </h3>
                            <span class="text-[11px] text-gray-500">Terdaftar Sejak:
                                {{ $inovator->dibuat_pada ? $inovator->dibuat_pada->format('d M Y') : '-' }}</span>
                        </div>
                    </div>

                    <div class="space-y-3 text-xs">
                        <div>
                            <span class="block text-gray-400 font-medium">Nomor Telepon / WhatsApp</span>
                            <span class="font-semibold text-gray-800 text-sm">{{ $inovator->nomor_telepon }}</span>
                        </div>
                        <div>
                            <span class="block text-gray-400 font-medium">Wilayah / Kecamatan</span>
                            <span
                                class="font-semibold text-gray-800">{{ $inovator->wilayah->nama_kecamatan ?? '-' }}</span>
                        </div>
                        <div>
                            <span class="block text-gray-400 font-medium">Status Akun</span>
                            @if ($inovator->status == 'Aktif')
                                <span
                                    class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium bg-[#dcfce7] text-[#166534] mt-0.5">Aktif</span>
                            @else
                                <span
                                    class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium bg-gray-100 text-gray-600 mt-0.5">Non-Aktif</span>
                            @endif
                        </div>
                        <div>
                            <span class="block text-gray-400 font-medium">Alamat Lengkap Workshop</span>
                            <p
                                class="text-gray-700 mt-0.5 leading-relaxed bg-gray-50 p-2.5 rounded border border-gray-100">
                                {{ $inovator->alamat_lengkap ?? 'Tidak ada alamat yang diisi.' }}</p>
                        </div>
                    </div>
                </div>

                <!-- DAFTAR ALAT TTG CIPTAAN (2 Kolom di Kanan) -->
                <div class="lg:col-span-2 bg-white p-5 rounded-xl border border-gray-200 shadow-sm flex flex-col">
                    <div class="flex justify-between items-center border-b border-gray-100 pb-3 mb-4">
                        <h3 class="text-sm font-bold text-gray-900 flex items-center gap-2">
                            <span class="material-symbols-outlined text-[#29abe2] text-[18px]">inventory_2</span> Daftar
                            Alat TTG Ciptaan
                        </h3>
                        <span class="text-xs bg-blue-50 text-[#29abe2] px-2.5 py-0.5 rounded-full font-bold">
                            Total: {{ $inovator->alatTtg->count() }} Alat
                        </span>
                    </div>

                    <!-- Tabel Ringkas Alat -->
                    <div class="overflow-x-auto flex-1">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr
                                    class="bg-gray-50 text-gray-500 text-[10px] font-bold uppercase tracking-wider border-b border-gray-200">
                                    <th class="py-2.5 px-3">No</th>
                                    <th class="py-2.5 px-3">Nama Alat</th>
                                    <th class="py-2.5 px-3">Tahun</th>
                                    <th class="py-2.5 px-3">Status</th>
                                    <th class="py-2.5 px-3 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-xs text-gray-700 divide-y divide-gray-100">
                                @forelse($inovator->alatTtg as $index => $alat)
                                    <tr class="hover:bg-gray-50/50 transition-colors">
                                        <td class="py-2.5 px-3 text-gray-500">{{ $index + 1 }}</td>
                                        <td class="py-2.5 px-3 font-semibold text-[#29abe2]">{{ $alat->nama_alat }}
                                        </td>
                                        <td class="py-2.5 px-3 text-gray-600">{{ $alat->tahun_produksi ?? '-' }}</td>
                                        <td class="py-2.5 px-3">
                                            <span
                                                class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-medium {{ $alat->status_publikasi == 'Aktif' ? 'bg-green-50 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                                {{ $alat->status_publikasi }}
                                            </span>
                                        </td>
                                        <td class="py-2.5 px-3 text-center">
                                            <a href="/admin/alat/{{ $alat->id }}"
                                                class="text-gray-400 hover:text-[#29abe2] transition-colors"
                                                title="Lihat Alat">
                                                <span class="material-symbols-outlined text-[16px]">visibility</span>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-8 text-center text-gray-400 text-xs">
                                            Inovator ini belum mendaftarkan produk alat TTG.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <!-- Script Sidebar Mobile Toggle -->
    <script>
        const menuBtn = document.getElementById('menu-btn');
        const sidebar = document.getElementById('sidebar');
        menuBtn?.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });
    </script>
</body>

</html>
