<?php

namespace App\Http\Controllers\IGD\Layanan;

use App\Models\Rajal;
use App\Models\Pasien;
use App\Models\LayananIgd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EwsController extends Controller
{
    protected $view;
    protected $routeIndex;
    protected $prefix;
    protected $pasien;
    protected $rajal;
    protected $layanan;

    public function __construct(LayananIgd $layanan)
    {
        $this->layanan = $layanan;
        $this->view = 'pages.igd.layananIGD.';
        $this->prefix = 'Layanan';
        $this->pasien = new Pasien;
        $this->rajal = new Rajal;
    }

    public function ewsDewasa()
    {
        $title = 'EWS Dewasa';
        // $biodata = $this->rajal->pasien_bynoreg($noReg);
        return view($this->view . 'ewsDewasa.index', compact('title'));
    }

    public function addDewasa()
    {
        $title = 'Add Data Ews Dewasa';
        // $biodata = $this->rajal->pasien_bynoreg($noReg);
        return view($this->view . 'ewsDewasa.add', compact('title'));
    }

    public function ewsAnak()
    {
        $title = 'EWS Anak';
        // $biodata = $this->rajal->pasien_bynoreg($noReg);
        return view($this->view . 'ewsAnak.index', compact('title'));
    }

    public function addAnak()
    {
        $title = 'Add Data Ews Anak';
        // $biodata = $this->rajal->pasien_bynoreg($noReg);
        return view($this->view . 'ewsAnak.add', compact('title'));
    }

    public function ewsHamil()
    {
        $title = 'EWS Ibu Hamil';
        // $biodata = $this->rajal->pasien_bynoreg($noReg);
        return view($this->view . 'ewsHamil.index', compact('title'));
    }

    public function addHamil()
    {
        $title = 'Add Data Ews Ibu Hamil';
        // $biodata = $this->rajal->pasien_bynoreg($noReg);
        return view($this->view . 'ewsHamil.add', compact('title'));
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
