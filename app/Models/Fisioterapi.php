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


    public function getDokterFisio(){
            $data= DB::connection('db_rsmm')
        ->table('DOKTER as d')
        ->select(
            'd.Kode_Dokter',
            'd.Nama_Dokter'
        )
        ->whereIn('d.Spesialis', array('SPESIALIS REHABILITASI MEDIK','FISIOTERAPI'))
        ->get();

        return $data;
    }

    // List Pasien Fisioterapi
    public function pasienCpptdanFisioterapi($kode_dokter)
    {
        // $query= DB::connection('db_rsmm')
        // ->table('DOKTER as d')
        // ->select('d.Kode_Dokter')
        // ->whereIn('d.Spesialis', array('SPESIALIS REHABILITASI MEDIK','FISIOTERAPI'))
        // ->get();

        // dd($query);
        $date = date('Y-m-d');
        $data = DB::connection('db_rsmm')
            ->table('ANTRIAN as a')
            ->Join('REGISTER_PASIEN as rp', 'a.No_MR', '=', 'rp.No_MR')
            ->Join('PENDAFTARAN as p', 'a.No_MR', '=', 'p.No_MR')
            ->Join('DOKTER as d', 'p.KODE_DOKTER', '=', 'd.KODE_DOKTER')
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
            // ->whereIn('p.Kode_Dokter', function ($query) {
            //     $query->select('d.Kode_Dokter')
            //           ->from('DOKTER as d')
            //           ->whereIn('d.Spesialis', array('SPESIALIS REHABILITASI MEDIK','FISIOTERAPI'));
            // })
            // ->whereIn('a.Dokter', function ($query) {
            //     $query->select('d.Kode_Dokter')
            //           ->from('DOKTER as d')
            //           ->whereIn('d.Spesialis', array('SPESIALIS REHABILITASI MEDIK','FISIOTERAPI'));
            // })
      
            ->where('p.Kode_Dokter', $kode_dokter)
            ->where('a.Dokter', $kode_dokter)
            ->where('a.Tanggal', $date)
            ->where('p.Tanggal', $date)
            ->where('p.Status', '1')
            ->orderBy('a.NOMOR', 'ASC')
            ->get()->toArray();


        return $data;
    }

    public function pasienCpptdanFisioterapiList()
    {
        // $query= DB::connection('db_rsmm')
        // ->table('DOKTER as d')
        // ->select('d.Kode_Dokter')
        // ->whereIn('d.Spesialis', array('SPESIALIS REHABILITASI MEDIK','FISIOTERAPI'))
        // ->get();

        // dd($query);
        $date = date('Y-m-d');
        $data = DB::connection('db_rsmm')
            ->table('ANTRIAN as a')
            ->Join('REGISTER_PASIEN as rp', 'a.No_MR', '=', 'rp.No_MR')
            ->Join('PENDAFTARAN as p', 'a.No_MR', '=', 'p.No_MR')
            ->Join('DOKTER as d', 'p.KODE_DOKTER', '=', 'd.KODE_DOKTER')
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
            ->whereIn('p.Kode_Dokter', function ($query) {
                $query->select('d.Kode_Dokter')
                      ->from('DOKTER as d')
                      ->whereIn('d.Spesialis', array('SPESIALIS REHABILITASI MEDIK','FISIOTERAPI'));
            })
            ->whereIn('a.Dokter', function ($query) {
                $query->select('d.Kode_Dokter')
                      ->from('DOKTER as d')
                      ->whereIn('d.Spesialis', array('SPESIALIS REHABILITASI MEDIK','FISIOTERAPI'));
            })
      
            // ->where('p.Kode_Dokter', $kode_dokter)
            // ->where('a.Dokter', $kode_dokter)
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

    public function getPasienRehabMedis($kode_dokter)
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
                'P.NO_REG',
                'st.FS_STATUS'

            )
            ->where('A.Tanggal', $date)
            ->where('P.Tanggal', $date)
            ->where('A.Dokter', $kode_dokter)
            ->where('P.Kode_Dokter', $kode_dokter)
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

    public function cekInformedConcent($no_reg)
    {
    

        $data = DB::connection('pku')
            ->table('INFORMED_CONCENT_FISIOTERAPI')
            ->select('KODE_REGISTER')
            ->where('KODE_REGISTER', $no_reg)
            ->first();

            if ($data != null) {
                return true;
            } else {
                return false;
            }
    }

    public function cekSuratRujukan($no_reg)
    {
    

        $data = DB::connection('pku')
            ->table('fis_surat_rujukan')
            ->select('kode_registrasi')
            ->where('kode_registrasi', $no_reg)
            ->first();

            if ($data != null) {
                return true;
            } else {
                return false;
            }
    }

    public function getInformedConcent($no_reg)
    {
    
        $db_emr = DB::connection('sqlsrv')->getDatabaseName();
        $data = DB::connection('pku')
            ->table('INFORMED_CONCENT_FISIOTERAPI as ics')
            ->leftJoin($db_emr . '.dbo.users as u', 'ics.create_by', '=', 'u.id')
            ->leftJoin('TTD_PETUGAS_MASTER as t', 'u.username', '=', 't.USERNAME')->select(
                'ics.*',
                'u.name',
                't.IMAGE'

            )
            ->where('ics.KODE_REGISTER', $no_reg)
            ->first();
        return $data;
    }

    public function getSuratRujukan($no_reg)
    {
    
        $db_emr = DB::connection('sqlsrv')->getDatabaseName();
        $data = DB::connection('pku')
            ->table('fis_surat_rujukan as fsr')
            ->leftJoin($db_emr . '.dbo.users as u', 'fsr.create_by', '=', 'u.id')
            ->leftJoin('TTD_PETUGAS_MASTER as t', 'u.username', '=', 't.USERNAME')->select(
                'fsr.*',
                'u.name',
                't.IMAGE'

            )
            ->where('fsr.kode_registrasi', $no_reg)
            ->first();
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

    public function cek_asesmen_dokter_fisio($noReg)
    {
        $data = DB::connection('pku')->table('fis_asesmen_dokter')
            ->select('no_registrasi')
            ->where('no_registrasi', $noReg)
            ->first();

        if ($data != null) {
            return true;
        } else {
            return false;
        }
    }

    public function cek_cppt($noMr)
    {
        $data = DB::connection('pku')->table('TRANSAKSI_FISIOTERAPI as TS')
        ->Join('TR_CPPT_FISIOTERAPI as TRC', 'TS.ID_TRANSAKSI', '=', 'TRC.ID_TRANSAKSI_FISIO')->select(
            'TRC.ID_TRANSAKSI_FISIO'
        )
            ->where('TS.NO_MR_PASIEN', $noMr)
            ->orderBy('TS.KODE_TRANSAKSI_FISIO','DESC')
            ->first();
            if ($data != null) {
                return true;
            } else {
                return false;
            }
         
    }


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
    public function cpptGet($id)
    {
        $dbemr_new = DB::connection('sqlsrv')->getDatabaseName();
        $data = DB::connection('pku')
            ->table('TR_CPPT_FISIOTERAPI as TR_CPPT')
            ->join('TRANSAKSI_FISIOTERAPI as TR_FIS', 'TR_CPPT.ID_TRANSAKSI_FISIO', '=', 'TR_FIS.ID_TRANSAKSI')
            ->Join($dbemr_new . '.dbo.users as U', 'TR_CPPT.CREATE_BY', '=', 'u.id')->select(
                'TR_CPPT.*',
                'U.name',

            )
            ->where('TR_CPPT.ID_TRANSAKSI_FISIO', $id)
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

    public function getDiagnosisKlinis()
    {
        $data = DB::connection('pku')
            ->table('fis_master_diagnosis_fungsi')
            ->get();
        return $data;
    }
    
    public function getDiagnosisMedis()
    {
        $data = DB::connection('pku')
            ->table('fis_master_diagnosis_medis')
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
