<?php

namespace App\Models;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
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
        // First query for fisioterapi
        $fisioQuery = DB::connection('db_rsmm')
            ->table('DOKTER')
            ->select(
                'KODE_DOKTER as kode_dokter',
                'NAMA_DOKTER as nama_dokter'
            )
            ->where('Spesialis', 'FISIOTERAPI');

        // Second query for dokter spesialis
        $dokterQuery = DB::connection('db_rsmm')
            ->table('DOKTER')
            ->select(
                'KODE_DOKTER as kode_dokter',
                'NAMA_DOKTER as nama_dokter'
            )
            ->whereNotIn('KODE_DOKTER', ['140s', 'TM140', '01JKN'])
            ->where('JENIS_PROFESI', 'DOKTER SPESIALIS')
            ->orWhere('Kode_Dokter', '100');

        // Combine both queries using union
        $combinedQuery = $fisioQuery->union($dokterQuery);

        // Get the results as an array
        $data = $combinedQuery->get()->toArray();

        return $data;
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

    public function asasmenPerawatGet($noReg)
    {
        $data = DB::connection('pku')->table('TAC_ASES_PER2')
            ->join('TAC_RJ_VITAL_SIGN', 'TAC_ASES_PER2.FS_KD_REG', '=', 'TAC_RJ_VITAL_SIGN.FS_KD_REG')
            ->join('TAC_RJ_NYERI', 'TAC_ASES_PER2.FS_KD_REG', '=', 'TAC_RJ_NYERI.FS_KD_REG')
            ->join('TAC_RJ_JATUH', 'TAC_ASES_PER2.FS_KD_REG', '=', 'TAC_RJ_JATUH.FS_KD_REG')
            ->join('TAC_RJ_NUTRISI', 'TAC_ASES_PER2.FS_KD_REG', '=', 'TAC_RJ_NUTRISI.FS_KD_REG')
            ->where('TAC_ASES_PER2.FS_KD_REG', $noReg)
            ->first();

        return $data;
    }

    public function asasmenPerawatKonsul($noReg)
    {
        $dbpku = DB::connection('db_rsmm')->getDatabaseName();
        $data = DB::connection('pku')->table('TAC_ASES_PER2')
            ->join('TAC_RJ_VITAL_SIGN', 'TAC_ASES_PER2.FS_KD_REG', '=', 'TAC_RJ_VITAL_SIGN.FS_KD_REG')
            ->join('TAC_RJ_JATUH', 'TAC_ASES_PER2.FS_KD_REG', '=', 'TAC_RJ_JATUH.FS_KD_REG')
            ->leftJoin($dbpku . '.dbo.REGISTER_PASIEN', 'TAC_ASES_PER2.FS_KD_REG', '=', 'REGISTER_PASIEN.No_MR')
            ->where('TAC_ASES_PER2.FS_KD_REG', $noReg)
            ->first();

        return $data;
    }

    public function assesmenPerawatIGD($noReg)
    {
        $data = DB::connection('pku')->table('TAC_ASES_PER2')
            ->leftjoin('TAC_RJ_VITAL_SIGN', 'TAC_ASES_PER2.FS_KD_REG', '=', 'TAC_RJ_VITAL_SIGN.FS_KD_REG')
            ->leftjoin('TAC_RJ_NYERI', 'TAC_ASES_PER2.FS_KD_REG', '=', 'TAC_RJ_NYERI.FS_KD_REG')
            ->leftjoin('TAC_RJ_NUTRISI', 'TAC_ASES_PER2.FS_KD_REG', '=', 'TAC_RJ_NUTRISI.FS_KD_REG')
            ->leftjoin('TAC_RJ_ALERGI', 'TAC_ASES_PER2.FS_KD_REG', '=', 'TAC_RJ_ALERGI.FS_KD_REG')
            ->where('TAC_ASES_PER2.FS_KD_REG', $noReg)
            ->first();

        return $data;
    }

    public function riwayatGet($noReg)
    {
        $data = DB::connection('db_rsmm')->table('REGISTER_PASIEN')
            ->join('PENDAFTARAN', 'REGISTER_PASIEN.NO_MR', '=', 'PENDAFTARAN.NO_MR')
            ->where('PENDAFTARAN.NO_REG', $noReg)->first();
        return $data;
    }

    public function getUserEmr($username)
    {
        $data = DB::connection('pku')->table('TAC_COM_USER')
            ->where('user_name', $username)->first();
        return $data;
    }

    public function masalahPerawatanGetByNoreg($noReg)
    {
        $data = DB::connection('pku')->table('TAC_RJ_MASALAH_KEP')
            ->where('FS_KD_REG', $noReg)->get();
        return $data;
    }

    public function getKodeDokterIGD($noReg)
    {
        $data = DB::connection('db_rsmm')->table('DOKTER')
            ->where('Kode_Dokter', $noReg)->first();
        return $data;
    }

    public function rencanaPerawatanGetByNoreg($noReg)
    {
        $data = DB::connection('pku')->table('TAC_RJ_REN_KEP')
            ->where('FS_KD_REG', $noReg)->get();
        return $data;
    }

    // Button Cek Laboratori
    public function cek_lab($noReg)
    {
        $data = DB::connection('pku')->table('TA_TRS_KARTU_PERIKSA4')
            ->select('FS_KD_REG2')
            ->where('FS_KD_REG2', $noReg)
            ->first();

        if ($data != null) {
            return true;
        } else {
            return false;
        }
    }

    // Button Cek Radiologi
    public function cek_rad($noReg)
    {
        $data = DB::connection('pku')
            ->table('TA_TRS_KARTU_PERIKSA5')
            ->select(
                'FS_KD_REG2'
            )
            ->where('FS_KD_REG2', $noReg)
            ->first();

        if ($data != null) {
            return true;
        } else {
            return false;
        }
    }

    public function cek_order_alkes($noReg)
    {

        $data = DB::connection('pku')
            ->table('fis_order_alkes')
            ->select(
                'no_registrasi'
            )
            ->where('no_registrasi', $noReg)
            ->first();

        if ($data != null) {
            return true;
        } else {
            return false;
        }
    }

    public function cek_lingkar_pinggang($noReg)
    {

        $data = DB::connection('pku')
            ->table('fis_order_alkes')
            ->select(
                'no_registrasi',
                'lingkar_pinggang'
            )
            ->where('no_registrasi', $noReg)
            ->first();

        return $data;
    }

    public function masalah_perawatan()
    {
        $data = DB::connection('pku')->table('TAC_COM_DAFTAR_DIAG')->get();
        return $data;
    }

    public function rencana_perawatan()
    {
        $data = DB::connection('pku')->table('TAC_COM_PARAM_REN_KEP')->get();
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

    // Get Data Pasien Rawat Jalan (Jangan Dirubah)
    public function pasien_bynoreg($noReg)
    {

        $pku = DB::connection('pku')->getDatabaseName();

        $data = DB::connection('db_rsmm')
            ->table('REGISTER_PASIEN as a')
            ->leftJoin('PENDAFTARAN as b', 'a.No_MR', '=', 'b.No_MR')
            ->leftJoin('DOKTER as c', 'b.KODE_DOKTER', '=', 'c.KODE_DOKTER')
            ->leftJoin($pku . '.dbo.TAC_RJ_MEDIS as d', 'b.NO_REG', '=', 'd.FS_KD_REG')
            ->leftJoin('REKANAN as e', 'b.KODEREKANAN', '=', 'e.KODEREKANAN')
            ->select(
                'a.NAMA_PASIEN',
                'a.NO_MR',
                'a.ALAMAT',
                'a.JENIS_KELAMIN',
                'a.PROVINSI',
                'a.HP1',
                'a.HP2',
                'a.TGL_LAHIR',
                'a.FS_REAK_ALERGI',
                'a.FS_RIW_PENYAKIT_DAHULU',
                'a.FS_RIW_PENYAKIT_DAHULU2',
                'a.FS_HIGH_RISK',
                'b.NO_REG',
                'b.Tanggal',
                'b.Kode_Dokter',
                'c.NAMA_DOKTER',
                'c.SPESIALIS',
                'd.FS_DIAGNOSA',
                'd.FS_DIAGNOSA_SEKUNDER',
                'd.FS_KD_TRS',
                'e.NAMAREKANAN',
                'a.FS_ALERGI',
            )
            ->where('b.NO_REG', $noReg)
            ->first();
        return $data;
    }

    //  View Profil Resume Medis Pasien
    // public function resumeMedisPasienByMR($noMR)
    // {
    //     $request = $this->httpClient->get($this->simrsUrlApi . 'berkas/resumeRawatJalan/' . $noMR);
    //     $response = $request->getBody()->getContents();
    //     $data = json_decode($response, true);
    //     return $data['data'];
    // }

    // Data Cetak Resume Berkas Pasien
    public function resumeMedisPasienByMR($noMR)
    {
        $dbpku = DB::connection('pku')->getDatabaseName();
        $data = DB::connection('db_rsmm')
            ->table('PENDAFTARAN as a')
            ->Join('REGISTER_PASIEN as rp', 'a.No_MR', '=', 'rp.No_MR')
            ->Join('DOKTER as c', 'a.KODE_DOKTER', '=', 'c.KODE_DOKTER')
            ->leftJoin($dbpku . '.dbo.TAC_RJ_MEDIS as st', 'a.NO_REG', '=', 'st.FS_KD_REG')
            ->leftJoin($dbpku . '.dbo.TAC_RJ_VITAL_SIGN as m', 'a.NO_REG', '=', 'm.FS_KD_REG')
            ->select(
                'a.TANGGAL',
                'a.STATUS',
                'a.NO_REG',
                'rp.NAMA_PASIEN',
                'rp.ALAMAT',
                'rp.NO_MR',
                'rp.KOTA',
                'rp.PROVINSI',
                'rp.GOL_DARAH',
                'rp.STATUS_NIKAH',
                'rp.NAMA_PASANGAN',
                'rp.TGL_LAHIR',
                'rp.JENIS_KELAMIN',
                'rp.WARGA_NEGARA',
                'rp.PEKERJAAN',
                'rp.AGAMA',
                'rp.NO_TELP',
                'rp.HP1',
                'rp.HP2',
                'rp.KODE_POS',
                'rp.EMAIL',
                'rp.NAMA_HUB',
                'rp.NO_IDENTITAS',
                'rp.HUB_PASIEN',
                'rp.TELP_RUMAH',
                'rp.FS_ALERGI',
                'c.NAMA_DOKTER',
                'c.SPESIALIS',
                'st.*',
                'm.*',
            )
            ->where('a.NO_MR', $noMR)
            ->orderBy('a.TANGGAL', 'DESC')
            ->limit('10')
            ->get()->toArray();
        return $data;
    }

    // Edit Data Rawat Jalan
    public function editData($noMR)
    {
        $request = $this->httpClient->get($this->simrsUrlApi . 'api/rawatjalan/perawat/asasmen_perawat/' . $noMR);
        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        return $data['data'];
    }

    // alasan skdp
    public function getAlesanSkdp()
    {
        $data = DB::connection('pku')->table('TAC_COM_PARAMETER_SKDP_ALASAN')->get();
        return $data;
    }

    public function getTanggal($noReg)
    {
        $data = DB::connection('pku')->table('TAC_ASES_PER2')->where('FS_KD_REG', $noReg)->first();
        return $data;
    }

    public function getSkdp($NoReg)
    {
        $data = DB::connection('pku')->table('TAC_RJ_SKDP')->where('FS_KD_REG', $NoReg)->get();
        return $data;
    }
    public function getSkdp2($NoReg)
    {
        $data = DB::connection('pku')->table('TAC_RJ_SKDP')->where('FS_KD_REG', $NoReg)->first();
        return $data;
    }

    public function getEditSkdp($NoReg)
    {
        $data = DB::connection('pku')->table('TAC_RJ_SKDP')->where('FS_KD_REG', $NoReg)->first();
        return $data;
    }

    public function get_rencana_skdp_by_noreg()
    {
        $data = DB::connection('pku')->table('TAC_COM_PARAMETER_SKDP_RENCANA')->get()->toArray();
        return $data;
    }
    public function get_rencana_skdp($id)
    {
        $data = DB::connection('pku')->table('TAC_COM_PARAMETER_SKDP_RENCANA')->where('FS_KD_TRS_SKDP_ALASAN', $id)->get();
        return $data;
    }

    public function editRujukInternal($noReg)
    {
        $data = DB::connection('pku')->table('TAC_RJ_RUJUKAN')
            ->select(
                'TAC_RJ_RUJUKAN.*',
            )
            ->where('FS_KD_REG', $noReg)
            ->first();

        return $data;
    }
    public function editPRB($noReg)
    {
        $data = DB::connection('pku')->table('TAC_RJ_PRB')
            ->select(
                'TAC_RJ_PRB.*',
            )
            ->where('FS_KD_REG', $noReg)
            ->first();

        return $data;
    }
}
