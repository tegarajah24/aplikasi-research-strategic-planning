<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Renstra extends Model
{
    protected $table = 'renstra';

    protected $fillable = [
        'bidang_id',
        'fakultas_id',
        'kode',
        'tahun_mulai',
        'tahun_selesai',
        'status',
    ];

    public function bidang()
    {
        return $this->belongsTo(Bidang::class);
    }

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class);
    }

    public function sasarans()
    {
        return $this->hasMany(RenstraSasaran::class)->orderBy('urutan');
    }

    public function programs()
    {
        return $this->hasMany(Program::class);
    }
}