<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AkunPesertaExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    protected ?string $kategori;
    protected ?string $partisipasi;
    protected ?string $keyword;
    private int $rowNumber = 0;

    public function __construct(?string $kategori = null, ?string $partisipasi = null, ?string $keyword = null)
    {
        $this->kategori = $kategori;
        $this->partisipasi = $partisipasi;
        $this->keyword = $keyword;
    }

    public function collection()
    {
        $query = User::withCount('pendaftaranLomba')->with('pendaftaranLomba')->orderBy('created_at', 'desc');

        if (!empty($this->keyword)) {
            $kw = $this->keyword;
            $query->where(function ($q) use ($kw) {
                $q->where('name', 'like', "%{$kw}%")
                    ->orWhere('email', 'like', "%{$kw}%")
                    ->orWhere('no_wa', 'like', "%{$kw}%")
                    ->orWhere('asal_instansi', 'like', "%{$kw}%");
            });
        }

        if (!empty($this->kategori)) {
            $query->where('kategori', $this->kategori);
        }

        if ($this->partisipasi === 'sudah') {
            $query->has('pendaftaranLomba');
        } elseif ($this->partisipasi === 'belum') {
            $query->doesntHave('pendaftaranLomba');
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Lengkap / Akun',
            'Email Akun',
            'Nomor WhatsApp',
            'Asal Instansi / Sekolah / Kampus',
            'Kategori Peserta',
            'Jumlah Karya Diajukan',
            'Daftar Judul Karya',
            'Waktu Pendaftaran Akun'
        ];
    }

    public function map($user): array
    {
        $this->rowNumber++;

        $karyaTitles = $user->pendaftaranLomba->pluck('nama_alat')->implode(', ');

        return [
            $this->rowNumber,
            $user->name,
            $user->email,
            $user->no_wa ?? '-',
            $user->asal_instansi ?? '-',
            $user->kategori ?? 'Umum',
            $user->pendaftaran_lomba_count . ' Karya',
            $karyaTitles ?: 'Belum mengajukan karya',
            $user->created_at ? $user->created_at->translatedFormat('d F Y, H:i') : '-',
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
