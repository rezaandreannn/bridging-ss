<?php

namespace App\Http\Requests\Operasi\PenandaanPasien;

use Illuminate\Foundation\Http\FormRequest;

class StorePenandaanPasienRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'kode_register' => 'required',
            'signatureData' => 'required|string',
            'asal_ruangan' => 'required',
            'jenis_operasi' => 'required'
        ];
    }
}
