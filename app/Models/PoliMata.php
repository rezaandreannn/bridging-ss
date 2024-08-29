<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PoliMata extends Model
{
    public function getDokterMata()
    {
        // $data = DB::connection('db_rsmm')
        //     ->table('DOKTER as d')
        //     ->select(
        //         'd.Kode_Dokter',
        //         'd.Nama_Dokter'
        //     )
        //     ->whereIn('d.Spesialis', array('SPESIALIS MATA'))
        //     ->get();

        // return $data;
        $data = DB::connection('db_rsmm')
            ->table('DOKTER as d')
            ->select(
                'd.Kode_Dokter',
                'd.Nama_Dokter'
            )
            ->whereIn('d.Kode_Dokter', array('148', '156'))
            ->get();

        return $data;
    }

    public function cekAsesmenDokter($noReg)
    {
        $data = DB::connection('pku')
            ->table('poli_mata_asesmen_dokter')
            ->select(
                'NO_REG'
            )
            ->where('NO_REG', $noReg)
            ->first();

        if ($data != null) {
            return true;
        } else {
            return false;
        }
    }

    public function cekDokter($noReg)
    {
        $data = DB::connection('pku')
            ->table('poli_mata_dokter')
            ->select(
                'NO_REG'
            )
            ->where('NO_REG', $noReg)
            ->first();

        if ($data != null) {
            return true;
        } else {
            return false;
        }
    }

    public function cekRefraksi($noReg)
    {
        $data = DB::connection('pku')
            ->table('poli_mata_refraksi')
            ->select(
                'NO_REG'
            )
            ->where('NO_REG', $noReg)
            ->first();

        if ($data != null) {
            return true;
        } else {
            return false;
        }
    }

    // public function asasmenPerawatGet($noReg)
    // {
    //     $dbpku = DB::connection('db_rsmm')->getDatabaseName();
    //     $data = DB::connection('pku')->table('TAC_ASES_PER2')
    //         ->join('TAC_RJ_VITAL_SIGN', 'TAC_ASES_PER2.FS_KD_REG', '=', 'TAC_RJ_VITAL_SIGN.FS_KD_REG')
    //         ->join('TAC_RJ_JATUH', 'TAC_ASES_PER2.FS_KD_REG', '=', 'TAC_RJ_JATUH.FS_KD_REG')
    //         ->join('poli_mata_asesmen', 'TAC_ASES_PER2.FS_KD_REG', '=', 'poli_mata_asesmen.FS_KD_REG')
    //         ->leftJoin($dbpku . '.dbo.REGISTER_PASIEN', 'TAC_ASES_PER2.FS_KD_REG', '=', 'REGISTER_PASIEN.No_MR')
    //         ->where('TAC_ASES_PER2.FS_KD_REG', $noReg)
    //         ->first();

    //     return $data;
    // }

    public function asasmenPerawatGet($noReg)
    {
        $dbpku = DB::connection('db_rsmm')->getDatabaseName();
        $data = DB::connection('pku')->table('TAC_ASES_PER2')
            ->join('TAC_RJ_VITAL_SIGN', 'TAC_ASES_PER2.FS_KD_REG', '=', 'TAC_RJ_VITAL_SIGN.FS_KD_REG')
            ->join('TAC_RJ_JATUH', 'TAC_ASES_PER2.FS_KD_REG', '=', 'TAC_RJ_JATUH.FS_KD_REG')
            ->join('poli_mata_asesmen', 'TAC_ASES_PER2.FS_KD_REG', '=', 'poli_mata_asesmen.NO_REG')
            ->leftJoin($dbpku . '.dbo.REGISTER_PASIEN', 'TAC_ASES_PER2.FS_KD_REG', '=', 'REGISTER_PASIEN.No_MR')
            ->where('TAC_ASES_PER2.FS_KD_REG', $noReg)
            ->first();
        return $data;
    }

    public function getDataRefraksi()
    {
        $data = DB::connection('pku')
            ->table('poli_mata_refraksi')
            ->get();

        return $data;
    }

    public function getRefraksi($noReg)
    {
        $data = DB::connection('pku')
            ->table('poli_mata_refraksi')
            ->where('poli_mata_refraksi.NO_REG', $noReg)
            ->first();

        return $data;
    }

    // ASLI
    // public function asasmenDokterGet($noReg)
    // {
    //     $dbpku = DB::connection('db_rsmm')->getDatabaseName();
    //     $data = DB::connection('pku')->table('TAC_ASES_PER2')
    //         ->join('TAC_RJ_VITAL_SIGN', 'TAC_ASES_PER2.FS_KD_REG', '=', 'TAC_RJ_VITAL_SIGN.FS_KD_REG')
    //         ->join('TAC_RJ_JATUH', 'TAC_ASES_PER2.FS_KD_REG', '=', 'TAC_RJ_JATUH.FS_KD_REG')
    //         ->join('poli_mata_asesmen', 'TAC_ASES_PER2.FS_KD_REG', '=', 'poli_mata_asesmen.NO_REG')
    //         ->join('poli_mata_asesmen_dokter', 'TAC_ASES_PER2.FS_KD_REG', '=', 'poli_mata_asesmen_dokter.NO_REG')
    //         ->leftJoin($dbpku . '.dbo.REGISTER_PASIEN', 'TAC_ASES_PER2.FS_KD_REG', '=', 'REGISTER_PASIEN.No_MR')
    //         ->where('TAC_ASES_PER2.FS_KD_REG', $noReg)
    //         ->first();

    //     return $data;
    // }


    // TESTING
    public function asasmenDokter($noReg)
    {
        $dbpku = DB::connection('db_rsmm')->getDatabaseName();
        $data = DB::connection('pku')->table('poli_mata_dokter')
            ->join('poli_mata_refraksi', 'poli_mata_dokter.NO_REG', '=', 'poli_mata_dokter.NO_REG')
            ->join('TAC_RJ_MEDIS', 'poli_mata_dokter.NO_REG', '=', 'TAC_RJ_MEDIS.FS_KD_REG')
            ->leftJoin($dbpku . '.dbo.DOKTER as c', 'poli_mata_dokter.CREATE_BY', '=', 'c.KODE_DOKTER')
            ->select(
                'poli_mata_dokter.*',
                'poli_mata_refraksi.*',
                'TAC_RJ_MEDIS.FS_TERAPI',
                'TAC_RJ_MEDIS.FS_CARA_PULANG',
                'c.NAMA_DOKTER',
                'c.KODE_DOKTER',
            )
            ->where('poli_mata_dokter.NO_REG', $noReg)
            ->first();

        return $data;
    }

    public function resep($noReg)
    {
        $data = DB::connection('pku')
            ->table('TAC_RJ_MEDIS as a')
            ->where('a.FS_KD_REG', $noReg)
            ->get();
        return $data;
    }

    public function cetakResep($noReg, $kode_transaksi)
    {
        $dbRsmm = DB::connection('db_rsmm')->getDatabaseName();
        $data = DB::connection('pku')
            ->table('TAC_RJ_MEDIS as a')
            ->leftJoin('TAC_RJ_VITAL_SIGN', 'a.FS_KD_REG', '=', 'TAC_RJ_VITAL_SIGN.FS_KD_REG')
            ->leftJoin('TAC_RJ_JATUH', 'a.FS_KD_REG', '=', 'TAC_RJ_JATUH.FS_KD_REG')
            ->leftJoin('TAC_ASES_PER2', 'TAC_ASES_PER2.FS_KD_REG', '=', 'a.FS_KD_REG')
            ->leftJoin('TAC_COM_USER as b', 'a.mdb', '=', 'b.user_id')
            ->leftJoin('poli_mata_asesmen', 'a.FS_KD_REG', '=', 'poli_mata_asesmen.NO_REG')
            ->leftJoin('poli_mata_dokter', 'a.FS_KD_REG', '=', 'poli_mata_dokter.NO_REG')
            ->leftJoin($dbRsmm . '.dbo.DOKTER as c', 'poli_mata_dokter.CREATE_BY', '=', 'c.KODE_DOKTER')
            ->leftJoin($dbRsmm . '.dbo.TUSER as d', 'b.user_name', '=', 'd.NAMAUSER')
            ->select(
                'a.FS_TERAPI',
                'b.user_name',
                'c.NAMA_DOKTER',
                'c.KODE_DOKTER',
                'd.NAMALENGKAP',
                'TAC_ASES_PER2.*',
                'TAC_RJ_VITAL_SIGN.*',
                'TAC_RJ_JATUH.*',
                'poli_mata_asesmen.*',
                'poli_mata_dokter.*',
            )
            ->where('a.FS_KD_REG', $noReg)
            ->where('a.FS_KD_TRS', $kode_transaksi)
            ->first();
        return $data;
    }
}
