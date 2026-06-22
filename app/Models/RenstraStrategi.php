<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RenstraStrategi extends Model
{
    protected $table = 'renstra_strategi';

    protected $fillable = [
        'renstra_sasaran_id',
        'strategi',
        'urutan',
    ];

    public function renstraSasaran()
    {
        return $this->belongsTo(RenstraSasaran::class);
    }

    public function programs()
    {
        return $this->hasMany(RenstraProgram::class, 'renstra_strategi_id')->orderBy('urutan');
    }
}
