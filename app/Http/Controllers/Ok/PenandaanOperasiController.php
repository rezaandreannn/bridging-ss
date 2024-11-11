<?php

namespace App\Http\Controllers\OK;

use App\Models\RajalDokter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OperasiKamar;
use App\Models\Rekam_medis;

class PenandaanOperasiController extends Controller
{
    protected $view;
    protected $routeIndex;
    protected $prefix;
    protected $operasiKamar;
    protected $rajaldokter;
    protected $rekam_medis;

    public function __construct(OperasiKamar $operasiKamar)
    {
        $this->rajaldokter = new RajalDokter;
        $this->rekam_medis = new Rekam_medis;
        $this->operasiKamar = $operasiKamar;
        $this->view = 'pages.ok.';
        $this->prefix = 'Penandaan Lokasi';
    }
    public function index(Request $request)
    {
        $title = 'Jadwal Operasi';
        $jadwal = $this->operasiKamar->getJadwalOperasi();
        $operasiKamar = new OperasiKamar();
        return view($this->view . 'penandaanOperasi.index', compact('title', 'operasiKamar', 'jadwal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = $this->prefix . ' ' . 'Operasi';
        // $biodata = $this->rekam_medis->getBiodata($noReg);
        $operasiKamar = new OperasiKamar();
        return view($this->view . 'penandaanOperasi.create', compact('title', 'operasiKamar'));
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
