<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

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
        $request = $this->httpClient->get($this->simrsUrlApi . 'berkas/resep/' . $noReg . '/' .  $kode_transaksi);
        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        return $data['data'];
    }

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

    //Biodata By No Reg
    public function getBiodata($noReg)
    {
        $request = $this->httpClient->get($this->simrsUrlApi . 'pasien/biodatabynoreg/' . $noReg);
        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        return $data['data'];
    }
}
