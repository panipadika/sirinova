<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataIndikatorMakro extends Model
{
    use HasFactory;

    protected $table = 'data_indikator_makro';

    const CREATED_AT = 'dibuat_pada';
    const UPDATED_AT = 'diperbarui_pada';

    protected $fillable = [
        'indikator_id',
        'tahun',
        'nama_daerah',
        'nilai',
        'is_kota_tasik',
    ];

    protected $casts = [
        'nilai' => 'float',
        'is_kota_tasik' => 'boolean',
    ];

    public function indikator()
    {
        return $this->belongsTo(IndikatorMakro::class, 'indikator_id');
    }
}
