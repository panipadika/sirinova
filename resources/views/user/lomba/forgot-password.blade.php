<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Lupa Password - Lomba TTG SI RINOVA</title>
    
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
            <div class="mb-5 text-center">
                <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Lupa Password?</h1>
                <p class="text-xs sm:text-sm text-slate-500 mt-2 leading-relaxed">
                    Verifikasi data akun Anda dengan memasukkan Email dan Nomor WhatsApp terdaftar.
                </p>
            </div>

            <!-- Banner Info Verifikasi -->
            <div class="mb-5 p-3 bg-sky-50/70 border border-sky-100 rounded-xl text-xs text-sky-900 flex items-center justify-center gap-2 text-center shadow-xs">
                <span class="text-base select-none">💡</span>
                <span>Masukkan <strong class="font-bold text-sky-950">Email</strong> dan <strong class="font-bold text-sky-950">Nomor WhatsApp</strong> yang digunakan saat pendaftaran. Tautan pemulihan kata sandi akan dikirimkan ke email terdaftar.</span>
            </div>

            <!-- Generic Status Message -->
            @if(session('status'))
            <div class="mb-5 p-3.5 bg-emerald-50 rounded-xl border border-emerald-200 text-xs font-semibold text-emerald-800 flex items-center gap-2">
                <span class="material-symbols-outlined text-base text-emerald-600 shrink-0">mark_email_read</span>
                <span>{{ session('status') }}</span>
            </div>
            @endif

            <!-- Error Alerts -->
            @if(isset($errors) && $errors->any())
            <div class="mb-5 p-3 bg-rose-50 rounded-xl border border-rose-200 text-xs font-semibold text-rose-800 flex items-center gap-2">
                <span class="material-symbols-outlined text-base text-rose-600 shrink-0">error</span>
                <span>{{ $errors->first() }}</span>
            </div>
            @endif

            <!-- Form -->
            <form action="{{ route('peserta.password.email') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="email" class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1.5">EMAIL AKUN</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none material-symbols-outlined text-slate-400 text-lg">mail</span>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                               placeholder="Masukkan email terdaftar Anda"
                               class="w-full pl-10 pr-3.5 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#00A3E0]/20 focus:border-[#00A3E0] transition-all outline-none">
                    </div>
                </div>

                <div>
                    <label for="no_wa" class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1.5">NOMOR WHATSAPP</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none material-symbols-outlined text-slate-400 text-lg">call</span>
                        <input type="text" id="no_wa" name="no_wa" value="{{ old('no_wa') }}" required
                               placeholder="Contoh: 0812xxxxxxxx"
                               class="w-full pl-10 pr-3.5 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#00A3E0]/20 focus:border-[#00A3E0] transition-all outline-none">
                    </div>
                </div>

                <button type="submit" 
                        class="w-full py-3 px-4 bg-[#00A3E0] hover:bg-[#008cc0] active:scale-[0.99] text-white font-bold text-sm rounded-xl shadow-md shadow-sky-500/20 transition-all flex items-center justify-center gap-2 cursor-pointer mt-4">
                    <span class="material-symbols-outlined text-lg">send</span>
                    <span>Kirim Tautan Atur Ulang Kata Sandi</span>
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

</body>
</html>
