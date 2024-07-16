<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RanapDokter extends Model
{
    public function dataMedis($noReg)
    {
        $dbpku = DB::connection('db_rsmm')->getDatabaseName();
        $data = DB::connection('pku')
            ->table('TAC_RI_MEDIS as a')
            ->leftJoin('TAC_COM_USER as b', 'a.mdb', '=', 'b.user_id')
            ->leftJoin($dbpku . '.dbo.DOKTER as c', 'b.user_name', '=', 'c.Kode_Dokter')
            ->select(
                'a.*',
                'b.user_name',
                'c.Kode_Dokter',
                'c.Nama_Dokter',
            )
            ->where('a.FS_KD_REG', $noReg)
            ->whereIn('a.FS_KD_MEDIS', ['216', '217', '215', '213', '202', '219', '220', '221', '312', '222', '223', '224', '225'])
            ->first();
        return $data;
    }

    public function dataPerawat($noReg)
    {
        $data = DB::connection('pku')
            ->table('TAC_RI_ASES_PER2')
            ->select(
                'TAC_RI_ASES_PER2.*'
            )
            ->where('FS_KD_REG', $noReg)
            ->first();
        return $data;
    }

    public function dataRencanaPulang($noReg)
    {
        $data = DB::connection('pku')
            ->table('RENCANA_PULANG')
            ->select(
                'RENCANA_PULANG.*'
            )
            ->where('FS_KD_REG', $noReg)
            ->first();
        return $data;
    }

    public function dataResume($noReg)
    {
        $data = DB::connection('pku')
            ->table('TAB_PX_PULANG_RESUME')
            ->select(
                'TAB_PX_PULANG_RESUME.*'
            )
            ->where('FS_KD_REG', $noReg)
            ->first();
        return $data;
    }

    public function dataBidan($noReg)
    {
        $data = DB::connection('pku')
            ->table('TAC_RI_ASES_AWAL_BIDAN_INAP')
            ->where('FS_KD_REG', $noReg)
            ->first();
        return $data;
    }
}
