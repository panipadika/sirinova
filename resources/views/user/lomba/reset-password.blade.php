<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Reset Kata Sandi - Lomba TTG SI RINOVA</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('storage/images/favicon_tasik.png') }}?v=3">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=3">
    <link rel="apple-touch-icon" href="{{ asset('storage/images/favicon_tasik.png') }}?v=3">
    
    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>

    <style>
        html, body {
            margin: 0 !important;
            padding: 0 !important;
        }
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, h4, h5, h6 { font-family: 'Plus Jakarta Sans', sans-serif; }

        /* Hide scrollbar completely */
        html, body, * {
            -ms-overflow-style: none !important;
            scrollbar-width: none !important;
        }
        html::-webkit-scrollbar,
        body::-webkit-scrollbar,
        *::-webkit-scrollbar {
            display: none !important;
            width: 0 !important;
            height: 0 !important;
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 min-h-screen flex items-center justify-center p-4 sm:p-6 antialiased selection:bg-[#00A3E0] selection:text-white">

    <div class="w-full max-w-md my-4">
        <!-- Logo & Header -->
        <div class="text-center mb-6">
            <a href="/" class="inline-flex items-center gap-2.5 group">
                <img src="{{ asset('storage/images/logo_tasik.png') }}" alt="Logo Kota Tasikmalaya" class="h-12 w-auto object-contain group-hover:scale-105 transition-transform">
                <div class="text-left">
                    <span class="text-xl font-black text-[#00A3E0] tracking-tight block leading-tight">SI RINOVA</span>
                    <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider block">Kota Tasikmalaya</span>
                </div>
            </a>
        </div>

        <!-- Card Container -->
        <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/60 border border-slate-200/80 p-6 sm:p-8">
            <div class="mb-6 text-center">
                <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Buat Kata Sandi Baru</h1>
                <p class="text-xs sm:text-sm text-slate-500 mt-2 leading-relaxed">
                    Masukkan kata sandi baru untuk mengamankan akun peserta Anda.
                </p>
            </div>

            <!-- Flash Info Verifikasi Berhasil -->
            @if(session('info'))
            <div class="mb-5 p-3.5 bg-emerald-50 rounded-xl border border-emerald-200 text-xs text-emerald-800 flex items-start gap-2.5 leading-relaxed">
                <span class="material-symbols-outlined text-lg text-emerald-600 shrink-0 mt-0.5">verified</span>
                <span class="font-medium">{{ session('info') }}</span>
            </div>
            @endif

            <!-- Error Alerts -->
            @if(isset($errors) && $errors->any())
            <div class="mb-5 p-3.5 bg-rose-50 rounded-xl border border-rose-200 text-xs text-rose-800 space-y-1">
                <div class="flex items-center gap-1.5 font-bold">
                    <span class="material-symbols-outlined text-base text-rose-600">error</span>
                    <span>Terdapat kendala:</span>
                </div>
                <ul class="list-disc list-inside pl-1 space-y-0.5">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Form -->
            <form action="{{ route('peserta.password.update') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div>
                    <label for="email" class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1.5">EMAIL</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none material-symbols-outlined text-slate-400 text-lg">mail</span>
                        <input type="email" id="email" name="email" value="{{ old('email', $email) }}" required readonly
                               class="w-full pl-10 pr-3.5 py-2.5 text-sm bg-slate-100 text-slate-600 border border-slate-200 rounded-xl cursor-not-allowed outline-none">
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-xs font-semibold text-slate-700 mb-1.5">Kata Sandi Baru <span class="text-rose-500">*</span></label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none material-symbols-outlined text-slate-400 text-lg">lock</span>
                        <input type="password" id="password" name="password" required minlength="6" autofocus
                               placeholder="Minimal 6 karakter"
                               class="w-full pl-9 pr-10 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#00A3E0]/20 focus:border-[#00A3E0] transition-all outline-none">
                        <button type="button" onclick="togglePasswordVisibility('password', 'eye-icon-password')" 
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600 transition-colors">
                            <span id="eye-icon-password" class="material-symbols-outlined text-lg">visibility</span>
                        </button>
                    </div>
                </div>

                <div>
                    <label for="password_confirmation" class="block text-xs font-semibold text-slate-700 mb-1.5">Konfirmasi Kata Sandi Baru <span class="text-rose-500">*</span></label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none material-symbols-outlined text-slate-400 text-lg">lock_reset</span>
                        <input type="password" id="password_confirmation" name="password_confirmation" required minlength="6"
                               placeholder="Ulangi kata sandi baru"
                               class="w-full pl-9 pr-10 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#00A3E0]/20 focus:border-[#00A3E0] transition-all outline-none">
                        <button type="button" onclick="togglePasswordVisibility('password_confirmation', 'eye-icon-confirm')" 
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600 transition-colors">
                            <span id="eye-icon-confirm" class="material-symbols-outlined text-lg">visibility</span>
                        </button>
                    </div>
                </div>

                <button type="submit" 
                        class="w-full py-3 px-4 bg-[#00A3E0] hover:bg-[#008cc0] active:scale-[0.99] text-white font-bold text-sm rounded-xl shadow-md shadow-sky-500/20 transition-all flex items-center justify-center gap-2 cursor-pointer mt-4">
                    <span class="material-symbols-outlined text-lg">check_circle</span>
                    <span>Simpan Kata Sandi Baru</span>
                </button>
            </form>

            <!-- Back to Login -->
            <div class="mt-6 pt-5 border-t border-slate-100 text-center">
                <a href="{{ route('peserta.login') }}" class="inline-flex items-center gap-1.5 text-xs sm:text-sm font-semibold text-[#00A3E0] hover:text-[#008cc0] hover:underline transition-colors">
                    <span class="material-symbols-outlined text-base">arrow_back</span>
                    <span>Kembali ke halaman login</span>
                </a>
            </div>
        </div>

        <!-- Footer Copyright -->
        <div class="text-center mt-6 text-xs text-slate-400">
            &copy; 2026 Bappelitbangda Kota Tasikmalaya
        </div>
    </div>

    <script>
        function togglePasswordVisibility(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (input && icon) {
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.textContent = 'visibility_off';
                } else {
                    input.type = 'password';
                    icon.textContent = 'visibility';
                }
            }
        }
    </script>
</body>
</html>
