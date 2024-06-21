<?php

namespace App\Models;

use GuzzleHttp\Client;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fisioterapi extends Model
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
    use HasFactory;


    // List Pasien Fisioterapi
    public function pasienCpptdanFisioterapi()
    {
        $date = date('Y-m-d');
        $kode_dokter = array('028', '151');
        $data = DB::connection('db_rsmm')
            ->table('ANTRIAN as a')
            ->Join('REGISTER_PASIEN as rp', 'a.No_MR', '=', 'rp.No_MR')
            ->Join('PENDAFTARAN as p', 'a.No_MR', '=', 'p.No_MR')
            ->select(
                'a.NOMOR',

                'a.TANGGAL',
                'p.Kode_Dokter',
                'rp.NAMA_PASIEN',
                'rp.ALAMAT',
                'rp.KOTA',
                'rp.PROVINSI',
                'rp.NO_MR',
                'p.NO_REG',
                'p.KODEREKANAN'

            )
            ->whereIn('p.Kode_Dokter', $kode_dokter)
            ->whereIn('a.Dokter', $kode_dokter)
            ->where('a.Tanggal', $date)
            ->where('p.Tanggal', $date)
            ->where('p.Status', '1')
            ->orderBy('a.NOMOR', 'ASC')
            ->get()->toArray();
        return $data;
    }

    public function biodataPasienByMr($no_mr)
    {
        $data = DB::connection('db_rsmm')
            ->table('REGISTER_PASIEN as a')
            ->leftJoin('PENDAFTARAN as b', 'a.No_MR', '=', 'b.No_MR')
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
            )
            ->where('a.NO_MR', $no_mr)
            ->orderBy('b.No_Reg', 'DESC')
            ->limit('1')
            ->get()->toArray();
        return $data;
    }

    public function getPasienRehabMedis()
    {
        $dbpku = DB::connection('pku')->getDatabaseName();
        $date = date('Y-m-d');
        $data = DB::connection('db_rsmm')
            ->table('ANTRIAN as A')
            ->join('PENDAFTARAN as P', 'A.No_MR', '=', 'P.No_MR')
            ->join('REGISTER_PASIEN as RP', 'P.No_MR', '=', 'RP.No_MR')
            ->leftJoin($dbpku . '.dbo.TAC_RJ_STATUS as st', 'P.NO_REG', '=', 'st.FS_KD_REG')->select(
                'A.Nomor',
                'RP.No_MR',
                'RP.Nama_Pasien',
                'RP.Alamat',
                'st.FS_STATUS'

            )
            ->where('A.Tanggal', $date)
            ->where('P.Tanggal', $date)
            ->where('A.Dokter', '151')
            ->where('P.Kode_Dokter', '151')
            ->where('P.Medis', 'RAWAT JALAN')
            ->orderBy('Nomor', 'ASC')
            ->get()->toArray();
        return $data;
    }


    // Data Table Pasien Fisioterapi
    public function transaksiFisioByMr($no_mr)
    {
        // $request = $this->httpClient->get($this->simrsUrlApi . 'fisioterapi/transaksi/' . $no_mr);
        // $response = $request->getBody()->getContents();
        // $data = json_decode($response, true);
        // return $data['data'];

        $data = DB::connection('pku')
            ->table('TRANSAKSI_FISIOTERAPI')
            ->where('NO_MR_PASIEN', $no_mr)
            ->orderBy('ID_TRANSAKSI', 'DESC')
            ->get();
        return $data;
    }


    // Menghitung Jumlah Fisio yang sudah dilakukan
    public function countCpptByKodeTr($id)
    {
        $data = DB::connection('pku')->table('TR_CPPT_FISIOTERAPI')->where('ID_TRANSAKSI_FISIO', $id)->count();
        return $data;
    }

    public function jumlahMaxFisioByKodeTr($id)
    {
        $data = DB::connection('pku')->table('TR_CPPT_FISIOTERAPI')->where('ID_TRANSAKSI_FISIO', $id)->count();
        return $data;
    }

    // public function getLastTransaksiFisio()
    // {
    //     $data = DB::connection('pku')
    //         ->table('TRANSAKSI_FISIOTERAPI')
    //         ->orderBy('ID_TRANSAKSI', 'DESC')
    //         ->limit('1')
    //         ->get();
    //     return $data;
    // }


    // // Get Kode Transaksi
    public function getLastTransaksiFisio()
    {
        $request = $this->httpClient->get($this->simrsUrlApi . 'fisioterapi/transaksis');
        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        return $data['data'];
    }

    public function getDataTransaksiByID($id)
    {
        $request = $this->httpClient->get($this->simrsUrlApi . 'fisioterapi/transaksiById/' . $id);
        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        return $data['data'];
    }

    public function addCpptByKodeTr()
    {
        $request = $this->httpClient->get($this->simrsUrlApi . 'api/fisioterapi/cppt/transaksi_fisioterapi');
        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        return $data['data'];
    }

    // Cetak CPPT
    public function cetakCPPT($id)
    {
        $data = DB::connection('pku')
            ->table('TR_CPPT_FISIOTERAPI')
            ->join('TRANSAKSI_FISIOTERAPI', 'TR_CPPT_FISIOTERAPI.ID_TRANSAKSI_FISIO', '=', 'TRANSAKSI_FISIOTERAPI.ID_TRANSAKSI')
            ->where('TR_CPPT_FISIOTERAPI.ID_TRANSAKSI_FISIO', $id)
            ->get();
        return $data;
    }

    // Get Data Pasien CPPT
    public function dataPasienCPPT($id)
    {
        $data = DB::connection('pku')
            ->table('TR_CPPT_FISIOTERAPI')
            ->join('TRANSAKSI_FISIOTERAPI', 'TR_CPPT_FISIOTERAPI.ID_TRANSAKSI_FISIO', '=', 'TRANSAKSI_FISIOTERAPI.ID_TRANSAKSI')
            ->where('TR_CPPT_FISIOTERAPI.ID_TRANSAKSI_FISIO', $id)
            ->orderBy('ID_CPPT_FISIO', 'ASC')
            ->get();
        return $data;
    }

    public function dataPasienTransaksi()
    {
        $data = DB::connection('pku')
            ->table('TRANSAKSI_FISIOTERAPI')
            ->get();
        return $data;
    }

    public function dataEditPasienCPPT($id)
    {
        $data = DB::connection('pku')
            ->table('TR_CPPT_FISIOTERAPI')
            ->join('TRANSAKSI_FISIOTERAPI', 'TR_CPPT_FISIOTERAPI.ID_TRANSAKSI_FISIO', '=', 'TRANSAKSI_FISIOTERAPI.ID_TRANSAKSI')
            ->where('TR_CPPT_FISIOTERAPI.ID_CPPT_FISIO', $id)
            ->first();
        return $data;
    }
}
