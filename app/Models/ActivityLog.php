<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $fillable = [
        'user_id',
        'aktivitas',
        'modul',
        'data_id',
        'deskripsi',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function log($aktivitas, $modul, $dataId = null, $deskripsi = null)
    {
        return static::create([
            'user_id' => auth()->id(),
            'aktivitas' => $aktivitas,
            'modul' => $modul,
            'data_id' => $dataId,
            'deskripsi' => $deskripsi,
        ]);
    }
}