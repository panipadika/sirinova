<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndikatorMakro extends Model
{
    use HasFactory;

    protected $table = 'indikator_makro';

    const CREATED_AT = 'dibuat_pada';
    const UPDATED_AT = 'diperbarui_pada';

    protected $fillable = [
        'nama_indikator',
        'satuan',
        'deskripsi',
        'urutan',
    ];

    public function dataIndikator()
    {
        return $this->hasMany(DataIndikatorMakro::class, 'indikator_id');
    }
}
