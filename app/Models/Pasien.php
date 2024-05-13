<?php

namespace App\Models;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pasien extends Model
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
            $request = $this->httpClient->get($this->simrsUrlApi . 'pasien', [
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

    public function biodataPasienByMr($no_mr)
    {
        $request = $this->httpClient->get($this->simrsUrlApi . 'pasien/biodatabymr/' . $no_mr);
        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        return $data['data'];
    }

    // public function biodataPasienByMr($no_mr)
    // {
    //     $data = DB::connection('db_rsmm')
    //         ->table('REGISTER_PASIEN as a')
    //         ->select(
    //             'a.NAMA_PASIEN',
    //             'a.NO_MR',
    //             'a.HP2',
    //             'a.HP1',
    //             'a.ALAMAT',
    //             'a.KOTA',
    //             'a.PROVINSI',
    //             'a.JENIS_KELAMIN',
    //             'a.TGL_LAHIR',
    //             'a.FS_ALERGI',
    //             'a.FS_REAK_ALERGI',
    //             'a.FS_RIW_PENYAKIT_DAHULU',
    //             'a.FS_RIW_PENYAKIT_DAHULU2',
    //             'b.No_Reg'
    //         )
    //         ->join('PENDAFTARAN as b', 'a.NO_MR', '=', 'b.NO_MR')
    //         ->where('a.NO_MR', $no_mr)
    //         ->first();

    //     return $data;
    // }
}
