<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrestasiAkademik extends Model
{
    protected $table = 'prestasi_akademiks';

    protected $casts = [
        'tahun' => 'integer',
        'regional' => 'integer',
        'nasional' => 'integer',
        'internasional' => 'integer',
    ];

    protected $fillable = [
        'tahun',
        'nama_mahasiswa',
        'prodi',
        'fakultas',
        'regional',
        'nasional',
        'internasional',
    ];
}
