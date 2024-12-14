<?php

namespace App\Http\Requests\Operasi\PreOperasi;

use Illuminate\Foundation\Http\FormRequest;

class StorePreOperasiRequest extends FormRequest
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
            // Tindakan Pre Operasi
            'lapor_dokter' => 'nullable',
            'lapor_kamar' => 'nullable',
            'surat_izin_pembedahan' => 'nullable',
            'tandai_daerah_operasi' => 'nullable',
            'memakai_gelang_identitas' => 'nullable',
            'melepas_aksesoris' => 'nullable',
            'menghapus_aksesoris' => 'nullable',
            'melakukan_oral_hygiene' => 'nullable',
            'memasang_bidai' => 'nullable',
            'memasang_infuse' => 'nullable',
            'memasang_dc' => 'nullable',
            'deskripsi_dc' => 'nullable',
            'memasang_ngt' => 'nullable',
            'deskripsi_ngt' => 'nullable',
            'memasang_drainage' => 'nullable',
            'memasang_wsd' => 'nullable',
            'mencukur_daerah_operasi' => 'nullable',
            'lainnya' => 'nullable',
            'deskripsi_lainnya' => 'nullable',
            'penyakit_dm' => 'nullable',
            'penyakit_hipertensi' => 'nullable',
            'penyakit_tb_paru' => 'nullable',
            'penyakit_hiv' => 'nullable',
            'penyakit_hepatitis' => 'nullable',
            // Ttv Pre Operasi
            'tinggi_badan' => 'string|nullable',
            'berat_badan' => 'string|nullable',
            'tekanan_darah' => 'string',
            'nadi' => 'string',
            'suhu' => 'string',
            'pernafasan' => 'string',
        ];
    }
}
