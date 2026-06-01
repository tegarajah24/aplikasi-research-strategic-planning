<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrestasiNonAkademik extends Model
{
    protected $table = 'prestasi_non_akademiks';

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
