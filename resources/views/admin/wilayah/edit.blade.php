<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Edit Wilayah - Admin Panel</title>
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

<body class="text-gray-800 min-h-screen antialiased flex overflow-hidden">

    <!-- SIDEBAR -->
    @include('partials.sidebar')

    <!-- MAIN CONTENT -->
    <div class="flex-1 flex flex-col h-screen md:ml-[260px] w-full md:w-[calc(100%-260px)]">
        <main class="flex-1 p-6 md:p-8 overflow-y-auto">

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8">

                <a href="/admin/wilayah"
                    class="text-[#29abe2] flex items-center gap-1 text-sm font-medium hover:underline mb-4 w-max">
                    <span class="material-symbols-outlined text-[16px]">arrow_back</span> Kembali ke Data Wilayah
                </a>

                <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Edit Data Wilayah</h2>
                <p class="text-sm text-gray-600 mt-1 mb-8">Ubah informasi kecamatan wilayah di sistem.</p>

                @if ($errors->any())
                    <div class="bg-red-50 text-red-700 p-3 rounded-lg mb-6 border border-red-200 text-sm">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="/admin/wilayah/{{ $wilayah->id }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-semibold text-gray-800 mb-2">Nama Kecamatan <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="nama_kecamatan"
                            value="{{ old('nama_kecamatan', $wilayah->nama_kecamatan) }}"
                            placeholder="Contoh: Cihideung"
                            class="w-full px-4 py-3 text-sm bg-gray-50 border border-gray-200 rounded-md focus:bg-white focus:ring-1 focus:ring-[#29abe2] focus:border-[#29abe2] outline-none transition-colors"
                            required>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-800 mb-2">Kode Wilayah <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="kode_wilayah"
                            value="{{ old('kode_wilayah', $wilayah->kode_wilayah) }}" placeholder="Contoh: 32.78.01"
                            class="w-full px-4 py-3 text-sm bg-gray-50 border border-gray-200 rounded-md focus:bg-white focus:ring-1 focus:ring-[#29abe2] focus:border-[#29abe2] outline-none transition-colors"
                            required>
                        <p class="text-xs text-gray-500 mt-2">Kode referensi unik untuk wilayah ini.</p>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-800 mb-2">Deskripsi Singkat</label>
                        <textarea name="deskripsi" rows="4" placeholder="Tuliskan deskripsi singkat mengenai wilayah ini..."
                            class="w-full px-4 py-3 text-sm bg-gray-50 border border-gray-200 rounded-md focus:bg-white focus:ring-1 focus:ring-[#29abe2] focus:border-[#29abe2] outline-none resize-none transition-colors">{{ old('deskripsi', $wilayah->deskripsi) }}</textarea>
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-6">
                        <a href="/admin/wilayah"
                            class="px-6 py-2.5 border border-[#29abe2] text-[#29abe2] text-sm rounded-md hover:bg-sky-50 font-medium transition-colors">Batal</a>
                        <button type="submit"
                            class="px-6 py-2.5 bg-yellow-500 text-white text-sm rounded-md hover:bg-yellow-600 font-medium shadow-sm flex items-center gap-2 transition-colors">
                            <span class="material-symbols-outlined text-[18px]">update</span> Perbarui Wilayah
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>

</html>
