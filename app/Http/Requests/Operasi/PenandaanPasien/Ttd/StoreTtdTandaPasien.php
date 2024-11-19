<?php

namespace App\Http\Requests\Operasi\PenandaanPasien\Ttd;

use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Http\FormRequest;

class StoreTtdTandaPasien extends FormRequest
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
            //
            'kode_register' => 'required',
        ];
    }
    
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $kodeRegister = $this->input('kode_register');

            $exists = DB::connection('pku')
                ->table('ok_tanda_tangan_pasien')
                ->where('kode_register', $kodeRegister)
                ->exists();

            if ($exists) {
                $validator->errors()->add('kode_register', 'Kode register sudah ada.');
            }
        });
    }

}
