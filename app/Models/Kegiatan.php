<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    protected $table = 'kegiatans';

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    protected $fillable = [
        'program_id',
        'kode_kegiatan',
        'nama_kegiatan',
        'indikator_kinerja',
        'target_kegiatan',
        'penanggung_jawab',
        'waktu_pelaksanaan',
        'waktu_mulai',
        'waktu_selesai',
        'tahun_akademik',
        'kebutuhan_anggaran',
        'status',
        'catatan',
        'dokumen',
    ];

    /**
     * Status label mapping
     */
    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'perencanaan' => 'Perencanaan',
            'berjalan'    => 'Berjalan',
            'selesai'     => 'Selesai',
            'tertunda'    => 'Tertunda',
            default       => 'Tidak Diketahui',
        };
    }

    /**
     * Status color class mapping (Tailwind)
     */
    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'perencanaan' => 'blue',
            'berjalan'    => 'amber',
            'selesai'     => 'emerald',
            'tertunda'    => 'rose',
            default       => 'slate',
        };
    }
}
