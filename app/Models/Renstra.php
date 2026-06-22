<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Renstra extends Model
{
    protected $table = 'renstra';

    const STATUS_BELUM_TERCAPAI = 'belum_tercapai';
    const STATUS_DALAM_PROSES = 'dalam_proses';
    const STATUS_TERCAPAI = 'tercapai';

    const STATUSES = [
        self::STATUS_BELUM_TERCAPAI => 'Belum Tercapai',
        self::STATUS_DALAM_PROSES => 'Dalam Proses',
        self::STATUS_TERCAPAI => 'Tercapai',
    ];

    protected $casts = [
        'tahun_mulai' => 'integer',
        'tahun_selesai' => 'integer',
    ];

    protected $fillable = [
        'fakultas_id',
        'kode',
        'tahun_mulai',
        'tahun_selesai',
        'status',
    ];

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class);
    }

    public function sasarans()
    {
        return $this->hasMany(RenstraSasaran::class)->orderBy('urutan');
    }
}
