<?php

namespace App\Http\Requests\Operasi\Prabedah;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Http\FormRequest;

class UpdateVerifikasiPraBedahRequest extends FormRequest
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
            'status_pasien' => 'nullable|boolean',
            'assesmen_pra_bedah' => 'nullable|boolean',
            'penandaan_lokasi' => 'nullable|boolean',
            'informed_consent_bedah' => 'nullable|boolean',
            'informed_consent_anastesi' => 'nullable|boolean',
            'assesmen_pra_anastesi_sedasi' => 'nullable|boolean',
            'edukasi_anastesi' => 'nullable|boolean',
            'laboratorium' => 'nullable|boolean',
            'radiologi' => 'nullable|boolean',
            'deskripsi_darah' => 'nullable|string',
            'deskripsi_obat' => 'nullable|string',
            'deskripsi_ekg' => 'nullable|string',
            'deskripsi_radiologi' => 'nullable|string',
            'lab_hemoglobin' => 'nullable|string',
            'lab_leukosit' => 'nullable|string',
            'lab_trombosit' => 'nullable|string',
            'lab_hematrokit' => 'nullable|string',
            'lab_bt' => 'nullable|string',
            'lab_ct' => 'nullable|string',
            'ekg' => 'nullable|boolean',
            'darah' => 'nullable|boolean',
            'jumlah' => 'nullable|integer',
            'gol' => 'nullable|string',
            'obat' => 'nullable|boolean',
            'estimasi_waktu' => 'nullable|string',
            'rencana_tindakan' => 'nullable|string',
        ];
    }
}
