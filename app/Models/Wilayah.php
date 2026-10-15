<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wilayah extends Model
{
    use HasFactory;

    protected $table = 'wilayah';
    protected $guarded = ['id'];

    const CREATED_AT = 'dibuat_pada';
    const UPDATED_AT = 'diperbarui_pada';

    // Relasi ke Alat TTG (1 Wilayah memiliki Banyak Alat)
    public function alatTtg()
    {
        return $this->hasMany(AlatTtg::class, 'id_wilayah', 'id');
    }

    // Relasi ke Inovator (1 Wilayah memiliki Banyak Inovator)
    public function inovator()
    {
        return $this->hasMany(Inovator::class, 'id_wilayah', 'id');
    }
}

