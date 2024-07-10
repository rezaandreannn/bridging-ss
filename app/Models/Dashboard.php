<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dashboard extends Model
{
    use HasFactory;

    // rajal 
    public function countPasienRajal(){

        $date = date('Y-m-d');
        $data = DB::connection('db_rsmm')
            ->table('PENDAFTARAN')
            ->where('Tanggal',$date)
            ->where('Medis','RAWAT JALAN')
            ->count();
        return $data;
    }

    // ranap 
    public function countPasienRanap(){

        $date = date('Y-m-d');
        $data = DB::connection('db_rsmm')
            ->table('PENDAFTARAN')
            ->where('Tanggal',$date)
            ->where('Medis','RAWAT INAP')
            ->count();
        return $data;

    }

        // fisioterapi 
        public function countPasienFisioterapi(){

            $date = date('Y-m-d');
            $data = DB::connection('db_rsmm')
                ->table('PENDAFTARAN')
                ->where('Tanggal',$date)
                ->where('Kode_Dokter','028')
                ->where('Medis','RAWAT JALAN')
                ->count();
            return $data;
        }

        // SPKFR 
        public function countPasienSPKFR(){

            $date = date('Y-m-d'); 
       
            $data = DB::connection('db_rsmm')
                ->table('PENDAFTARAN')
                ->where('Tanggal',$date)
                ->whereIn('Kode_Dokter',array('151'))
                ->where('Medis','RAWAT JALAN')
                ->count();
              
            return $data;

           
        }

        // public function countPasienByDokter()
        // {

            
        //     $date = date('Y-m-d');
        //     $data = DB::connection('db_rsmm')
        //     ->table('DOKTER as d')
        //     ->join('PENDAFTARAN as p', 'd.Kode_Dokter', '=', 'p.Kode_Dokter')
        //         ->select(
        //             'p.Kode_Dokter',DB::raw('count(*) as total')
        //         )
        //         // ->where('d.Spesialis', 'FISIOTERAPI')
        //         // ->where('d.JENIS_PROFESI', 'DOKTER UMUM')
        //         ->orWhere('d.JENIS_PROFESI', 'DOKTER SPESIALIS')
        //         ->whereNotIn('d.KODE_DOKTER', ['140s', 'TM140','121p'])
        //         ->where('p.Tanggal',$date)
        //         ->();

        //         dd($data);

        //     return $data;
        // }
}
