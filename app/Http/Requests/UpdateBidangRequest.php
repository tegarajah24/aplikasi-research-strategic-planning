<?php

namespace App\Http\Requests;

use App\Models\Bidang;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBidangRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'kode_bidang' => 'required|string|max:20|unique:bidangs,kode_bidang,' . $this->route('bidang')->id,
            'nama_bidang' => 'required|string|max:255',
            'deskripsi'   => 'nullable|string',
            'status'      => 'required|in:' . implode(',', array_keys(Bidang::STATUSES)),
        ];
    }
}
