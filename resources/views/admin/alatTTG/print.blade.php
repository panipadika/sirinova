<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Data Alat TTG</title>
    <style>

        @page {
            size: A4 portrait; /* Mengatur ukuran kertas otomatis */
             /* Menghilangkan margin bawaan browser */
        }
        /* Menggunakan font dasar agar kompatibel dengan DomPDF */
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 11px;
            color: #1f2937;
            margin: 0;
            padding: 0;
        }

        /* Area Kop Surat */
        .header {
            width: 100%;
            border-bottom: 3px solid #000;
            padding-bottom: 15px;
            margin-bottom: 20px;
            text-align: center;
            position: relative;
        }

        /* Posisi Logo di Kiri Atas */
        .logo {
            position: absolute;
            left: 0;
            top: 5px;
            width: 75px;
            height: auto;
        }

        .header h1 {
            margin: 0 0 5px 0;
            font-size: 18px;
            text-transform: uppercase;
            font-weight: bold;
        }

        .header p {
            margin: 2px 0;
            font-size: 12px;
        }

        /* Desain Tabel */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #4b5563;
            padding: 8px 6px;
            text-align: left;
            vertical-align: top;
        }

        th {
            background-color: #f3f4f6;
            font-weight: bold;
            text-align: center;
            text-transform: uppercase;
            font-size: 10px;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .w-5 {
            width: 5%;
        }

        .w-12 {
            width: 12%;
        }

        .w-10 {
            width: 10%;
        }

        .w-18 {
            width: 18%;
        }

        .w-20 {
            width: 20%;
        }
    </style>
</head>

<body>

    <div class="header">
<!-- Logo Kota Tasikmalaya (Menggunakan metode Base64 khusus untuk DomPDF) -->
@php
    $imagePath = public_path('storage/images/logo_tasik.png');
    $imageData = base64_encode(file_get_contents($imagePath));
    $src = 'data:image/png;base64,' . $imageData;
@endphp
<img src="{{ $src }}" alt="Logo Kota Tasikmalaya" class="logo">

        <h1>Laporan Data Alat Teknologi Tepat Guna (TTG)</h1>
        <p><strong>Pemerintah Kota Tasikmalaya</strong></p>
    </div>

    <table>
        <thead>
            <tr>
                <th class="w-5">No</th>
                <th class="w-18">Nama Alat</th>
                <th class="w-10">Kategori</th>
                <th class="w-12">Inovator</th>
                <th class="w-12">Est. Harga</th>
                <th class="w-20">Alamat Lengkap</th>
                <th class="w-10">Wilayah</th>
                <th class="w-5">Tahun</th>
                <th class="w-5">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($alatTtg as $index => $item)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td><strong>{{ $item->nama_alat }}</strong></td>
                    <td class="text-center">{{ $item->kategori->nama_kategori ?? '-' }}</td>
                    <td>{{ $item->inovator->nama_inovator ?? '-' }}</td>
                    <!-- Menambahkan Rp di depan estimasi harga -->
                    <td>{{ $item->estimasi_harga ? 'Rp ' . number_format((float) preg_replace('/[^0-9]/', '', $item->estimasi_harga), 0, ',', '.') : '-' }}
                    </td>
                    <td>{{ $item->alamat_lengkap ?? '-' }}</td>
                    <td class="text-center">{{ $item->wilayah->nama_kecamatan ?? '-' }}</td>
                    <td class="text-center">{{ $item->tahun_produksi }}</td>
                    <td class="text-center">{{ $item->status_publikasi }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center" style="padding: 20px;">Belum ada data Alat TTG.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>

</html>
