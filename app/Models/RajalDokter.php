<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RajalDokter extends Model
{
    public function getPasienByDokter()
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
            ->where('c.Kode_Dokter', '140')
            ->orderBy('a.NOMOR', 'ASC')
            ->get()
            ->toArray();

        return $data;
        return $data;
    }
}
