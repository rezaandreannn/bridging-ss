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

    public function asasmenPerawatGet($noReg)
    {
        $data = DB::connection('pku')->table('TAC_ASES_PER2')
            ->join('TAC_RJ_VITAL_SIGN', 'TAC_ASES_PER2.FS_KD_REG', '=', 'TAC_RJ_VITAL_SIGN.FS_KD_REG')
            ->join('TAC_RJ_NYERI', 'TAC_ASES_PER2.FS_KD_REG', '=', 'TAC_RJ_NYERI.FS_KD_REG')
            ->join('TAC_RJ_JATUH', 'TAC_ASES_PER2.FS_KD_REG', '=', 'TAC_RJ_JATUH.FS_KD_REG')
            ->join('TAC_RJ_NUTRISI', 'TAC_ASES_PER2.FS_KD_REG', '=', 'TAC_RJ_NUTRISI.FS_KD_REG')
            ->where('TAC_ASES_PER2.FS_KD_REG', $noReg)->first();

        // $data = DB::connection('pku')
        //     ->table('TR_CPPT_FISIOTERAPI')
        //     ->join('TRANSAKSI_FISIOTERAPI', 'TR_CPPT_FISIOTERAPI.ID_TRANSAKSI_FISIO', '=', 'TRANSAKSI_FISIOTERAPI.ID_TRANSAKSI')
        //     ->where('TR_CPPT_FISIOTERAPI.ID_TRANSAKSI_FISIO', $id)
        //     ->get();
        return $data;
    }

    public function riwayatGet($noReg)
    {
        $data = DB::connection('db_rsmm')->table('REGISTER_PASIEN')
            ->join('PENDAFTARAN', 'REGISTER_PASIEN.NO_MR', '=', 'PENDAFTARAN.NO_MR')
            ->where('PENDAFTARAN.NO_REG', $noReg)->first();

        // $data = DB::connection('pku')
        //     ->table('TR_CPPT_FISIOTERAPI')
        //     ->join('TRANSAKSI_FISIOTERAPI', 'TR_CPPT_FISIOTERAPI.ID_TRANSAKSI_FISIO', '=', 'TRANSAKSI_FISIOTERAPI.ID_TRANSAKSI')
        //     ->where('TR_CPPT_FISIOTERAPI.ID_TRANSAKSI_FISIO', $id)
        //     ->get();
        return $data;
    }

    public function masalahPerawatanGetByNoreg($noReg)
    {
        $data = DB::connection('pku')->table('TAC_RJ_MASALAH_KEP')
            ->where('FS_KD_REG', $noReg)->get();

        // $data = DB::connection('pku')
        //     ->table('TR_CPPT_FISIOTERAPI')
        //     ->join('TRANSAKSI_FISIOTERAPI', 'TR_CPPT_FISIOTERAPI.ID_TRANSAKSI_FISIO', '=', 'TRANSAKSI_FISIOTERAPI.ID_TRANSAKSI')
        //     ->where('TR_CPPT_FISIOTERAPI.ID_TRANSAKSI_FISIO', $id)
        //     ->get();
        return $data;
    }
    public function rencanaPerawatanGetByNoreg($noReg)
    {
        $data = DB::connection('pku')->table('TAC_RJ_REN_KEP')
            ->where('FS_KD_REG', $noReg)->get();

        // $data = DB::connection('pku')
        //     ->table('TR_CPPT_FISIOTERAPI')
        //     ->join('TRANSAKSI_FISIOTERAPI', 'TR_CPPT_FISIOTERAPI.ID_TRANSAKSI_FISIO', '=', 'TRANSAKSI_FISIOTERAPI.ID_TRANSAKSI')
        //     ->where('TR_CPPT_FISIOTERAPI.ID_TRANSAKSI_FISIO', $id)
        //     ->get();
        return $data;
    }

    // Button Cek Laboratori
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

    // Button Cek Radiologi
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
        $request = $this->httpClient->get($this->simrsUrlApi . 'api/rawatjalan/perawat/masalah_keperawatan');
        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        return $data['data'];
    }

    public function rencana_perawatan()
    {
        $request = $this->httpClient->get($this->simrsUrlApi . 'api/rawatjalan/perawat/rencana_keperawatan');
        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        return $data['data'];
    }

    // Get Data Pasien Rawat Jalan
    public function pasien_bynoreg($noReg)
    {
        $request = $this->httpClient->get($this->simrsUrlApi . 'pasien/biodatabynoreg/' . $noReg);
        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        // Mengganti kunci NO_REG menjadi No_Reg
        $data['data']['No_Reg'] = $data['data']['NO_REG'];
        unset($data['data']['NO_REG']);
        return $data['data'];
    }

    //  View Profil Resume Medis Pasien
    public function resumeMedisPasienByMR($noMR)
    {
        $request = $this->httpClient->get($this->simrsUrlApi . 'berkas/resumeRawatJalan/' . $noMR);
        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        return $data['data'];
    }

    // Cetak Profil Resume Medis Pasien
    public function profilMR($noMR)
    {
        $request = $this->httpClient->get($this->simrsUrlApi . 'pasien/biodatabymr/' . $noMR);
        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        return $data['data'];
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

    public function getSkdp($NoReg)
    {

        $data = DB::connection('pku')->table('TAC_RJ_SKDP')->where('FS_KD_REG', $NoReg)->get()->first();
        return $data;
    }

    public function get_rencana_skdp_by_noreg()
    {

        $data = DB::connection('pku')->table('TAC_COM_PARAMETER_SKDP_RENCANA')->get()->toArray();
        return $data;
    }
    public function get_rencana_skdp($id)
    {

        $data = DB::connection('pku')->table('TAC_COM_PARAMETER_SKDP_RENCANA')->where('FS_KD_TRS_SKDP_ALASAN',$id)->get();
        return $data;
    }
}
