<?php

namespace App\Http\Controllers\Fisio;

use App\Models\Pasien;
use GuzzleHttp\Client;
use App\Models\JenisFisio;
use App\Models\Fisioterapi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class FisioController extends Controller
{
    protected $view;
    protected $routeIndex;
    protected $prefix;
    protected $fisio;
    protected $pasien;
    protected $jenisFisio;
    protected $httpClient;
    protected $simrsUrlApi;

    public function __construct(Fisioterapi $fisio)
    {

        $this->fisio = $fisio;
        $this->view = 'pages.fisioterapi.';
        $this->routeIndex = 'cppt.fisio';
        $this->prefix = 'Fisioterapi';
        $this->pasien = new Pasien;
        $this->jenisFisio = new JenisFisio;

        $this->httpClient = new Client([
            'headers' => [
                'Content-Type' => 'application/json'
            ],
        ]);
        $this->simrsUrlApi = env('SIMRS_BASE_URL');
    }

    // LIST DAFTAR PASIEN FISIOTERAPI
    public function index()
    {
        $listpasien = $this->fisio->pasienCpptdanFisioterapi();

        $title = $this->prefix . ' ' . 'Index';
        return view($this->view . 'cppt', compact('title', 'listpasien'));
    }

    // Detail Pasien Transaksi Fisioterapi
    public function transaksi(Request $request)
    {
        $fisioModel = new Fisioterapi();
        $biodatas = $this->pasien->biodataPasienByMr($request->no_mr);
        $transaksis = $this->fisio->transaksiFisioByMr($request->no_mr);
        $title = $this->prefix . ' ' . 'Form CPPT';
        return view($this->view . 'transaksiFisio', compact('title', 'biodatas', 'transaksis', 'fisioModel'));
    }

    // Proses Tambah Data Transaksi Fisioterapi
    public function store(Request $request)
    {
        $lastKodeTransaksi = $this->fisio->getLastTransaksiFisio();


        $kode = 'F';
        if ($lastKodeTransaksi == null) {
            $nomorUrut = "000001";
        } else {
            $noTerakhir = substr($lastKodeTransaksi['KODE_TRANSAKSI_FISIO'], 2) + 1;
            $nomorUrut = sprintf('%06s', $noTerakhir);
            // var_dump($nomorUrut);
            // die;
        }

        $kode_transaksi = $kode . '-' . $nomorUrut;

        $validatedData = $request->validate([
            'NO_MR_PASIEN' => 'required',
            'JUMLAH_TOTAL_FISIO' => 'required|numeric',
        ]);

        $no_mr_pasien = $request->input('NO_MR_PASIEN');
        $jumlah_total_fisio = $request->input('JUMLAH_TOTAL_FISIO');

        if ($jumlah_total_fisio > 8) {
            return redirect()->back()->with('warning', 'Pastikan jumlah maksimal fisioterapi adalah 8 kali');
        }

        $response = $this->httpClient->post($this->simrsUrlApi . 'api/fisioterapi/cppt/transaksi_fisioterapi', [
            'json' => [
                'KODE_TRANSAKSI_FISIO' => $kode_transaksi,
                'NO_MR_PASIEN' => $no_mr_pasien,
                'JUMLAH_TOTAL_FISIO' => $jumlah_total_fisio,
                'CREATE_AT' => now(),
                'CREATE_BY' => auth()->user()->name,
            ]
        ]);

        $responseData = $response->getBody()->getContents();

        return redirect()->back()->with('success', 'Transaksi Berhasil Ditambahkan!');
    }

    // Update Data Transaksi Fisioterapi
    public function update(Request $request, $id_transaksi)
    {


        $validatedData = $request->validate([
            'NO_MR_PASIEN' => 'required',
            'JUMLAH_TOTAL_FISIO' => 'required|numeric',
        ]);

        if ($request->input('JUMLAH_TOTAL_FISIO') > 8) {
            return redirect()->back()->with('warning', 'Pastikan jumlah maksimal fisioterapi adalah 8 kali');
        }

        $response = $this->httpClient->put($this->simrsUrlApi . 'api/fisioterapi/cppt/transaksi_fisioterapi/' . $id_transaksi, [
            'json' => [
                'KODE_TRANSAKSI_FISIO' => $request->input('KODE_TRANSAKSI_FISIO'),
                'NO_MR_PASIEN' => $request->input('NO_MR_PASIEN'),
                'JUMLAH_TOTAL_FISIO' => $request->input('JUMLAH_TOTAL_FISIO'),
            ]
        ]);

        return redirect()->back()->with('success', 'Transaksi Berhasil Diperbarui!');
    }

    // Delete Data Transaksi Fisioterapi
    public function delete($id_transaksi)
    {
        $response = $this->httpClient->delete($this->simrsUrlApi . 'api/fisioterapi/cppt/transaksi_fisioterapi/' . $id_transaksi);

        return redirect()->back()->with('success', 'Transaksi Berhasil Dihapus!');
    }



    // ------------------------------------------//
    // ----- Data Pasien CPPT Fisioterapi ----- //

    // Tambah Data CPPT Pasien Fisioterapi
    public function tambah_cppt(Request $request, $id)
    {
        $title = $this->prefix . ' Tambah CPPT';
        $jenisfisio = DB::connection('sqlsrv')->table('TAC_COM_FISIOTERAPI_MASTER')->get();
     
        $biodatas = $this->pasien->biodataPasienByMr($request->no_mr);
        $data = $this->fisio->dataPasienCPPT($request->no_mr, $request->kode_transaksi);
        $cppt = $this->fisio->getDataTransaksiByID($id);
        return view($this->view . 'tambah', compact('title', 'biodatas', 'data', 'cppt', 'jenisfisio'));
    }

    //Proses Tambah Data CPPT Fisioterapi
    public function tambahDataCPPT(Request $request)
    {
        $cppt = $this->fisio->countCpptByKodeTr($request->input('KD_TRANSAKSI_FISIO'));
        $jumlahmax = $this->fisio->jumlahMaxFisioByKodeTr($request->input('KD_TRANSAKSI_FISIO'));
        $jumlahMaxFisio = $jumlahmax['JUMLAH_TOTAL_FISIO'];

        $validatedData = $request->validate([
            'ANAMNESA' => 'required',
        ]);

        if ($cppt >= $jumlahMaxFisio) {

            return redirect()->back()->with('error', 'Data CPPT Tidak Melebihi batas yang telah ditentukan!');
        } else {
            $jenis_terapi = $request->input('JENIS_FISIO');
            $terapi = '';
            if (!empty($jenis_terapi)) {
                foreach ($jenis_terapi as  $value) {
                    $terapi = $value . ', ' . $terapi;
                }
            }

            $response = $this->httpClient->post($this->simrsUrlApi . 'fisioterapi/cppt/add', [
                'json' => [
                    'KD_TRANSAKSI_FISIO' => $request->input('KD_TRANSAKSI_FISIO'),
                    'NO_MR' => $request->input('NO_MR'),
                    'TEKANAN_DARAH' => $request->input('TEKANAN_DARAH'),
                    'NADI' => $request->input('NADI'),
                    'SUHU' => $request->input('SUHU'),
                    'JENIS_FISIO' => $terapi,
                    'TANGGAL_FISIO' => $request->input('TANGGAL_FISIO'),
                    'JAM_FISIO' => $request->input('JAM_FISIO'),
                    'CARA_PULANG' => $request->input('CARA_PULANG'),
                    'ANAMNESA' => $request->input('ANAMNESA'),
                    'CREATE_AT' => now(),
                    'CREATE_BY' => auth()->user()->name,
                ]
            ]);

            return redirect()->back()->with('success', 'CPPT Berhasil Ditambahkan!');
        }
    }

    // Edit Data CPPT Fisioterapi
    public function edit_cppt($id)
    {

              // Memecah string menjadi array
    
              $jenis_terapi_fisio =  DB::connection('sqlsrv')->table('TR_CPPT_FISIOTERAPI')->where('ID_CPPT_FISIO', $id)->first();

      
              $data = array();
              $string = $jenis_terapi_fisio->JENIS_FISIO;
              $string = trim($string, ','); // Menghapus koma di awal dan akhir string (jika ada)
             $jenis_fisio=array();
              if (!empty($string)) {
                  $jenis_fisio = explode(', ', $string);
              }

        $title = $this->prefix . ' ' . 'CPPT';

        $jenisfisio = $this->jenisFisio->getDataJenisFisio();
        $data = $this->fisio->dataEditPasienCPPT($id);

        return view($this->view . 'edit', compact('title', 'data', 'jenisfisio','jenis_fisio'));
    }

    // Proses Edit Data CPPT Fisioterapi
    public function editDataCPPT(Request $request, $id)
    {
        $validatedData = $request->validate([
            'ANAMNESA' => 'required',
        ]);

        $jenis_terapi = $request->input('JENIS_FISIO');
        $terapi = '';
        if (!empty($jenis_terapi)) {
            foreach ($jenis_terapi as  $value) {
                $terapi = $value . ', ' . $terapi;
            }
        }

        $response = $this->httpClient->put($this->simrsUrlApi . 'fisioterapi/cppt/update/' . $id, [
            'json' => [
                'KD_TRANSAKSI_FISIO' => $request->input('KD_TRANSAKSI_FISIO'),
                'NO_MR' => $request->input('NO_MR'),
                'TEKANAN_DARAH' => $request->input('TEKANAN_DARAH'),
                'NADI' => $request->input('NADI'),
                'SUHU' => $request->input('SUHU'),
                'JENIS_FISIO' => $terapi,
                'TANGGAL_FISIO' => $request->input('TANGGAL_FISIO'),
                'JAM_FISIO' => $request->input('JAM_FISIO'),
                'CARA_PULANG' => $request->input('CARA_PULANG'),
                'ANAMNESA' => $request->input('ANAMNESA'),
                'CREATE_AT' => now(),
                'CREATE_BY' => auth()->user()->name,
            ]
        ]);

       

        return redirect()->route('cppt.tambah',  [$request->input('NO_MR'), $request->input('KD_TRANSAKSI_FISIO')])->with('success', 'CPPT Berhasil Diperbarui!');
    }

    // Delete Data CPPT Fisioterapi
    public function deleteDataCPPT($id_cppt)
    {
        $response = $this->httpClient->delete($this->simrsUrlApi . 'fisioterapi/cppt/delete/' . $id_cppt);

        return redirect()->back()->with('success', 'CPPT Berhasil Dihapus!');
    }

    public function cetak_cppt(Request $request, $kode_transaksi)
    {
        $title = $this->prefix . ' ' . 'Cetak CPPT';

        $data = $this->fisio->cetakCPPT($kode_transaksi);
        $biodatas = $this->pasien->biodataPasienByMr($request->no_mr);
        $date = date('dMY');
        $filename = 'CPPT-' . $date . '-' . $kode_transaksi;

        $pdf = PDF::loadview($this->view . 'cetak/cppt', ['title' => $title, 'data' => $data, 'biodatas' => $biodatas]);
        return $pdf->stream($filename . '.pdf');
    }

    public function bukti_layanan(Request $request, $kode_transaksi)
    {
        $title = $this->prefix . ' ' . 'Bukti Layanan CPPT';

        $data = $this->fisio->cetakCPPT($kode_transaksi);
        $biodatas = $this->pasien->biodataPasienByMr($request->no_mr);
        $date = date('dMY');
        $filename = 'BuktiLayanan-' . $date . '-' . $kode_transaksi;
        $pdf = PDF::loadview($this->view . 'cetak/bukti_pelayanan', ['title' => $title, 'data' => $data, 'biodatas' => $biodatas]);
        return $pdf->stream($filename . '.pdf');
    }
}
