<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $fillable = [
        'renstra_id',
        'bidang_id',
        'kode_program',
        'nama_program',
        'deskripsi',
        'anggaran',
        'status',
    ];

    public function bidang()
    {
        return $this->belongsTo(Bidang::class);
    }

    public function renstra()
    {
        return $this->belongsTo(Renstra::class);
    }

    public function kegiatans()
    {
        return $this->hasMany(Kegiatan::class);
    }
}
