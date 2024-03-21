<?php

namespace App\Models;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dokter extends Model
{
    protected $httpClient;
    protected $guarded = [];
    protected $table = 'simrs_dokters';

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

    public function getSelect()
    {
        $request = $this->httpClient->get('https://daftar.rsumm.co.id/api.simrs/dokter/select');
        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        return $data['data'];
    }

    public function getByKodeDokter($kodeDokter)
    {
        $response = Http::get('https://daftar.rsumm.co.id/api.simrs/dokter/detail/' . $kodeDokter);
        return $response->json();
    }

    public function getNik($kodeDokter)
    {
        $request = Http::get('https://daftar.rsumm.co.id/api.simrs/dokter/detail/' . $kodeDokter);
        $response = $request->getBody()->getContents();
        $result = json_decode($response, true);
        return $result['data']['nik'];
    }
}
