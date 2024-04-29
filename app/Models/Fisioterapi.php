<?php

namespace App\Models;

use GuzzleHttp\Client;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fisioterapi extends Model
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
    use HasFactory;


    // List Pasien Fisioterapi
    public function pasienCpptdanFisioterapi()
    {
        $request = $this->httpClient->get($this->simrsUrlApi . 'pendaftaran/listfisioterapi');
        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        return $data['data'];
    }


    // Data Table Pasien Fisioterapi
    public function transaksiFisioByMr($no_mr)
    {
        $request = $this->httpClient->get($this->simrsUrlApi . 'fisioterapi/transaksi/' . $no_mr);
        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        return $data['data'];
    }


    // Menghitung Jumlah Fisio yang sudah dilakukan
    public function countCpptByKodeTr($kode_tr)
    {
        $request = $this->httpClient->get($this->simrsUrlApi . 'fisioterapi/cpptcount/' . $kode_tr);
        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        return $data['total'];
    }


    // Get Kode Transaksi
    public function getLastTransaksiFisio()
    {
        $request = $this->httpClient->get($this->simrsUrlApi . 'fisioterapi/transaksis');
        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        return $data['data'];
    }

    public function addCpptByKodeTr()
    {
        $request = $this->httpClient->get($this->simrsUrlApi . 'api/fisioterapi/cppt/transaksi_fisioterapi');
        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        return $data['data'];
    }

    // Cetak CPPT
    public function cetakCPPT($kode_transaksi)
    {
        $request = $this->httpClient->get($this->simrsUrlApi . 'fisioterapi/berkas/cppt/' . $kode_transaksi);
        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        return $data['data'];
    }

    // Get Data Pasien CPPT
    public function dataPasienCPPT($no_mr, $kode_transaksi)
    {
        $request = $this->httpClient->get($this->simrsUrlApi . 'fisioterapi/cppt/list/' . $no_mr . '/' .  $kode_transaksi);
        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        return $data['data'];
    }
}
