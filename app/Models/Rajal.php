<?php

namespace App\Models;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Model;

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

    public function byKodeDokter()
    {
        $request = $this->httpClient->get($this->simrsUrlApi . 'dokter/select');
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

    public function skdp_bynoreg($noReg)
    {

        $request = $this->httpClient->get('https://daftar.rsumm.co.id/api.simrs/berkas/skdp/' . $noReg);
        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        // Memeriksa apakah ada data SKDP yang dikembalikan
        if (isset($data['data']) && !empty($data['data'])) {
            return true; // Jika ada data SKDP
        } else {
            return false; // Jika tidak ada data SKDP
        }
    }

    public function cek_lab($noReg)
    {
        $request = Http::get($this->simrsUrlApi . '/berkas/cekLaboratorium/' . $noReg);
        $code = $request->status();
        if ($code == 200) {
            return true;
        } else {
            return false;
        }
    }

    public function cek_rad($noReg)
    {
        $request = Http::get($this->simrsUrlApi . '/berkas/cekRadiologi/' . $noReg);
        $code = $request->status();
        if ($code == 200) {
            return true;
        } else {
            return false;
        }
    }

    public function masalah_perawatan()
    {
        $request = $this->httpClient->get('https://daftar.rsumm.co.id/api.simrs/api/rawatjalan/perawat/masalah_keperawatan');
        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        return $data['data'];
    }

    public function rencana_perawatan()
    {
        $request = $this->httpClient->get('https://daftar.rsumm.co.id/api.simrs/api/rawatjalan/perawat/rencana_keperawatan');
        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        return $data['data'];
    }

    public function pasien_bynoreg($noReg)
    {
        $request = $this->httpClient->get('https://daftar.rsumm.co.id/api.simrs/pasien/biodatabynoreg/' . $noReg);
        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        // Mengganti kunci NO_REG menjadi no_registrasi
        $data['data']['No_Reg'] = $data['data']['NO_REG'];
        unset($data['data']['NO_REG']);
        return $data['data'];
    }

    public function profil($noMR)
    {
        $request = $this->httpClient->get($this->simrsUrlApi . 'berkas/resumeRawatJalan/' . $noMR);
        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        return $data['data'];
    }
}
