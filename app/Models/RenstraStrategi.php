<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RenstraStrategi extends Model
{
    protected $table = 'renstra_strategi';

    protected $fillable = [
        'sasaran_id',
        'nama_strategi',
        'urutan',
    ];

    public function renstraSasaran()
    {
        return $this->belongsTo(RenstraSasaran::class, 'sasaran_id');
    }

    public function programs()
    {
        return $this->hasMany(RenstraProgram::class, 'strategi_id')->orderBy('urutan');
    }
}
