<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProgramRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'bidang_id'        => 'required|exists:bidangs,id',
            'kode_program'     => 'required|string|max:20',
            'nama_program'     => 'required|string|max:255',
            'deskripsi'        => 'nullable|string',
            'sasaran'          => 'nullable|string',
            'strategi_renstra'  => 'nullable|string',
            'program_tahunan'  => 'nullable|string',
            'anggaran'         => 'nullable|numeric|min:0',
            'status'           => 'required|in:Aktif,Tidak Aktif',
        ];
    }
}
