<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RajalDokter extends Model
{
    public function getPasienByDokter($kode_dokter)
    {
        $dbpku = DB::connection('pku')->getDatabaseName();
        $date = now();

        $data = DB::connection('db_rsmm')
            ->table('ANTRIAN as a')
            ->leftJoin('REGISTER_PASIEN as rp', 'a.No_MR', '=', 'rp.No_MR')
            ->leftJoin('PENDAFTARAN as c', 'a.No_MR', '=', 'c.No_MR')
            ->leftJoin($dbpku . '.dbo.TAC_RJ_STATUS as s', 'c.NO_REG', '=', 's.FS_KD_REG')
            ->leftJoin($dbpku . '.dbo.TAC_RJ_MEDIS as m', 'c.NO_REG', '=', 'm.FS_KD_REG')
            ->leftJoin('DOKTER as d', 'm.mdb', '=', 'd.KODE_DOKTER')
            ->select(
                'a.NOMOR',
                'a.NO_MR',
                'rp.NAMA_PASIEN',
                'rp.ALAMAT',
                'rp.NO_MR',
                'rp.KOTA',
                'rp.PROVINSI',
                'c.NO_REG',
                's.FS_STATUS',
                'm.mdb',
                'm.FS_TERAPI',
                'm.FS_KD_TRS',
                'd.NAMA_DOKTER'
            )
            ->whereDate('a.TANGGAL', $date)
            ->whereDate('c.TANGGAL', $date)
            ->where('c.Kode_Dokter', $kode_dokter)
            ->orderBy('a.NOMOR', 'ASC')
            ->get()
            ->toArray();

        return $data;
    }

    public function getHistoryPasien($noMR)
    {
        $dbpku = DB::connection('pku')->getDatabaseName();
        $data = DB::connection('db_rsmm')
            ->table('PENDAFTARAN as a')
            ->leftJoin('REGISTER_PASIEN as rp', 'a.NO_MR', '=', 'rp.NO_MR')
            ->leftJoin('DOKTER as d', 'a.KODE_DOKTER', '=', 'd.KODE_DOKTER')
            ->leftJoin('M_SPESIALIS as c', 'd.SPESIALIS', '=', 'c.SPESIALIS')
            ->leftJoin($dbpku . '.dbo.TAC_RJ_MEDIS as m', 'a.NO_REG', '=', 'm.FS_KD_REG')
            ->select(
                'a.TANGGAL',
                'a.KODE_RUANG',
                'a.STATUS',
                'a.NO_REG',
                'rp.NAMA_PASIEN',
                'rp.ALAMAT',
                'rp.TGL_LAHIR',
                'rp.KOTA',
                'rp.PROVINSI',
                'rp.JENIS_KELAMIN',
                'd.NAMA_DOKTER',
                'c.SPESIALIS',
                'm.FS_KD_MEDIS',
                'm.FS_KD_TRS',
                'm.HASIL_ECHO',
            )
            ->where('a.NO_MR', $noMR)
            ->orderBy('a.TANGGAL', 'DESC')
            ->take(15)
            ->get();

        return $data;
    }

    public function getDataLab($noReg)
    {
        $data = DB::connection('db_rsmm')
            ->table('TR_MASTER_LAB as a')
            ->select(
                'a.*',
            )
            ->where('a.No_Reg', $noReg)
            ->get();

        return $data;
    }

    public function getDataResep($noReg)
    {
        $data = DB::connection('db_rsmm')
            ->table('TR_MASTER_RESEP as a')
            ->select(
                'a.*',
            )
            ->where('a.No_Reg', $noReg)
            ->get();

        return $data;
    }
}
