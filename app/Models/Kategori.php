<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori'; // Sesuaikan jika nama tabel Anda berbeda (mis: 'kategoris')
    protected $guarded = ['id'];

    // Sesuaikan konstanta timestamp jika menggunakan penamaan bahasa Indonesia
    const CREATED_AT = 'dibuat_pada';
    const UPDATED_AT = 'diperbarui_pada';

    // Relasi ke Alat TTG (1 Kategori memiliki Banyak Alat)
    public function alatTtg()
    {
        return $this->hasMany(AlatTtg::class, 'id_kategori', 'id');
    }
}
