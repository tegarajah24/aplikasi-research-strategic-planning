<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    protected $table = 'artikels';

    protected $fillable = [
        'judul',
        'penulis',
        'tahun',
        'penerbit',
        'doi',
        'file_path',
    ];
}
