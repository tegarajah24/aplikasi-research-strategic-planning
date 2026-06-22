<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RenstraProgram extends Model
{
    protected $table = 'renstra_program';

    protected $fillable = [
        'strategi_id',
        'nama_program',
        'tahun_akademik',
        'kode_program',
        'deskripsi',
        'status',
        'urutan',
    ];

    public function renstraStrategi()
    {
        return $this->belongsTo(RenstraStrategi::class, 'strategi_id');
    }

    public function kegiatans()
    {
        return $this->hasMany(Kegiatan::class, 'program_id');
    }
}
