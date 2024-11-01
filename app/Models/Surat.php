<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Surat extends Model
{
    public function cekSurat($noReg)
    {
        $data = DB::connection('pku')
            ->table('SURAT_SAKIT')
            ->select(
                'FS_KD_REG'
            )
            ->where('FS_KD_REG', $noReg)
            ->first();

        if ($data != null) {
            return true;
        } else {
            return false;
        }
    }
    public function cekSkd($noReg)
    {
        $data = DB::connection('pku')
            ->table('SURAT_KET_DOKTER')
            ->select(
                'FS_KD_REG'
            )
            ->where('FS_KD_REG', $noReg)
            ->first();

        if ($data != null) {
            return true;
        } else {
            return false;
        }
    }

    public function getSurat($noReg)
    {
        $dbpku = DB::connection('db_rsmm')->getDatabaseName();
        $data = DB::connection('pku')->table('SURAT_SAKIT')
            ->leftJoin($dbpku . '.dbo.DOKTER as c', 'SURAT_SAKIT.mdb', '=', 'c.KODE_DOKTER')
            ->select(
                'SURAT_SAKIT.*',
                'c.NAMA_DOKTER',
                'c.KODE_DOKTER',
            )
            ->where('SURAT_SAKIT.FS_KD_REG', $noReg)
            ->first();
        return $data;
    }

    public function getSkd($noReg)
    {
        $dbpku = DB::connection('db_rsmm')->getDatabaseName();
        $data = DB::connection('pku')->table('SURAT_KET_DOKTER')
            ->leftJoin($dbpku . '.dbo.DOKTER as c', 'SURAT_KET_DOKTER.mdb', '=', 'c.KODE_DOKTER')
            ->select(
                'SURAT_KET_DOKTER.*',
                'c.NAMA_DOKTER',
                'c.KODE_DOKTER',
            )
            ->where('SURAT_KET_DOKTER.FS_KD_REG', $noReg)
            ->first();
        return $data;
    }

    public function get_max_nomor_skd()
    {
        $data = DB::connection('pku')->table('SURAT_KET_DOKTER')
            ->select(DB::raw('MAX(NO_SURAT) as nomax'))
            ->first();
        return $data;
    }
}
