<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $fillable = [
        'renstra_id',
        'kode_program',
        'nama_program',
        'deskripsi',
        'status',
    ];

    public function renstra()
    {
        return $this->belongsTo(Renstra::class);
    }

    public function bidang()
    {
        return $this->hasOneThrough(Bidang::class, Renstra::class, 'id', 'id', 'renstra_id', 'bidang_id');
    }

    public function kegiatans()
    {
        return $this->hasMany(Kegiatan::class);
    }
}