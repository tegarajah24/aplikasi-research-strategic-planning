<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    protected $table = 'rkt_kegiatan';

    protected $casts = [
        'kebutuhan_anggaran' => 'decimal:2',
    ];

    public function program()
    {
        return $this->belongsTo(RenstraProgram::class, 'program_id');
    }

    protected $fillable = [
        'program_id',
        'kode_kegiatan',
        'nama_kegiatan',
        'indikator_kinerja',
        'target_kegiatan',
        'penanggung_jawab',
        'waktu_pelaksanaan',
        'tgl_mulai_pelaksanaan',
        'tgl_selesai_pelaksanaan',
        'tahun_akademik',
        'kebutuhan_anggaran',
        'status',
        'catatan',
        'dokumen',
    ];

    public function getKebutuhanAnggaranFormattedAttribute(): string
    {
        $val = $this->kebutuhan_anggaran / 1_000_000;
        if ($val == intval($val)) {
            return 'Rp ' . number_format($val, 0) . ' Juta';
        }
        return 'Rp ' . number_format($val, 1) . ' Juta';
    }

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
