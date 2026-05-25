<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrestasiAkademik extends Model
{
    protected $table = 'prestasi_akademiks';

    protected $fillable = [
        'tahun',
        'regional',
        'nasional',
        'internasional',
    ];
}
