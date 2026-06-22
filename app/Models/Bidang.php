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
        return $this->hasManyThrough(Renstra::class, RenstraSasaran::class, 'bidang_id', 'id', 'id', 'renstra_id')->distinct();
    }

    public function sasarans()
    {
        return $this->hasMany(RenstraSasaran::class);
    }

    public function kegiatans()
    {
        return $this->hasManyThrough(Kegiatan::class, RenstraProgram::class, null, 'program_id', null, 'id');
    }
}
