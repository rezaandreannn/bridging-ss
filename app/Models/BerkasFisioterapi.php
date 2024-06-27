<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BerkasFisioterapi extends Model
{
    use HasFactory;

    public function getFisioterapiHistory($no_mr)
    {

        $data = DB::connection('db_rsmm')
            ->table('PENDAFTARAN as p')
            ->Join('REGISTER_PASIEN as rp', 'p.No_MR', '=', 'rp.No_MR')
            ->Join('DOKTER as d', 'p.KODE_DOKTER', '=', 'd.KODE_DOKTER')->select(
                'p.No_Reg',
                'd.Nama_Dokter',
                'p.Medis',
                'p.No_MR',
                'p.Tanggal',
                'rp.Nama_Pasien'
            )
            ->where('p.No_MR', $no_mr)
            ->whereIn('p.Kode_Dokter',array('151','028'))
            ->get();
        return $data;
    }
}
