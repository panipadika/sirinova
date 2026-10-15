<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inovator extends Model
{
    protected $table = 'inovator';
    protected $guarded = ['id'];
    const CREATED_AT = 'dibuat_pada';
    const UPDATED_AT = 'diperbarui_pada';

    public function wilayah()
    {
        return $this->belongsTo(Wilayah::class, 'id_wilayah');
    }

    // Relasi ke tabel Alat TTG (1 Inovator memiliki Banyak Alat)
    public function alatTtg()
    {
        return $this->hasMany(AlatTtg::class, 'id_inovator', 'id');
    }
}
