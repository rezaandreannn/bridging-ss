<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PoliMata extends Model
{
    public function getDokterMata()
    {
        $data = DB::connection('db_rsmm')
            ->table('DOKTER as d')
            ->select(
                'd.Kode_Dokter',
                'd.Nama_Dokter'
            )
            ->whereIn('d.Spesialis', array('SPESIALIS MATA'))
            ->get();

        return $data;
    }

    public function asasmenPerawatGet($noReg)
    {
        $dbpku = DB::connection('db_rsmm')->getDatabaseName();
        $data = DB::connection('pku')->table('TAC_ASES_PER2')
            ->join('TAC_RJ_VITAL_SIGN', 'TAC_ASES_PER2.FS_KD_REG', '=', 'TAC_RJ_VITAL_SIGN.FS_KD_REG')
            ->join('TAC_RJ_JATUH', 'TAC_ASES_PER2.FS_KD_REG', '=', 'TAC_RJ_JATUH.FS_KD_REG')
            ->join('poli_mata_asesmen', 'TAC_ASES_PER2.FS_KD_REG', '=', 'poli_mata_asesmen.FS_KD_REG')
            ->leftJoin($dbpku . '.dbo.REGISTER_PASIEN', 'TAC_ASES_PER2.FS_KD_REG', '=', 'REGISTER_PASIEN.No_MR')
            ->where('TAC_ASES_PER2.FS_KD_REG', $noReg)
            ->first();

        return $data;
    }
}
