<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Login Admin - SI RINOVA Kota Tasikmalaya</title>
    
    <!-- Favicon Logo Tasikmalaya -->
    <link rel="icon" type="image/png" href="{{ asset('storage/images/favicon_tasik.png') }}?v=3">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=3">
    <link rel="apple-touch-icon" href="{{ asset('storage/images/favicon_tasik.png') }}?v=3">
    
    <!-- Google Fonts: Inter & Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
    
    <!-- Material Symbols Outlined -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" rel="stylesheet">
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .circuit-pattern {
            background-image: radial-gradient(circle at 2px 2px, rgba(255, 255, 255, 0.12) 1px, transparent 0);
            background-size: 28px 28px;
        }
        @keyframes floatSlow {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-10px) rotate(2deg); }
        }
        .animate-float {
            animation: floatSlow 5s ease-in-out infinite;
        }
        /* Hide scrollbar completely */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 h-full flex flex-col md:flex-row antialiased overflow-x-hidden selection:bg-[#29abe2] selection:text-white">

    <!-- LEFT SIDE: Modern Branding & Dynamic Module Highlights -->
    <div class="relative hidden md:flex flex-col justify-between w-1/2 bg-[#29abe2] text-white p-8 lg:p-12 overflow-hidden shadow-2xl z-10">
    
        <!-- Background Circuit Pattern & Glowing Accents -->
        <div class="absolute inset-0 opacity-20 pointer-events-none circuit-pattern"></div>
        <div class="absolute -top-24 -left-24 w-80 h-80 bg-white/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-cyan-400/20 rounded-full blur-3xl pointer-events-none"></div>

        <!-- Decorative Floating Lines -->
        <svg class="absolute top-0 left-0 w-full h-full pointer-events-none opacity-25" xmlns="http://www.w3.org/2000/svg">
            <path class="animate-float" d="M-100 200 L300 -100 M-50 400 L500 -50" fill="none" stroke="white" stroke-width="1.5"></path>
            <circle class="animate-float" cx="220" cy="140" fill="none" r="45" stroke="white" stroke-width="1.2"></circle>
            <path class="animate-float" d="M400 600 L800 200 M350 800 L900 350" fill="none" stroke="white" stroke-width="1.5"></path>
        </svg>

        <!-- Middle Hero Banner -->
        <div class="relative z-20 my-auto py-8 space-y-6 max-w-lg">
            <div class="space-y-3">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 bg-white/15 backdrop-blur-md border border-white/20 rounded-full text-xs font-bold text-cyan-100">
                    <span>Sistem Informasi Riset & Inovasi</span>
                </div>
                <h1 class="text-4xl lg:text-5xl font-black tracking-tight text-white leading-tight">
                    SI RINOVA
                </h1>
                <h2 class="text-xl lg:text-2xl font-extrabold text-cyan-100 tracking-tight">
                    Panel Administrasi
                </h2>
                <p class="text-sm lg:text-base text-cyan-50 leading-relaxed font-normal opacity-90 pt-1">
                    Pusat pengelolaan terintegrasi riset, indikator pembangunan makro, katalog teknologi tepat guna, repositori e-book kajian, telaahan staf, dan publikasi inovasi daerah.
                </p>
            </div>
        </div>

        <!-- Footer Notice -->
        <div class="relative z-20 text-xs text-cyan-100/70 font-medium">
            &copy; 2026 Bappelitbangda Kota Tasikmalaya. 
        </div>
    </div>

    <!-- RIGHT SIDE: Clean & Functional Admin Login Form -->
    <div class="w-full md:w-1/2 bg-white h-full flex flex-col justify-center px-6 py-6 md:px-10 lg:px-14 overflow-y-auto no-scrollbar relative shadow-2xl z-20">

        <div class="w-full max-w-md mx-auto space-y-4 sm:space-y-5">
            
            <!-- Mobile Brand Header (Shows only on small screens) -->
            <div class="flex items-center gap-3 md:hidden border-b border-slate-100 pb-4">
                <img alt="Logo Kota Tasikmalaya" class="w-10 h-10 object-contain" src="{{ asset('storage/images/logo_tasik.png') }}">
                <div>
                    <h3 class="text-lg font-black text-[#29abe2]">SI RINOVA</h3>
                    <p class="text-xs text-slate-500 font-bold">Panel Administrasi Admin</p>
                </div>
            </div>

            <!-- Login Form Header -->
            <div class="text-center space-y-2">
                <img alt="Logo Kota Tasikmalaya" class="w-20 h-20 sm:w-24 sm:h-24 mx-auto object-contain drop-shadow-md mb-1" src="{{ asset('storage/images/logo_tasik.png') }}">
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Login Admin</h2>
            </div>

            <!-- Flash Messages -->
            @if(session('success') || session('status'))
            <div class="p-3.5 bg-emerald-50 rounded-2xl border border-emerald-200 flex items-center gap-3">
                <span class="material-symbols-outlined text-emerald-600 shrink-0">check_circle</span>
                <p class="text-xs font-bold text-emerald-800 leading-relaxed">{{ session('success') ?? session('status') }}</p>
            </div>
            @endif

            <!-- Dynamic Error State -->
            @if($errors->any())
            <div class="p-3.5 bg-rose-50 rounded-2xl border border-rose-200 flex items-center gap-3 animate-shake">
                <span class="material-symbols-outlined text-rose-600 shrink-0">error</span>
                <p class="text-xs font-bold text-rose-800 leading-relaxed">{{ $errors->first() }}</p>
            </div>
            @endif

            @php
                $isRememberChecked = request()->cookie('remember_checked') === '1';
                $savedEmail = $isRememberChecked ? request()->cookie('remember_email') : '';
            @endphp

            <!-- Login Form -->
            <form action="/login" class="space-y-4" method="POST" autocomplete="{{ $isRememberChecked ? 'on' : 'off' }}">
                @csrf

                <!-- Email Input -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700" for="email">Email</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none material-symbols-outlined text-slate-400 text-xl">mail</span>
                        <input class="block w-full pl-11 pr-4 py-3 text-sm text-slate-900 bg-slate-50/70 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#29abe2] focus:border-[#29abe2] transition-all outline-none" 
                               id="email" 
                               name="email" 
                               value="{{ old('email', $savedEmail) }}" 
                               placeholder="Masukkan Email Anda" 
                               autocomplete="{{ $isRememberChecked ? 'username' : 'off' }}"
                               required 
                               type="email">
                    </div>
                </div>

                <!-- Password Input -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700" for="password">Password</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none material-symbols-outlined text-slate-400 text-xl">lock</span>
                        <input class="block w-full pl-11 pr-11 py-3 text-sm text-slate-900 bg-slate-50/70 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#29abe2] focus:border-[#29abe2] transition-all outline-none" 
                               id="password" 
                               name="password" 
                               value=""
                               placeholder="Masukkan password" 
                               autocomplete="current-password"
                               required 
                               type="password">
                        <button class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-[#29abe2] transition-colors cursor-pointer" onclick="togglePassword()" type="button" title="Tampilkan Password">
                            <span class="material-symbols-outlined text-xl" id="visibilityIcon">visibility_off</span>
                        </button>
                    </div>
                </div>

                <!-- Remember Me Checkbox & Forgot Password Link -->
                <div class="flex items-center justify-between pt-1">
                    <label class="flex items-center gap-2.5 cursor-pointer group select-none">
                        <input class="h-4 w-4 rounded border-slate-300 text-[#29abe2] focus:ring-[#29abe2] transition-colors cursor-pointer" 
                               id="remember" 
                               name="remember" 
                               type="checkbox"
                               value="1"
                               {{ old('remember', $isRememberChecked) ? 'checked' : '' }}>
                        <span class="text-xs font-semibold text-slate-600 group-hover:text-slate-900 transition-colors">Ingat saya</span>
                    </label>
                    <a href="{{ route('admin.password.request') }}" class="text-xs font-semibold text-[#29abe2] hover:text-[#1a95c9] hover:underline transition-colors">
                        Lupa Password?
                    </a>
                </div>

                <!-- Submit Button -->
                <button class="w-full py-3.5 px-5 bg-[#29abe2] hover:bg-[#1f96c8] active:scale-[0.99] text-white font-bold text-sm rounded-xl shadow-md shadow-sky-500/20 transition-all duration-200 flex items-center justify-center gap-2 group cursor-pointer" type="submit">
                    <span>Masuk ke Panel Admin</span>
                    <span class="material-symbols-outlined text-lg group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Toggle Password Script -->
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const visibilityIcon = document.getElementById('visibilityIcon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                visibilityIcon.textContent = 'visibility';
            } else {
                passwordInput.type = 'password';
                visibilityIcon.textContent = 'visibility_off';
            }
        }
    </script>
</body>
</html>
