<?php

namespace App\Http\Controllers\Berkas\igd;

use App\Models\Rajal;
use App\Models\Pasien;
use App\Models\Rekam_medis;
use App\Models\RanapDokter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RekamMedisIgdController extends Controller
{
    protected $view;
    protected $routeIndex;
    protected $prefix;
    protected $pasien;
    protected $rajal;
    protected $ranap;
    protected $rekam_medis;

    public function __construct(Rekam_medis $rekam_medis)
    {
        $this->rekam_medis = $rekam_medis;
        $this->view = 'pages.rekam_medis.igd.';
        $this->prefix = 'Riwayat Rekam Medis';
        $this->pasien = new Pasien;
        $this->rajal = new Rajal;
        $this->ranap = new RanapDokter;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        //
        $title = $this->prefix . ' ' . 'IGD';
        $nomr = $request->input('nomr');
        $biodatas = $this->pasien->biodataPasienByMr($nomr);
        $dataPasien = [];
        if ($nomr != null) {
            $dataPasien = $this->rekam_medis->rekamMedisIgd($nomr);
        }
        // dd($dataPasien);

        $cek_mr = 'false';
        if ($biodatas != null) {
            $cek_mr = 'true';
        }


        return view($this->view . 'index', compact('title', 'biodatas', 'cek_mr', 'dataPasien'));
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
