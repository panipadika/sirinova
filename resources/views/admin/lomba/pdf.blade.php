<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Rekapitulasi Pendaftaran Lomba TTG - Bapperida Kota Tasikmalaya</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 15mm 15mm 15mm 15mm;
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
            padding: 5px 6px;
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
        .text-right { text-align: right; }
        .font-mono { font-family: 'Courier', monospace; font-weight: bold; }
        .badge-status {
            font-weight: bold;
            padding: 2px 4px;
            border-radius: 3px;
            display: inline-block;
            font-size: 7.5pt;
        }
        .status-lolos { color: #047857; }
        .status-menunggu { color: #b45309; }
        .status-ditolak { color: #b91c1c; }
        .status-perbaikan { color: #d97706; }
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
        <h4>REKAPITULASI PENDAFTARAN LOMBA TEKNOLOGI TEPAT GUNA (TTG)</h4>
        <div class="meta">Sistem Informasi Riset & Inovasi Daerah (SI-RINOVA) &bull; Dicetak pada: {{ \Carbon\Carbon::now()->translatedFormat('d F Y, H:i') }} WIB</div>
    </div>

    @if(!empty($kategoriFilter) || !empty($statusFilter) || !empty($keywordFilter))
    <div class="filter-info">
        <strong>Filter Diterapkan:</strong>
        @if(!empty($kategoriFilter)) Kategori: <strong>{{ $kategoriFilter }}</strong> &bull; @endif
        @if(!empty($statusFilter)) Status: <strong>{{ $statusFilter }}</strong> &bull; @endif
        @if(!empty($keywordFilter)) Kata Kunci: <strong>"{{ $keywordFilter }}"</strong> &bull; @endif
        Total Data: <strong>{{ count($pendaftar) }}</strong> pendaftar
    </div>
    @endif

    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 25px;">No</th>
                <th style="width: 80px;">No. Registrasi</th>
                <th style="width: 75px;">Tanggal</th>
                <th>Nama Alat TTG</th>
                <th style="width: 95px;">Kategori</th>
                <th>Inovator / Tim</th>
                <th>Asal Instansi</th>
                <th style="width: 65px;">Biaya (Rp)</th>
                <th style="width: 65px;">Harga (Rp)</th>
                <th style="width: 90px;">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pendaftar as $idx => $item)
            <tr>
                <td class="text-center">{{ $idx + 1 }}</td>
                <td class="font-mono text-center">{{ $item->nomor_registrasi }}</td>
                <td class="text-center">{{ $item->dibuat_pada ? $item->dibuat_pada->format('d/m/Y') : '-' }}</td>
                <td>
                    <strong>{{ $item->nama_alat }}</strong>
                    @if($item->fungsi)
                    <div style="font-size: 7.5pt; color: #64748b; margin-top: 2px;">{{ Str::limit($item->fungsi, 90) }}</div>
                    @endif
                </td>
                <td class="text-center">{{ $item->kategori_peserta }}</td>
                <td>
                    <strong>{{ $item->nama_inovator }}</strong>
                    @if($item->nomor_wa)
                    <div style="font-size: 7.5pt; color: #64748b;">WA: {{ $item->nomor_wa }}</div>
                    @endif
                </td>
                <td>{{ $item->asal_instansi ?? '-' }}</td>
                <td class="text-right">{{ number_format($item->biaya_pembuatan, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($item->estimasi_harga_jual, 0, ',', '.') }}</td>
                <td class="text-center">
                    <span class="badge-status 
                        @if($item->status == 'Lolos Administrasi') status-lolos
                        @elseif($item->status == 'Menunggu Verifikasi') status-menunggu
                        @elseif($item->status == 'Ditolak') status-ditolak
                        @else status-perbaikan @endif">
                        {{ $item->status }}
                    </span>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="10" class="text-center" style="padding: 18px; color: #94a3b8;">
                    Tidak ada data pendaftaran lomba yang sesuai dengan filter.
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
