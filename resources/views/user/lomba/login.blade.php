<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Login Peserta - Lomba TTG SI RINOVA</title>
    
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

    <div class="w-full max-w-md">
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

        <!-- Clean Card -->
        <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/60 border border-slate-200/80 p-6 sm:p-8">
            <div class="mb-6 text-center">
                <h1 class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight">Login Peserta</h1>
                <p class="text-xs text-slate-500 mt-1">Lomba Teknologi Tepat Guna (TTG)</p>
            </div>

            <!-- Alerts -->
            @if(session('success'))
            <div class="mb-4 p-3 bg-emerald-50 rounded-xl border border-emerald-200 text-xs font-semibold text-emerald-800 flex items-center gap-2">
                <span class="material-symbols-outlined text-base text-emerald-600">check_circle</span>
                <span>{{ session('success') }}</span>
            </div>
            @endif

            @if(session('status') || session('success'))
            <div class="mb-4 p-3 bg-emerald-50 rounded-xl border border-emerald-200 text-xs font-semibold text-emerald-800 flex items-center gap-2">
                <span class="material-symbols-outlined text-base text-emerald-600">check_circle</span>
                <span>{{ session('status') ?? session('success') }}</span>
            </div>
            @endif

            @if(session('info'))
            <div class="mb-4 p-3 bg-sky-50 rounded-xl border border-sky-200 text-xs font-semibold text-sky-800 flex items-center gap-2">
                <span class="material-symbols-outlined text-base text-sky-600">info</span>
                <span>{{ session('info') }}</span>
            </div>
            @endif

            @if(isset($errors) && $errors->any())
            <div class="mb-4 p-3 bg-rose-50 rounded-xl border border-rose-200 text-xs font-semibold text-rose-800 flex items-center gap-2">
                <span class="material-symbols-outlined text-base text-rose-600">error</span>
                <span>{{ $errors->first() }}</span>
            </div>
            @endif

            <!-- Form -->
            <form action="{{ route('peserta.login.post') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="email" class="block text-xs font-semibold text-slate-700 mb-1.5">Email</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none material-symbols-outlined text-slate-400 text-lg">mail</span>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                               placeholder="Masukkan Email Anda"
                               class="w-full pl-9 pr-3.5 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#00A3E0]/20 focus:border-[#00A3E0] transition-all outline-none">
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-xs font-semibold text-slate-700 mb-1.5">Kata Sandi</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none material-symbols-outlined text-slate-400 text-lg">lock</span>
                        <input type="password" id="password" name="password" required
                               placeholder="Masukkan Kata Sandi"
                               class="w-full pl-9 pr-10 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#00A3E0]/20 focus:border-[#00A3E0] transition-all outline-none">
                        <button type="button" onclick="togglePasswordVisibility('password', 'eye-icon')" 
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600">
                            <span id="eye-icon" class="material-symbols-outlined text-lg">visibility</span>
                        </button>
                    </div>
                </div>

                <div class="flex items-center justify-between text-xs pt-1">
                    <label class="flex items-center gap-2 cursor-pointer text-slate-600">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded border-slate-300 text-[#00A3E0] focus:ring-[#00A3E0]">
                        <span>Ingat saya</span>
                    </label>
                    <a href="{{ route('peserta.password.request') }}" class="font-semibold text-[#00A3E0] hover:text-[#008cc0] hover:underline transition-colors">
                        Lupa Password?
                    </a>
                </div>

                <button type="submit" 
                        class="w-full py-2.5 px-4 bg-[#00A3E0] hover:bg-[#008cc0] active:scale-[0.99] text-white font-bold text-sm rounded-xl shadow-md shadow-sky-500/20 transition-all flex items-center justify-center gap-2 cursor-pointer mt-2">
                    <span>Masuk ke Akun</span>
                    <span class="material-symbols-outlined text-lg">arrow_forward</span>
                </button>
            </form>

            <div class="mt-6 pt-5 border-t border-slate-100 text-center text-xs text-slate-500">
                Belum punya akun? 
                <a href="{{ route('peserta.register') }}" class="font-bold text-[#00A3E0] hover:underline ml-1">
                    Daftar Akun Baru
                </a>
            </div>
        </div>

        <!-- Back to Info Lomba -->
        <div class="text-center mt-5">
            <a href="{{ route('lomba.info') }}" class="inline-flex items-center gap-1.5 text-xs text-slate-500 hover:text-[#00A3E0] font-medium transition-colors">
                <span class="material-symbols-outlined text-sm">arrow_back</span>
                <span>Kembali ke Informasi Lomba</span>
            </a>
        </div>
    </div>

    <script>
        function togglePasswordVisibility(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (input.type === 'password') {
                input.type = 'text';
                icon.textContent = 'visibility_off';
            } else {
                input.type = 'password';
                icon.textContent = 'visibility';
            }
        }
    </script>
</body>
</html>
