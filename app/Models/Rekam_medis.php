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
                'a.FS_DIAGNOSA',
                'a.FS_DIAGNOSA_SEKUNDER',
                'a.FS_TERAPI',
                'a.FS_ALERGI',
                'b.user_name',
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
}
