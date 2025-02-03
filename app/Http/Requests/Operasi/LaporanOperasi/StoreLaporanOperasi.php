<?php

namespace App\Http\Requests\Operasi\LaporanOperasi;

use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Http\FormRequest;

class StoreLaporanOperasi extends FormRequest
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
            'tanggal' => 'required',
            'diagnosa_pre_op' => 'required',
            'diagnosa_post_op' => 'required',
            'jaringan_dieksekusi' => 'nullable',
            'mulai_operasi' => 'nullable',
            'selesai_operasi' => 'nullable',
            'lama_operasi' => 'nullable',
            'permintaan_pa' => 'nullable',
            'macam_operasi' => 'nullable',
            'laporan_operasi' => 'required',
            'pendarahan' => 'nullable',
            'nama_operator' => 'nullable',
            'nama_asisten' => 'nullable',
            'nama_perawat' => 'nullable',
            'nama_ahli_anastesi' => 'nullable',
            'nama_anastesi' => 'nullable',
            'jenis_anastesi' => 'nullable',
            // 'cara_masuk' => 'nullable|string'
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $kodeRegister = $this->input('kode_register');

            $exists = DB::connection('pku')
                ->table('ok_laporan_operasi')
                ->where('kode_register', $kodeRegister)
                ->exists();

            if ($exists) {
                $validator->errors()->add('kode_register', 'Kode register sudah ada.');
            }
        });
    }
}
