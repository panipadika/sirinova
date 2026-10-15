<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Detail Pendaftaran Lomba TTG - {{ $item->nomor_registrasi }}</title>
    <!-- Favicon Logo Tasikmalaya -->
    <link rel="icon" type="image/png" href="{{ asset('storage/images/favicon_tasik.png') }}?v=3">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=3">
    <link rel="apple-touch-icon" href="{{ asset('storage/images/favicon_tasik.png') }}?v=3">
    
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Public+Sans:wght@600;700;800&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f4f7f6; }
        h1, h2, h3, h4, h5, h6 { font-family: 'Public Sans', sans-serif; }
        * { -ms-overflow-style: none !important; scrollbar-width: none !important; }
        *::-webkit-scrollbar { display: none !important; width: 0 !important; height: 0 !important; }
    </style>
</head>

<body class="text-gray-800 min-h-screen antialiased flex overflow-hidden">

    <!-- SIDEBAR -->
    @include('partials.sidebar')

    <!-- MAIN CONTENT -->
    <div class="flex-1 flex flex-col h-screen md:ml-[260px] w-full md:w-[calc(100%-260px)] overflow-y-auto">

        <!-- Mobile Header -->
        <header class="md:hidden bg-white border-b flex justify-between items-center h-14 px-4 sticky top-0 z-40">
            <button class="p-2 text-gray-500 rounded hover:bg-gray-100" id="menu-btn" onclick="document.getElementById('sidebar').classList.toggle('-translate-x-full')">
                <span class="material-symbols-outlined">menu</span>
            </button>
            <span class="text-lg font-bold text-gray-900">Detail Pendaftar Lomba</span>
        </header>

        <div class="p-4 sm:p-5 lg:p-6 space-y-4 max-w-5xl">

            <!-- Breadcrumb & Back -->
            <div class="flex items-center justify-between gap-3 flex-wrap">
                <a href="{{ route('admin.lomba.index') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-gray-500 hover:text-[#00A3E0] transition-colors">
                    <span class="material-symbols-outlined text-base">arrow_back</span>
                    <span>Kembali ke Daftar Pendaftar</span>
                </a>

                <div class="flex items-center gap-2">
                    <span class="font-mono text-xs font-bold bg-slate-100 border border-slate-200 px-2.5 py-1 rounded-lg text-slate-800">
                        {{ $item->nomor_registrasi }}
                    </span>
                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold border {{ $item->status_badge }}">
                        <span class="material-symbols-outlined text-sm">{{ $item->status_icon }}</span>
                        <span>{{ $item->status }}</span>
                    </span>
                </div>
            </div>

            <!-- Flash Alert -->
            @if(session('success'))
            <div class="p-3 bg-emerald-50 rounded-xl border border-emerald-200 flex items-center gap-2.5">
                <span class="material-symbols-outlined text-emerald-600 shrink-0 text-lg">check_circle</span>
                <p class="text-xs font-bold text-emerald-800">{{ session('success') }}</p>
            </div>
            @endif

            <!-- MAIN DETAIL CARD -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-xs p-4 sm:p-5 space-y-4">

                <!-- Header Title -->
                <div class="border-b border-gray-100 pb-3.5 space-y-1">
                    <div class="flex items-center gap-2 flex-wrap text-xs">
                        <span class="px-2.5 py-0.5 bg-sky-50 text-[#00A3E0] border border-sky-100 rounded-lg text-[10px] font-black uppercase tracking-wider">
                            Kategori: {{ $item->kategori_peserta }}
                        </span>
                        <span class="text-gray-400 text-[11px] flex items-center gap-1">
                            <span class="material-symbols-outlined text-xs">calendar_today</span>
                            <span>Diajukan pada {{ $item->dibuat_pada ? $item->dibuat_pada->translatedFormat('d F Y, H:i') : '-' }} WIB</span>
                        </span>
                    </div>
                    <h1 class="text-xl sm:text-2xl font-black text-gray-900 leading-snug">
                        {{ $item->nama_alat }}
                    </h1>
                </div>

                <!-- Grid Data: Inovator & Biaya vs Foto & Dokumen -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    
                    <!-- SISI KIRI: Identitas Inovator & Analisis Biaya -->
                    <div class="space-y-3.5 flex flex-col justify-between">
                        <!-- Identitas Inovator -->
                        <div class="bg-slate-50/80 p-3.5 rounded-xl border border-slate-100 space-y-2.5 text-xs">
                            <h3 class="text-xs font-black uppercase tracking-wider text-[#00A3E0] flex items-center gap-1.5 border-b border-slate-200/60 pb-2">
                                <span class="material-symbols-outlined text-base">person</span>
                                <span>Identitas Inovator / Tim</span>
                            </h3>

                            <div class="space-y-2">
                                <div>
                                    <span class="text-gray-400 block text-[10px] uppercase font-bold tracking-wider">Nama Inovator (Ketua)</span>
                                    <strong class="text-gray-900 text-xs sm:text-sm font-bold block">{{ $item->nama_inovator }}</strong>
                                </div>

                                @if($item->nama_anggota)
                                <div>
                                    <span class="text-gray-400 block text-[10px] uppercase font-bold tracking-wider">Anggota Tim</span>
                                    <p class="text-gray-800 font-medium text-xs whitespace-pre-line">{{ $item->nama_anggota }}</p>
                                </div>
                                @endif

                                <div>
                                    <span class="text-gray-400 block text-[10px] uppercase font-bold tracking-wider">Asal Instansi / Sekolah / Kampus</span>
                                    <strong class="text-gray-800 font-semibold text-xs block">{{ $item->asal_instansi }}</strong>
                                </div>

                                <div class="pt-1.5 border-t border-slate-200/60 flex items-center justify-between flex-wrap gap-2">
                                    <div>
                                        <span class="text-gray-400 block text-[10px] uppercase font-bold tracking-wider">Nomor WhatsApp</span>
                                        <strong class="text-gray-800 font-semibold text-xs font-mono">{{ $item->nomor_wa }}</strong>
                                    </div>
                                    @php
                                        $cleanPhone = preg_replace('/[^0-9]/', '', $item->nomor_wa);
                                        if(str_starts_with($cleanPhone, '0')) {
                                            $cleanPhone = '62' . substr($cleanPhone, 1);
                                        }
                                    @endphp
                                    <a href="https://wa.me/{{ $cleanPhone }}?text=Halo%20{{ urlencode($item->nama_inovator) }},%20kami%20dari%20Panitia%20Lomba%20TTG%20Bappelitbangda%20Kota%20Tasikmalaya..." target="_blank" 
                                       class="inline-flex items-center gap-1 px-2.5 py-1 bg-emerald-600 hover:bg-emerald-700 active:scale-[0.98] text-white rounded-lg font-bold text-[10px] shadow-2xs transition-all cursor-pointer">
                                        <span class="material-symbols-outlined text-xs">chat</span> Chat WA
                                    </a>
                                </div>

                                <div>
                                    <span class="text-gray-400 block text-[10px] uppercase font-bold tracking-wider">Alamat Email</span>
                                    <a href="mailto:{{ $item->email }}" class="text-[#00A3E0] hover:underline font-semibold text-xs">{{ $item->email }}</a>
                                </div>
                            </div>
                        </div>

                        <!-- Analisis Biaya & Proposal -->
                        <div class="bg-slate-50/80 p-3.5 rounded-xl border border-slate-100 space-y-2.5 text-xs">
                            <h3 class="text-xs font-black uppercase tracking-wider text-[#00A3E0] flex items-center gap-1.5 border-b border-slate-200/60 pb-2">
                                <span class="material-symbols-outlined text-base">payments</span>
                                <span>Analisis Biaya & Dokumen Proposal</span>
                            </h3>

                            <div class="grid grid-cols-2 gap-2.5">
                                <div class="bg-white p-2.5 rounded-lg border border-slate-200/80">
                                    <span class="text-gray-400 block text-[10px] uppercase font-bold tracking-wider">Biaya Pembuatan</span>
                                    <strong class="text-gray-900 text-xs sm:text-sm font-extrabold block">Rp {{ number_format($item->biaya_pembuatan, 0, ',', '.') }}</strong>
                                </div>
                                <div class="bg-white p-2.5 rounded-lg border border-slate-200/80">
                                    <span class="text-gray-400 block text-[10px] uppercase font-bold tracking-wider">Estimasi Harga Jual</span>
                                    <strong class="text-emerald-600 text-xs sm:text-sm font-extrabold block">Rp {{ number_format($item->estimasi_harga_jual, 0, ',', '.') }}</strong>
                                </div>
                            </div>

                            <!-- Proposal Download Button -->
                            <div class="bg-white p-2.5 rounded-lg border border-sky-200 flex items-center justify-between gap-2">
                                <div class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-xl text-[#00A3E0]">description</span>
                                    <div>
                                        <strong class="text-gray-900 block font-bold text-xs leading-tight">File Proposal Inovasi</strong>
                                        <span class="text-[10px] text-gray-400 block leading-tight">Diunggah oleh peserta</span>
                                    </div>
                                </div>
                                <a href="{{ route('lomba.proposal.download', $item->id) }}" class="py-1.5 px-3 bg-[#00A3E0] hover:bg-[#008cc0] active:scale-[0.98] text-white font-bold text-xs rounded-lg flex items-center gap-1 transition-all shadow-2xs cursor-pointer">
                                    <span class="material-symbols-outlined text-sm">download</span>
                                    <span>Unduh Proposal</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- SISI KANAN: Foto Dokumentasi Alat TTG -->
                    <div class="bg-slate-50/80 p-3.5 rounded-xl border border-slate-100 space-y-2.5 text-xs flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between border-b border-slate-200/60 pb-2">
                                <h3 class="text-xs font-black uppercase tracking-wider text-[#00A3E0] flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-base">photo_camera</span>
                                    <span>Foto Dokumentasi Alat TTG</span>
                                </h3>
                                @if($item->foto_alat)
                                <span class="px-2 py-0.5 bg-emerald-50 text-emerald-700 text-[10px] font-bold rounded-md border border-emerald-200 flex items-center gap-1">
                                    <span class="material-symbols-outlined text-xs">verified</span> Ada
                                </span>
                                @else
                                <span class="px-2 py-0.5 bg-rose-50 text-rose-700 text-[10px] font-bold rounded-md border border-rose-200">
                                    Kosong
                                </span>
                                @endif
                            </div>

                            <div class="mt-2.5">
                                @if($item->foto_alat)
                                <div class="relative group rounded-xl overflow-hidden border border-slate-200 bg-slate-900/5 flex items-center justify-center cursor-pointer min-h-[190px] max-h-[220px]" onclick="openPhotoModal('{{ asset('storage/' . $item->foto_alat) }}')">
                                    <img src="{{ asset('storage/' . $item->foto_alat) }}" alt="{{ $item->nama_alat }}" class="w-full h-48 object-contain bg-slate-50 group-hover:scale-105 transition-transform duration-300">
                                    <div class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-1.5 text-white font-bold text-xs">
                                        <span class="material-symbols-outlined text-lg">zoom_in</span>
                                        <span>Perbesar Foto</span>
                                    </div>
                                </div>
                                @else
                                <div class="p-8 rounded-xl bg-slate-50 border border-dashed border-rose-200 text-center text-rose-500">
                                    <span class="material-symbols-outlined text-2xl mb-1">image_not_supported</span>
                                    <p class="text-[11px] font-bold">Foto dokumentasi belum terunggah</p>
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="space-y-2 pt-1">
                            @if($item->foto_alat)
                            <div class="flex items-center gap-2">
                                <button type="button" onclick="openPhotoModal('{{ asset('storage/' . $item->foto_alat) }}')" class="flex-1 py-1.5 px-3 bg-[#00A3E0] hover:bg-[#008cc0] active:scale-[0.98] text-white font-bold text-xs rounded-lg flex items-center justify-center gap-1 transition-all shadow-2xs cursor-pointer">
                                    <span class="material-symbols-outlined text-sm">fullscreen</span>
                                    <span>Lihat Ukuran Penuh</span>
                                </button>
                                <a href="{{ asset('storage/' . $item->foto_alat) }}" download class="py-1.5 px-3 bg-white hover:bg-slate-100 text-slate-700 font-bold text-xs rounded-lg flex items-center justify-center gap-1 transition-colors border border-slate-200" title="Unduh Gambar">
                                    <span class="material-symbols-outlined text-sm">download</span>
                                </a>
                            </div>
                            @endif

                            @if($item->link_video)
                            <div class="p-2 bg-white rounded-lg border border-slate-200 flex items-center justify-between gap-2">
                                <span class="text-gray-400 block text-[10px] uppercase font-bold tracking-wider">Video Demo</span>
                                <a href="{{ $item->link_video }}" target="_blank" class="inline-flex items-center gap-1 text-xs font-bold text-red-600 hover:underline truncate max-w-[200px]">
                                    <span class="material-symbols-outlined text-sm">play_circle</span>
                                    <span class="truncate">Buka Tautan Video</span>
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- DESKRIPSI KARYA (Compact 2-Column Grid) -->
                <div class="space-y-3 pt-3 border-t border-gray-100">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3.5">
                        <!-- Fungsi & Manfaat -->
                        <div class="bg-slate-50/80 p-3.5 rounded-xl border border-slate-100 space-y-1.5">
                            <h4 class="text-xs font-black uppercase tracking-wider text-gray-700 flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-base text-[#00A3E0]">lightbulb</span>
                                <span>Fungsi & Kegunaan Alat TTG</span>
                            </h4>
                            <div class="bg-white p-3 rounded-lg border border-slate-200/70 text-xs text-gray-700 leading-relaxed whitespace-pre-line min-h-[55px]">
                                {{ $item->fungsi ?: 'Belum diisi oleh pendaftar.' }}
                            </div>
                        </div>

                        <!-- Spesifikasi Teknis & Bahan -->
                        <div class="bg-slate-50/80 p-3.5 rounded-xl border border-slate-100 space-y-1.5">
                            <h4 class="text-xs font-black uppercase tracking-wider text-gray-700 flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-base text-[#00A3E0]">build</span>
                                <span>Spesifikasi Teknis & Bahan</span>
                            </h4>
                            <div class="bg-white p-3 rounded-lg border border-slate-200/70 text-xs text-gray-700 leading-relaxed whitespace-pre-line min-h-[55px]">
                                {{ $item->spesifikasi_bahan ?: 'Belum diisi oleh pendaftar.' }}
                            </div>
                        </div>
                    </div>

                    @if($item->latar_belakang)
                    <!-- Latar Belakang -->
                    <div class="bg-slate-50/80 p-3.5 rounded-xl border border-slate-100 space-y-1.5">
                        <h4 class="text-xs font-black uppercase tracking-wider text-gray-700 flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-base text-[#00A3E0]">history_edu</span>
                            <span>Latar Belakang & Nilai Kebaruan</span>
                        </h4>
                        <div class="bg-white p-3 rounded-lg border border-slate-200/70 text-xs text-gray-700 leading-relaxed whitespace-pre-line">
                            {{ $item->latar_belakang }}
                        </div>
                    </div>
                    @endif
                </div>

                <!-- FORM VERIFIKASI & CATATAN ADMIN -->
                <div class="bg-gradient-to-br from-sky-50/70 via-white to-sky-50/40 p-3.5 sm:p-4 rounded-xl border border-sky-200/80 shadow-2xs space-y-3">
                    <div class="flex items-center justify-between gap-2 flex-wrap border-b border-sky-100 pb-2">
                        <div class="space-y-0.5">
                            <h3 class="text-xs sm:text-sm font-extrabold text-gray-900 flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-[#00A3E0] text-base sm:text-lg">rule</span>
                                <span>Form Evaluasi & Verifikasi Admin</span>
                            </h3>
                            <p class="text-[11px] text-gray-500">Perbarui status verifikasi karya pendaftar ini dan cantumkan catatan/masukan juri.</p>
                        </div>
                        <span class="text-[10px] font-bold text-sky-700 bg-sky-100/70 px-2 py-0.5 rounded-md">Panel Verifikasi</span>
                    </div>

                    <form action="{{ route('admin.lomba.update-status', $item->id) }}" method="POST" class="space-y-3">
                        @csrf
                        @method('PATCH')

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                            <!-- Pilihan Status -->
                            <div class="space-y-1 md:col-span-1">
                                <label for="status" class="block text-[11px] font-bold text-gray-700">Status Verifikasi</label>
                                <div class="relative">
                                    <select name="status" id="status" class="appearance-none w-full pl-3 pr-8 py-2 text-xs bg-white border border-slate-200 rounded-lg focus:ring-2 focus:ring-[#00A3E0]/20 focus:border-[#00A3E0] outline-none font-bold text-slate-800 cursor-pointer transition-all">
                                        <option value="Menunggu Verifikasi" {{ $item->status == 'Menunggu Verifikasi' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                                        <option value="Lolos Administrasi" {{ $item->status == 'Lolos Administrasi' ? 'selected' : '' }}>Lolos Administrasi</option>
                                        <option value="Perlu Perbaikan" {{ $item->status == 'Perlu Perbaikan' ? 'selected' : '' }}>Perlu Perbaikan</option>
                                        <option value="Ditolak" {{ $item->status == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2.5 text-slate-400">
                                        <span class="material-symbols-outlined text-base">expand_more</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Catatan Evaluasi -->
                            <div class="space-y-1 md:col-span-2">
                                <label for="catatan_admin" class="block text-[11px] font-bold text-gray-700">Catatan Dewan Juri / Admin <span class="text-gray-400 font-normal">(Dilihat oleh Peserta)</span></label>
                                <input type="text" name="catatan_admin" id="catatan_admin" 
                                       value="{{ old('catatan_admin', $item->catatan_admin) }}"
                                       placeholder="Contoh: Proposal telah memenuhi persyaratan administrasi. Lolos ke tahap presentasi dewan juri." 
                                       class="w-full px-3 py-2 text-xs bg-white border border-slate-200 rounded-lg focus:ring-2 focus:ring-[#00A3E0]/20 focus:border-[#00A3E0] outline-none transition-all">
                            </div>
                        </div>

                        <div class="flex justify-end pt-1">
                            <button type="submit" class="px-4 py-2 bg-[#00A3E0] hover:bg-[#008cc0] active:scale-[0.99] text-white font-bold text-xs rounded-lg shadow-2xs transition-all flex items-center gap-1.5 cursor-pointer">
                                <span class="material-symbols-outlined text-base">save</span>
                                <span>Simpan Perubahan Status</span>
                            </button>
                        </div>
                    </form>
                </div>

            </div>

        </div>

    </div>

    <!-- MODAL PRATINJAU FOTO ALAT ADMIN -->
    <div id="admin-photo-modal" class="fixed inset-0 z-[9999] hidden items-center justify-center bg-slate-900/80 backdrop-blur-sm p-4">
        <div class="bg-white rounded-3xl shadow-2xl max-w-3xl w-full overflow-hidden border border-slate-100 flex flex-col max-h-[90vh]">
            <!-- Header Modal -->
            <div class="p-4 sm:p-5 border-b border-gray-100 flex items-center justify-between bg-slate-50">
                <div class="space-y-0.5">
                    <div class="flex items-center gap-2">
                        <span class="text-[10px] font-mono font-bold bg-sky-100 text-[#00A3E0] px-2 py-0.5 rounded-md">{{ $item->nomor_registrasi }}</span>
                        <span class="text-xs font-bold text-gray-500">Inovator: {{ $item->nama_inovator }}</span>
                    </div>
                    <h3 class="text-sm sm:text-base font-extrabold text-gray-900 line-clamp-1">{{ $item->nama_alat }}</h3>
                </div>
                <button type="button" onclick="closePhotoModal()" class="p-2 text-gray-400 hover:text-gray-700 hover:bg-gray-200/60 rounded-xl transition-colors cursor-pointer">
                    <span class="material-symbols-outlined text-xl">close</span>
                </button>
            </div>

            <!-- Image View Area -->
            <div class="p-4 bg-slate-950 flex items-center justify-center overflow-auto max-h-[65vh]">
                <img id="modal-photo-img" src="" alt="{{ $item->nama_alat }}" class="max-h-[60vh] max-w-full object-contain rounded-lg shadow-md">
            </div>

            <!-- Modal Footer -->
            <div class="p-4 border-t border-gray-100 flex items-center justify-between bg-white">
                <span class="text-xs text-gray-500 flex items-center gap-1.5 font-medium">
                    <span class="material-symbols-outlined text-sm text-emerald-600">verified</span>
                    Dokumentasi Resmi Prototipe Alat TTG
                </span>
                <div class="flex items-center gap-2">
                    <a id="modal-photo-tab-link" href="" target="_blank" class="px-3.5 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs rounded-xl transition-colors flex items-center gap-1">
                        <span class="material-symbols-outlined text-sm">open_in_new</span>
                        <span>Tab Baru</span>
                    </a>
                    <button type="button" onclick="closePhotoModal()" class="px-4 py-2 bg-[#29abe2] hover:bg-[#1f96c8] text-white font-bold text-xs rounded-xl shadow-sm transition-colors cursor-pointer">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openPhotoModal(imgUrl) {
            document.getElementById('modal-photo-img').src = imgUrl;
            document.getElementById('modal-photo-tab-link').href = imgUrl;

            const modal = document.getElementById('admin-photo-modal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closePhotoModal() {
            const modal = document.getElementById('admin-photo-modal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        document.getElementById('admin-photo-modal').addEventListener('click', function(e) {
            if (e.target === this) {
                closePhotoModal();
            }
        });
    </script>
</body>
</html>
