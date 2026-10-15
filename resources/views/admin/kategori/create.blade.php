<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Tambah Kategori - Admin Panel</title>
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

<body class="text-gray-800 min-h-screen antialiased flex overflow-hidden">

    <!-- SIDEBAR -->
    @include('partials.sidebar')

    <!-- MAIN CONTENT -->
    <div class="flex-1 flex flex-col h-screen md:ml-[260px] w-full md:w-[calc(100%-260px)]">
        <main class="flex-1 p-6 md:p-8 overflow-y-auto">

            <div class="mb-6">
                <a href="/admin/kategori"
                    class="text-[#29abe2] flex items-center gap-1 text-xs font-semibold hover:underline mb-1 w-max">
                    <span class="material-symbols-outlined text-sm">arrow_back</span> Kembali ke Data Kategori
                </a>
                <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Tambah Kategori</h2>
                <p class="text-sm text-gray-600 mt-1">Masukkan informasi kategori baru dan pilih ikon visual yang
                    sesuai.</p>
            </div>

            @if ($errors->any())
                <div class="bg-red-50 text-red-700 p-3 rounded-lg mb-5 border border-red-200 text-xs">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <form action="/admin/kategori" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Nama Kategori</label>
                        <input type="text" name="nama_kategori" value="{{ old('nama_kategori') }}"
                            placeholder="Contoh: Pertanian, Energi, dll."
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-1 focus:ring-[#29abe2] outline-none"
                            required>
                    </div>

                    <!-- GRID ICON PICKER INTERAKTIF -->
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Pilih Ikon Representatif</label>
                        <input type="hidden" name="icon" id="selected-icon" value="{{ old('icon', 'category') }}">

                        <div class="grid grid-cols-4 sm:grid-cols-6 gap-2 pt-1">

                            <!-- Daftar Pilihan Ikon -->
                            @php
                                $icons = [
                                    ['name' => 'agriculture', 'label' => 'Pertanian'],
                                    ['name' => 'bolt', 'label' => 'Energi'],
                                    ['name' => 'recycling', 'label' => 'Lingkungan'],
                                    ['name' => 'school', 'label' => 'Edukasi'],
                                    ['name' => 'factory', 'label' => 'Manufaktur'],
                                    ['name' => 'category', 'label' => 'Lainnya'],
                                ];
                            @endphp

                            @foreach ($icons as $ico)
                                <div type="button" onclick="selectIcon('{{ $ico['name'] }}', this)"
                                    class="icon-card flex flex-col items-center justify-center p-3 border border-gray-200 rounded-lg cursor-pointer hover:border-[#29abe2] hover:bg-sky-50/50 transition-all {{ old('icon', 'category') == $ico['name'] ? 'border-[#29abe2] bg-sky-50 text-[#29abe2] ring-1 ring-[#29abe2]' : 'text-gray-600' }}">
                                    <span class="material-symbols-outlined text-[24px] mb-1">{{ $ico['name'] }}</span>
                                    <span
                                        class="text-[10px] font-medium text-center truncate w-full">{{ $ico['label'] }}</span>
                                </div>
                            @endforeach

                        </div>
                        <p class="text-[11px] text-gray-400 mt-1.5">*Klik salah satu kotak ikon di atas untuk memilih.
                        </p>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Deskripsi Kategori</label>
                        <textarea name="deskripsi" rows="3" placeholder="Tuliskan deskripsi singkat mengenai kategori alat ini..."
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-1 focus:ring-[#29abe2] outline-none resize-none">{{ old('deskripsi') }}</textarea>
                    </div>

                    <div class="flex items-center justify-end gap-2 pt-4 border-t border-gray-100">
                        <a href="/admin/kategori"
                            class="px-5 py-2 border border-gray-300 text-gray-700 text-sm rounded-md hover:bg-gray-50 font-medium">Batal</a>
                        <button type="submit"
                            class="px-5 py-2 bg-[#29abe2] text-white text-sm rounded-md hover:bg-[#1a95c9] font-medium shadow-sm flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-[16px]">save</span> Simpan Kategori
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <!-- Skrip JavaScript untuk Grid Picker -->
    <script>
        function selectIcon(iconName, element) {
            // Masukkan nilai nama ikon ke input hidden
            document.getElementById('selected-icon').value = iconName;

            // Hapus style aktif dari seluruh kartu ikon
            document.querySelectorAll('.icon-card').forEach(card => {
                card.classList.remove('border-[#29abe2]', 'bg-sky-50', 'text-[#29abe2]', 'ring-1',
                'ring-[#29abe2]');
                card.classList.add('text-gray-600');
            });

            // Tambahkan style aktif ke kartu yang sedang diklik
            element.classList.add('border-[#29abe2]', 'bg-sky-50', 'text-[#29abe2]', 'ring-1', 'ring-[#29abe2]');
            element.classList.remove('text-gray-600');
        }
    </script>
</body>

</html>
