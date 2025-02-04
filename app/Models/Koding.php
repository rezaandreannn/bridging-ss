<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Koding extends Model
{
    use HasFactory;

    public function getAsesmenDokter($noReg)
    {   

        $data = DB::connection('pku')
        ->table('TAC_RJ_MEDIS as trm')
        ->join('poli_mata_dokter as pm', 'pm.NO_REG', '=', 'trm.FS_KD_REG','left')
        ->select(
            'trm.FS_KD_REG',
            'trm.FS_DIAGNOSA',
            'trm.FS_KD_MEDIS',
            'trm.mdd',
            'trm.FS_JAM_TRS',
            'pm.DIAGNOSA as DIAGNOSA_MATA'
            )
        ->where('FS_KD_REG', $noReg)
        ->first();
    return $data;

    }

    public function getDataCondition($noReg)
    {   

        $data = DB::connection('bridging_ss')
        ->table('satusehat_condition')
        ->where('kode_register', $noReg)
        ->first();
    return $data;

    }
}
