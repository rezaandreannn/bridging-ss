<?php

namespace App\Http\Controllers\Rj;

use App\Http\Controllers\Controller;
use App\Models\Rajal;
use Illuminate\Http\Request;

class RawatJalanController extends Controller
{
    protected $view;
    protected $rajal;
    protected $routeIndex;
    protected $prefix;

    public function __construct(Rajal $rajal)
    {
        $this->rajal = $rajal;
        $this->view = 'pages.rj.';
        $this->routeIndex = 'rj.index';
        $this->prefix = 'Rawat Jalan';
    }

    public function index(Request $request)
    {
        $title = $this->prefix . ' ' . 'Index';
        $kode_dokter = $request->input('kode_dokter');
        $dokters = $this->rajal->byKodeDokter();
        $data = $this->rajal->getData($kode_dokter);

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
}
