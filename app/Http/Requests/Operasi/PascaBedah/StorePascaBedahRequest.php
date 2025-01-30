<?php

namespace App\Http\Requests\Operasi\PascaBedah;

use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Http\FormRequest;

class StorePascaBedahRequest extends FormRequest
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

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $kodeRegister = $this->input('kode_register');

            $exists = DB::connection('pku')
                ->table('ok_perencanaan_medis_pasca_bedah')
                ->where('kode_register', $kodeRegister)
                ->exists();

            if ($exists) {
                $validator->errors()->add('kode_register', 'Kode register sudah ada.');
            }
        });
    }
}
