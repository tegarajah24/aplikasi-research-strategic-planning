<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Renop extends Model
{
    protected $table = 'renop';

    protected $fillable = [
        'program_kerja',
        'fakultas',
        'tahun',
        'progress',
        'status',
    ];
}
