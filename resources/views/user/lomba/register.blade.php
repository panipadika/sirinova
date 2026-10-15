<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Daftar Akun Peserta - Lomba TTG SI RINOVA</title>
    
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

    <div class="w-full max-w-lg my-6">
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
                <h1 class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight">Daftar Akun Peserta</h1>
                <p class="text-xs text-slate-500 mt-1">Lomba Teknologi Tepat Guna (TTG)</p>
            </div>

            <!-- Errors Alert -->
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
            <form action="{{ route('peserta.register.post') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Nama Lengkap -->
                <div>
                    <label for="name" class="block text-xs font-semibold text-slate-700 mb-1.5">Nama Lengkap / Ketua Tim <span class="text-rose-500"></span></label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none material-symbols-outlined text-slate-400 text-lg">person</span>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus
                               placeholder="Masukkan Nama Anda"
                               class="w-full pl-9 pr-3.5 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#00A3E0]/20 focus:border-[#00A3E0] transition-all outline-none">
                    </div>
                </div>

                <!-- Grid: Email & No WA -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="email" class="block text-xs font-semibold text-slate-700 mb-1.5">Email Aktif <span class="text-rose-500"></span></label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none material-symbols-outlined text-slate-400 text-lg">mail</span>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                   placeholder="Masukkan Email Anda"
                                   class="w-full pl-9 pr-3.5 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#00A3E0]/20 focus:border-[#00A3E0] transition-all outline-none">
                        </div>
                    </div>

                    <div>
                        <label for="no_wa" class="block text-xs font-semibold text-slate-700 mb-1.5">Nomor WhatsApp <span class="text-rose-500"></span></label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none material-symbols-outlined text-slate-400 text-lg">call</span>
                            <input type="text" id="no_wa" name="no_wa" value="{{ old('no_wa') }}" required
                                   placeholder="0812xxxxxxxx"
                                   class="w-full pl-9 pr-3.5 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#00A3E0]/20 focus:border-[#00A3E0] transition-all outline-none">
                        </div>
                    </div>
                </div>

                <!-- Asal Sekolah / Kampus / Instansi -->
                <div>
                    <label for="asal_instansi" class="block text-xs font-semibold text-slate-700 mb-1.5">Asal Sekolah / Kampus / Instansi <span class="text-rose-500">*</span></label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none material-symbols-outlined text-slate-400 text-lg">school</span>
                        <input type="text" id="asal_instansi" name="asal_instansi" value="{{ old('asal_instansi') }}" required
                               placeholder="Contoh: Universitas Siliwangi / SMKN 1 Tasikmalaya / Mandiri"
                               class="w-full pl-9 pr-3.5 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#00A3E0]/20 focus:border-[#00A3E0] transition-all outline-none">
                    </div>
                </div>

                <!-- Kategori Peserta Akun -->
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">
                        Kategori Peserta Lomba <span class="text-rose-500">*</span>
                    </label>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-2.5">
                        <!-- SMA/SMK -->
                        <label class="relative flex flex-col p-3 border-2 rounded-xl cursor-pointer transition-all hover:border-[#00A3E0] has-[:checked]:border-[#00A3E0] has-[:checked]:bg-sky-50/50 border-slate-200 group">
                            <input type="radio" name="kategori" value="SMA/SMK Sederajat" class="sr-only" {{ old('kategori') === 'SMA/SMK Sederajat' ? 'checked' : '' }} required>
                            <div class="flex items-center justify-between mb-1">
                                <span class="w-7 h-7 rounded-lg bg-sky-100 text-[#00A3E0] flex items-center justify-center material-symbols-outlined text-base">school</span>
                                <span class="w-4 h-4 rounded-full border-2 border-slate-300 group-has-[:checked]:border-[#00A3E0] group-has-[:checked]:bg-[#00A3E0] flex items-center justify-center transition-all">
                                    <span class="w-1.5 h-1.5 rounded-full bg-white opacity-0 group-has-[:checked]:opacity-100"></span>
                                </span>
                            </div>
                            <strong class="text-xs font-bold text-slate-800 block">SMA/SMK</strong>
                            <span class="text-[10px] text-slate-400">Pelajar SMA/SMK/MA</span>
                        </label>

                        <!-- Perguruan Tinggi -->
                        <label class="relative flex flex-col p-3 border-2 rounded-xl cursor-pointer transition-all hover:border-indigo-600 has-[:checked]:border-indigo-600 has-[:checked]:bg-indigo-50/50 border-slate-200 group">
                            <input type="radio" name="kategori" value="Perguruan Tinggi" class="sr-only" {{ old('kategori', 'Perguruan Tinggi') === 'Perguruan Tinggi' ? 'checked' : '' }} required>
                            <div class="flex items-center justify-between mb-1">
                                <span class="w-7 h-7 rounded-lg bg-indigo-100 text-indigo-600 flex items-center justify-center material-symbols-outlined text-base">account_balance</span>
                                <span class="w-4 h-4 rounded-full border-2 border-slate-300 group-has-[:checked]:border-indigo-600 group-has-[:checked]:bg-indigo-600 flex items-center justify-center transition-all">
                                    <span class="w-1.5 h-1.5 rounded-full bg-white opacity-0 group-has-[:checked]:opacity-100"></span>
                                </span>
                            </div>
                            <strong class="text-xs font-bold text-slate-800 block">Perguruan Tinggi</strong>
                            <span class="text-[10px] text-slate-400">Mahasiswa D3/S1/S2</span>
                        </label>

                        <!-- Umum -->
                        <label class="relative flex flex-col p-3 border-2 rounded-xl cursor-pointer transition-all hover:border-amber-500 has-[:checked]:border-amber-500 has-[:checked]:bg-amber-50/50 border-slate-200 group">
                            <input type="radio" name="kategori" value="Umum" class="sr-only" {{ old('kategori') === 'Umum' ? 'checked' : '' }} required>
                            <div class="flex items-center justify-between mb-1">
                                <span class="w-7 h-7 rounded-lg bg-amber-100 text-amber-600 flex items-center justify-center material-symbols-outlined text-base">groups</span>
                                <span class="w-4 h-4 rounded-full border-2 border-slate-300 group-has-[:checked]:border-amber-500 group-has-[:checked]:bg-amber-500 flex items-center justify-center transition-all">
                                    <span class="w-1.5 h-1.5 rounded-full bg-white opacity-0 group-has-[:checked]:opacity-100"></span>
                                </span>
                            </div>
                            <strong class="text-xs font-bold text-slate-800 block">Umum</strong>
                            <span class="text-[10px] text-slate-400">Praktisi / Masyarakat</span>
                        </label>
                    </div>
                    <p class="text-[10px] text-slate-400 mt-1">Akun Anda akan terkunci pada kategori yang dipilih dan tidak dapat mendaftar di kategori lain.</p>
                </div>

                <!-- Grid: Password & Konfirmasi -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="password" class="block text-xs font-semibold text-slate-700 mb-1.5">Kata Sandi <span class="text-rose-500"></span></label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none material-symbols-outlined text-slate-400 text-lg">lock</span>
                            <input type="password" id="password" name="password" required minlength="6"
                                   placeholder="Min. 6 karakter"
                                   class="w-full pl-9 pr-10 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#00A3E0]/20 focus:border-[#00A3E0] transition-all outline-none">
                            <button type="button" onclick="togglePasswordVisibility('password', 'eye-icon-password')" 
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600 transition-colors">
                                <span id="eye-icon-password" class="material-symbols-outlined text-lg">visibility</span>
                            </button>
                        </div>
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-xs font-semibold text-slate-700 mb-1.5">Ulangi Sandi <span class="text-rose-500"></span></label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none material-symbols-outlined text-slate-400 text-lg">lock_reset</span>
                            <input type="password" id="password_confirmation" name="password_confirmation" required minlength="6"
                                   placeholder="Ulangi kata sandi"
                                   class="w-full pl-9 pr-10 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#00A3E0]/20 focus:border-[#00A3E0] transition-all outline-none">
                            <button type="button" onclick="togglePasswordVisibility('password_confirmation', 'eye-icon-confirm')" 
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600 transition-colors">
                                <span id="eye-icon-confirm" class="material-symbols-outlined text-lg">visibility</span>
                            </button>
                        </div>
                    </div>
                </div>

                <button type="submit" 
                        class="w-full py-2.5 px-4 bg-[#00A3E0] hover:bg-[#008cc0] active:scale-[0.99] text-white font-bold text-sm rounded-xl shadow-md shadow-sky-500/20 transition-all flex items-center justify-center gap-2 cursor-pointer mt-3">
                    <span class="material-symbols-outlined text-lg">how_to_reg</span>
                    <span>Buat Akun & Lanjut Mendaftar</span>
                </button>
            </form>

            <div class="mt-6 pt-5 border-t border-slate-100 text-center text-xs text-slate-500">
                Sudah memiliki akun? 
                <a href="{{ route('peserta.login') }}" class="font-bold text-[#00A3E0] hover:underline ml-1">
                    Masuk di sini
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
