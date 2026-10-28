<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>405 - Metode Tidak Diizinkan | SI-RINOVA</title>
    <!-- Favicon Logo Tasikmalaya -->
    <link rel="icon" type="image/png" href="{{ asset('storage/images/favicon_tasik.png') }}?v=3">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=3">
    <link rel="apple-touch-icon" href="{{ asset('storage/images/favicon_tasik.png') }}?v=3">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts Inter & Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Outfit:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #F8FAFC;
        }
        .heading-font {
            font-family: 'Outfit', sans-serif;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4 relative overflow-hidden bg-slate-900">

    <!-- Ambient Glowing Background Spheres -->
    <div class="absolute -top-32 -left-32 w-96 h-96 bg-purple-500/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-32 -right-32 w-96 h-96 bg-[#00A3E0]/30 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-lg w-full text-center relative z-10 space-y-6">
        
        <!-- Animated 405 Badge -->
        <div class="inline-flex items-center gap-2 px-4 py-2 bg-purple-500/10 backdrop-blur-md border border-purple-500/20 rounded-full text-purple-300 font-bold text-xs uppercase tracking-widest shadow-xl animate-pulse">
            <span class="material-symbols-outlined text-sm">block</span>
            <span>Error Code 405</span>
        </div>

        <!-- Huge 405 Heading -->
        <div class="space-y-2">
            <h1 class="heading-font text-8xl sm:text-9xl font-black text-transparent bg-clip-text bg-gradient-to-r from-purple-400 via-sky-300 to-white tracking-tighter">
                405
            </h1>
            <h2 class="heading-font text-2xl sm:text-3xl font-extrabold text-white">
                Metode Permintaan Tidak Diizinkan
            </h2>
            <p class="text-slate-400 text-sm sm:text-base max-w-md mx-auto leading-relaxed">
                Metode HTTP yang digunakan untuk mengakses halaman ini tidak didukung oleh sistem.
            </p>
        </div>

        <!-- Quick Action Buttons -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-3 pt-4">
            <a href="{{ url('/') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-[#00A3E0] hover:bg-sky-500 text-white font-bold text-sm rounded-xl shadow-lg shadow-cyan-500/30 hover:scale-105 active:scale-95 transition-all">
                <span class="material-symbols-outlined text-lg">home</span>
                <span>Kembali ke Beranda</span>
            </a>
            <a href="javascript:history.back()" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-white/10 hover:bg-white/20 text-white border border-white/20 font-bold text-sm rounded-xl backdrop-blur-md hover:scale-105 active:scale-95 transition-all">
                <span class="material-symbols-outlined text-lg">arrow_back</span>
                <span>Halaman Sebelumnya</span>
            </a>
        </div>

        <!-- Footer Note -->
        <p class="text-xs text-slate-500 pt-6">
            SI-RINOVA &copy; Bapperida Kota Tasikmalaya
        </p>

    </div>

</body>
</html>
