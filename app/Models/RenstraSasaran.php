<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RenstraSasaran extends Model
{
    protected $table = 'renstra_sasaran';

    protected $fillable = [
        'renstra_id',
        'sasaran',
        'urutan',
    ];

    public function renstra()
    {
        return $this->belongsTo(Renstra::class);
    }

    public function strategis()
    {
        return $this->hasMany(RenstraStrategi::class, 'renstra_sasaran_id')->orderBy('urutan');
    }
}
