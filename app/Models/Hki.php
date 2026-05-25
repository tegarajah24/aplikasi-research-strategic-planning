<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hki extends Model
{
    protected $table = 'hkis';

    protected $fillable = [
        'judul',
        'pencipta',
        'jenis_hki',
        'nomor_pendaftaran',
        'tahun',
        'file_path',
    ];
}
