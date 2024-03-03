<?php

namespace App\Models;

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;

class Antrean extends Model
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

    public function getData()
    {
        try {
            $request = $this->httpClient->get('https://daftar.rsumm.co.id/api.simrs/index.php/api/antrian/');
            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);
            return $data['data']; // Mengambil bagian 'data' dari respons
        } catch (\Exception $e) {
            // Tangani kesalahan
            return []; // Mengembalikan array kosong jika terjadi kesalahan
        }
    }

    public function byKodeDokter($kodeDokter = '')
    {
        $request = $this->httpClient->get('https://daftar.rsumm.co.id/api.simrs/index.php/api/antrian/' . $kodeDokter);
        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        return $data['data'];
    }
}
