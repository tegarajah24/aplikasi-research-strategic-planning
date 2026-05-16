<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penelitian extends Model
{
    protected $table = 'penelitian';

    protected $fillable = [
        'judul',
        'ketua',
        'tahun',
        'status',
    ];
}
