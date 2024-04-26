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

    public function index()
    {
        $listpasien = $this->fisio->pasienCpptdanFisioterapi();

        $title = $this->prefix . ' ' . 'Index';
        return view($this->view . 'cppt', compact('title', 'listpasien'));
    }

    public function edit(Request $request)
    {
        $fisioModel = new Fisioterapi();
        $biodatas = $this->pasien->biodataPasienByMr($request->no_mr);
        $transaksis = $this->fisio->transaksiFisioByMr($request->no_mr);
        $title = $this->prefix . ' ' . 'Form CPPT';
        return view($this->view . 'transaksiFisio', compact('title', 'biodatas', 'transaksis', 'fisioModel'));
    }

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

        // Make a POST request to the API endpoint
        $response = $this->httpClient->post($this->simrsUrlApi . 'api/fisioterapi/cppt/transaksi_fisioterapi', [
            'json' => [
                'KODE_TRANSAKSI_FISIO' => $kode_transaksi,
                'NO_MR_PASIEN' => $no_mr_pasien,
                'JUMLAH_TOTAL_FISIO' => $jumlah_total_fisio,
                'CREATE_AT' => now(),
                'CREATE_BY' => auth()->user()->name,
            ]
        ]);

        // Get the response body
        $responseData = $response->getBody()->getContents();
        // Redirect the user back or to a different page after successful submission
        return redirect()->back()->with('success', 'Transaction added successfully!');
    }

    public function update(Request $request, $id_transaksi)
    {

        // Validate the incoming request data
        $validatedData = $request->validate([
            'NO_MR_PASIEN' => 'required',
            'JUMLAH_TOTAL_FISIO' => 'required|numeric',
        ]);

        if ($request->input('JUMLAH_TOTAL_FISIO') > 8) {
            return redirect()->back()->with('warning', 'Pastikan jumlah maksimal fisioterapi adalah 8 kali');
        }

        // Make a PUT or PATCH request to the API endpoint to update the data
        $response = $this->httpClient->put($this->simrsUrlApi . 'api/fisioterapi/cppt/transaksi_fisioterapi/' . $id_transaksi, [
            'json' => [
                'KODE_TRANSAKSI_FISIO' => $request->input('KODE_TRANSAKSI_FISIO'),
                'NO_MR_PASIEN' => $request->input('NO_MR_PASIEN'),
                'JUMLAH_TOTAL_FISIO' => $request->input('JUMLAH_TOTAL_FISIO'),
                // Add other fields you want to update here
            ]
        ]);

        // Redirect the user back or to a different page after successful submission
        return redirect()->back()->with('success', 'Transaction updated successfully!');
    }

    public function delete($id_transaksi)
    {

        // Make a PUT or PATCH request to the API endpoint to update the data
        $response = $this->httpClient->delete($this->simrsUrlApi . 'api/fisioterapi/cppt/transaksi_fisioterapi/' . $id_transaksi);
        // Redirect the user back or to a different page after successful submission
        return redirect()->back()->with('success', 'Transaction deleted successfully!');
    }

    public function tambah_cppt(Request $request)
    {
        $title = $this->prefix . 'Tambah CPPT';
        $biodatas = $this->pasien->biodataPasienByMr($request->no_mr);
        return view($this->view . 'tambah', compact('title', 'biodatas'));
    }

    public function edit_cppt()
    {
        $title = $this->prefix . ' ' . 'CPPT';
        return view($this->view . 'edit', compact('title'));
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

    public function bukti_layanan()
    {
        $date = date('dMY');
        $title = $this->prefix . ' ' . 'Bukti Layanan CPPT';

        $filename = 'resep-' . $date;

        $pdf = PDF::loadview($this->view . 'cetak/bukti_pelayanan', ['title' => $title]);
        return $pdf->stream($filename . '.pdf');
    }
}
