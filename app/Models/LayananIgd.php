<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LayananIgd extends Model
{
    use HasFactory;

    public function pasienTriaseIgd($tanggal)
    {   


        $data = DB::connection('db_rsmm')
        ->table('PENDAFTARAN as p')
        ->join('REGISTER_PASIEN as rp', 'p.No_MR', '=', 'rp.No_MR')
        ->select(
            'p.No_Reg',
            'p.No_MR',
            'p.Kode_Ruang',
            'p.Kode_Masuk',
            'p.Kode_Dokter',
            'p.Tanggal',
            'rp.Nama_Pasien',
            'rp.Alamat',
            )
            ->where('p.Kode_Masuk', '1')
            ->where('p.Status', '1')
            ->where('p.Tanggal', $tanggal)
            ->get();
            return $data;
            
        }
        
        public function getTriaseIgd($tanggal)
    {   

        $db_rsmm = DB::connection('db_rsmm')->getDatabaseName();
        $data = DB::connection('pku')
        ->table('TRIASE as t')
        ->leftJoin($db_rsmm.'.dbo.PENDAFTARAN as p', 'p.No_Reg', '=', 't.FS_KD_REG')
        ->leftJoin($db_rsmm.'.dbo.REGISTER_PASIEN as rp', 'rp.No_MR', '=', 'p.No_MR')
        ->leftJoin($db_rsmm.'.dbo.TUSER as tu', 'tu.NAMAUSER', '=', 't.KD_PERAWAT')
        ->select(
            't.*',
            'p.No_Reg',
            'p.No_MR',
            'p.Kode_Ruang',
            'p.Kode_Masuk',
            'p.Kode_Dokter',
            'p.Tanggal',
            // 'rp.Nama_Pasien as namaSudah',
            // 'rp.Alamat as alamatSudah',
            'tu.NAMALENGKAP'
            )
        // ->where('p.Kode_Masuk', '1')
        ->orwhere('p.Tanggal', $tanggal)
        ->orWhereDate('t.mdd', $tanggal)
        // ->where('t.mdd', $tanggal)
        ->get();
    return $data;

    }
}
