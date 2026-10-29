<!-- FOOTER -->
<footer class="bg-[#e0f2fe]/50 border-t border-sky-100 py-12 text-slate-600 text-xs">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-8">

        <div class="space-y-2 max-w-md">
            <a href="/" class="flex items-center gap-2.5">
                <picture>
                    <source srcset="{{ asset('storage/images/logo_tasik.webp') }}" type="image/webp">
                    <img src="{{ asset('storage/images/logo_tasik.png') }}" alt="Logo Kota Tasikmalaya"
                        width="28" height="28" loading="lazy" decoding="async" class="h-7 w-auto object-contain">
                </picture>
                <span class="text-xl font-black text-[#00A3E0] tracking-tight">
                    SI RINOVA
                </span>
            </a>
            <p class="text-slate-500 leading-relaxed">
                Bapperida Kota Tasikmalaya. Mendorong inovasi dan penerapan Teknologi Tepat Guna untuk
                kesejahteraan masyarakat.
            </p>
        </div>

        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-6 sm:gap-8 font-semibold text-slate-600">
            <a href="{{ route('lomba.info') }}" class="hover:text-[#00A3E0] transition-colors cursor-pointer text-xs font-bold text-[#00A3E0]">Lomba TTG</a>
            <button type="button" onclick="openFooterModal('privasi')" class="hover:text-[#00A3E0] transition-colors cursor-pointer text-xs font-semibold focus:outline-none">Kebijakan Privasi</button>
            <button type="button" onclick="openFooterModal('syarat')" class="hover:text-[#00A3E0] transition-colors cursor-pointer text-xs font-semibold focus:outline-none">Syarat & Ketentuan</button>
            <button type="button" onclick="openFooterModal('bantuan')" class="hover:text-[#00A3E0] transition-colors cursor-pointer text-xs font-semibold focus:outline-none">Bantuan</button>
            <a href="{{ route('public.tentang') }}#form-pesan" class="hover:text-[#00A3E0] transition-colors cursor-pointer">Kontak Kami</a>
        </div>

    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8 pt-6 border-t border-sky-100/80 text-center text-slate-400">
        <p>&copy; 2026 Pemerintah Kota Tasikmalaya.</p>
    </div>
</footer>

<style>
    #footer-modal-body::-webkit-scrollbar {
        display: none !important;
        width: 0 !important;
        height: 0 !important;
    }
    #footer-modal-body {
        -ms-overflow-style: none !important;
        scrollbar-width: none !important;
    }
</style>

<!-- MODAL FOOTER INFO (Kebijakan Privasi, Syarat & Ketentuan, Bantuan) -->
<div id="footer-info-modal" class="fixed inset-0 z-[9999] hidden items-center justify-center bg-slate-900/60 backdrop-blur-sm p-4 transition-all duration-300">
    <div id="footer-modal-card" class="bg-white rounded-3xl shadow-2xl max-w-xl sm:max-w-2xl w-full max-h-[92vh] flex flex-col overflow-hidden transform scale-95 transition-transform duration-300 border border-slate-100">
        
        <!-- Header Modal -->
        <div class="p-5 sm:p-6 border-b border-slate-100 flex items-center justify-between gap-4 bg-slate-50/50">
            <div class="flex items-center gap-3">
                <div id="footer-modal-icon-container" class="w-10 h-10 rounded-2xl flex items-center justify-center shrink-0">
                    <span id="footer-modal-icon" class="material-symbols-outlined text-xl"></span>
                </div>
                <div>
                    <h3 id="footer-modal-title" class="text-base sm:text-lg font-bold text-slate-900 tracking-tight"></h3>
                    <p id="footer-modal-subtitle" class="text-xs text-slate-500 mt-0.5"></p>
                </div>
            </div>
            <button type="button" onclick="closeFooterModal()" class="w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-500 hover:text-slate-800 flex items-center justify-center transition-colors cursor-pointer" title="Tutup">
                <span class="material-symbols-outlined text-lg">close</span>
            </button>
        </div>

        <!-- Body Modal (Scrollable tanpa scrollbar terlihat) -->
        <div id="footer-modal-body" class="p-5 sm:p-6 overflow-y-auto space-y-3.5 text-xs text-slate-600 leading-relaxed [scrollbar-width:none] [-ms-overflow-style:none] [&::-webkit-scrollbar]:hidden" style="scrollbar-width: none; -ms-overflow-style: none;">
            <!-- Dynamic Content Injected by JS -->
        </div>

        <!-- Footer Modal -->
        <div class="p-4 border-t border-slate-100 bg-slate-50/50 flex items-center justify-end">
            <button type="button" onclick="closeFooterModal()" class="bg-[#00A3E0] hover:bg-[#0090c7] text-white px-6 py-2 rounded-xl text-xs font-bold shadow-md shadow-[#00A3E0]/20 hover:shadow-[#00A3E0]/40 transition-all cursor-pointer">
                Tutup
            </button>
        </div>
    </div>
</div>

<script>
    const footerModalData = {
        privasi: {
            title: 'Kebijakan Privasi',
            subtitle: 'Perlindungan & Kerahasiaan Data Pengunjung',
            icon: 'verified_user',
            iconClass: 'bg-emerald-50 text-emerald-600',
            html: `
                <div class="space-y-3">
                    <p class="text-slate-600">Bapperida Kota Tasikmalaya berkomitmen penuh melindungi hak privasi setiap pengunjung portal SI RINOVA.</p>
                    <div class="p-3.5 bg-emerald-50/60 border border-emerald-100 rounded-2xl space-y-1">
                        <strong class="text-emerald-800 block text-xs">1. Pengumpulan Informasi</strong>
                        <p class="text-slate-600 text-[11px] leading-relaxed">Informasi identitas (Nama, Email, Nomor WhatsApp) yang Anda berikan melalui formulir Kirim Pesan semata-mata digunakan untuk keperluan tindak lanjut komunikasi kedinasan dan konsultasi inovasi daerah.</p>
                    </div>
                    <div class="p-3.5 bg-slate-50 border border-slate-100 rounded-2xl space-y-1">
                        <strong class="text-slate-800 block text-xs">2. Perlindungan & Kerahasiaan</strong>
                        <p class="text-slate-600 text-[11px] leading-relaxed">Kami tidak akan membagikan, memperjualbelikan, atau mendistribusikan data pribadi Anda kepada pihak ketiga tanpa izin resmi atau kewajiban hukum.</p>
                    </div>
                    <div class="p-3.5 bg-slate-50 border border-slate-100 rounded-2xl space-y-1">
                        <strong class="text-slate-800 block text-xs">3. Keamanan Sistem</strong>
                        <p class="text-slate-600 text-[11px] leading-relaxed">Data disimpan dengan standar keamanan teknologi informasi pemerintah kota untuk menjamin integritas dan mencegah akses yang tidak berwenang.</p>
                    </div>
                </div>
            `
        },
        syarat: {
            title: 'Syarat & Ketentuan',
            subtitle: 'Ketentuan Akses & Pemanfaatan Data SI RINOVA',
            icon: 'gavel',
            iconClass: 'bg-sky-50 text-[#00A3E0]',
            html: `
                <div class="space-y-3">
                    <p class="text-slate-600">Dengan mengakses portal SI RINOVA Kota Tasikmalaya, Anda menyetujui ketentuan pemanfaatan data berikut:</p>
                    <div class="p-3.5 bg-sky-50/60 border border-sky-100 rounded-2xl space-y-1">
                        <strong class="text-sky-900 block text-xs">1. Hak Cipta & Hak Kekayaan Intelektual</strong>
                        <p class="text-slate-600 text-[11px] leading-relaxed">Inovasi Teknologi Tepat Guna (TTG) yang tercantum merupakan hak milik intelektual inovator bersangkutan yang difasilitasi dan dipublikasikan oleh Bapperida Kota Tasikmalaya.</p>
                    </div>
                    <div class="p-3.5 bg-slate-50 border border-slate-100 rounded-2xl space-y-1">
                        <strong class="text-slate-800 block text-xs">2. Sitasi & Referensi Publikasi</strong>
                        <p class="text-slate-600 text-[11px] leading-relaxed">Dokumen E-Book Kajian, Telaahan Staf, dan data Indikator Makro dapat digunakan untuk kepentingan riset, akademik, dan edukasi dengan mencantumkan sumber sitasi resmi SI RINOVA Kota Tasikmalaya.</p>
                    </div>
                    <div class="p-3.5 bg-slate-50 border border-slate-100 rounded-2xl space-y-1">
                        <strong class="text-slate-800 block text-xs">3. Etika Interaksi</strong>
                        <p class="text-slate-600 text-[11px] leading-relaxed">Pengguna dilarang menyalahgunakan formulir interaktif untuk pengiriman pesan spam, promosi komersial tidak relevan, atau konten yang melanggar hukum.</p>
                    </div>
                </div>
            `
        },
        bantuan: {
            title: 'Pusat Bantuan & FAQ',
            subtitle: 'Panduan Praktis Penggunaan Portal',
            icon: 'help_outline',
            iconClass: 'bg-amber-50 text-amber-600',
            html: `
                <div class="space-y-3">
                    <div class="p-3.5 bg-slate-50 border border-slate-100 rounded-2xl space-y-1">
                        <strong class="text-slate-800 flex items-center gap-1.5 text-xs">
                            <span class="material-symbols-outlined text-sm text-[#00A3E0]">inventory_2</span>
                            Bagaimana cara mencari alat TTG?
                        </strong>
                        <p class="text-slate-600 text-[11px] leading-relaxed">Buka menu <strong>Katalog TTG</strong> atau gunakan kotak pencarian di halaman Beranda untuk menyaring berdasarkan kategori sektor dan sebaran kecamatan di Kota Tasikmalaya.</p>
                    </div>
                    <div class="p-3.5 bg-slate-50 border border-slate-100 rounded-2xl space-y-1">
                        <strong class="text-slate-800 flex items-center gap-1.5 text-xs">
                            <span class="material-symbols-outlined text-sm text-[#00A3E0]">menu_book</span>
                            Bagaimana cara mengunduh E-Book Kajian?
                        </strong>
                        <p class="text-slate-600 text-[11px] leading-relaxed">Kunjungi menu <strong>E-Book Kajian</strong>, klik pada judul kajian yang Anda butuhkan, lalu klik tombol <em>Unduh PDF</em> yang tersedia.</p>
                    </div>
                    <div class="p-3.5 bg-slate-50 border border-slate-100 rounded-2xl space-y-1">
                        <strong class="text-slate-800 flex items-center gap-1.5 text-xs">
                            <span class="material-symbols-outlined text-sm text-[#00A3E0]">send</span>
                            Ingin konsultasi atau mengajukan inovasi?
                        </strong>
                        <p class="text-slate-600 text-[11px] leading-relaxed">Silakan kirimkan pesan melalui menu <a href="{{ route('public.tentang') }}#form-pesan" class="text-[#00A3E0] font-bold hover:underline" onclick="closeFooterModal()">Kirim Pesan</a> atau hubungi kontak resmi Bapperida Kota Tasikmalaya.</p>
                    </div>
                </div>
            `
        }
    };

    function openFooterModal(type) {
        const modal = document.getElementById('footer-info-modal');
        const card = document.getElementById('footer-modal-card');
        const data = footerModalData[type];
        if (!modal || !data) return;

        document.getElementById('footer-modal-title').innerText = data.title;
        document.getElementById('footer-modal-subtitle').innerText = data.subtitle;
        document.getElementById('footer-modal-icon').innerText = data.icon;
        
        const iconContainer = document.getElementById('footer-modal-icon-container');
        iconContainer.className = `w-10 h-10 rounded-2xl flex items-center justify-center shrink-0 ${data.iconClass}`;

        document.getElementById('footer-modal-body').innerHTML = data.html;

        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';

        requestAnimationFrame(() => {
            card.classList.remove('scale-95');
            card.classList.add('scale-100');
        });
    }

    function closeFooterModal() {
        const modal = document.getElementById('footer-info-modal');
        const card = document.getElementById('footer-modal-card');
        if (!modal || !card) return;

        card.classList.remove('scale-100');
        card.classList.add('scale-95');

        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = '';
        }, 150);
    }

    // Tutup saat klik di luar card
    document.getElementById('footer-info-modal')?.addEventListener('click', (e) => {
        if (e.target === e.currentTarget) closeFooterModal();
    });

    // Tutup dengan tombol Esc
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeFooterModal();
    });
</script>
