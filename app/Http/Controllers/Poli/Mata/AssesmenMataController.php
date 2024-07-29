<?php

namespace App\Http\Controllers\Poli\Mata;

use App\Models\Pasien;
use App\Models\PoliMata;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RajalDokter;
use App\Models\Rekam_medis;

class AssesmenMataController extends Controller
{

    protected $view;
    protected $routeIndex;
    protected $prefix;
    protected $poliMata;
    protected $pasien;
    protected $rajaldokter;
    protected $rekam_medis;

    public function __construct(PoliMata $poliMata)
    {
        $this->rajaldokter = new RajalDokter;
        $this->rekam_medis = new Rekam_medis;
        $this->poliMata = $poliMata;
        $this->view = 'pages.poli.mata.';
        $this->prefix = 'Poli';
        $this->pasien = new Pasien;
    }

    public function index()
    {
        $title = $this->prefix . ' ' . 'Mata';
        $pasien = $this->rajaldokter->getPasienByDokter(auth()->user()->username);
        // dd($pasien);
        return view($this->view . 'index', compact('title', 'pasien'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function assesmenKeperawatan($noReg)
    {
        $title = $this->prefix . ' ' . 'Mata Assesmen Keperawatan';
        $biodata = $this->rekam_medis->getBiodata($noReg);
        return view($this->view . 'assesmenKeperawatan', compact('title', 'biodata'));
    }

    public function create($noReg)
    {
        $title = $this->prefix . ' ' . 'Mata Assesmen Awal';
        $biodata = $this->rekam_medis->getBiodata($noReg);
        return view($this->view . 'assesmenAwal', compact('title', 'biodata'));
    }

    public function assesmenMata($noReg)
    {
        $title = $this->prefix . ' ' . 'Mata Assesmen Pemeriksaan';
        $biodata = $this->rekam_medis->getBiodata($noReg);
        return view($this->view . 'assesmenMata', compact('title', 'biodata'));
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
