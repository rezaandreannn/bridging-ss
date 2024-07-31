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
        ->table('TAC_RJ_MEDIS')
        ->select(
            'FS_KD_REG',
            'FS_DIAGNOSA',
            'FS_KD_MEDIS',
            'mdd',
            'FS_JAM_TRS'
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
