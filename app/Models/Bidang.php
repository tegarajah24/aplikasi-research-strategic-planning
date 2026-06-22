<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bidang extends Model
{
    protected $fillable = [
        'kode_bidang',
        'nama_bidang',
        'deskripsi',
        'status',
    ];

    public function renstras()
    {
        return $this->hasMany(Renstra::class);
    }

    public function programs()
    {
        return $this->hasManyThrough(Program::class, Renstra::class);
    }

    public function kegiatans()
    {
        return $this->hasManyThrough(Kegiatan::class, Program::class, 'renstra_id', 'program_id');
    }
}