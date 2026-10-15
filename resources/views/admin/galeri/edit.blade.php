<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Edit Dokumentasi Galeri - Admin Panel</title>
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

            <!-- Breadcrumb & Header -->
            <div class="mb-6">
                <a href="{{ route('admin.galeri.index') }}" class="text-[#29abe2] flex items-center gap-1 text-xs font-semibold hover:underline mb-1 w-max">
                    <span class="material-symbols-outlined text-sm">arrow_back</span> Kembali ke Data Galeri Kegiatan
                </a>
                <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Edit Dokumentasi Kegiatan</h2>
            </div>

            <!-- Form Card -->
            <div class="bg-white rounded-xl shadow-[0_2px_10px_rgba(0,0,0,0.04)] border border-gray-100 p-6 md:p-8 max-w-4xl">
                
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 text-red-700 border border-red-200 rounded-lg text-sm space-y-1">
                        <div class="font-bold flex items-center gap-2">
                            <span class="material-symbols-outlined text-lg">error</span>
                            Terdapat kesalahan pengisian form:
                        </div>
                        <ul class="list-disc list-inside space-y-0.5 text-xs">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.galeri.update', $galeri->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Judul Kegiatan -->
                    <div class="space-y-1.5">
                        <label class="block text-sm font-semibold text-gray-700">Judul Kegiatan <span class="text-red-500">*</span></label>
                        <input type="text" name="judul" value="{{ old('judul', $galeri->judul) }}" required
                            placeholder="Contoh: Pameran Gelar Teknologi Tepat Guna Kota Tasikmalaya 2026"
                            class="w-full px-4 py-2.5 bg-white border border-gray-300 rounded-lg text-sm focus:ring-1 focus:ring-[#29abe2] focus:border-[#29abe2] outline-none">
                    </div>

                    <!-- Grid 3 Kolom: Tanggal, Lokasi & Status -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Tanggal Kegiatan -->
                        <div class="space-y-1.5">
                            <label class="block text-sm font-semibold text-gray-700">Tanggal Kegiatan <span class="text-red-500">*</span></label>
                            <input type="date" name="tanggal_kegiatan" value="{{ old('tanggal_kegiatan', $galeri->tanggal_kegiatan ? $galeri->tanggal_kegiatan->format('Y-m-d') : '') }}" required
                                class="w-full px-4 py-2.5 bg-white border border-gray-300 rounded-lg text-sm focus:ring-1 focus:ring-[#29abe2] outline-none">
                        </div>

                        <!-- Lokasi -->
                        <div class="space-y-1.5">
                            <label class="block text-sm font-semibold text-gray-700">Lokasi Kegiatan</label>
                            <input type="text" name="lokasi" value="{{ old('lokasi', $galeri->lokasi) }}"
                                placeholder="Contoh: Gedung Bale Kota Tasikmalaya / Kec. Cihideung"
                                class="w-full px-4 py-2.5 bg-white border border-gray-300 rounded-lg text-sm focus:ring-1 focus:ring-[#29abe2] outline-none">
                        </div>

                        <!-- Status Publikasi -->
                        <div class="space-y-1.5">
                            <label class="block text-sm font-semibold text-gray-700">Status Publikasi <span class="text-red-500">*</span></label>
                            <select name="status" required
                                class="w-full px-4 py-2.5 bg-white border border-gray-300 rounded-lg text-sm focus:ring-1 focus:ring-[#29abe2] outline-none cursor-pointer">
                                <option value="Dipublikasikan" {{ old('status', $galeri->status) == 'Dipublikasikan' ? 'selected' : '' }}>Dipublikasikan</option>
                                <option value="Draft" {{ old('status', $galeri->status) == 'Draft' ? 'selected' : '' }}>Draft</option>
                            </select>
                        </div>
                    </div>

                    <!-- FOTO UTAMA -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">Foto Utama Dokumentasi</label>
                        <div class="flex flex-col sm:flex-row items-start gap-4 p-4 bg-gray-50 border border-dashed border-gray-300 rounded-xl">
                            <div id="img-main-preview" class="w-36 h-28 rounded-lg bg-gray-200 overflow-hidden shrink-0 flex items-center justify-center border border-gray-300">
                                @if($galeri->foto)
                                    <img src="{{ asset($galeri->foto) }}" class="w-full h-full object-cover rounded-lg">
                                @else
                                    <span class="material-symbols-outlined text-3xl text-gray-400">image</span>
                                @endif
                            </div>
                            <div class="space-y-2 flex-1">
                                <input type="file" name="foto" id="foto-main-input" accept="image/*" onchange="previewMainFile(this)"
                                    class="text-xs text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-[#29abe2] file:text-white hover:file:bg-[#1a95c9] cursor-pointer">
                                <p class="text-xs text-gray-500">Biarkan kosong jika tidak ingin mengubah foto utama. Format PNG, JPG, JPEG, WEBP. Maksimal 10MB.</p>
                            </div>
                        </div>
                    </div>

                    <!-- FOTO PENDUKUNG (MAKSIMAL 4 FOTO) -->
                    @php
                        $fotoPendukung = is_array($galeri->foto_pendukung) ? $galeri->foto_pendukung : [];
                    @endphp

                    <div class="space-y-2 pt-2 border-t border-gray-100">
                        <div class="flex items-center justify-between">
                            <label class="block text-sm font-semibold text-gray-700">
                                Foto Pendukung Kegiatan <span class="text-xs text-gray-400 font-normal">(Opsional - Maksimal 4 Foto)</span>
                            </label>
                            <span class="text-xs font-semibold text-[#29abe2] bg-sky-50 px-2.5 py-1 rounded-md border border-sky-100">
                                {{ count($fotoPendukung) }} / 4 foto terisi
                            </span>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                            @for ($i = 0; $i < 4; $i++)
                                @php
                                    $existingImg = isset($fotoPendukung[$i]) ? $fotoPendukung[$i] : null;
                                @endphp
                                <div class="p-3 bg-gray-50 border border-gray-200 rounded-xl space-y-2 text-center relative group">
                                    <div class="flex items-center justify-between">
                                        <span class="text-[11px] font-bold text-gray-500 uppercase tracking-wider">Foto {{ $i + 1 }}</span>
                                        @if($existingImg)
                                            <label class="inline-flex items-center gap-1 cursor-pointer" title="Centang untuk simpan foto ini">
                                                <input type="checkbox" name="existing_foto_pendukung[]" value="{{ $existingImg }}" checked class="w-3.5 h-3.5 text-[#29abe2] rounded border-gray-300 focus:ring-[#29abe2]">
                                                <span class="text-[10px] font-semibold text-emerald-600">Simpan</span>
                                            </label>
                                        @endif
                                    </div>
                                    
                                    <div id="img-support-preview-{{ $i }}" class="w-full h-28 rounded-lg bg-gray-200 overflow-hidden flex items-center justify-center border border-gray-300 relative">
                                        @if($existingImg)
                                            <img src="{{ asset($existingImg) }}" class="w-full h-full object-cover rounded-lg">
                                        @else
                                            <span class="material-symbols-outlined text-3xl text-gray-400">add_photo_alternate</span>
                                        @endif
                                    </div>

                                    <input type="file" name="foto_pendukung[]" id="support-input-{{ $i }}" accept="image/*" onchange="previewSupportFile(this, {{ $i }})"
                                        class="text-xs text-gray-500 w-full file:mr-0 file:w-full file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-[11px] file:font-semibold file:bg-white file:text-gray-700 file:border file:border-gray-300 hover:file:bg-gray-100 cursor-pointer">
                                </div>
                            @endfor
                        </div>
                    </div>

                    <!-- Deskripsi Kegiatan -->
                    <div class="space-y-1.5 pt-2 border-t border-gray-100">
                        <label class="block text-sm font-semibold text-gray-700">Deskripsi / Catatan Dokumentasi</label>
                        <textarea name="deskripsi" rows="4"
                            placeholder="Jelaskan secara ringkas mengenai maksud, suasana, atau hasil dari kegiatan..."
                            class="w-full px-4 py-2.5 bg-white border border-gray-300 rounded-lg text-sm focus:ring-1 focus:ring-[#29abe2] outline-none">{{ old('deskripsi', $galeri->deskripsi) }}</textarea>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="pt-4 border-t border-gray-100 flex items-center justify-end gap-3">
                        <a href="{{ route('admin.galeri.index') }}"
                            class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg text-sm font-semibold transition-colors">
                            Batal
                        </a>
                        <button type="submit"
                            class="px-6 py-2.5 bg-[#29abe2] hover:bg-[#1a95c9] text-white rounded-lg text-sm font-semibold shadow-sm transition-colors flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-[18px]">save</span> Perbarui Dokumentasi
                        </button>
                    </div>

                </form>
            </div>
        </main>
    </div>

    <script>
        function previewMainFile(input) {
            const previewBox = document.getElementById('img-main-preview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewBox.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover rounded-lg">`;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function previewSupportFile(input, index) {
            const previewBox = document.getElementById(`img-support-preview-${index}`);
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewBox.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover rounded-lg">`;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>
