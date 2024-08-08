<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Igd extends Model
{
    use HasFactory;

    // RM Triase
    public function getDataTriaseByNoReg($noReg)
    {
        $dbpku = DB::connection('db_rsmm')->getDatabaseName();
        $data = DB::connection('pku')
            ->table('TRIASE as a')
            ->leftJoin($dbpku . '.dbo.PENDAFTARAN as b', 'b.No_Reg', '=', 'a.FS_KD_REG')
            ->leftJoin($dbpku . '.dbo.REGISTER_PASIEN as c', 'b.No_MR', '=', 'c.No_MR')
            ->leftJoin($dbpku . '.dbo.TUSER as d', 'd.NAMAUSER', '=', 'a.KD_PERAWAT')
            ->select(
                'a.*',
                'b.Kode_Dokter',
                'b.No_Reg',
                'b.Kode_Ruang',
                'b.Kode_Masuk',
                'c.Tgl_lahir',
                'c.No_MR',
                'd.NAMALENGKAP'
            )
            ->where('a.FS_KD_REG', $noReg)
            ->first();

        return $data;
    }

    // RM Keperawatan
    public function getDataPerawatByNoReg($noReg)
    {
        $dbpku = DB::connection('db_rsmm')->getDatabaseName();
        $data = DB::connection('pku')
            ->table('IGD_AWAL_PERAWAT as a')
            ->leftJoin($dbpku . '.dbo.PENDAFTARAN as b', 'b.No_Reg', '=', 'a.FS_KD_REG')
            ->leftJoin($dbpku . '.dbo.REGISTER_PASIEN as c', 'b.No_MR', '=', 'c.No_MR')
            ->leftJoin($dbpku . '.dbo.TUSER as d', 'd.NAMAUSER', '=', 'a.MDB')
            ->select(
                'a.*',
                'b.*',
                'c.Tgl_lahir',
                'c.No_MR',
                'd.NAMALENGKAP'
            )
            ->where('a.FS_KD_REG', $noReg)
            ->take(1)
            ->first();

        return $data;
    }

    // RM Medis
    public function getDataMedisByNoReg($noReg)
    {
        $dbpku = DB::connection('db_rsmm')->getDatabaseName();
        $data = DB::connection('pku')
            ->table('IGD_AWAL_MEDIS as a')
            ->leftJoin($dbpku . '.dbo.PENDAFTARAN as b', 'b.No_Reg', '=', 'a.FS_KD_REG')
            ->leftJoin($dbpku . '.dbo.REGISTER_PASIEN as c', 'b.No_MR', '=', 'c.No_MR')
            ->leftJoin($dbpku . '.dbo.TUSER as d', 'd.NAMAUSER', '=', 'a.MDB')
            ->select(
                'a.*',
                'b.*',
                'c.Tgl_lahir',
                'c.No_MR',
                'd.NAMALENGKAP'
            )
            ->where('a.FS_KD_REG', $noReg)
            ->take(1)
            ->first();

        return $data;
    }
}
