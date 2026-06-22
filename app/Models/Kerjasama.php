<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kerjasama extends Model
{
    protected $table = 'kerjasamas';

    protected $casts = [
        'tanggal' => 'date',
    ];

    protected $fillable = [
        'nomor_surat',
        'tanggal',
        'mitra',
        'jenis',
        'tingkat',
        'pic',
        'program_studi',
        'file_path',
    ];
}
