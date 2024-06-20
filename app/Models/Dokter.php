<?php

namespace App\Models;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dokter extends Model
{
    protected $httpClient;
    protected $guarded = [];
    protected $table = 'simrs_dokters';
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

    // public function getData()
    // {
    //     try {
    //         $request = $this->httpClient->get($this->simrsUrlApi . 'dokter');
    //         $response = $request->getBody()->getContents();
    //         $data = json_decode($response, true);
    //         return $data['data']; // Mengambil bagian 'data' dari respons
    //     } catch (\Exception $e) {
    //         // Tangani kesalahan
    //         return []; // Mengembalikan array kosong jika terjadi kesalahan
    //     }
    // }

    public function getData()
    {
        $data = DB::connection('db_rsmm')
            ->table('DOKTER as a')
            ->select(
                'a.Kode_Dokter as kode_dokter',
                'a.Jenis_Profesi as jenis_profesi',
                'a.Spesialis as spesialis',
                'a.Nama_Dokter as nama_dokter',
                'a.Jenis_Kelamin as jenis_kelamin',
                'a.Tgl_Lahir as tgl_lahir',
                'a.Agama as agama',
                'a.Email as email',
                'a.No_KTP as nik',
                'a.Alamat as alamat',
                'a.Kota as kota',
                'a.Provinsi as provinsi',
                'a.Kode_Pos as kode_pos',
                DB::raw('COALESCE(NULLIF(a.HP1, \'\'), a.Telp_Rumah) as no_hp'),
                'a.Pemeriksaan as pemeriksaan',
                'a.Visite as visite',
                'a.Konsul as konsul',
                'a.Tindakan as tindakan',
                'a.Lain as lain'
            )
            ->where('a.Jenis_Profesi', 'like', '%dokter%')
            ->where('a.Nama_Dokter', '!=', '-')
            ->where('a.No_KTP', '!=', '')
            ->get();
        return $data;
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
        $request = $this->httpClient->get($this->simrsUrlApi . 'dokter/select');
        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        return $data['data'];
    }

    // public function getByKodeDokter($kodeDokter)
    // {
    //     $response = Http::get($this->simrsUrlApi . 'dokter/detail/' . $kodeDokter);
    //     return $response->json();
    // }

    public function getByKodeDokter($kodeDokter)
    {
        $data = DB::connection('db_rsmm')
            ->table('DOKTER as a')
            ->select(
                'a.Kode_Dokter as kode_dokter',
                'a.Jenis_Profesi as jenis_profesi',
                'a.Spesialis as spesialis',
                'a.Nama_Dokter as nama_dokter',
                'a.Jenis_Kelamin as jenis_kelamin',
                'a.Tgl_Lahir as tgl_lahir',
                'a.Agama as agama',
                'a.Email as email',
                'a.No_KTP as nik',
                'a.Alamat as alamat',
                'a.Kota as kota',
                'a.Provinsi as provinsi',
                'a.Kode_Pos as kode_pos',
                DB::raw('COALESCE(NULLIF(a.HP1, \'\'), a.Telp_Rumah) as no_hp'),
                'a.Pemeriksaan as pemeriksaan',
                'a.Visite as visite',
                'a.Konsul as konsul',
                'a.Tindakan as tindakan',
                'a.Lain as lain'
            )
            ->where('Kode_Dokter', $kodeDokter)
            ->first();
        return $data;
    }

    public function getNik($kodeDokter)
    {
        $request = Http::get($this->simrsUrlApi . 'dokter/detail/' . $kodeDokter);
        $response = $request->getBody()->getContents();
        $result = json_decode($response, true);
        return $result['data']['nik'];
    }
}
