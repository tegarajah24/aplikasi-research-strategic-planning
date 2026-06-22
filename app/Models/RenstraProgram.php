<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RenstraProgram extends Model
{
    protected $table = 'renstra_program';

    protected $fillable = [
        'renstra_strategi_id',
        'program_tahunan',
        'urutan',
    ];

    public function renstraStrategi()
    {
        return $this->belongsTo(RenstraStrategi::class);
    }
}
