<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengabmas extends Model
{
    protected $table = 'pengabmas';

    protected $fillable = [
        'nama_kegiatan',
        'ketua',
        'lokasi',
        'tahun',
        'status',
    ];
}
