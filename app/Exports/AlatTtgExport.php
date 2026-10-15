<?php

namespace App\Exports;

use App\Models\AlatTtg;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AlatTtgExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    public function collection()
    {
        return AlatTtg::with(['inovator', 'kategori', 'wilayah'])->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Alat',
            'Kategori',
            'Inovator',
            'Wilayah',
            'Alamat Lengkap',
            'Tahun',
            'Estimasi Harga',
            'Kontak / WA',
            'Status'
        ];
    }

public function map($alat): array
    {
        static $no = 1;


        $estimasiHarga = $alat->estimasi_harga;

        // 1. LOGIKA PINTAR NOMOR TELEPON (ANTI-KOSONG)
        $kontak = '-';
        if (!empty($alat->noomor_telepon)) {
            $kontak = $alat->nomor_telepon; // Ambil dari tabel alat_ttg
        } elseif (!empty($alat->inovator->nomor_telepon)) {
            $kontak = $alat->inovator->nomor_telepon; // Jika kosong, pinjam dari tabel inovator
        }

        // 2. LOGIKA PINTAR ALAMAT (ANTI-KOSONG)
        $alamat = '-';
        if (!empty($alat->alamat_workshop)) {
            $alamat = $alat->alamat_workshop;
        } elseif (!empty($alat->inovator->alamat_lengkap)) {
            $alamat = $alat->inovator->alamat_lengkap;
        } elseif (!empty($alat->inovator->alamat)) {
            $alamat = $alat->inovator->alamat;
        }

        return [
            $no++,
            $alat->nama_alat,
            $alat->kategori->nama_kategori ?? '-',
            $alat->inovator->nama_inovator ?? '-',
            $alat->wilayah->nama_kecamatan ?? '-',
            $alamat,
            $alat->tahun_produksi,
            $estimasiHarga,
            $kontak, // Memanggil variabel kontak yang sudah diproses
            $alat->status_publikasi,
        ];

    }
}
