<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;

class Dokter extends Model
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
            $request = $this->httpClient->get('https://daftar.rsumm.co.id/api.simrs/dokter');
            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);
            return $data['data']; // Mengambil bagian 'data' dari respons
        } catch (\Exception $e) {
            // Tangani kesalahan
            return []; // Mengembalikan array kosong jika terjadi kesalahan
        }
    }

    // Method to fetch data for a specific doctor
    public static function editDokter($kode_dokter)
    {
        try {
            $httpClient = new Client();
            $response = $httpClient->get('https://daftar.rsumm.co.id/api.simrs/dokter/' . $kode_dokter);
            $responseData = json_decode($response->getBody()->getContents(), true);

            // Check if 'data' key exists in the response
            if (isset($responseData['data'])) {
                return $responseData['data'];
            } else {
                \Log::error('Data key not found in API response');
                return null; // Or handle the error in another way
            }
        } catch (\Exception $e) {
            // Log the error
            \Log::error($e->getMessage());
            // Return null or handle the error in another way
            return null;
        }
    }
}
