<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Detail Pesan - Admin Panel</title>
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

            <!-- Alert Sukses -->
            @if (session('success'))
                <div class="mb-4 p-3 bg-green-50 text-green-700 border border-green-200 rounded-lg flex items-center gap-3 text-sm">
                    <span class="material-symbols-outlined text-lg">check_circle</span>
                    {{ session('success') }}
                </div>
            @endif

            <!-- Tombol Kembali -->
            <div class="mb-6">
                <a href="{{ route('admin.pesan.index') }}"
                    class="inline-flex items-center gap-1.5 text-sm text-gray-600 hover:text-[#29abe2] font-medium transition-colors">
                    <span class="material-symbols-outlined text-[18px]">arrow_back</span> Kembali ke Pesan Masuk
                </a>
            </div>

            <!-- Card Detail Pesan -->
            <div class="bg-white rounded-xl shadow-[0_2px_10px_rgba(0,0,0,0.04)] border border-gray-100 overflow-hidden max-w-3xl">

                <!-- Header Pesan -->
                <div class="p-6 border-b border-gray-100 space-y-3">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 tracking-tight">{{ $pesan->subjek }}</h2>
                            <p class="text-sm text-gray-500 mt-1">Diterima pada {{ $pesan->dibuat_pada ? $pesan->dibuat_pada->format('d M Y, H:i') . ' WIB' : '-' }}</p>
                        </div>
                        <div>
                            @if($pesan->is_dibaca)
                                <span class="inline-flex items-center gap-1 text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-full text-xs font-medium">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Dibaca
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 text-[#29abe2] bg-sky-50 px-2.5 py-1 rounded-full text-xs font-medium">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#29abe2]"></span> Baru
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Info Pengirim -->
                <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <!-- Nama -->
                        <div class="flex items-start gap-3">
                            <div class="w-9 h-9 bg-sky-50 rounded-xl flex items-center justify-center text-[#29abe2] shrink-0">
                                <span class="material-symbols-outlined text-lg">person</span>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 font-medium">Nama Pengirim</p>
                                <p class="text-sm font-semibold text-gray-900 mt-0.5">{{ $pesan->nama }}</p>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="flex items-start gap-3">
                            <div class="w-9 h-9 bg-sky-50 rounded-xl flex items-center justify-center text-[#29abe2] shrink-0">
                                <span class="material-symbols-outlined text-lg">mail</span>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 font-medium">Email</p>
                                <p class="text-sm font-semibold text-gray-900 mt-0.5">{{ $pesan->email }}</p>
                            </div>
                        </div>

                        <!-- No. WhatsApp / HP -->
                        <div class="flex items-start gap-3">
                            <div class="w-9 h-9 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600 shrink-0">
                                <span class="material-symbols-outlined text-lg">call</span>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 font-medium">No. WhatsApp / HP</p>
                                @if($pesan->no_wa)
                                    @php
                                        $cleanWa = preg_replace('/[^0-9]/', '', $pesan->no_wa);
                                        if (str_starts_with($cleanWa, '0')) {
                                            $cleanWa = '62' . substr($cleanWa, 1);
                                        }
                                    @endphp
                                    <a href="https://wa.me/{{ $cleanWa }}" target="_blank" class="text-sm font-semibold text-emerald-600 hover:underline mt-0.5 block">
                                        {{ $pesan->no_wa }}
                                    </a>
                                @else
                                    <p class="text-sm text-gray-400 mt-0.5 italic">Tidak dicantumkan</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Isi Pesan -->
                <div class="p-6 space-y-2">
                    <h3 class="text-sm font-bold text-gray-700 flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-base text-gray-400">chat</span> Isi Pesan
                    </h3>
                    <div class="bg-gray-50 rounded-xl p-5 border border-gray-100 text-sm text-gray-700 leading-relaxed whitespace-pre-wrap">{{ $pesan->pesan }}</div>
                </div>

                <!-- Action Buttons -->
                <div class="p-6 border-t border-gray-100 flex flex-wrap items-center gap-3">
                    @if($pesan->no_wa)
                        @php
                            $waNum = preg_replace('/[^0-9]/', '', $pesan->no_wa);
                            if (str_starts_with($waNum, '0')) {
                                $waNum = '62' . substr($waNum, 1);
                            }
                        @endphp
                        <!-- Balas via WhatsApp -->
                        <a href="https://wa.me/{{ $waNum }}?text={{ urlencode('Halo ' . $pesan->nama . ', kami dari Bapperida Kota Tasikmalaya menindaklanjuti pesan Anda terkait: ' . $pesan->subjek) }}"
                            target="_blank"
                            class="bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2.5 rounded-md transition-colors flex items-center gap-2 font-medium text-sm shadow-sm">
                            <span class="material-symbols-outlined text-[18px]">chat</span> Balas via WhatsApp
                        </a>
                    @else
                        <!-- No WA tidak ada -->
                        <span class="bg-gray-100 text-gray-400 border border-gray-200 px-4 py-2.5 rounded-md flex items-center gap-2 font-medium text-xs">
                            <span class="material-symbols-outlined text-base">info</span> No. WhatsApp tidak tersedia
                        </span>
                    @endif

                    <!-- Toggle Dibaca -->
                    <form method="POST" action="{{ route('admin.pesan.toggle-dibaca', $pesan->id) }}" class="inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit"
                            class="bg-white border border-gray-200 text-gray-700 px-4 py-2.5 rounded-md hover:bg-gray-50 transition-colors flex items-center gap-2 font-medium text-sm">
                            <span class="material-symbols-outlined text-[18px]">{{ $pesan->is_dibaca ? 'mark_email_read' : 'mark_email_unread' }}</span>
                            {{ $pesan->is_dibaca ? 'Tandai Belum Dibaca' : 'Tandai Sudah Dibaca' }}
                        </button>
                    </form>

                    <!-- Hapus -->
                    <form method="POST" action="{{ route('admin.pesan.destroy', $pesan->id) }}" class="inline"
                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="bg-white border border-red-200 text-red-600 px-4 py-2.5 rounded-md hover:bg-red-50 transition-colors flex items-center gap-2 font-medium text-sm">
                            <span class="material-symbols-outlined text-[18px]">delete</span> Hapus
                        </button>
                    </form>
                </div>

            </div>
        </main>
    </div>

    <!-- Scripts -->
    <script>
        const menuBtn = document.getElementById('menu-btn');
        const sidebar = document.getElementById('sidebar');
        menuBtn?.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });
    </script>
</body>
</html>
