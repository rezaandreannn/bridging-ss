<?php

namespace App\Http\Requests\Operasi\LaporanOperasi;

use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Http\FormRequest;

class UpdateLaporanOperasi extends FormRequest
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
            'jaringan_dieksekusi' => 'required',
            'mulai_operasi' => 'nullable',
            'selesai_operasi' => 'nullable',
            'lama_operasi' => 'nullable',
            'permintaan_pa' => 'nullable',
            'pendarahan' => 'nullable',
            'macam_operasi' => 'required',
            'laporan_operasi' => 'required',
            'nama_operator' => 'nullable',
            'nama_asisten' => 'nullable',
            'nama_perawat' => 'nullable',
            'nama_ahli_anastesi' => 'nullable',
            'nama_anastesi' => 'nullable',
            'jenis_anastesi' => 'required',
            // 'cara_masuk' => 'nullable|string'
        ];
    }
}
