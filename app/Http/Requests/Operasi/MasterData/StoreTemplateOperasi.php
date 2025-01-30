<?php

namespace App\Http\Requests\Operasi\MasterData;

use Illuminate\Foundation\Http\FormRequest;

class StoreTemplateOperasi extends FormRequest
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
            'macam_operasi' => 'required',
            'laporan_operasi' => 'required',
        ];
    }
}
