<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;

class Pendaftaran extends Model
{
    protected $httpClient;
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

    public function getData($kode_dokter = null, $tanggal = null, $status_rawat = null)
    {
        // $tanggal = date('Y-m-d');
        try {
            // Menyiapkan query parameters
            $queryParams = [];
            if ($kode_dokter !== null) {
                $queryParams['kode_dokter'] = $kode_dokter;
            }
            if ($tanggal !== null) {
                $queryParams['tanggal'] = $tanggal ?? date('Y-m-d'); // Tanggal sekarang;
            }
            if ($status_rawat !== null) {
                $queryParams['status_rawat'] = $status_rawat;
            }
            // Mengirim permintaan HTTP dengan query parameters
            $request = $this->httpClient->get($this->simrsUrlApi . 'pendaftaran', [
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

    public function byKodeDokter($kodeDokter = '')
    {
        $request = $this->httpClient->get($this->simrsUrlApi . 'dokter/select/' . $kodeDokter);
        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        return $data['data'];
    }

    public function getByKodeReg($noReg)
    {
        $request = $this->httpClient->get($this->simrsUrlApi . 'pendaftaran/detail/' . $noReg);
        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        return $data['data'];
    }
}
