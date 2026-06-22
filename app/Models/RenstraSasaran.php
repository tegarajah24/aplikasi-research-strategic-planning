<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RenstraSasaran extends Model
{
    protected $table = 'renstra_sasaran';

    protected $fillable = [
        'renstra_id',
        'bidang_id',
        'kode_sasaran',
        'nama_sasaran',
        'urutan',
    ];

    public function renstra()
    {
        return $this->belongsTo(Renstra::class);
    }

    public function bidang()
    {
        return $this->belongsTo(Bidang::class);
    }

    public function strategis()
    {
        return $this->hasMany(RenstraStrategi::class, 'sasaran_id')->orderBy('urutan');
    }
}
