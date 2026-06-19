<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProgramRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'renstra_id'       => 'required|exists:renstra,id',
            'bidang_id'        => 'required|exists:bidangs,id',
            'kode_program'     => 'required|string|max:20',
            'nama_program'     => 'required|string|max:255',
            'deskripsi'        => 'nullable|string',
            'status'           => 'required|in:Aktif,Tidak Aktif',
        ];
    }
}
