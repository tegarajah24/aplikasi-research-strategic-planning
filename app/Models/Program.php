<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $fillable = [
        'bidang_id',
        'kode_program',
        'nama_program',
        'deskripsi',
        'sasaran',
        'strategi_renstra',
        'program_tahunan',
        'anggaran',
        'status',
    ];

    public function bidang()
    {
        return $this->belongsTo(Bidang::class);
    }

    public function kegiatans()
    {
        return $this->hasMany(Kegiatan::class);
    }
}
