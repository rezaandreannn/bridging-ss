<?php

namespace App\Http\Requests\Operasi\PascaBedah;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePascaBedahRequest extends FormRequest
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
            'kode_register' => 'required|string',
            'tingkat_perawatan' => 'nullable',
            'monitoring_ttv_start' => 'nullable',
            'monitoring_ttv_end' => 'nullable',
            'konsultasi_pelayanan' => 'nullable',
            'terapi' => 'required',
        ];
    }
}
