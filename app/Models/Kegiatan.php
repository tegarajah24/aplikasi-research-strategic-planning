<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    protected $table = 'rkt_kegiatan';

    const STATUS_PERENCANAAN = 'perencanaan';
    const STATUS_BERJALAN = 'berjalan';
    const STATUS_SELESAI = 'selesai';
    const STATUS_TERTUNDA = 'tertunda';

    const STATUSES = [
        self::STATUS_PERENCANAAN => 'Perencanaan',
        self::STATUS_BERJALAN => 'Berjalan',
        self::STATUS_SELESAI => 'Selesai',
        self::STATUS_TERTUNDA => 'Tertunda',
    ];

    const STATUS_COLORS = [
        self::STATUS_PERENCANAAN => 'blue',
        self::STATUS_BERJALAN => 'amber',
        self::STATUS_SELESAI => 'emerald',
        self::STATUS_TERTUNDA => 'rose',
    ];

    const STATUS_CSS = [
        self::STATUS_PERENCANAAN => 'upcoming',
        self::STATUS_BERJALAN => 'running',
        self::STATUS_SELESAI => 'done',
        self::STATUS_TERTUNDA => 'late',
    ];

    protected $casts = [
        'kebutuhan_anggaran' => 'decimal:2',
        'tgl_mulai_pelaksanaan' => 'date',
        'tgl_selesai_pelaksanaan' => 'date',
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
        return self::STATUSES[$this->status] ?? 'Tidak Diketahui';
    }

    public function getStatusColorAttribute(): string
    {
        return self::STATUS_COLORS[$this->status] ?? 'slate';
    }
}
