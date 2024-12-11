<?php

namespace App\Helpers\Ok;

use App\Models\MasterData\TtdPerawat;
use App\Models\Operasi\LaporanOperasi;
use App\Models\Operasi\PenandaanOperasi;

class LaporanOperasiHelper
{
    public static function getStatusLaporanOperasi($laporanOperasis)
    {
        $statusLaporanOperasi = [];

        foreach ($laporanOperasis as $laporanOperasi) {
            $exists = LaporanOperasi::where('kode_register', $laporanOperasi->kode_register)->first();
            $statusLaporanOperasi[$laporanOperasi->id] = $exists ? $exists->id : 'create';
        }

        return $statusLaporanOperasi;
    }

   
}
