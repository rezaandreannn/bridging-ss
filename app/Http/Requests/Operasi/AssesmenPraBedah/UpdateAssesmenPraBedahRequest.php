<?php

namespace App\Http\Requests\Operasi\AssesmenPraBedah;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAssesmenPraBedahRequest extends FormRequest
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
            'anamnesa' => 'required',
            'pemeriksaan_fisik' => 'required',
            'diagnosa' => 'required',
            'planning' => 'required',
            'estimasi_waktu' => 'nullable',
            'rencana_tindakan' => 'nullable',
        ];
    }
}
