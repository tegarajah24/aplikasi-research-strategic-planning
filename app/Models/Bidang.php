<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bidang extends Model
{
    const STATUS_AKTIF = 'Aktif';
    const STATUS_TIDAK_AKTIF = 'Tidak Aktif';

    const STATUSES = [
        self::STATUS_AKTIF => 'Aktif',
        self::STATUS_TIDAK_AKTIF => 'Tidak Aktif',
    ];

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

}
