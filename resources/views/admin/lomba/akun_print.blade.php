<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Cetak Rekapitulasi Akun Peserta Lomba TTG - Bappelitbangda Kota Tasikmalaya</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10pt;
            color: #111;
            margin: 20px;
        }
        .header {
            text-align: center;
            border-bottom: 3px double #000;
            padding-bottom: 12px;
            margin-bottom: 20px;
        }
        .header h2 {
            margin: 0;
            font-size: 14pt;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .header h3 {
            margin: 4px 0 0 0;
            font-size: 15pt;
            font-weight: bold;
        }
        .header p {
            margin: 4px 0 0 0;
            font-size: 9pt;
            color: #333;
        }
        .title {
            text-align: center;
            margin-bottom: 20px;
        }
        .title h4 {
            margin: 0;
            font-size: 12pt;
            text-decoration: underline;
        }
        .title span {
            font-size: 9pt;
            color: #555;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 9pt;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px 8px;
            vertical-align: top;
        }
        th {
            background-color: #f2f2f2;
            text-align: center;
            font-weight: bold;
        }
        .footer {
            margin-top: 35px;
            float: right;
            text-align: center;
            width: 250px;
            font-size: 10pt;
        }
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body onload="window.print()">

    <div class="no-print" style="margin-bottom: 15px; text-align: right;">
        <button onclick="window.print()" style="padding: 8px 16px; background: #00A3E0; color: white; border: none; border-radius: 6px; cursor: pointer; font-weight: bold;">Cetak Lembar / Print</button>
    </div>

    <div class="header">
        <h2>Pemerintah Kota Tasikmalaya</h2>
        <h3>Badan Perencanaan Pembangunan, Riset dan Inovasi Daerah</h3>
        <p>Jl. Letnan Harun, Panglayungan Cipedes, Tasikmalaya, Jawa Barat 46134</p>
    </div>

    <div class="title">
        <h4>REKAPITULASI DAFTAR AKUN PESERTA LOMBA TEKNOLOGI TEPAT GUNA (TTG)</h4>
        <span>Sistem Informasi Riset & Inovasi Daerah (SI-RINOVA) &bull; Tahun {{ date('Y') }}</span>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 30px;">No</th>
                <th>Nama Lengkap</th>
                <th>Alamat Email</th>
                <th>No. WhatsApp</th>
                <th style="width: 110px;">Kategori</th>
                <th>Asal Instansi</th>
                <th style="width: 80px;">Karya Diajukan</th>
                <th style="width: 90px;">Tgl Registrasi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $idx => $user)
            <tr>
                <td style="text-align: center;">{{ $idx + 1 }}</td>
                <td><strong>{{ $user->name }}</strong></td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->no_wa ?? '-' }}</td>
                <td style="text-align: center;">{{ $user->kategori ?? '-' }}</td>
                <td>{{ $user->asal_instansi ?? '-' }}</td>
                <td style="text-align: center; font-weight: bold;">{{ $user->pendaftaran_lomba_count }} Karya</td>
                <td style="text-align: center;">{{ $user->created_at ? $user->created_at->format('d/m/Y') : '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="8" style="text-align: center; padding: 20px;">Belum ada akun pendaftar terdaftar.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Kota Tasikmalaya, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
        <p style="margin-top: -5px;">Panitia Lomba Inovasi TTG,</p>
        <div style="height: 60px;"></div>
        <p><strong>Bappelitbangda Kota Tasikmalaya</strong></p>
    </div>

</body>
</html>
