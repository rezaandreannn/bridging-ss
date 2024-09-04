<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Farmasi extends Model
{
    use HasFactory;

    public function getFisioterapAlkes($tanggal)
    {
        $pku = DB::connection('db_rsmm')->getDatabaseName();

        
        $data = DB::connection('pku')

        ->table('fis_order_alkes as alkes')
        ->Join($pku . '.dbo.PENDAFTARAN as p', 'p.No_Reg', '=', 'alkes.no_registrasi')
        ->Join($pku . '.dbo.REGISTER_PASIEN as rp', 'p.No_MR', '=', 'rp.No_MR')
        ->Join($pku . '.dbo.DOKTER as d', 'd.Kode_Dokter', '=', 'p.Kode_Dokter')
        ->leftJoin('fis_verifikasi_alkes_by_farmasi as farmasi', 'farmasi.no_registrasi', '=', 'alkes.no_registrasi')
        ->select(
            'p.No_Reg',
            'd.Nama_Dokter',
            'd.Spesialis',
            'p.Medis',
            'p.Kode_Dokter',
            'p.No_MR',
            'p.Tanggal',
            'rp.Nama_Pasien',
            'alkes.jenis_alat',
            'alkes.lingkar_pinggang',
            'alkes.biaya',
            'farmasi.no_registrasi as verif_by',
            )
            ->where('p.Tanggal', $tanggal)
            ->orderBy('p.Tanggal', 'desc')
            // ->whereIn('p.Kode_Dokter', function ($query) {
            //     $query->select('d.Kode_Dokter')
            //     ->from('DOKTER as d')
            //     ->whereIn('d.Spesialis', array('SPESIALIS REHABILITASI MEDIK'));
            // })
        
            ->get();
            return $data;
        }

        public function getMasterAlkes(){

            $data=DB::connection('pku')
            ->table('fis_master_data_alkes')
            ->get();
    
            return $data;
        }

        public function getMasterHargaAlkes(){

            $data=DB::connection('pku')
            ->table('fis_harga_alkes as harga')
            ->Join('fis_master_data_alkes as alkes', 'alkes.id', '=', 'harga.id_alkes')
            ->select(
                'harga.*',
                'alkes.nama_alat'
                )
            ->get();
    
            return $data;
        }

        public function getHargaAlkes($id)
        {
            $data = DB::connection('pku')
            ->table('fis_harga_alkes as harga')
            ->Join('fis_master_data_alkes as alkes', 'alkes.id', '=', 'harga.id_alkes')
            ->select(
                'harga.*',
                'alkes.nama_alat'
                )
            ->where('harga.id', $id)->first();
            return $data;
        }
}
