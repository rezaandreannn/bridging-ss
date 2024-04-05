<?php

namespace App\Http\Controllers\Rj;

use App\Models\Rajal;
use GuzzleHttp\Client;
use App\Models\Antrean;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class RawatJalanController extends Controller
{
    protected $view;
    protected $rajal;
    protected $routeIndex;
    protected $prefix;
    protected $antrean;

    public function __construct(Rajal $rajal)
    {
        $this->rajal = $rajal;
        $this->view = 'pages.rj.';
        $this->routeIndex = 'rj.index';
        $this->prefix = 'Rawat Jalan';
        $this->antrean = new Antrean();
    }

    public function index(Request $request)
    {
        $title = $this->prefix . ' ' . 'Index';

        $rajalModel = new Rajal();
        $kode_dokter = $request->input('kode_dokter');
        $dokters = $this->rajal->byKodeDokter();
        $data = $this->antrean->getData($kode_dokter);


        return view($this->view . 'index', compact('title', 'dokters', 'data', 'rajalModel'));
    }

    public function add($noReg)
    {
        $title = $this->prefix . ' ' . 'Add Data';
        $masalah_perawatan = $this->rajal->masalah_perawatan();
        $rencana_perawatan = $this->rajal->rencana_perawatan();
        $rajal = $this->rajal->pasien_bynoreg($noReg);

        return view($this->view . 'add', compact('title', 'masalah_perawatan', 'rencana_perawatan', 'rajal'));
    }

    public function resume($noMR)
    {
        $title = $this->prefix . ' ' . 'Resume Pasien';
        $data = $this->rajal->resumeMedisPasienByMR($noMR);
        $pasien = $this->rajal->profilMR($noMR);
        return view($this->view . 'resume', compact('title', 'data', 'pasien'));
    }

    public function profilPDF($noMR)
    {
        // Fetch data using the model
        $data = $this->rajal->resumeMedisPasienByMR($noMR);
        $pasien = $this->rajal->profilMR($noMR);

        $date = date('dMY');

        $filename = 'resumeMedis - ' . $date . '-' . $noMR;

        $pdf = PDF::loadview('pages.rj.profil', ['data' => $data, 'pasien' => $pasien]);
        return $pdf->download($filename . '.pdf');
    }
}
