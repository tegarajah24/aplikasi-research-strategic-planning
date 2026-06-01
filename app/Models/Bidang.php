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

    public function programs()
    {
        return $this->hasMany(Program::class);
    }
}
