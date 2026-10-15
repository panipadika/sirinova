<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Input Data 27 Daerah - Admin Panel</title>
    <!-- Favicon Logo Tasikmalaya -->
    <link rel="icon" type="image/png" href="{{ asset('storage/images/favicon_tasik.png') }}?v=3">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=3">
    <link rel="apple-touch-icon" href="{{ asset('storage/images/favicon_tasik.png') }}?v=3">
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Public+Sans:wght@600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f7f6;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Public Sans', sans-serif;
        }

        /* Hide scrollbar completely across all elements & browsers */
        html, body, div, main, table, ul, nav, * {
            -ms-overflow-style: none !important;
            scrollbar-width: none !important;
        }

        ::-webkit-scrollbar,
        *::-webkit-scrollbar,
        html::-webkit-scrollbar,
        body::-webkit-scrollbar,
        div::-webkit-scrollbar {
            display: none !important;
            width: 0 !important;
            height: 0 !important;
        }

        /* Hide number input spinners/arrows */
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
</head>

<body class="text-gray-800 min-h-screen antialiased flex overflow-hidden">

    <!-- SIDEBAR -->
    @include('partials.sidebar')

    <!-- MAIN CONTENT -->
    <div class="flex-1 flex flex-col h-screen md:ml-[260px] w-full md:w-[calc(100%-260px)] overflow-y-auto">
        <!-- Header Mobile Toggle -->
        <header class="md:hidden bg-white border-b flex justify-between items-center h-14 px-4 sticky top-0 z-40">
            <button class="p-2 text-gray-500 rounded hover:bg-gray-100" id="menu-btn">
                <span class="material-symbols-outlined">menu</span>
            </button>
            <span class="text-lg font-bold text-gray-900">Input Data Indikator</span>
        </header>

        <main class="flex-1 p-5 md:p-6 space-y-5">
            <!-- Header & Navigasi Kembali -->
            <div class="mb-6">
                <a href="{{ route('admin.indikator-makro.index', ['tahun' => $tahun]) }}"
                    class="text-[#29abe2] flex items-center gap-1 text-xs font-semibold hover:underline mb-1 w-max">
                    <span class="material-symbols-outlined text-sm">arrow_back</span> Kembali ke Indikator Makro
                </a>
                <h2 class="text-3xl font-bold text-gray-900 tracking-tight">{{ $indikator->nama_indikator }}</h2>
                <p class="text-sm text-gray-600 mt-1">Input / edit persentase atau nilai indikator seluruh Kota/Kabupaten Jawa Barat (Satuan: <strong>{{ $indikator->satuan }}</strong>).</p>
            </div>

            <!-- Form Batch Input -->
            <form action="{{ route('admin.indikator-makro.store-batch') }}" method="POST">
                @csrf
                <input type="hidden" name="indikator_id" value="{{ $indikator->id }}">

                <!-- Selector Tahun Batch -->
                <div class="bg-blue-50/70 border border-blue-100 p-4 rounded-xl flex flex-wrap items-center justify-between gap-4 mb-4">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-[#0284c7]">calendar_today</span>
                        <div>
                            <h4 class="text-xs font-bold text-gray-800">Tahun Pendataan</h4>
                            <p class="text-[11px] text-gray-500">Pilih tahun data yang akan disimpan ke database</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <label class="text-xs font-bold text-gray-700">Tahun:</label>
                        <input type="number" name="tahun" value="{{ $tahun }}" min="2000" max="2100" required class="w-28 text-xs font-bold text-center rounded-lg border-gray-200 focus:ring-[#29abe2] focus:border-[#29abe2]">
                    </div>
                </div>

                <!-- Table 27 Daerah -->
                <div class="bg-white rounded-xl border border-gray-100 shadow-[0_2px_8px_rgba(0,0,0,0.03)] overflow-hidden">
                    <div class="p-4 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3 bg-white">
                        <h3 class="text-sm font-bold text-gray-900 flex items-center gap-2">
                            <span class="material-symbols-outlined text-[#29abe2]">edit_note</span>
                            Daftar 27 Kabupaten / Kota Jawa Barat
                        </h3>
                        <div class="flex items-center gap-2 shrink-0">
                            <!-- Button Quick Upload Excel -->
                            <button type="button" onclick="openModal('modal-paste-excel')"
                                    class="bg-emerald-50 hover:bg-emerald-100 text-emerald-700 border border-emerald-200 px-3 py-1.5 rounded-lg text-xs font-semibold flex items-center gap-1.5 transition-colors shadow-2xs">
                                <span class="material-symbols-outlined text-[16px] text-emerald-600">upload_file</span>
                                Import File Excel
                            </button>
                            <!-- Badge Petunjuk Enter -->
                            <span class="hidden lg:inline-flex items-center gap-1 text-[11px] text-gray-500 bg-gray-50 border border-gray-200 px-2.5 py-1 rounded-lg">
                                <kbd class="px-1.5 py-0.5 text-[10px] font-bold bg-white border border-gray-300 rounded text-gray-700 shadow-2xs">Enter ↵</kbd> Pindah Baris
                            </span>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-[#f8fafc] text-gray-500 text-[11px] font-bold uppercase tracking-wider border-b border-gray-200">
                                    <th class="py-3 px-4 w-[8%] text-center">No</th>
                                    <th class="py-3 px-4 w-[45%]">Nama Kabupaten / Kota</th>
                                    <th class="py-3 px-4 w-[32%] text-center">Nilai ({{ $indikator->satuan }})</th>
                                    <th class="py-3 px-4 w-[15%] text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody class="text-xs text-gray-700 divide-y divide-gray-100">
                                @foreach($daftarDaerah as $index => $daerah)
                                    @php
                                        $isTasik = ($daerah === 'Kota Tasikmalaya');
                                        $record = $existingData->get($daerah);
                                        $currentVal = $record ? $record->nilai : '';
                                        $isFilled = ($currentVal !== '' && $currentVal !== null && (float)$currentVal != 0);
                                    @endphp
                                    <tr class="transition-colors {{ $isTasik ? 'bg-[#fed000]/15 border-l-4 border-l-[#fed000] font-medium' : 'hover:bg-gray-50/60' }}">
                                        <td class="py-3 px-4 text-center font-bold text-gray-500">{{ $index + 1 }}</td>
                                        <td class="py-3 px-4">
                                            <div class="flex items-center gap-2">
                                                <span class="font-bold text-gray-900">{{ $daerah }}</span>
                                                @if($isTasik)
                                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md text-[10px] font-extrabold bg-[#fed000] text-gray-900 shadow-2xs">
                                                        <span class="material-symbols-outlined text-[12px]">star</span> KOTA UTAMA
                                                    </span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="py-3 px-4 text-center">
                                            <div class="relative max-w-xs mx-auto">
                                                <input type="number" step="0.01" name="nilai[{{ $daerah }}]" data-daerah="{{ $daerah }}" value="{{ $currentVal }}" placeholder="0.00"
                                                       class="daerah-nilai-input w-full text-xs font-semibold text-center rounded-lg border-gray-300 focus:ring-[#29abe2] focus:border-[#29abe2] {{ $isTasik ? 'border-[#fed000] bg-white ring-1 ring-[#fed000] font-bold text-gray-900' : '' }}">
                                                <span class="absolute right-3 top-2.5 text-[10px] font-bold text-gray-400 select-none">{{ $indikator->satuan }}</span>
                                            </div>
                                        </td>
                                        <td class="status-cell py-3 px-4 text-center">
                                            @if($isFilled)
                                                <span class="inline-flex items-center gap-1 text-[11px] font-semibold text-emerald-600">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Terisi
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-1 text-[11px] font-semibold text-gray-400">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-gray-300"></span> Kosong
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Bottom Action Footer -->
                    <div class="p-4 border-t border-gray-100 flex items-center justify-between bg-[#f8fafc]">
                        <p class="text-xs text-gray-500">Pastikan seluruh nilai terisi dengan format angka persentase/point (contoh: <strong>76.59</strong> atau <strong>10.84</strong>).</p>
                        <button type="submit" class="bg-[#29abe2] hover:bg-[#1a95c9] text-white px-6 py-2.5 rounded-lg text-xs font-bold flex items-center gap-2 shadow-sm transition-colors">
                            <span class="material-symbols-outlined text-base">save</span> Simpan Semua Data 27 Daerah
                        </button>
                    </div>
                </div>
            </form>
        </main>
    </div>

    <!-- MODAL IMPORT DATA EXCEL -->
    <div id="modal-paste-excel" class="fixed inset-0 bg-black/40 backdrop-blur-xs z-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-2xl p-6 w-full max-w-lg shadow-2xl border border-gray-100 animate-in fade-in zoom-in duration-200">
            <div class="flex items-center justify-between border-b border-gray-100 pb-3 mb-4">
                <h3 class="text-base font-bold text-gray-900 flex items-center gap-2">
                    <span class="material-symbols-outlined text-emerald-600">upload_file</span>
                    Import Data dari File Excel
                </h3>
                <button type="button" onclick="closeModal('modal-paste-excel')" class="text-gray-400 hover:text-gray-600">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>

            <div class="space-y-4">
                <!-- UPLOAD FILE EXCEL -->
                <div class="bg-emerald-50/60 border border-emerald-100 p-4 rounded-xl space-y-2">
                    <label class="block text-xs font-bold text-emerald-900 flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-[16px] text-emerald-600">file_upload</span>
                        Upload File Excel (.xlsx, .xls, .csv, .txt)
                    </label>
                    <input type="file" id="excel-file-input" accept=".xlsx, .xls, .csv, .txt"
                           class="block w-full text-xs text-gray-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-600 file:text-white hover:file:bg-emerald-700 cursor-pointer bg-white rounded-lg border border-emerald-200 p-1">
                    <p class="text-[11px] text-emerald-700 mt-1">Mendukung format tabel BPS! Sistem akan secara otomatis mencocokkan nama Kabupaten/Kota dan mengisikan nilainya ke tabel.</p>
                </div>

                <div class="flex items-center justify-end pt-3 border-t border-gray-100">
                    <button type="button" onclick="closeModal('modal-paste-excel')" class="px-4 py-2 text-xs font-semibold text-gray-600 hover:bg-gray-100 rounded-lg">Batal</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
        }

        // Live update status badge saat mengetik
        function updateInputStatus(inputEl) {
            const val = parseFloat(inputEl.value);
            const row = inputEl.closest('tr');
            const statusTd = row.querySelector('.status-cell');
            if (!isNaN(val) && val !== 0 && inputEl.value.trim() !== '') {
                statusTd.innerHTML = `
                    <span class="inline-flex items-center gap-1 text-[11px] font-semibold text-emerald-600">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Terisi
                    </span>
                `;
            } else {
                statusTd.innerHTML = `
                    <span class="inline-flex items-center gap-1 text-[11px] font-semibold text-gray-400">
                        <span class="w-1.5 h-1.5 rounded-full bg-gray-300"></span> Kosong
                    </span>
                `;
            }
        }

        // Helper Normalisasi Nama Daerah
        function normalizeStr(str) {
            if (!str) return '';
            return str.toString().toLowerCase()
                .replace(/kabupaten/g, 'kab')
                .replace(/kab\./g, 'kab')
                .replace(/[^a-z0-9]/g, '');
        }

        // Pencocokan Nama Daerah dari BPS
        function matchRegionInput(text) {
            if (!text || typeof text !== 'string') return null;
            let clean = text.trim().toLowerCase();
            if (!clean || clean.length < 3) return null;

            // Abaikan label header BPS
            if (/^(category|ipm|tinggi|sedang|rendah|tahun|jumlah|rata|provinsi|jawa barat)/i.test(clean)) {
                return null;
            }

            const inputs = Array.from(document.querySelectorAll('.daerah-nilai-input'));

            // 1. Direct / Exact Match
            for (let input of inputs) {
                let daerah = input.getAttribute('data-daerah');
                let normDaerah = normalizeStr(daerah);
                let normText = normalizeStr(clean);
                if (normText === normDaerah) return input;
            }

            // 2. Match Kata Kunci Utama
            let isKota = /\bkota\b/i.test(clean);
            let isKab = /\bkab\b|\bkabupaten\b/i.test(clean);

            let baseName = clean.replace(/^(kota|kabupaten|kab\.)\s+/i, '').trim();
            let normBase = normalizeStr(baseName);

            if (normBase.length < 3) return null;

            for (let input of inputs) {
                let daerah = input.getAttribute('data-daerah');
                let targetIsKota = /^kota/i.test(daerah);
                let targetBase = normalizeStr(daerah.replace(/^(kota|kab\.?|kabupaten)\s+/i, ''));

                if (normBase === targetBase) {
                    if (isKota && targetIsKota) return input;
                    if (isKab && !targetIsKota) return input;
                    if (!isKota && !isKab && !targetIsKota) return input;
                }
            }

            return null;
        }

        // Ekstraksi Nilai Angka & Otomatisasi Desimal Koma BPS
        function extractNumericValue(cellVal) {
            if (cellVal === null || cellVal === undefined) return null;

            // Jika nilai berupa number murni
            if (typeof cellVal === 'number') {
                let val = cellVal;
                if (val > 100 && val < 10000) {
                    val = val / 100;
                }
                return parseFloat(val.toFixed(2));
            }

            let str = cellVal.toString().trim();
            if (!str) return null;

            // Jika format desimal koma Indonesia (contoh: "83,54" atau "75,04")
            let cleanStr = str;
            if (/\d+,\d+/.test(cleanStr)) {
                cleanStr = cleanStr.replace(',', '.');
            }

            let match = cleanStr.match(/-?\d+(\.\d+)?/);
            if (match) {
                let val = parseFloat(match[0]);
                if (!isNaN(val)) {
                    // Jika nilai terlanjur terbaca tanpa koma/titik (contoh: 7504 -> 75.04)
                    if (val > 100 && val < 10000) {
                        val = val / 100;
                    }
                    return parseFloat(val.toFixed(2));
                }
            }
            return null;
        }

        // Proses Baris Tabel dengan Logic Smart BPS
        function processRowsWithSmartBps(rows) {
            const inputs = Array.from(document.querySelectorAll('.daerah-nilai-input'));
            let matchedCount = 0;
            let filledInputs = new Set();

            // Strategi 1: Smart Name Matching BPS
            rows.forEach(row => {
                if (!Array.isArray(row)) return;

                let foundInput = null;
                let foundVal = null;

                // Cari nama daerah pada baris
                row.forEach(cell => {
                    if (cell && !foundInput) {
                        let inputEl = matchRegionInput(cell.toString());
                        if (inputEl && !filledInputs.has(inputEl)) {
                            foundInput = inputEl;
                        }
                    }
                });

                // Cari angka pada baris yang sama
                if (foundInput) {
                    row.forEach(cell => {
                        if (cell !== null && cell !== undefined && foundVal === null) {
                            let cellStr = cell.toString().trim();
                            if (!matchRegionInput(cellStr)) {
                                let num = extractNumericValue(cellStr);
                                if (num !== null) {
                                    foundVal = num;
                                }
                            }
                        }
                    });

                    if (foundVal !== null) {
                        foundInput.value = foundVal;
                        updateInputStatus(foundInput);
                        filledInputs.add(foundInput);
                        matchedCount++;
                    }
                }
            });

            // Strategi 2: Fallback ke urutan biasa jika tidak ada nama daerah (hanya list angka)
            if (matchedCount < 5) {
                let valuesList = [];
                rows.forEach(row => {
                    if (Array.isArray(row)) {
                        row.forEach(cell => {
                            if (cell !== null && cell !== undefined) {
                                let str = cell.toString().trim();
                                if (!/(category|ipm|tinggi|sedang|rendah|≥|<=|>|<|tahun|provinsi)/i.test(str)) {
                                    let num = extractNumericValue(str);
                                    if (num !== null) {
                                        valuesList.push(num);
                                    }
                                }
                            }
                        });
                    }
                });

                let seqCount = 0;
                valuesList.forEach((val, idx) => {
                    if (idx < inputs.length) {
                        inputs[idx].value = val;
                        updateInputStatus(inputs[idx]);
                        seqCount++;
                    }
                });
                return seqCount;
            }

            return matchedCount;
        }

        document.addEventListener('DOMContentLoaded', () => {
            const inputs = document.querySelectorAll('.daerah-nilai-input');

            inputs.forEach((input, idx) => {
                input.addEventListener('input', () => updateInputStatus(input));

                input.addEventListener('keydown', (e) => {
                    if (e.key === 'Enter' || e.key === 'ArrowDown') {
                        e.preventDefault();
                        if (inputs[idx + 1]) {
                            inputs[idx + 1].focus();
                            inputs[idx + 1].select();
                        }
                    } else if (e.key === 'ArrowUp') {
                        e.preventDefault();
                        if (idx > 0) {
                            inputs[idx - 1].focus();
                            inputs[idx - 1].select();
                        }
                    }
                });
            });

            // Handler Upload File Excel / CSV / TXT
            document.getElementById('excel-file-input')?.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (!file) return;

                const fileName = file.name.toLowerCase();

                if (fileName.endsWith('.txt') || fileName.endsWith('.csv')) {
                    const reader = new FileReader();
                    reader.onload = function(evt) {
                        const rawLines = evt.target.result.split(/\r?\n/).map(l => l.trim().split(/,|\t|\s{2,}/));
                        processRowsWithSmartBps(rawLines);
                        closeModal('modal-paste-excel');
                        document.getElementById('excel-file-input').value = '';
                    };
                    reader.readAsText(file);
                } else {
                    const reader = new FileReader();
                    reader.onload = function(evt) {
                        try {
                            const data = new Uint8Array(evt.target.result);
                            const workbook = XLSX.read(data, {type: 'array', raw: false});
                            const firstSheetName = workbook.SheetNames[0];
                            const worksheet = workbook.Sheets[firstSheetName];
                            
                            // Gunakan raw: false agar desimal koma BPS (contoh "83,54") tetap terjaga dalam bentuk string
                            const jsonRows = XLSX.utils.sheet_to_json(worksheet, {header: 1, raw: false});

                            processRowsWithSmartBps(jsonRows);

                            closeModal('modal-paste-excel');
                            document.getElementById('excel-file-input').value = '';
                        } catch (err) {
                            alert('Gagal membaca file Excel. Pastikan format file valid.');
                        }
                    };
                    reader.readAsArrayBuffer(file);
                }
            });
        });

        // Mobile Sidebar Toggle
        const menuBtn = document.getElementById('menu-btn');
        const sidebar = document.getElementById('sidebar');
        menuBtn?.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });
    </script>
</body>

</html>
