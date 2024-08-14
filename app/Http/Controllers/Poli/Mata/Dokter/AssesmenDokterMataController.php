<?php

namespace App\Http\Controllers\Poli\Mata\Dokter;

use App\Models\Rajal;
use App\Models\PoliMata;
use App\Models\RajalDokter;
use App\Models\Rekam_medis;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AssesmenDokterMataController extends Controller
{
    protected $view;
    protected $routeIndex;
    protected $prefix;
    protected $poliMata;
    protected $rajaldokter;
    protected $rajal;
    protected $rekam_medis;

    public function __construct(PoliMata $poliMata)
    {
        $this->rajaldokter = new RajalDokter();
        $this->rekam_medis = new Rekam_medis;
        $this->rajal = new Rajal;
        $this->poliMata = $poliMata;
        $this->view = 'pages.poli.mata.';
        $this->prefix = 'Poli';
    }

    public function index()
    {
        $title = $this->prefix . ' ' . 'Mata Dokter';
        $pasien = $this->rajaldokter->getPasienByDokter(auth()->user()->username);
        return view($this->view . 'dokter.index', compact('title', 'pasien'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add($noReg)
    {
        $title = $this->prefix . ' ' . 'Mata Assesmen Dokter';
        $biodata = $this->rekam_medis->getBiodata($noReg);
        $asasmen_perawat = $this->poliMata->asasmenPerawatGet($noReg);
        // dd($asasmen_perawat);
        return view($this->view . 'dokter.assesmenAwal', compact('title', 'biodata', 'asasmen_perawat'));
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
    public function edit($id)
    {
        //
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
