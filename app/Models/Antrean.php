<?php

namespace App\Models;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Antrean extends Model
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

    public function getDataPasienRajal($kode_dokter)
    {

        $date = date('Y-m-d');
        $dbpku = DB::connection('pku')->getDatabaseName();
        $data = DB::connection('db_rsmm')
            ->table('ANTRIAN as a')
            ->Join('REGISTER_PASIEN as rp', 'a.No_MR', '=', 'rp.No_MR')
            ->Join('PENDAFTARAN as p', 'a.No_MR', '=', 'p.No_MR')
            ->Join('DOKTER as d', 'p.Kode_Dokter', '=', 'd.Kode_Dokter')
            ->leftJoin($dbpku . '.dbo.TAC_RJ_STATUS as st', 'p.NO_REG', '=', 'st.FS_KD_REG')
            ->leftJoin($dbpku . '.dbo.TAC_RJ_MEDIS as m', 'p.NO_REG', '=', 'm.FS_KD_REG')
            ->leftJoin($dbpku . '.dbo.TAC_RJ_RUJUKAN as sr', 'p.NO_REG', '=', 'sr.FS_KD_REG')
            ->select(
                'a.No_Ponsel as no_hp',
                'a.Nomor as nomor_antrean',
                'a.No_MR as no_mr',
                'a.Tanggal as tanggal',
                'a.Dokter as kode_dokter',
                'a.Jenis as jenis_pasien',
                'a.Status as created_by',
                'rp.Nama_Pasien as nama_pasien',
                'rp.No_Identitas',
                'rp.Alamat',
                'p.No_Reg',
                'st.FS_STATUS',
                'm.FS_CARA_PULANG',
                'm.FS_TERAPI',
                'm.FS_KD_TRS',
                'sr.FS_KD_TRS as ID_SURAT_RUJUKAN',
                'm.HASIL_ECHO',
                'd.SPESIALIS',
            )
            ->where('a.Dokter', $kode_dokter)
            ->where('p.Kode_Dokter', $kode_dokter)
            ->where('a.Tanggal', $date)
            ->where('p.Tanggal', $date)
            ->where('p.Status', '1')
            ->orderBy('a.Nomor', 'ASC')
            ->get()->toArray();
        return $data;
    }

    public function getDataPasienRajalPoliMata($kode_dokter)
    {

        $date = date('Y-m-d');
        $dbpku = DB::connection('pku')->getDatabaseName();
        $data = DB::connection('db_rsmm')
            ->table('ANTRIAN as a')
            ->Join('REGISTER_PASIEN as rp', 'a.No_MR', '=', 'rp.No_MR')
            ->Join('PENDAFTARAN as p', 'a.No_MR', '=', 'p.No_MR')
            ->leftJoin($dbpku . '.dbo.TAC_RJ_STATUS as st', 'p.NO_REG', '=', 'st.FS_KD_REG')
            ->leftJoin($dbpku . '.dbo.TAC_RJ_MEDIS as m', 'p.NO_REG', '=', 'm.FS_KD_REG')
            ->leftJoin($dbpku . '.dbo.TAC_ASES_PER2 as tap', 'p.NO_REG', '=', 'tap.FS_KD_REG')
            ->select(
                'a.No_Ponsel as no_hp',
                'a.Nomor as nomor_antrean',
                'a.No_MR as no_mr',
                'a.Tanggal as tanggal',
                'a.Dokter as kode_dokter',
                'a.Jenis as jenis_pasien',
                'a.Status as created_by',
                'rp.Nama_Pasien as nama_pasien',
                'rp.No_Identitas',
                'rp.Alamat',
                'p.No_Reg',
                'st.FS_STATUS',
                'm.FS_CARA_PULANG',
                'm.FS_TERAPI',
                'm.FS_KD_TRS',
                'm.HASIL_ECHO',
                'tap.FS_ANAMNESA',
            )
            ->where('a.Dokter', $kode_dokter)
            ->where('p.Kode_Dokter', $kode_dokter)
            ->where('a.Tanggal', $date)
            ->where('p.Tanggal', $date)
            ->orderBy('a.Nomor', 'ASC')
            ->get()->toArray();
        return $data;
    }

    public function getPasienRajal($kode_dokter)
    {

        $date = date('Y-m-d');
        $dbpku = DB::connection('pku')->getDatabaseName();
        $data = DB::connection('db_rsmm')
            ->table('ANTRIAN as a')
            ->Join('REGISTER_PASIEN as rp', 'a.No_MR', '=', 'rp.No_MR')
            ->Join('PENDAFTARAN as p', 'a.No_MR', '=', 'p.No_MR')
            ->leftJoin($dbpku . '.dbo.TAC_RJ_STATUS as st', 'p.NO_REG', '=', 'st.FS_KD_REG')
            ->leftJoin($dbpku . '.dbo.TAC_RJ_MEDIS as m', 'p.NO_REG', '=', 'm.FS_KD_REG')
            ->select(
                'a.No_Ponsel as no_hp',
                'a.Nomor as nomor_antrean',
                'a.No_MR as no_mr',
                'a.Tanggal as tanggal',
                'a.Dokter as kode_dokter',
                'a.Jenis as jenis_pasien',
                'a.Status as created_by',
                'rp.Nama_Pasien as nama_pasien',
                'rp.No_Identitas',
                'rp.Alamat',
                'p.No_Reg',
                'st.FS_STATUS',
                'm.FS_CARA_PULANG',
                'm.FS_TERAPI',
                'm.FS_KD_TRS',
                'm.HASIL_ECHO',
            )
            ->where('a.Dokter', $kode_dokter)
            ->where('p.Kode_Dokter', $kode_dokter)
            ->where('a.Tanggal', $date)
            ->where('p.Tanggal', $date)
            ->orderBy('a.Nomor', 'ASC')
            ->first();
        return $data;
    }

    public function getDataPasienRajalDiagnosa($kode_dokter, $tanggal)
    {

        $date = date('Y-m-d');
        $dbpku = DB::connection('pku')->getDatabaseName();
        $bridging_ss = DB::connection('bridging_ss')->getDatabaseName();
        $data = DB::connection('db_rsmm')
            ->table('ANTRIAN as a')
            ->Join('REGISTER_PASIEN as rp', 'a.No_MR', '=', 'rp.No_MR')
            ->Join('PENDAFTARAN as p', 'a.No_MR', '=', 'p.No_MR')
            // versi lama
            // ->Join($bridging_ss . '.dbo.satusehat_encounter as se', 'p.NO_REG', '=', 'se.kode_register')
            // versi baru
            ->leftJoin($bridging_ss . '.dbo.satusehat_encounter as se', 'p.NO_REG', '=', 'se.kode_register')
            ->leftJoin($bridging_ss . '.dbo.satusehat_condition as sc', 'p.NO_REG', '=', 'sc.kode_register')
            ->leftJoin($dbpku . '.dbo.TAC_RJ_STATUS as st', 'p.NO_REG', '=', 'st.FS_KD_REG')
            ->leftJoin($dbpku . '.dbo.TAC_RJ_MEDIS as m', 'p.NO_REG', '=', 'm.FS_KD_REG')
            ->select(
                'a.No_Ponsel as no_hp',
                'a.Nomor as nomor_antrean',
                'a.No_MR as no_mr',
                'a.Tanggal as tanggal',
                'a.Dokter as kode_dokter',
                'a.Jenis as jenis_pasien',
                'a.Status as created_by',
                'rp.Nama_Pasien as nama_pasien',
                'rp.No_Identitas',
                'rp.Alamat',
                'p.No_Reg',
                'st.FS_STATUS',
                'm.FS_CARA_PULANG',
                'm.FS_TERAPI',
                'm.FS_KD_TRS',
                'm.HASIL_ECHO',
                'sc.kode_register'
            )
            ->where('a.Dokter', $kode_dokter)
            ->where('p.Kode_Dokter', $kode_dokter)
            ->where('a.Tanggal', $tanggal)
            ->where('p.Tanggal', $tanggal)
            ->orderBy('a.Nomor', 'ASC')
            ->get()->toArray();
        return $data;
    }

    // public function getData($kode_dokter = null, $tanggal = null)
    // {
    //     try {
    //         // Menyiapkan query parameters
    //         $queryParams = [];
    //         if ($kode_dokter !== null) {
    //             $queryParams['kode_dokter'] = $kode_dokter;
    //         }
    //         if ($tanggal !== null) {
    //             $queryParams['tanggal'] = $tanggal ?? date('Y-m-d'); // Tanggal sekarang;
    //         }
    //         // Mengirim permintaan HTTP dengan query parameters
    //         $request = $this->httpClient->get($this->simrsUrlApi . 'antrean?kode_dokter', [
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

    public function getData($kode_dokter)
    {
        $date = date('Y-m-d');
        $dbpku = DB::connection('pku')->getDatabaseName();
        $data = DB::connection('db_rsmm')
            ->table('ANTRIAN as a')
            ->Join('REGISTER_PASIEN as rp', 'a.No_MR', '=', 'rp.No_MR')
            ->Join('PENDAFTARAN as p', 'a.No_MR', '=', 'p.No_MR')
            ->leftJoin($dbpku . '.dbo.TAC_RJ_STATUS as st', 'p.NO_REG', '=', 'st.FS_KD_REG')
            ->leftJoin($dbpku . '.dbo.TAC_RJ_MEDIS as m', 'p.NO_REG', '=', 'm.FS_KD_REG')
            ->select(
                'a.No_Ponsel as no_hp',
                'a.Nomor as nomor_antrean',
                'a.No_MR as no_mr',
                'a.Tanggal as tanggal',
                'a.Dokter as kode_dokter',
                'a.Jenis as jenis_pasien',
                'a.Status as created_by',
                'rp.Nama_Pasien as nama_pasien',
                'rp.No_Identitas',
                'rp.Alamat',
                'p.No_Reg',
                'st.FS_STATUS',
                'm.FS_CARA_PULANG',
                'm.FS_TERAPI',
                'm.FS_KD_TRS',
                'm.HASIL_ECHO',
            )
            ->where('a.Dokter', $kode_dokter)
            ->where('p.Kode_Dokter', $kode_dokter)
            ->where('a.Tanggal', $date)
            ->where('p.Tanggal', $date)
            ->orderBy('a.Nomor', 'ASC')
            ->get()->toArray();
        return $data;
    }

    // public function byKodeDokter($kodeDokter = '')
    // {
    //     $request = $this->httpClient->get($this->simrsUrlApi . 'dokter/select' . $kodeDokter);
    //     $response = $request->getBody()->getContents();
    //     $data = json_decode($response, true);
    //     return $data['data'];
    // }

    public function byKodeDokter()
    {
        $data = DB::connection('db_rsmm')
            ->table('DOKTER as a')
            ->select(
                'a.KODE_DOKTER as kode_dokter',
                'a.NAMA_DOKTER as nama_dokter',
            )
            ->where(function ($query) {
                $query->where('JENIS_PROFESI', 'DOKTER UMUM')
                    ->orWhere('JENIS_PROFESI', 'DOKTER SPESIALIS')
                    ->orWhere('Spesialis', 'FISIOTERAPI');
            })
            ->whereNotIn('KODE_DOKTER', ['140s', 'TM140'])
            ->orderBy('NAMA_DOKTER', 'ASC')
            ->get();
        return $data;
    }

    public function history($noMR)
    {
        $dbpku = DB::connection('pku')->getDatabaseName();
        $data = DB::connection('db_rsmm')
            ->table('PENDAFTARAN as p')
            ->Join('REGISTER_PASIEN as rp', 'p.No_MR', '=', 'rp.No_MR')
            ->Join('DOKTER as d', 'p.KODE_DOKTER', '=', 'd.KODE_DOKTER')
            ->Join('REKANAN as r', 'p.KODEREKANAN', '=', 'r.KODEREKANAN')
            ->Join('M_SPESIALIS as ms', 'd.SPESIALIS', '=', 'ms.SPESIALIS')
            ->leftJoin($dbpku . '.dbo.TAC_RJ_STATUS as st', 'p.NO_REG', '=', 'st.FS_KD_REG')
            ->leftJoin($dbpku . '.dbo.TAC_RJ_MEDIS as m', 'p.NO_REG', '=', 'm.FS_KD_REG')
            ->select(
                'p.TANGGAL',
                'p.STATUS',
                'p.NO_REG',
                'p.KODE_RUANG',
                'rp.NAMA_PASIEN',
                'rp.ALAMAT',
                'rp.KOTA',
                'rp.PROVINSI',
                'rp.TGL_LAHIR',
                'rp.JENIS_KELAMIN',
                'rp.FS_ALERGI',
                'd.NAMA_DOKTER',
                'ms.SPESIALIS',
                'st.FS_FORM',
                'm.FS_KD_TRS',
            )
            ->where('p.NO_MR', $noMR)
            ->orderBy('p.TANGGAL', 'DESC')
            ->limit('10')
            ->get()->toArray();
        return $data;
    }
}
