<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Tambah Telaahan Staf - Admin Panel</title>
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

            <div class="mb-6">
                <a href="{{ route('admin.telaahan-staf.index') }}" class="text-[#29abe2] flex items-center gap-1 text-xs font-semibold hover:underline mb-1 w-max">
                    <span class="material-symbols-outlined text-sm">arrow_back</span> Kembali ke Data Telaahan Staf
                </a>
                <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Tambah Dokumen Telaahan Staf</h2>
                <p class="text-sm text-gray-600 mt-1">Masukkan rincian analisis, rekomendasi dinas, serta berkas PDF pendukung.</p>
            </div>

            @if ($errors->any())
                <div class="bg-red-50 text-red-700 p-4 rounded-xl mb-6 border border-red-200 text-xs">
                    <p class="font-bold mb-1">Terjadi kesalahan input:</p>
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white rounded-2xl shadow-xs border border-gray-200 p-6 sm:p-8">
                <form action="{{ route('admin.telaahan-staf.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <!-- Judul Telaahan Staf -->
                    <div>
                        <label for="judul" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                            Judul Telaahan Staf <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="judul" id="judul" value="{{ old('judul') }}" required
                               placeholder="Contoh: Telaahan Staf Perencanaan Kebijakan Penerapan TTG Pertanian Urban"
                               class="w-full px-4 py-2.5 text-sm rounded-xl border border-gray-300 focus:border-[#29abe2] focus:ring-1 focus:ring-[#29abe2] outline-none">
                    </div>

                    <!-- Tahun Dokumen & Pembuat Bidang -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label for="tahun_dokumen" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                                Tahun Dokumen <span class="text-red-500">*</span>
                            </label>
                            <input type="number" min="2000" max="2099" step="1" name="tahun_dokumen" id="tahun_dokumen" value="{{ old('tahun_dokumen', date('Y')) }}" required
                                   placeholder="Contoh: 2026"
                                   class="w-full px-4 py-2.5 text-sm rounded-xl border border-gray-300 focus:border-[#29abe2] focus:ring-1 focus:ring-[#29abe2] outline-none bg-white">
                        </div>

                        <div>
                            <label for="pembuat_bidang" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                                Bidang Pembuat <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="pembuat_bidang" id="pembuat_bidang" value="{{ old('pembuat_bidang', 'Bidang Penelitian dan Pengembangan (Litbang)') }}" required
                                   placeholder="Contoh: Bidang Penelitian dan Pengembangan (Litbang)"
                                   class="w-full px-4 py-2.5 text-sm rounded-xl border border-gray-300 focus:border-[#29abe2] focus:ring-1 focus:ring-[#29abe2] outline-none">
                        </div>
                    </div>

                    <!-- Status Publikasi -->
                    <div>
                        <label for="status" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                            Status Publikasi <span class="text-red-500">*</span>
                        </label>
                        <select name="status" id="status" required
                                class="w-full px-4 py-2.5 text-sm rounded-xl border border-gray-300 focus:border-[#29abe2] focus:ring-1 focus:ring-[#29abe2] outline-none bg-white">
                            <option value="Dipublikasikan" {{ old('status') == 'Dipublikasikan' ? 'selected' : '' }}>Dipublikasikan (Tampil Publik)</option>
                            <option value="Draft" {{ old('status') == 'Draft' ? 'selected' : '' }}>Draft (Internal Admin)</option>
                        </select>
                    </div>

                    <!-- Ringkasan / Latar Belakang -->
                    <div>
                        <label for="ringkasan" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                            Ringkasan / Latar Belakang
                        </label>
                        <textarea name="ringkasan" id="ringkasan" rows="4"
                                  placeholder="Uraian singkat mengenai latar belakang penyusunan telaahan staf..."
                                  class="w-full px-4 py-2.5 text-sm rounded-xl border border-gray-300 focus:border-[#29abe2] focus:ring-1 focus:ring-[#29abe2] outline-none leading-relaxed">{{ old('ringkasan') }}</textarea>
                    </div>

                    <!-- Upload PDF File -->
                    <div class="pt-2 border-t border-gray-100">
                        <label for="file_pdf" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                            File Dokumen PDF Bertanda Tangan (Maks 20MB)
                        </label>
                        <input type="file" name="file_pdf" id="file_pdf" accept="application/pdf"
                               class="w-full text-xs text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-emerald-50 file:text-emerald-600 hover:file:bg-emerald-100 cursor-pointer">
                    </div>

                    <!-- Form Buttons -->
                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                        <a href="{{ route('admin.telaahan-staf.index') }}"
                           class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl text-xs font-bold transition-all">
                            Batal
                        </a>
                        <button type="submit"
                                class="px-6 py-2.5 bg-[#29abe2] hover:bg-[#2092c4] text-white rounded-xl text-xs font-bold shadow-sm hover:shadow-md transition-all">
                            Simpan Dokumen
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <!-- Script Hamburger Menu Mobile -->
    <script>
        const menuBtn = document.getElementById('menu-btn');
        const sidebar = document.getElementById('sidebar');

        if (menuBtn && sidebar) {
            menuBtn.addEventListener('click', () => {
                sidebar.classList.toggle('-translate-x-full');
            });
        }
    </script>
</body>
</html>
