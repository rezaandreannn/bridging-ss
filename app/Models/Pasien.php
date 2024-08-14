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

    // public function getData($no_mr = null, $no_bpjs = null, $nik = null, $nama = null)
    // {
    //     try {
    //         // Menyiapkan query parameters
    //         $queryParams = [];
    //         if ($no_mr !== null) {
    //             $queryParams['no_mr'] = $no_mr;
    //         }
    //         if ($no_bpjs !== null) {
    //             $queryParams['no_bpjs'] = $no_bpjs;
    //         }
    //         if ($nik !== null) {
    //             $queryParams['nik'] = $nik;
    //         }
    //         if ($nama !== null) {
    //             $queryParams['nama'] = $nama;
    //         }
    //         // Mengirim permintaan HTTP dengan query parameters
    //         $request = $this->httpClient->get($this->simrsUrlApi . 'pasien', [
    //             'query' => $queryParams,
    //         ]);

    //         // Mengambil respons dari API
    //         $response = $request->getBody()->getContents();
    //         $data = json_decode($response, true);

    //         // Mengembalikan data pasien
    //         return $data['data']; // Mengambil bagian 'data' dari respons
    //     } catch (\Exception $e) {
    //         // Tangani kesalahan
    //         return []; // Mengembalikan array kosong jika terjadi kesalahan
    //     }
    // }

    public function getData($no_mr, $no_bpjs, $nik, $nama)
    {
        $query = DB::connection('db_rsmm')
            ->table('REGISTER_PASIEN as rp')
            ->select(
                'rp.NOID as id',
                'rp.NO_MR as no_mr',
                'rp.Nama_Pasien as nama_pasien',
                'rp.No_Identitas as no_bpjs',
                'rp.HP2 as nik',
                DB::raw('COALESCE(rp.Telp_Rumah, rp.HP1) as no_hp'),
                'rp.Tgl_Lahir as tanggal_lahir',
                'rp.Jenis_Kelamin as jenis_kelamin'
            );

        if ($no_mr) {
            $query->where('rp.No_MR', $no_mr);
        }
        if ($no_bpjs) {
            $query->where('rp.No_Identitas', $no_bpjs);
        }
        if ($nik) {
            $query->where('rp.HP2', $nik);
        }
        if ($nama) {
            $query->where('rp.Nama_Pasien', 'LIKE', '%' . $nama . '%');
        }

        $data = $query->orderBy('rp.Tgl_Register', 'DESC')
            ->limit(1000)
            ->get()
            ->toArray();

        return $data;
    }

    // public function getByNoMR($noMr)
    // {
    //     $request = $this->httpClient->get('https://daftar.rsumm.co.id/api.simrs/pasien/detail/' . $noMr);
    //     $response = $request->getBody()->getContents();
    //     $data = json_decode($response, true);
    //     return $data['data'];
    // }

    public function getByNoMR($no_mr)
    {
        $data = DB::connection('db_rsmm')
            ->table('REGISTER_PASIEN as a')
            ->leftJoin('PENDAFTARAN as b', 'a.No_MR', '=', 'b.No_MR')
            ->leftJoin('DOKTER as c', 'b.KODE_DOKTER', '=', 'c .KODE_DOKTER')
            ->leftJoin('REKANAN as d', 'b.KODEREKANAN', '=', 'd.KODEREKANAN')
            ->leftJoin('ANTRIAN as e', 'e.No_MR', '=', 'b.No_MR')
            ->select(
                'a.NAMA_PASIEN as nama_pasien',
                'a.NO_MR as no_mr',
                'a.HP1 as no_hp',
                'a.HP2 as nik',
                'a.No_Identitas as no_bpjs',
                'a.ALAMAT as alamat',
                'a.KOTA as kota',
                'a.PROVINSI as provinsi',
                'a.JENIS_KELAMIN as jenis_kelamin',
                'a.TGL_LAHIR as tgl_lahir',
                'a.FS_REAK_ALERGI',
                'a.FS_RIW_PENYAKIT_DAHULU',
                'a.FS_ALERGI',
                'a.FS_RIW_PENYAKIT_DAHULU2',
                'a.FS_HIGH_RISK',
                'b.NamaUser as created_by',
                'b.No_MR',
                'b.Medis as status_rawat',
                'b.No_Reg as no_registrasi',
                'b.KODE_DOKTER as kode_dokter',
                'c.NAMA_DOKTER as nama_dokter',
                'd.NamaRekanan as nama_rekanan',
                'e.Status as daftar_by',
            )
            ->where('a.NO_MR', $no_mr)
            ->orderBy('b.No_Reg', 'DESC')
            ->limit('1')
            ->first();
        return $data;
    }

    // public function biodataPasienByMr($no_mr)
    // {
    //     $request = $this->httpClient->get($this->simrsUrlApi . 'pasien/biodatabymr/' . $no_mr);
    //     $response = $request->getBody()->getContents();
    //     $data = json_decode($response, true);
    //     return $data['data'];
    // }

    public function biodataPasienByMr($no_mr)
    {
        $data = DB::connection('db_rsmm')
            ->table('REGISTER_PASIEN as a')
            ->leftJoin('PENDAFTARAN as b', 'a.No_MR', '=', 'b.No_MR')
            ->leftJoin('DOKTER as c', 'b.KODE_DOKTER', '=', 'c.KODE_DOKTER')
            ->leftJoin('REKANAN as d', 'b.KODEREKANAN', '=', 'd.KODEREKANAN')
            ->select(
                'a.NAMA_PASIEN',
                'a.NO_MR',
                'a.HP1',
                'a.HP2',
                'a.ALAMAT',
                'a.KOTA',
                'a.PROVINSI',
                'a.JENIS_KELAMIN',
                'a.TGL_LAHIR',
                'a.FS_REAK_ALERGI',
                'a.FS_RIW_PENYAKIT_DAHULU',
                'a.FS_ALERGI',
                'a.FS_RIW_PENYAKIT_DAHULU2',
                'a.FS_HIGH_RISK',
                'b.No_MR',
                'b.No_Reg',
                'b.Tanggal',
                'c.NAMA_DOKTER',
                'c.SPESIALIS',
                'd.NAMAREKANAN',
            )
            ->where('a.NO_MR', $no_mr)
            ->orderBy('b.No_Reg', 'DESC')
            ->limit('1')
            ->first();
        return $data;
    }
}
