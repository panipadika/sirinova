<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Rekapitulasi Akun Peserta Lomba TTG - Bapperida Kota Tasikmalaya</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 15mm;
        }
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 9pt;
            color: #1f2937;
            line-height: 1.3;
        }
        .header-table {
            width: 100%;
            border-bottom: 2px solid #000;
            padding-bottom: 8px;
            margin-bottom: 12px;
        }
        .header-text {
            text-align: center;
        }
        .header-text h2 {
            margin: 0;
            font-size: 13pt;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #111;
        }
        .header-text h3 {
            margin: 3px 0 0 0;
            font-size: 14pt;
            font-weight: bold;
            color: #000;
        }
        .header-text p {
            margin: 3px 0 0 0;
            font-size: 8.5pt;
            color: #4b5563;
        }
        .report-title {
            text-align: center;
            margin-bottom: 14px;
        }
        .report-title h4 {
            margin: 0;
            font-size: 11pt;
            font-weight: bold;
            text-decoration: underline;
            color: #111;
        }
        .report-title .meta {
            margin-top: 3px;
            font-size: 8pt;
            color: #6b7280;
        }
        .filter-info {
            margin-bottom: 10px;
            font-size: 8pt;
            color: #374151;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            padding: 5px 8px;
            border-radius: 4px;
        }
        table.data-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 8pt;
        }
        table.data-table th, 
        table.data-table td {
            border: 1px solid #cbd5e1;
            padding: 6px 8px;
            vertical-align: top;
        }
        table.data-table th {
            background-color: #f1f5f9;
            color: #1e293b;
            font-weight: bold;
            text-align: center;
            text-transform: uppercase;
            font-size: 7.5pt;
        }
        .text-center { text-align: center; }
        .footer-table {
            width: 100%;
            margin-top: 25px;
            page-break-inside: avoid;
        }
        .signature-box {
            text-align: center;
            width: 240px;
            float: right;
            font-size: 9pt;
        }
    </style>
</head>
<body>

    <table class="header-table">
        <tr>
            <td class="header-text">
                <h2>Pemerintah Kota Tasikmalaya</h2>
                <h3>Badan Perencanaan Pembangunan, Riset dan Inovasi Daerah</h3>
                <p>Jl. Letnan Harun, Panglayungan, Kec. Cipedes, Kota Tasikmalaya, Jawa Barat 46134</p>
            </td>
        </tr>
    </table>

    <div class="report-title">
        <h4>REKAPITULASI DAFTAR AKUN PENDAFTAR LOMBA TEKNOLOGI TEPAT GUNA (TTG)</h4>
        <div class="meta">Sistem Informasi Riset & Inovasi Daerah (SI-RINOVA) &bull; Dicetak pada: {{ \Carbon\Carbon::now()->translatedFormat('d F Y, H:i') }} WIB</div>
    </div>

    @if(!empty($kategoriFilter) || !empty($partisipasiFilter) || !empty($keywordFilter))
    <div class="filter-info">
        <strong>Filter Diterapkan:</strong>
        @if(!empty($kategoriFilter)) Kategori: <strong>{{ $kategoriFilter }}</strong> &bull; @endif
        @if(!empty($partisipasiFilter)) Partisipasi: <strong>{{ $partisipasiFilter == 'sudah' ? 'Sudah Mendaftar Karya' : 'Belum Mendaftar Karya' }}</strong> &bull; @endif
        @if(!empty($keywordFilter)) Kata Kunci: <strong>"{{ $keywordFilter }}"</strong> &bull; @endif
        Total Akun: <strong>{{ count($users) }}</strong> akun
    </div>
    @endif

    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 25px;">No</th>
                <th style="width: 130px;">Nama Lengkap / Perwakilan</th>
                <th style="width: 130px;">Alamat Email</th>
                <th style="width: 90px;">No. WhatsApp</th>
                <th style="width: 110px;">Kategori</th>
                <th>Asal Instansi / Sekolah / Kampus</th>
                <th style="width: 80px;">Status Karya</th>
                <th style="width: 80px;">Terdaftar Sejak</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $idx => $user)
            <tr>
                <td class="text-center">{{ $idx + 1 }}</td>
                <td><strong>{{ $user->name }}</strong></td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->no_wa ?? '-' }}</td>
                <td class="text-center">{{ $user->kategori ?? '-' }}</td>
                <td>{{ $user->asal_instansi ?? '-' }}</td>
                <td class="text-center">
                    @if($user->pendaftaran_lomba_count > 0)
                        <strong style="color: #047857;">{{ $user->pendaftaran_lomba_count }} Karya</strong>
                    @else
                        <span style="color: #64748b;">Belum Ada</span>
                    @endif
                </td>
                <td class="text-center">{{ $user->created_at ? $user->created_at->format('d/m/Y') : '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center" style="padding: 18px; color: #94a3b8;">
                    Tidak ada akun pendaftar yang sesuai dengan kriteria filter.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <table class="footer-table">
        <tr>
            <td style="border: none; width: 65%;">
                <div style="font-size: 7.5pt; color: #94a3b8;">
                    Dokumen ini diunduh secara resmi melalui Panel Admin SI-RINOVA Bapperida Kota Tasikmalaya.
                </div>
            </td>
            <td style="border: none; width: 35%;">
                <div class="signature-box">
                    <p style="margin: 0;">Kota Tasikmalaya, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
                    <p style="margin: 4px 0 0 0; font-weight: bold;">Panitia Lomba Inovasi TTG</p>
                    <div style="height: 55px;"></div>
                    <p style="margin: 0; font-weight: bold; text-decoration: underline;">Bapperida Kota Tasikmalaya</p>
                </div>
            </td>
        </tr>
    </table>

</body>
</html>
