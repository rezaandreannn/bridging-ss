<?php

namespace App\Http\Controllers\Kunjungan;

use App\Models\Antrean;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien;
use App\Models\Rajal;
use App\Services\BPJS\Vclaim\FingerPrintService;

class AntreanController extends Controller
{
    protected $antrean, $fingerPrintService;
    protected $pasien;
    protected $rajal;
    protected $view;


    public function __construct(Antrean $antrean)
    {
        $this->antrean = $antrean;
        $this->pasien = new Pasien;
        $this->rajal = new Rajal;
        $this->view = 'pages.kunjungan.antrean.';
        $this->fingerPrintService = new FingerPrintService();
    }

    public function index(Request $request)
    {
        try {
            // Filter
            // Retrieve query parameters
            $kode_dokter = $request->input('kode_dokter');
            $tanggal = $request->input('tanggal') ?? date('Y-m-d');

            $title = 'Antrean';
            $dokters = $this->antrean->byKodeDokter();
            $data = $this->antrean->getData($kode_dokter, $tanggal);

            $fingerSEP = $this->fingerPrintService->byTanggal($tanggal);
            $listSEP = $fingerSEP['response']['list'];
            return view('pages.kunjungan.antrean.index', [
                'data' => $data,
                'dokters' => $dokters,
                'listSEP' => $listSEP
            ]);
        } catch (\Exception $e) {
            // Tangani kesalahan
            return response()->json(['error' => 'Failed to fetch data'], 500);
            // return view('error-view', ['error' => 'Failed to fetch data']);
        }
    }

    public function show($noMR)
    {
        $data = $this->antrean->history($noMR);
        $pasien = $this->pasien->biodataPasienByMr($noMR);
        return view($this->view . 'detail', compact('data', 'pasien'));
    }
}
