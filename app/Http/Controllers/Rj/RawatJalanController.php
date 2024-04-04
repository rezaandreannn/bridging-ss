<?php

namespace App\Http\Controllers\Rj;

use App\Models\Rajal;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Antrean;
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
        $kode_dokter = $request->input('kode_dokter');
        $dokters = $this->rajal->byKodeDokter();

        $kode_dokter = $request->input('kode_dokter');
        $data = $this->antrean->getData($kode_dokter);
        // dd($data);

        return view($this->view . 'index', compact('title', 'dokters', 'data'));
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
        $profil = $this->rajal->profil($noMR);
        return view($this->view . 'resume', compact('title', 'profil'));
    }
}
