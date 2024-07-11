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

    // rajal igd
    public function countPasienIgdRajal(){

        $date = date('Y-m-d');
        $data = DB::connection('db_rsmm')
            ->table('PENDAFTARAN')
            ->where('Tanggal',$date)
            ->where('Kode_Masuk','1')
            ->where('Medis','RAWAT JALAN')
            ->count();
            return $data;
        }
        
        // ranap igd
        public function countPasienIgdRanap(){
            
            $date = date('Y-m-d');
            $data = DB::connection('db_rsmm')
            ->table('PENDAFTARAN')
            ->where('Tanggal',$date)
            ->where('Kode_Masuk','1')
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
                ->table('PENDAFTARAN as P')
                ->leftjoin('DOKTER as d', 'p.Kode_Dokter', '=', 'd.Kode_Dokter')
                ->where('P.Tanggal',$date)
                ->where('d.Spesialis','SPESIALIS REHABILITASI MEDIK')
                ->where('p.Medis','RAWAT JALAN')
                ->count();

                // dd($data);
              
            return $data;
            

           
        }

        public function countPasienByDokter()
        {

            
            $date = date('Y-m-d');
            $data = DB::connection('db_rsmm')
            ->table('PENDAFTARAN as p')
            ->leftjoin('DOKTER as d', 'p.Kode_Dokter', '=', 'd.Kode_Dokter')
                ->select(
                    'd.Nama_Dokter',
                    DB::raw('count(*) as total')
                )
                
                ->where('d.JENIS_PROFESI', 'DOKTER SPESIALIS')
                ->where('p.Tanggal',$date)
                ->where('p.Medis','RAWAT JALAN')
                ->orderBy('total','DESC')
                ->groupBy('d.Nama_Dokter')
                ->get();

                // dd($data);

            return $data;
        }
}
