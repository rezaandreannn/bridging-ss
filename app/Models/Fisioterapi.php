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

    public function pasienCpptdanFisioterapi()
    {
        $request = $this->httpClient->get($this->simrsUrlApi . 'pendaftaran/listfisioterapi');
        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        return $data['data'];
    }

    public function transaksiFisioByMr($no_mr)
    {
        $request = $this->httpClient->get($this->simrsUrlApi . 'fisioterapi/transaksi/' . $no_mr);
        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        return $data['data'];
    }

    public function countCpptByKodeTr($kode_tr)
    {
        $request = $this->httpClient->get($this->simrsUrlApi . 'fisioterapi/cpptcount/' . $kode_tr);
        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        return $data['total'];
    }

    public function addCpptByKodeTr()
    {
        $request = $this->httpClient->get($this->simrsUrlApi . 'api/fisioterapi/cppt/transaksi_fisioterapi');
        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        return $data['data'];
    }

    public function generateRandomCode()
    {
        return $this->prefix . '-' . Str::random(8); // Change 8 to the desired length of your random code
    }
}
