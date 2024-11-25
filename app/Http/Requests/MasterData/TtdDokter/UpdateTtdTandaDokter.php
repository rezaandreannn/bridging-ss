<?php

namespace App\Http\Requests\MasterData\TtdDokter;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTtdTandaDokter extends FormRequest
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
        $rules =  [
            'kode_dokter' => 'required|string',
            'ttd_dokter' => 'required',
            'updated_at' => 'nullable'
        ];

            // Jika permintaan adalah untuk update (menggunakan metode PUT)
            if ($this->isMethod('put')) {
                // Mengambil kode dokter dan id dari route
                $kode_dokter = $this->input('kode_dokter');
                $id = $this->route('id'); // Mengambil id dari parameter route
    
                // Menambahkan aturan agar kode_dokter harus unik, kecuali untuk record yang sedang diperbarui
                $rules['kode_dokter'] = [
                    'required',
                    'string',
                    Rule::unique('ttd_dokter')->ignore($id) // Mengabaikan pengecekan untuk id yang sedang diupdate
                ];
            }

            return $rules;
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
