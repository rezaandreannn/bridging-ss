<?php

namespace App\Http\Requests\MasterData\TtdDokter;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Http\FormRequest;

class StoreTtdDokter extends FormRequest
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


    public function rules()
    {
        return [
            'kode_dokter' => 'required|string',
            'ttd_dokter' => 'required',
            'created_at' => 'nullable',
            'updated_at' => 'nullable'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */


        public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $kode_dokter = $this->input('kode_dokter');

            $exists = DB::connection('pku')
                ->table('ttd_dokter')
                ->where('kode_dokter', $kode_dokter)
                ->exists();

            if ($exists) {
                $validator->errors()->add('kode_dokter', 'Kode dokter sudah memiliki tanda tangan.');
            }
        });
    }
}
