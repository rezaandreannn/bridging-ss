<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;

class Rajal extends Model
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

    public function byKodeDokter($kodeDokter = '')
    {
        $request = $this->httpClient->get($this->simrsUrlApi . 'dokter/select' . $kodeDokter);
        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        return $data['data'];
    }

    public function getData($kode_dokter = null)
    {
        try {
            // Menyiapkan query parameters
            $queryParams = [];
            if ($kode_dokter !== null) {
                $queryParams['kode_dokter'] = $kode_dokter;
            }
            // Mengirim permintaan HTTP dengan query parameters
            $request = $this->httpClient->get($this->simrsUrlApi . 'antrean?kode_dokter', [
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
}
