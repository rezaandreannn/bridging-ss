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

        // $table->id();
        // $table->string('kode_register');
        // $table->date('tanggal');
        // $table->string('diagnosa_pre_op');
        // $table->string('diagnosa_post_op');
        // $table->string('jaringan_dieksekusi');
        // $table->time('mulai_operasi');
        // $table->time('selesai_operasi');
        // $table->string('lama_operasi');
        // $table->enum('permintaan_pa', ['Ya', 'Tidak']);
        // $table->text('laporan_operasi');
        // $table->string('created_by')->nullable();
        // $table->string('updated_by')->nullable();
        // $table->timestamps();
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
            'laporan_operasi' => 'required',
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
