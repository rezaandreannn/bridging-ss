<?php

namespace App\Http\Requests\Operasi\ChecklistPembedahan\SignIn;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePembedahanSignRequest extends FormRequest
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
            'identitas_pasien' => 'nullable',
            'lokasi_operasi_pasien' => 'nullable',
            'mesin_anestesi_lengkap' => 'nullable',
            'alergi_pasien' => 'nullable',
            'riwayat_asma_pasien' => 'nullable',
            'pemasangan_implant' => 'nullable',
            'kehilangan_darah' => 'nullable',
        ];
    }
}
