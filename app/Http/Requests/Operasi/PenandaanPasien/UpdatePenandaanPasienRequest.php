<?php

namespace App\Http\Requests\Operasi\PenandaanPasien;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePenandaanPasienRequest extends FormRequest
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
            'signatureData' => 'required',
            'asal_ruangan' => 'required',
            'jenis_operasi' => 'required',
        ];
    }
}
