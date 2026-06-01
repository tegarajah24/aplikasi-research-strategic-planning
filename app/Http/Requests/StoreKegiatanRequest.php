<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKegiatanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'program_id'        => 'required|exists:programs,id',
            'kode_kegiatan'     => 'required|string|max:20',
            'nama_kegiatan'     => 'required|string|max:255',
            'indikator_kinerja' => 'required|string',
            'target_kegiatan'   => 'required|string|max:100',
            'penanggung_jawab'  => 'required|string|max:100',
            'waktu_pelaksanaan' => 'required|string|max:150',
            'tahun_akademik'    => 'nullable|string|max:20',
            'kebutuhan_anggaran'=> 'required|string|max:200',
            'status'            => 'required|in:perencanaan,berjalan,selesai,tertunda',
            'catatan'           => 'nullable|string',
        ];
    }
}
