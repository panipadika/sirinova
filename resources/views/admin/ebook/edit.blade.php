<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Edit E-Book Kajian - Admin Panel</title>
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
                <a href="{{ route('admin.ebook.index') }}" class="text-[#29abe2] flex items-center gap-1 text-xs font-semibold hover:underline mb-1 w-max">
                    <span class="material-symbols-outlined text-sm">arrow_back</span> Kembali ke Data E-Book Kajian
                </a>
                <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Edit E-Book Kajian</h2>
                <p class="text-sm text-gray-600 mt-1">Perbarui informasi e-book riset/kajian dan ganti file cover atau PDF jika diperlukan.</p>
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
                <form action="{{ route('admin.ebook.update', $ebook->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Judul E-Book -->
                    <div>
                        <label for="judul" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                            Judul E-Book Kajian <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="judul" id="judul" value="{{ old('judul', $ebook->judul) }}" required
                               placeholder="Contoh: Kajian TTG Infrastruktur & Pertanian Perkotaan 2025"
                               class="w-full px-4 py-2.5 text-sm rounded-xl border border-gray-300 focus:border-[#29abe2] focus:ring-1 focus:ring-[#29abe2] outline-none">
                    </div>

                    <!-- Kategori & Tahun -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <!-- Kategori -->
                        <div>
                            <label for="kategori" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                                Kategori <span class="text-red-500">*</span>
                            </label>
                            <select name="kategori" id="kategori" required
                                    class="w-full px-4 py-2.5 text-sm rounded-xl border border-gray-300 focus:border-[#29abe2] focus:ring-1 focus:ring-[#29abe2] outline-none bg-white">
                                @php $selectedKat = old('kategori', $ebook->kategori); @endphp
                                <option value="Infrastruktur" {{ $selectedKat == 'Infrastruktur' ? 'selected' : '' }}>Infrastruktur</option>
                                <option value="Pertanian" {{ $selectedKat == 'Pertanian' ? 'selected' : '' }}>Pertanian</option>
                                <option value="Ekonomi" {{ $selectedKat == 'Ekonomi' ? 'selected' : '' }}>Ekonomi</option>
                                <option value="Lingkungan" {{ $selectedKat == 'Lingkungan' ? 'selected' : '' }}>Lingkungan</option>
                                <option value="Energi" {{ $selectedKat == 'Energi' ? 'selected' : '' }}>Energi</option>
                                <option value="Pendidikan" {{ $selectedKat == 'Pendidikan' ? 'selected' : '' }}>Pendidikan</option>
                                <option value="Kesehatan" {{ $selectedKat == 'Kesehatan' ? 'selected' : '' }}>Kesehatan</option>
                                <option value="Lainnya" {{ $selectedKat == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>

                        <!-- Tahun Terbit -->
                        <div>
                            <label for="tahun" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                                Tahun Terbit <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="tahun" id="tahun" value="{{ old('tahun', $ebook->tahun) }}" required
                                   placeholder="Contoh: 2025"
                                   class="w-full px-4 py-2.5 text-sm rounded-xl border border-gray-300 focus:border-[#29abe2] focus:ring-1 focus:ring-[#29abe2] outline-none">
                        </div>
                    </div>

                    <!-- Deskripsi / Abstraksi -->
                    <div>
                        <label for="deskripsi" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                            Abstraksi / Deskripsi Singkat <span class="text-red-500">*</span>
                        </label>
                        <textarea name="deskripsi" id="deskripsi" rows="5" required
                                  placeholder="Tuliskan ringkasan / abstraksi mengenai kajian e-book..."
                                  class="w-full px-4 py-2.5 text-sm rounded-xl border border-gray-300 focus:border-[#29abe2] focus:ring-1 focus:ring-[#29abe2] outline-none leading-relaxed">{{ old('deskripsi', $ebook->deskripsi) }}</textarea>
                    </div>

                    <!-- Upload Cover Image & PDF File -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-2 border-t border-gray-100">
                        <!-- Cover Image Upload -->
                        <div>
                            <label for="cover_image" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                                Ganti Foto Cover E-Book (PNG/JPG, Maks 5MB)
                            </label>
                            @if($ebook->cover_image)
                                <div class="mb-2 flex items-center gap-3">
                                    <img src="{{ asset($ebook->cover_image) }}" alt="Cover Current" class="w-10 h-14 object-cover rounded border border-gray-200">
                                    <span class="text-[11px] text-gray-500">Cover saat ini</span>
                                </div>
                            @endif
                            <input type="file" name="cover_image" id="cover_image" accept="image/*"
                                   class="w-full text-xs text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-blue-50 file:text-[#29abe2] hover:file:bg-blue-100 cursor-pointer">
                        </div>

                        <!-- PDF File Upload -->
                        <div>
                            <label for="file_pdf" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                                Ganti File Dokumen PDF (Maks 20MB)
                            </label>
                            @if($ebook->file_url && $ebook->file_url !== '#')
                                <div class="mb-2 flex items-center gap-2">
                                    <span class="material-symbols-outlined text-emerald-600 text-sm">picture_as_pdf</span>
                                    <a href="{{ asset($ebook->file_url) }}" target="_blank" class="text-[11px] font-bold text-emerald-600 hover:underline">Lihat PDF Saat Ini</a>
                                </div>
                            @endif
                            <input type="file" name="file_pdf" id="file_pdf" accept="application/pdf"
                                   class="w-full text-xs text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-emerald-50 file:text-emerald-600 hover:file:bg-emerald-100 cursor-pointer">
                        </div>
                    </div>

                    <!-- Form Buttons -->
                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                        <a href="{{ route('admin.ebook.index') }}"
                           class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl text-xs font-bold transition-all">
                            Batal
                        </a>
                        <button type="submit"
                                class="px-6 py-2.5 bg-[#29abe2] hover:bg-[#2092c4] text-white rounded-xl text-xs font-bold shadow-sm hover:shadow-md transition-all">
                            Perbarui E-Book
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
