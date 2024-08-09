<?php

namespace App\Http\Controllers\RawatInap\Detail;

use App\Models\Rajal;
use App\Models\Rekam_medis;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DetailRanapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $view;
    protected $routeIndex;
    protected $prefix;
    protected $rajal;
    protected $rekam_medis;

    public function __construct(Rekam_medis $rekam_medis)
    {
        $this->rekam_medis = $rekam_medis;
        $this->view = 'pages.ranap.berkas.';
        $this->prefix = 'Rawat Inap';
        $this->rajal = new Rajal;
    }

    public function rencanaKeperawatan($noReg)
    {
        $title = 'Detail Rencana Keperawatan';
        $biodata = $this->rajal->pasien_bynoreg($noReg);
        return view($this->view . 'detail.rencanaKeperawatan', compact('title', 'biodata'));
    }

    public function tindakanKeperawatan($noReg)
    {
        $title = 'Detail Tindakan Keperawatan';
        $biodata = $this->rajal->pasien_bynoreg($noReg);
        return view($this->view . 'detail.tindakanKeperawatan', compact('title', 'biodata'));
    }

    public function pemberianObat($noReg)
    {
        $title = 'Detail Catatan Pemberian Obat';
        $biodata = $this->rajal->pasien_bynoreg($noReg);
        return view($this->view . 'detail.pemberianObat', compact('title', 'biodata'));
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
