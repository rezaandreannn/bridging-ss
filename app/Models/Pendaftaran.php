<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;

class Pendaftaran extends Model
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
            $request = $this->httpClient->get('https://daftar.rsumm.co.id/api.simrs/pendaftaran');
            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);
            return $data['data']; // Mengambil bagian 'data' dari respons
        } catch (\Exception $e) {
            // Tangani kesalahan
            return []; // Mengembalikan array kosong jika terjadi kesalahan
        }
    }
}
