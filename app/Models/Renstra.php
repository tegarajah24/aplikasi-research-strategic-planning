<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Renstra extends Model
{
    protected $table = 'renstra';

    protected $fillable = [
        'fakultas_id',
        'kode',
        'sasaran',
        'strategi',
        'program_tahunan',
        'tahun_mulai',
        'tahun_selesai',
        'status',
    ];

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class);
    }

    public function programs()
    {
        return $this->hasMany(Program::class);
    }
}
