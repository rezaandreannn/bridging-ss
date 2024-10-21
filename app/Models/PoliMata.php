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
            ->leftJoin('TAC_COM_USER', 'TAC_RJ_VITAL_SIGN.mdb', '=', 'TAC_COM_USER.user_id')
            ->join('poli_mata_asesmen', 'TAC_ASES_PER2.FS_KD_REG', '=', 'poli_mata_asesmen.NO_REG')
            ->leftJoin($dbpku . '.dbo.REGISTER_PASIEN', 'TAC_ASES_PER2.FS_KD_REG', '=', 'REGISTER_PASIEN.No_MR')
            ->leftJoin($dbpku . '.dbo.TUSER', 'TAC_COM_USER.user_name', '=', 'TUSER.NAMAUSER')
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

    // TESTING
    public function asasmenDokter($noReg)
    {
        $dbpku = DB::connection('db_rsmm')->getDatabaseName();
        $data = DB::connection('pku')->table('poli_mata_dokter as pd')
            ->leftjoin('poli_mata_refraksi as pr', 'pd.NO_REG', '=', 'pr.NO_REG')
            ->leftjoin('TAC_RJ_MEDIS as tm', 'pd.NO_REG', '=', 'tm.FS_KD_REG')
            ->leftjoin('poli_mata_gambar as pg', 'pd.NO_REG', '=', 'pg.NO_REG')
            ->leftJoin($dbpku . '.dbo.DOKTER as c', 'pd.CREATE_BY', '=', 'c.KODE_DOKTER')
            ->select(
                'pd.*',
                'pg.GAMBAR',
                'pg.TIPE',
                'pg.DESKRIPSI',
                'pr.VISUS_OD',
                'pr.VISUS_OS',
                'pr.ADD_OD',
                'pr.ADD_OS',
                'pr.NCT_TOD',
                'pr.NCT_TOS',
                'pr.CREATE_REFRAKSI',
                'pr.UPDATE_REFRAKSI',
                'tm.FS_TERAPI',
                'tm.FS_CARA_PULANG',
                'c.NAMA_DOKTER',
                'c.KODE_DOKTER',
            )
            ->where('pd.NO_REG', $noReg)
            ->first();

        return $data;
    }

    public function getGambarMataKiri($noReg)
    {
        $data = DB::connection('pku')->table('poli_mata_gambar')
            ->select(
                'poli_mata_gambar.*',
            )
            ->where('NO_REG', $noReg)
            ->where('TIPE', 'Mata Kiri')
            ->first();

        return $data;
    }

    public function getMataKiri($noReg)
    {
        $data = DB::connection('pku')->table('poli_mata_gambar')
            ->select(
                'poli_mata_gambar.*',
            )
            ->where('NO_REG', $noReg)
            ->where('TIPE', 'Mata Kiri')
            ->first();

        return $data;
    }

    public function getGambarMataKanan($noReg)
    {
        $data = DB::connection('pku')->table('poli_mata_gambar')
            ->select(
                'poli_mata_gambar.*',
            )
            ->where('NO_REG', $noReg)
            ->where('TIPE', 'Mata Kanan')
            ->first();

        return $data;
    }

    public function getMataKanan($noReg)
    {
        $data = DB::connection('pku')->table('poli_mata_gambar')
            ->select(
                'poli_mata_gambar.*',
            )
            ->where('NO_REG', $noReg)
            ->where('TIPE', 'Mata Kanan')
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

    public function getDataResep($noReg)
    {
        $data = DB::connection('pku')
            ->table('TAC_RJ_MEDIS as a')
            ->select(
                'a.FS_KD_REG',
            )
            ->where('a.FS_KD_REG', $noReg)
            ->first();

        if ($data != null) {
            return true;
        } else {
            return false;
        }
    }

    // Master Data Penyakit Sekarang Poli Mata
    public function getPenyakitSekarang()
    {
        $dbRsmm = DB::connection('sqlsrv')->getDatabaseName();
        $data = DB::connection('pku')
            ->table('poli_mata_master_data_penyakitsekarang as a')
            ->leftJoin($dbRsmm . '.dbo.users as b', 'a.created_by', '=', 'b.id')
            ->select(
                'a.*',
                'b.name'
            )
            ->get();

        return $data;
    }

    public function getPenyakit()
    {
        $data = DB::connection('pku')->table('poli_mata_master_data_penyakitsekarang')->get();
        return $data;
    }
}
