<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Pengaturan Admin - SI RINOVA Kota Tasikmalaya</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('storage/images/favicon_tasik.png') }}?v=3">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=3">

    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>

    <style>
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, h4, h5, h6 { font-family: 'Plus Jakarta Sans', sans-serif; }

        /* Hide scrollbars */
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

<body class="bg-slate-50 text-slate-800 min-h-screen antialiased flex overflow-hidden selection:bg-[#29abe2] selection:text-white">

    <!-- SIDEBAR -->
    @include('partials.sidebar')

    <!-- MAIN CONTENT -->
    <div class="flex-1 flex flex-col h-screen md:ml-[260px] w-full md:w-[calc(100%-260px)] overflow-y-auto">

        <!-- Mobile Header Toggle -->
        <header class="md:hidden bg-white border-b flex justify-between items-center h-16 px-4 sticky top-0 z-40">
            <button class="p-2 text-gray-500 rounded hover:bg-gray-100 cursor-pointer" id="menu-btn" title="Toggle Menu">
                <span class="material-symbols-outlined">menu</span>
            </button>
            <span class="text-lg font-bold text-gray-900">Pengaturan Admin</span>
        </header>

        <main class="flex-1 p-5 md:p-8 space-y-6">

            <!-- Header Card -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white p-5 rounded-2xl border border-gray-100 shadow-[0_2px_10px_rgba(0,0,0,0.03)]">
                <div>
                    <div class="flex items-center gap-2 text-xs font-semibold text-[#29abe2] mb-1">
                        <span class="material-symbols-outlined text-base">manage_accounts</span>
                        <span>Panel Administrasi</span>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Pengaturan Akun Admin</h2>
                    <p class="text-xs text-gray-500 mt-1">Kelola data profil, alamat email, serta keamanan kata sandi administrator.</p>
                </div>
                <div class="inline-flex items-center gap-2 px-3.5 py-2 bg-sky-50 text-sky-800 border border-sky-100 rounded-xl text-xs font-semibold self-start sm:self-auto shrink-0 shadow-2xs">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span>Admin Aktif: <strong class="text-sky-950 font-bold">{{ $admin->nama }}</strong></span>
                </div>
            </div>

            <!-- Flash Success Message -->
            @if(session('success'))
            <div class="p-4 bg-emerald-50 rounded-2xl border border-emerald-200 flex items-center gap-3 shadow-xs">
                <span class="material-symbols-outlined text-emerald-600 text-xl shrink-0">check_circle</span>
                <p class="text-xs font-bold text-emerald-800 leading-relaxed">{{ session('success') }}</p>
            </div>
            @endif

            <!-- Flash Error Messages -->
            @if(isset($errors) && $errors->any())
            <div class="p-4 bg-rose-50 rounded-2xl border border-rose-200 flex items-start gap-3 shadow-xs">
                <span class="material-symbols-outlined text-rose-600 text-xl shrink-0 mt-0.5">error</span>
                <div class="text-xs text-rose-800 space-y-1">
                    <p class="font-bold">Gagal menyimpan perubahan:</p>
                    <ul class="list-disc list-inside space-y-0.5 pl-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif

            <!-- Two Cards Grid Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-start">

                <!-- CARD 1: Update Profile (Nama & Email) -->
                <div class="bg-white rounded-2xl border border-gray-100 shadow-[0_2px_10px_rgba(0,0,0,0.03)] p-6 space-y-5">
                    
                    <div class="flex items-center gap-3 pb-4 border-b border-gray-100">
                        <div class="w-10 h-10 rounded-xl bg-sky-50 text-[#29abe2] flex items-center justify-center shrink-0 shadow-xs">
                            <span class="material-symbols-outlined text-2xl">person</span>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-gray-900 tracking-tight">Informasi Profil & Email</h3>
                            <p class="text-xs text-gray-500">Perbarui nama lengkap dan email login akun administrator.</p>
                        </div>
                    </div>

                    <form action="{{ route('admin.pengaturan.profile') }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <!-- Nama Admin -->
                        <div class="space-y-1.5">
                            <label for="nama" class="block text-xs font-bold text-gray-700">Nama Administrator</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none material-symbols-outlined text-gray-400 text-lg">badge</span>
                                <input type="text" 
                                       id="nama" 
                                       name="nama" 
                                       value="{{ old('nama', $admin->nama) }}" 
                                       required
                                       placeholder="Masukkan nama administrator"
                                       class="block w-full pl-10 pr-3.5 py-2.5 text-xs text-gray-900 bg-gray-50/70 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#29abe2] focus:border-[#29abe2] transition-all outline-none">
                            </div>
                            <p class="text-[11px] text-gray-400">Nama yang tampil pada dashboard admin dan header sistem.</p>
                        </div>

                        <!-- Email Admin -->
                        <div class="space-y-1.5">
                            <label for="email" class="block text-xs font-bold text-gray-700">Alamat Email Administrator</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none material-symbols-outlined text-gray-400 text-lg">mail</span>
                                <input type="email" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email', $admin->email) }}" 
                                       required
                                       placeholder="Masukkan email administrator"
                                       class="block w-full pl-10 pr-3.5 py-2.5 text-xs text-gray-900 bg-gray-50/70 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#29abe2] focus:border-[#29abe2] transition-all outline-none">
                            </div>
                            <p class="text-[11px] text-gray-400">Email ini digunakan untuk masuk ke panel admin dan pemulihan kata sandi.</p>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-2">
                            <button type="submit" 
                                    class="w-full sm:w-auto px-5 py-2.5 bg-[#29abe2] hover:bg-[#1a95c9] active:scale-[0.99] text-white font-bold text-xs rounded-xl shadow-md shadow-sky-500/20 transition-all flex items-center justify-center gap-2 cursor-pointer">
                                <span class="material-symbols-outlined text-base">save</span>
                                <span>Simpan Perubahan Profil</span>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- CARD 2: Update Password -->
                <div class="bg-white rounded-2xl border border-gray-100 shadow-[0_2px_10px_rgba(0,0,0,0.03)] p-6 space-y-5">
                    
                    <div class="flex items-center gap-3 pb-4 border-b border-gray-100">
                        <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center shrink-0 shadow-xs">
                            <span class="material-symbols-outlined text-2xl">lock_reset</span>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-gray-900 tracking-tight">Keamanan Kata Sandi</h3>
                            <p class="text-xs text-gray-500">Perbarui kata sandi secara berkala untuk menjaga keamanan akun.</p>
                        </div>
                    </div>

                    <form action="{{ route('admin.pengaturan.password') }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <!-- Password Saat Ini -->
                        <div class="space-y-1.5">
                            <label for="current_password" class="block text-xs font-bold text-gray-700">Kata Sandi Saat Ini</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none material-symbols-outlined text-gray-400 text-lg">lock</span>
                                <input type="password" 
                                       id="current_password" 
                                       name="current_password" 
                                       required
                                       placeholder="Masukkan kata sandi saat ini"
                                       class="block w-full pl-10 pr-10 py-2.5 text-xs text-gray-900 bg-gray-50/70 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all outline-none">
                                <button type="button" 
                                        onclick="togglePasswordVisibility('current_password', 'eye_current')" 
                                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 cursor-pointer" 
                                        title="Tampilkan kata sandi">
                                    <span class="material-symbols-outlined text-lg" id="eye_current">visibility_off</span>
                                </button>
                            </div>
                        </div>

                        <!-- Password Baru -->
                        <div class="space-y-1.5">
                            <label for="password" class="block text-xs font-bold text-gray-700">Kata Sandi Baru</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none material-symbols-outlined text-gray-400 text-lg">key</span>
                                <input type="password" 
                                       id="password" 
                                       name="password" 
                                       required
                                       placeholder="Minimal 6 karakter"
                                       class="block w-full pl-10 pr-10 py-2.5 text-xs text-gray-900 bg-gray-50/70 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all outline-none">
                                <button type="button" 
                                        onclick="togglePasswordVisibility('password', 'eye_new')" 
                                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 cursor-pointer" 
                                        title="Tampilkan kata sandi">
                                    <span class="material-symbols-outlined text-lg" id="eye_new">visibility_off</span>
                                </button>
                            </div>
                            <p class="text-[11px] text-gray-400">Gunakan kombinasi minimal 6 karakter demi keamanan akun.</p>
                        </div>

                        <!-- Konfirmasi Password Baru -->
                        <div class="space-y-1.5">
                            <label for="password_confirmation" class="block text-xs font-bold text-gray-700">Konfirmasi Kata Sandi Baru</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none material-symbols-outlined text-gray-400 text-lg">check_circle</span>
                                <input type="password" 
                                       id="password_confirmation" 
                                       name="password_confirmation" 
                                       required
                                       placeholder="Ulangi kata sandi baru"
                                       class="block w-full pl-10 pr-10 py-2.5 text-xs text-gray-900 bg-gray-50/70 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all outline-none">
                                <button type="button" 
                                        onclick="togglePasswordVisibility('password_confirmation', 'eye_confirm')" 
                                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 cursor-pointer" 
                                        title="Tampilkan kata sandi">
                                    <span class="material-symbols-outlined text-lg" id="eye_confirm">visibility_off</span>
                                </button>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-2">
                            <button type="submit" 
                                    class="w-full sm:w-auto px-5 py-2.5 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 active:scale-[0.99] text-white font-bold text-xs rounded-xl shadow-md shadow-amber-500/20 transition-all flex items-center justify-center gap-2 cursor-pointer">
                                <span class="material-symbols-outlined text-base">verified_user</span>
                                <span>Perbarui Kata Sandi</span>
                            </button>
                        </div>
                    </form>
                </div>

            </div>

            <!-- Security Advisory Banner -->
            <div class="p-4 bg-sky-50/70 border border-sky-100 rounded-2xl flex items-start gap-3 shadow-2xs">
                <span class="text-xl select-none shrink-0 mt-0.5">🛡️</span>
                <div class="text-xs text-sky-950 space-y-0.5 leading-relaxed">
                    <p class="font-bold">Tips Keamanan Akun:</p>
                    <p class="text-sky-800">Jangan pernah membagikan email dan kata sandi administrator kepada pihak lain. Jika ada indikasi aktivitas mencurigakan, segera perbarui kata sandi Anda dan laporkan ke tim teknis Bappelitbangda Kota Tasikmalaya.</p>
                </div>
            </div>

        </main>
    </div>

    <!-- Scripts -->
    <script>
        // Sidebar Toggle Mobile
        const menuBtn = document.getElementById('menu-btn');
        const sidebar = document.getElementById('sidebar');
        menuBtn?.addEventListener('click', () => {
            sidebar?.classList.toggle('-translate-x-full');
        });

        // Toggle Password Visibility
        function togglePasswordVisibility(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (!input || !icon) return;

            if (input.type === 'password') {
                input.type = 'text';
                icon.textContent = 'visibility';
            } else {
                input.type = 'password';
                icon.textContent = 'visibility_off';
            }
        }
    </script>

</body>

</html>
