<?php

namespace App\Models;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pasien extends Model
{
    protected $httpClient;

    public function __construct()
    {
        $this->httpClient = new Client([
            'headers' => [
                'Content-Type' => 'application/json'
            ],
        ]);
    }

    public function getData($no_mr = null, $no_bpjs = null, $nik = null, $nama = null)
    {
        try {
            // Menyiapkan query parameters
            $queryParams = [];
            if ($no_mr !== null) {
                $queryParams['no_mr'] = $no_mr;
            }
            if ($no_bpjs !== null) {
                $queryParams['no_bpjs'] = $no_bpjs;
            }
            if ($nik !== null) {
                $queryParams['nik'] = $nik;
            }
            if ($nama !== null) {
                $queryParams['nama'] = $nama;
            }
            // Mengirim permintaan HTTP dengan query parameters
            $request = $this->httpClient->get('https://daftar.rsumm.co.id/api.simrs/pasien', [
                'query' => $queryParams,
            ]);

            // Mengambil respons dari API
            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);

            // Mengembalikan data pasien
            return $data['data']; // Mengambil bagian 'data' dari respons
        } catch (\Exception $e) {
            // Tangani kesalahan
            return []; // Mengembalikan array kosong jika terjadi kesalahan
        }
    }

    public function getByNoMR($noMr)
    {
        $request = $this->httpClient->get('https://daftar.rsumm.co.id/api.simrs/pasien/detail/' . $noMr);
        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        return $data['data'];
    }
}
