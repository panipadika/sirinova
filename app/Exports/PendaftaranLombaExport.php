<?php

namespace App\Exports;

use App\Models\PendaftaranLomba;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PendaftaranLombaExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    protected ?string $kategori;
    protected ?string $status;
    protected ?string $keyword;
    private int $rowNumber = 0;

    public function __construct(?string $kategori = null, ?string $status = null, ?string $keyword = null)
    {
        $this->kategori = $kategori;
        $this->status = $status;
        $this->keyword = $keyword;
    }

    public function collection()
    {
        $query = PendaftaranLomba::with('user')->orderBy('dibuat_pada', 'asc');

        if (!empty($this->keyword)) {
            $kw = $this->keyword;
            $query->where(function ($q) use ($kw) {
                $q->where('nama_alat', 'like', "%{$kw}%")
                    ->orWhere('nama_inovator', 'like', "%{$kw}%")
                    ->orWhere('asal_instansi', 'like', "%{$kw}%")
                    ->orWhere('nomor_registrasi', 'like', "%{$kw}%");
            });
        }

        if (!empty($this->kategori)) {
            $query->where('kategori_peserta', $this->kategori);
        }

        if (!empty($this->status)) {
            if (in_array($this->status, ['Ditolak / Perbaikan', 'ditolak_perbaikan'], true)) {
                $query->whereIn('status', ['Ditolak', 'Perlu Perbaikan']);
            } else {
                $query->where('status', $this->status);
            }
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'No. Registrasi',
            'Waktu Pendaftaran',
            'Nama Alat TTG',
            'Fungsi / Deskripsi Ringkas',
            'Kategori Peserta',
            'Nama Inovator / Tim',
            'Asal Instansi / Sekolah / Kampus',
            'Kontak / No. WhatsApp',
            'Biaya Pembuatan (Rp)',
            'Estimasi Harga Jual (Rp)',
            'Status Verifikasi',
            'Catatan Verifikator'
        ];
    }

    public function map($item): array
    {
        $this->rowNumber++;

        return [
            $this->rowNumber,
            $item->nomor_registrasi,
            $item->dibuat_pada ? $item->dibuat_pada->translatedFormat('d F Y, H:i') : '-',
            $item->nama_alat,
            $item->fungsi ?? '-',
            $item->kategori_peserta,
            $item->nama_inovator,
            $item->asal_instansi ?? '-',
            $item->nomor_wa ?? '-',
            $item->biaya_pembuatan,
            $item->estimasi_harga_jual,
            $item->status,
            $item->catatan_admin ?? '-',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['argb' => 'FF00A3E0'],
                ],
            ],
        ];
    }
}
