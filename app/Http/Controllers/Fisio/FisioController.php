<?php

namespace App\Http\Controllers\Fisio;

use App\Models\Pasien;
use App\Models\Fisioterapi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use App\Models\Rekam_medis;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Client;

class FisioController extends Controller
{
    protected $view;
    protected $routeIndex;
    protected $prefix;
    protected $fisio;
    protected $pasien;
    protected $httpClient;
    protected $simrsUrlApi;

    public function __construct(Fisioterapi $fisio)
    {

        $this->fisio = $fisio;
        $this->view = 'pages.fisioterapi.';
        $this->routeIndex = 'cppt.fisio';
        $this->prefix = 'Fisioterapi';
        $this->pasien = new Pasien;

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

        return redirect()->back()->with('success', 'Transaction added successfully!');
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

        return redirect()->back()->with('success', 'Transaction updated successfully!');
    }

    // Delete Data Transaksi Fisioterapi
    public function delete($id_transaksi)
    {
        $response = $this->httpClient->delete($this->simrsUrlApi . 'api/fisioterapi/cppt/transaksi_fisioterapi/' . $id_transaksi);

        return redirect()->back()->with('success', 'Transaction deleted successfully!');
    }



    // -------------------------------------------
    // Data Pasien CPPT Fisioterapi

    // Tambah Data CPPT Pasien Fisioterapi
    public function tambah_cppt(Request $request)
    {
        $title = $this->prefix . ' Tambah CPPT';
        $biodatas = $this->pasien->biodataPasienByMr($request->no_mr);
        $data = $this->fisio->dataPasienCPPT($request->no_mr, $request->kode_transaksi);
        $cppt = $this->fisio->getLastTransaksiFisio();
        return view($this->view . 'tambah', compact('title', 'biodatas', 'data', 'cppt'));
    }

    //Proses Tambah Data CPPT Fisioterapi
    public function tambahDataCPPT(Request $request)
    {
        $validatedData = $request->validate([
            'ANAMNESA' => 'required',
        ]);

        $response = $this->httpClient->post($this->simrsUrlApi . 'fisioterapi/cppt/add', [
            'json' => [
                'KD_TRANSAKSI_FISIO' => $request->input('KD_TRANSAKSI_FISIO'),
                'NO_MR' => $request->input('NO_MR'),
                'TEKANAN_DARAH' => $request->input('TEKANAN_DARAH'),
                'NADI' => $request->input('NADI'),
                'SUHU' => $request->input('SUHU'),
                'TERAPI' => $request->input('TERAPI'),
                'JENIS_FISIO' => $request->input('JENIS_FISIO'),
                'TANGGAL_FISIO' => $request->input('TANGGAL_FISIO'),
                'JAM_FISIO' => $request->input('JAM_FISIO'),
                'CARA_PULANG' => $request->input('CARA_PULANG'),
                'ANAMNESA' => $request->input('ANAMNESA'),
                'CREATE_AT' => now(),
                'CREATE_BY' => auth()->user()->name,
            ]
        ]);

        return redirect()->back()->with('success', 'Data CPPT Added successfully!');
    }

    // Edit Data CPPT Fisioterapi
    public function edit_cppt($id)
    {
        $title = $this->prefix . ' ' . 'CPPT';
        $data = $this->fisio->dataEditPasienCPPT($id);
        return view($this->view . 'edit', compact('title', 'data'));
    }

    // Proses Edit Data CPPT Fisioterapi
    public function editDataCPPT(Request $request, $id)
    {
        $validatedData = $request->validate([
            'ANAMNESA' => 'required',
        ]);

        $response = $this->httpClient->put($this->simrsUrlApi . 'fisioterapi/cppt/add' . $id, [
            'json' => [
                'KD_TRANSAKSI_FISIO' => $request->input('KD_TRANSAKSI_FISIO'),
                'NO_MR' => $request->input('NO_MR'),
                'TEKANAN_DARAH' => $request->input('TEKANAN_DARAH'),
                'NADI' => $request->input('NADI'),
                'SUHU' => $request->input('SUHU'),
                'TERAPI' => $request->input('TERAPI'),
                'JENIS_FISIO' => $request->input('JENIS_FISIO'),
                'TANGGAL_FISIO' => $request->input('TANGGAL_FISIO'),
                'JAM_FISIO' => $request->input('JAM_FISIO'),
                'CARA_PULANG' => $request->input('CARA_PULANG'),
                'ANAMNESA' => $request->input('ANAMNESA'),
                'CREATE_AT' => now(),
                'CREATE_BY' => auth()->user()->name,
            ]
        ]);

        return redirect()->back()->with('success', 'Data CPPT Added successfully!');
    }

    // Delete Data CPPT Fisioterapi
    public function deleteDataCPPT($id_cppt)
    {
        $response = $this->httpClient->delete($this->simrsUrlApi . 'fisioterapi/cppt/delete/' . $id_cppt);

        return redirect()->back()->with('success', 'CPPT deleted successfully!');
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
