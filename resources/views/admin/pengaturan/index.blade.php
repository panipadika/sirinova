<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Pengaturan Admin - Admin Panel</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('storage/images/favicon_tasik.png') }}?v=3">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=3">

    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Public+Sans:wght@600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>

    <style>
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, h4, h5, h6 { font-family: 'Public Sans', sans-serif; }

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

            <!-- CARD 3: URL Khusus Login Admin -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-[0_2px_10px_rgba(0,0,0,0.03)] p-6 space-y-6">
                
                <div class="flex items-center gap-3 pb-4 border-b border-gray-100">
                    <div class="w-10 h-10 rounded-xl bg-sky-50 text-[#29abe2] flex items-center justify-center shrink-0 shadow-xs">
                        <span class="material-symbols-outlined text-2xl">link</span>
                    </div>
                    <div>
                        <h3 class="text-base font-bold text-gray-900 tracking-tight">URL Khusus Login Admin</h3>
                        <p class="text-xs text-gray-500">Ubah alamat URL rahasia untuk masuk ke portal admin (default: /admin-dashboard)</p>
                    </div>
                </div>

                <!-- URL Login Aktif Banner -->
                <div class="p-4 sm:p-5 bg-sky-50/50 border border-sky-100 rounded-2xl flex flex-col sm:flex-row sm:items-center justify-between gap-4 shadow-2xs">
                    <div class="space-y-1">
                        <div class="flex items-center gap-1.5 text-[11px] font-bold text-[#1a95c9] tracking-wider uppercase">
                            <span class="material-symbols-outlined text-sm">shield</span>
                            <span>URL LOGIN ADMIN AKTIF SAAT INI</span>
                        </div>
                        <div class="text-sm sm:text-base font-bold font-mono text-sky-950 break-all select-all tracking-tight" id="active-url-text">
                            {{ url($adminLoginSlug) }}
                        </div>
                    </div>
                    <button type="button" 
                            onclick="copyAdminUrl()" 
                            id="btn-copy-url"
                            class="inline-flex items-center justify-center gap-1.5 px-4 py-2 bg-white hover:bg-sky-50 border border-sky-200 text-sky-700 text-xs font-bold rounded-xl shadow-2xs transition-all shrink-0 cursor-pointer active:scale-95">
                        <span class="material-symbols-outlined text-base" id="copy-icon">content_copy</span>
                        <span id="copy-text">Salin URL</span>
                    </button>
                </div>

                <!-- Form Ubah Path / Slug -->
                <form action="{{ route('admin.pengaturan.url-login') }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div class="space-y-1.5">
                        <label for="admin_login_slug" class="block text-xs font-bold text-gray-700">Path / Slug URL Login Baru</label>
                        <div class="flex rounded-xl overflow-hidden shadow-2xs border border-gray-200 focus-within:ring-2 focus-within:ring-[#29abe2] focus-within:border-[#29abe2] transition-all">
                            <span class="inline-flex items-center px-4 py-2.5 bg-gray-50 text-gray-500 text-xs sm:text-sm font-semibold border-r border-gray-200 select-none">
                                {{ url('/') }}/
                            </span>
                            <input type="text" 
                                   id="admin_login_slug" 
                                   name="admin_login_slug" 
                                   value="{{ old('admin_login_slug', $adminLoginSlug) }}" 
                                   required
                                   placeholder="admin-dashboard"
                                   class="block w-full px-3.5 py-2.5 text-xs sm:text-sm font-bold text-gray-900 bg-white border-0 focus:ring-0 outline-none">
                        </div>
                        <p class="text-[11px] text-gray-400">Hanya gunakan huruf (a-z), angka (0-9), strip (-), atau garis bawah (_). Minimal 3 karakter.</p>
                    </div>

                    <!-- Warning Alert -->
                    <div class="p-4 bg-amber-50/80 border border-amber-200/90 rounded-2xl flex items-start gap-3 shadow-2xs">
                        <span class="material-symbols-outlined text-amber-600 text-xl shrink-0 mt-0.5">warning</span>
                        <div class="text-xs text-amber-900 leading-relaxed font-normal">
                            <strong class="font-bold text-amber-950">Penting:</strong> Setelah URL diubah, URL login lama serta URL umum seperti <code>/admin</code> atau <code>/login</code> akan otomatis menghasilkan <strong>404 (Tidak Ditemukan)</strong>. Pastikan Anda menyalin atau mem-bookmark URL baru ini agar tidak lupa saat ingin login kembali.
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end pt-2">
                        <button type="submit" 
                                class="w-full sm:w-auto px-6 py-2.5 bg-[#29abe2] hover:bg-[#1a95c9] active:scale-[0.99] text-white font-bold text-xs rounded-xl shadow-md shadow-sky-500/20 transition-all flex items-center justify-center gap-2 cursor-pointer">
                            <span class="material-symbols-outlined text-base">verified_user</span>
                            <span>Simpan URL Login Baru</span>
                        </button>
                    </div>
                </form>
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

        // Copy Admin Active Login URL
        function copyAdminUrl() {
            const text = document.getElementById('active-url-text')?.innerText.trim();
            if (!text) return;

            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(text).then(showCopiedState).catch(() => fallbackCopy(text));
            } else {
                fallbackCopy(text);
            }
        }

        function showCopiedState() {
            const btnText = document.getElementById('copy-text');
            const btnIcon = document.getElementById('copy-icon');
            if (btnText) btnText.textContent = 'Tersalin!';
            if (btnIcon) btnIcon.textContent = 'check';
            setTimeout(() => {
                if (btnText) btnText.textContent = 'Salin URL';
                if (btnIcon) btnIcon.textContent = 'content_copy';
            }, 2000);
        }

        function fallbackCopy(text) {
            const textArea = document.createElement('textarea');
            textArea.value = text;
            textArea.style.position = 'fixed';
            textArea.style.left = '-999999px';
            textArea.style.top = '-999999px';
            document.body.appendChild(textArea);
            textArea.focus();
            textArea.select();
            try {
                document.execCommand('copy');
                showCopiedState();
            } catch (err) {
                console.error('Fallback copy failed', err);
            }
            document.body.removeChild(textArea);
        }
    </script>

</body>

</html>
