<?php

namespace App\Http\Requests\Operasi\PostOperasi;

use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Http\FormRequest;

class StorePostOperasiRequest extends FormRequest
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
            // data umum post operasi
            'diagnosa_prabedah' => 'required',
            'diagnosa_pascabedah' => 'required',
            'jenis_operasi' => 'required',
            'dokter_operator' => 'required',
            'asisten_bedah' => 'required',
            'jam_operasi' => 'required',
            'jenis_anastesi' => 'required',
            'dokter_anastesi' => 'required',
            'asisten_anastesi' => 'required',

            // Tindakan Post Operasi
            'status_pasien' => 'nullable',
            'catatan_anestesi' => 'nullable',
            'laporan_pembedahan' => 'nullable',
            'perencanaan_pasca_medis' => 'nullable',
            'checklist_keselamatan_pasien' => 'nullable',
            'checklist_monitoring' => 'nullable',
            'askep_perioperatif' => 'nullable',
            'lembar_pemantauan' => 'nullable',
            'formulir_pemeriksaan' => 'nullable',
            'sampel_pemeriksaan' => 'nullable',
            'foto_rontgen' => 'nullable',
            'resep' => 'nullable',
            'lainnya' => 'nullable',
            'deskripsi_lainnya' => 'nullable',
            // Alat Post Operasi
            'ngt' => 'nullable',
            'drain' => 'nullable',
            'tampon_hidung' => 'nullable',
            'tampon_gigi' => 'nullable',
            'tampon_abdomen' => 'nullable',
            'tampon_vagina' => 'nullable',
            'tranfusi' => 'nullable',
            'ivfd' => 'nullable',
            'deskripsi_ivfd' => 'nullable',
            'kompres_luka' => 'nullable',
            'dc' => 'nullable',
            'lainnya' => 'nullable',
            'deskripsi_lainnya' => 'nullable',
            // TTV
            'keadaan_umum' => 'string',
            'kesadaran' => 'string',
            'tekanan_darah' => 'string',
            'nadi' => 'string',
            'suhu' => 'string',
            'pernafasan' => 'string',
            'instruksi_dokter' => 'string',
        ];
    }
}
