<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Renstra extends Model
{
    protected $table = 'renstra';

    protected $fillable = [
        'kode',
        'sasaran',
        'strategi',
        'program_tahunan',
        'periode',
    ];
}
