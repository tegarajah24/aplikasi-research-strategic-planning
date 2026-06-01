<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBidangRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'kode_bidang' => 'required|string|max:20|unique:bidangs,kode_bidang',
            'nama_bidang' => 'required|string|max:255',
            'deskripsi'   => 'nullable|string',
            'status'      => 'required|in:Aktif,Tidak Aktif',
        ];
    }
}
