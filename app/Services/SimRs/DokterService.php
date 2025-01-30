<?php

namespace App\Services\SimRs;

use App\Models\Simrs\Dokter;

class DokterService
{
    public function byBedahOperasi()
    {
        $params =  [
            'SPESIALIS BEDAH',
            'SPESIALIS KANDUNGAN',
            'SPESIALIS ORTHOPEDI',
            'SPESIALIS BEDAH MULUT',
            'SPESIALIS THT-KL',
            'SPESIALIS UROLOGI',
            'SPESIALIS BEDAH SARAF',
            'SPESIALIS MATA'
        ];
        return Dokter::whereIn('Spesialis', $params)->get();
    }

    public function allDokter()
    {
        $data = Dokter::where('Jenis_Profesi', 'DOKTER SPESIALIS')->get();
        return $data;
    }

    public function byCode($doctorCode)
    {
        return Dokter::where('Kode_Dokter', $doctorCode)->first();
    }
}
