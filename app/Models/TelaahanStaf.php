<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class TelaahanStaf extends Model
{
    use HasFactory;

    protected $table = 'telaahan_staf';
    protected $guarded = ['id'];

    const CREATED_AT = 'dibuat_pada';
    const UPDATED_AT = 'diperbarui_pada';

    protected $casts = [
        'tahun_dokumen' => 'integer',
    ];

    /**
     * Accessor untuk backward-compatibility jika ada kode lama yang memanggil tanggal_dokumen
     */
    public function getTanggalDokumenAttribute()
    {
        return $this->tahun_dokumen ? $this->tahun_dokumen . '-01-01' : null;
    }

    /**
     * Otomatis hapus file PDF dari storage saat record Telaahan Staf dihapus.
     */
    protected static function booted()
    {
        static::deleting(function ($doc) {
            if ($doc->file_pdf && str_contains($doc->file_pdf, 'storage/telaahan_staf/pdfs/')) {
                $oldPath = str_replace('storage/', '', $doc->file_pdf);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }
        });
    }
}

