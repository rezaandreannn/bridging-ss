<?php

namespace App\Models;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Model;

class Rekam_medis extends Model
{

    protected $httpClient;
    protected $guarded = [];
    protected $simrsUrlApi;

    public function __construct()
    {
        $this->httpClient = new Client([
            'headers' => [
                'Content-Type' => 'application/json'
            ],
        ]);
        $this->simrsUrlApi = env('SIMRS_BASE_URL');
    }

    // Cetak Resep
    public function cetakResep($noReg, $kode_transaksi)
    {
        $dbRsmm = DB::connection('db_rsmm')->getDatabaseName();
        $data = DB::connection('pku')
            ->table('TAC_RJ_MEDIS as a')
            ->leftJoin('TAC_COM_USER as b', 'a.mdb', '=', 'b.user_id')
            // Menggunakan nama basis data secara eksplisit dalam join
            ->leftJoin($dbRsmm . '.dbo.DOKTER as c', 'b.user_name', '=', 'c.KODE_DOKTER')
            ->leftJoin($dbRsmm . '.dbo.TUSER as d', 'b.user_name', '=', 'd.NAMAUSER')
            ->select(
                'a.*',
                'b.user_name',
                'c.NAMA_DOKTER',
                'c.KODE_DOKTER',
                'd.NAMALENGKAP'
            )
            ->where('a.FS_KD_REG', $noReg)
            ->where('a.FS_KD_TRS', $kode_transaksi)
            ->first();
        return $data;
    }

    // public function cetakResep($noReg, $kode_transaksi)
    // {
    //     $request = $this->httpClient->get($this->simrsUrlApi . 'berkas/resep/' . $noReg . '/' .  $kode_transaksi);
    //     $response = $request->getBody()->getContents();
    //     $data = json_decode($response, true);
    //     return $data['data'];
    // }

    // Cetak SKDP
    public function cetakSKDP($noReg)
    {
        $request = $this->httpClient->get($this->simrsUrlApi . 'berkas/skdp/' . $noReg);
        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        return $data['data'];
    }

    // Cetak Radiologi
    public function cetakRAD($noReg)
    {
        $request = $this->httpClient->get($this->simrsUrlApi . 'berkas/radiologi/' . $noReg);
        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        return $data['data'];
    }

    // Cetak Rujukan
    public function cetakRujukan($noReg)
    {
        $request = $this->httpClient->get($this->simrsUrlApi . 'berkas/rujukanRs/' . $noReg);
        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        return $data['data'];
    }



    // Cetak LAB
    public function cetakLAB($noReg)
    {
        $request = $this->httpClient->get($this->simrsUrlApi . 'berkas/laboratorium/' . $noReg);
        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        return $data['data'];
    }

    // Cetak PRB & Faskes
    public function cetakPRB_Faskes($noReg)
    {
        $request = $this->httpClient->get($this->simrsUrlApi . 'berkas/prb/' . $noReg);
        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        return $data['data'];
    }

    // Get No PRB
    public function getNoPRB($noReg)
    {
        $request = $this->httpClient->get($this->simrsUrlApi . 'berkas/noPrb/' . $noReg);
        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        return $data['data'];
    }

    //Biodata By No Reg
    // public function getBiodata($noReg)
    // {
    //     $request = $this->httpClient->get($this->simrsUrlApi . 'pasien/biodatabynoreg/' . $noReg);
    //     $response = $request->getBody()->getContents();
    //     $data = json_decode($response, true);
    //     return $data['data'];
    // }

    public function getBiodata($noReg)
    {
        $pku = DB::connection('pku')->getDatabaseName();
        $data = DB::connection('db_rsmm')
            ->table('REGISTER_PASIEN as a')
            ->leftJoin('PENDAFTARAN as b', 'a.No_MR', '=', 'b.No_MR')
            ->leftJoin('DOKTER as c', 'b.KODE_DOKTER', '=', 'c.KODE_DOKTER')
            ->leftJoin($pku . '.dbo.TAC_RJ_MEDIS as d', 'b.NO_REG', '=', 'd.FS_KD_REG')
            ->leftJoin('REKANAN as e', 'b.KODEREKANAN', '=', 'e.KODEREKANAN')
            ->select(
                'a.NAMA_PASIEN',
                'a.NO_MR',
                'a.ALAMAT',
                'a.JENIS_KELAMIN',
                'a.PROVINSI',
                'a.TGL_LAHIR',
                'a.FS_REAK_ALERGI',
                'a.FS_RIW_PENYAKIT_DAHULU',
                'a.FS_ALERGI',
                'a.FS_RIW_PENYAKIT_DAHULU2',
                'a.FS_HIGH_RISK',
                'b.NO_REG',
                'b.Kode_Dokter',
                'b.Tanggal as tanggal_kunjungan',
                'c.NAMA_DOKTER',
                'c.SPESIALIS',
                'd.FS_DIAGNOSA',
                'd.FS_DIAGNOSA_SEKUNDER',
                'e.NAMAREKANAN',
            )
            ->where('b.NO_REG', $noReg)
            ->first();
        return $data;
    }


    // rekam medis by mr

    function rekamMediByMr($No_MR)
    {

        $pku = DB::connection('pku')->getDatabaseName();
        $data = DB::connection('db_rsmm')
            ->table('PENDAFTARAN as p')
            ->leftJoin('DOKTER as d', 'p.Kode_Dokter', '=', 'd.Kode_Dokter')
            ->leftJoin('M_RUANG as mr', 'p.Kode_Ruang', '=', 'mr.Kode_Ruang')
            ->leftJoin($pku . '.dbo.TAC_RJ_MEDIS as trm', 'p.No_Reg', '=', 'trm.FS_KD_REG')

            ->select(
                'P.No_MR',
                'p.Tanggal',
                'p.No_Reg',
                'p.Medis',
                'p.KodeRekanan',
                'p.Kode_Ruang',
                'p.Status',
                'd.Nama_Dokter',
                'mr.Nama_Ruang',
                'trm.FS_KD_TRS',
                'trm.FS_CARA_PULANG',

            )
            ->where('p.No_MR', $No_MR)
            ->orderBy('p.Tanggal', 'desc')
            ->get();
        return $data;
    }

    function rekamMedisIgd($No_MR)
    {

        $pku = DB::connection('pku')->getDatabaseName();
        $data = DB::connection('db_rsmm')
            ->table('PENDAFTARAN as p')
            ->leftJoin('DOKTER as d', 'p.Kode_Dokter', '=', 'd.Kode_Dokter')
            ->leftJoin($pku . '.dbo.IGD_AWAL_MEDIS as iam', 'p.No_Reg', '=', 'iam.FS_KD_REG')

            ->select(
                'P.No_MR',
                'p.Tanggal',
                'p.No_Reg',
                'p.Medis',
                'p.KodeRekanan',
                'p.Kode_Ruang',
                'p.Status',
                'd.Nama_Dokter',
                'iam.D_PLANNING',
                'iam.FS_TERAPI',
                'iam.rad',
                'iam.lab',
                'iam.id',

            )
            ->where('p.No_MR', $No_MR)
            ->where('p.Kode_Masuk', '1')
            ->orderBy('p.Tanggal', 'asc')
            ->get();
        return $data;
    }

    // rekam medis harian by dokter dan tanggal

    function rekamMedisHarian($kode_dokter, $tanggal)
    {

        $pku = DB::connection('pku')->getDatabaseName();
        $data = DB::connection('db_rsmm')
            ->table('PENDAFTARAN as p')
            ->leftJoin('DOKTER as d', 'p.Kode_Dokter', '=', 'd.Kode_Dokter')
            ->leftJoin('REGISTER_PASIEN as rp', 'p.No_MR', '=', 'rp.No_MR')
            ->leftJoin('ANTRIAN as a', 'p.No_MR', '=', 'a.No_MR')
            ->leftJoin('M_RUANG as mr', 'p.Kode_Ruang', '=', 'mr.Kode_Ruang')
            ->leftJoin($pku . '.dbo.TAC_RJ_MEDIS as trm', 'p.No_Reg', '=', 'trm.FS_KD_REG')
            ->leftJoin($pku . '.dbo.TAC_RJ_STATUS as trs', 'p.No_Reg', '=', 'trs.FS_KD_REG')

            ->select(
                'a.Nomor',
                'P.No_MR',
                'rp.Nama_Pasien',
                'rp.Alamat',
                'p.Tanggal',
                'p.No_Reg',
                'p.Medis',
                'p.KodeRekanan',
                'p.Kode_Ruang',
                'p.Kode_Dokter',
                'p.Status',
                'd.Nama_Dokter',
                'mr.Nama_Ruang',
                'trm.FS_KD_TRS',
                'trm.FS_CARA_PULANG',
                'trm.FS_TERAPI',
                'trm.HASIL_ECHO',
                'trs.FS_STATUS',

            )
            ->where('p.Tanggal', $tanggal)
            ->where('a.Tanggal', $tanggal)
            ->where('p.Kode_Dokter', $kode_dokter)
            ->where('a.Dokter', $kode_dokter)

            ->get();
        return $data;
    }
    
    public function cekLab($noReg)
    {

        $data = DB::connection('pku')
            ->table('TA_TRS_KARTU_PERIKSA4')
            ->select(
                'FS_KD_REG2'
            )
            ->where('FS_KD_REG2', $noReg)
            ->first();
            
        if ($data != null) {
            return true;
        } else {
            return false;
        }
    }
    
    public function cekRadiologi($noReg)
    {
        
        $data = DB::connection('pku')
        ->table('TA_TRS_KARTU_PERIKSA5')
        ->select(
            'FS_KD_REG2'
            )
            ->where('FS_KD_REG2', $noReg)
            ->first();

        if ($data != null) {
            return true;
        } else {
            return false;
        }
    }
    
    public function cetakRmRajal($noReg){
        
        $db_rsmm = DB::connection('db_rsmm')->getDatabaseName();
        $data = DB::connection('pku')
            ->table('TAC_ASES_PER2 as tap')

            ->leftJoin('TAC_RJ_VITAL_SIGN as vs', 'tap.FS_KD_REG', '=', 'vs.FS_KD_REG')
            ->leftJoin('TAC_RJ_NYERI as trn', 'tap.FS_KD_REG', '=', 'trn.FS_KD_REG')
            ->leftJoin('TAC_RJ_JATUH as trj', 'tap.FS_KD_REG', '=', 'trj.FS_KD_REG')
            ->leftJoin('TAC_COM_USER as tcm', 'vs.mdb', '=', 'tcm.user_id')
            ->leftJoin($db_rsmm . '.dbo.TUSER as u', 'tcm.user_name', '=', 'u.NAMAUSER')
       
            // ->leftJoin('ANTRIAN as a', 'p.No_MR', '=', 'a.No_MR')
            // ->leftJoin('M_RUANG as mr', 'p.Kode_Ruang', '=', 'mr.Kode_Ruang')
            // ->leftJoin($pku . '.dbo.TAC_RJ_MEDIS as trm', 'p.No_Reg', '=', 'trm.FS_KD_REG')
            // ->leftJoin($pku . '.dbo.TAC_RJ_STATUS as trs', 'p.No_Reg', '=', 'trs.FS_KD_REG')
        
            ->select(
                'tap.*',
                // vital sign
                'vs.FS_SUHU',
                'vs.FS_NADI',
                'vs.FS_R',
                'vs.FS_TD',
                'vs.FS_TB',
                'vs.FS_BB',
                'vs.MDD as TANGGAL_PERIKSA',
                'vs.FS_JAM_TRS as JAM_PERIKSA',
                'vs.FS_BB',
                // nyeri
                'trn.FS_NYERIP',
                'trn.FS_NYERIQ',
                'trn.FS_NYERIR',
                'trn.FS_NYERIS',
                'trn.FS_NYERIT',
                'trn.FS_NYERI',
                // resiko jatuh
                'trj.FS_CARA_BERJALAN1',
                'trj.FS_CARA_BERJALAN2',
                'trj.FS_CARA_DUDUK',
                'trj.INTERVENSI1',
                'trj.INTERVENSI2',
                // PEMERIKSAN TTV
                'u.NAMALENGKAP'

 
        
            )
            ->where('tap.FS_KD_REG', $noReg)
            ->where('vs.FS_KD_REG', $noReg)
            ->first();
        return $data;
    }
}
