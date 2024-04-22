<?php

namespace App\Http\Controllers\RawatJalan\Perawat;

use App\Models\Rajal;
use App\Models\Antrean;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AssesmenController extends Controller
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

    // Cetak PDF Profil Ringkas Medis Rawat Jalan
    public function profilPDF($noMR)
    {
        $data = $this->rajal->resumeMedisPasienByMR($noMR);
        $pasien = $this->rajal->profilMR($noMR);

        $date = date('dMY');
        $filename = 'resumeMedis-' . $date . '-' . $noMR;

        $pdf = PDF::loadview('pages.rj.profil', ['data' => $data, 'pasien' => $pasien]);
        return $pdf->download($filename . '.pdf');
    }

    public function editSKDP($noReg)
    {
        $title = $this->prefix . ' ' . 'Edit SKDP';
        $rajal = $this->rajal->pasien_bynoreg($noReg);

        return view($this->view . 'editSKDP', compact('title', 'rajal'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($noReg)
    {
        $title = $this->prefix . ' ' . 'Edit Data';
        $masalah_perawatan = $this->rajal->masalah_perawatan();
        $rencana_perawatan = $this->rajal->rencana_perawatan();
        $rajal = $this->rajal->pasien_bynoreg($noReg);

        return view($this->view . 'edit', compact('title', 'masalah_perawatan', 'rencana_perawatan', 'rajal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
