<?php

namespace App\Http\Controllers\RawatJalan\Dokter;

use App\Http\Controllers\Controller;
use App\Models\PoliMata;
use App\Models\Rekam_medis;
use Illuminate\Http\Request;

class KondisiPulangController extends Controller
{
    protected $view;
    // protected $routeIndex;
    protected $prefix;
    protected $kondisiPulang;
    protected $rekam_medis;
    protected $PoliMata;


    public function __construct()
    {

        // $this->kondisiPulang = $kondisiPulang;
        $this->view = 'pages.rj.dokter.';
        // $this->routeIndex = 'cppt.fisio';
        $this->prefix = 'Kondisi Pulang';
        $this->PoliMata = new PoliMata();
        $this->rekam_medis = new Rekam_medis();
    }

    public function rujukLuarRS($noReg)
    {
        // dd('ok');
        $biodata = $this->rekam_medis->getBiodata($noReg);
        $title = $this->prefix . ' ' . 'Rujuk Luar RS';
        return view($this->view . '.kondisiPulang.rawatLuar', compact('title', 'biodata'));
    }

    public function index()
    {
        //
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
