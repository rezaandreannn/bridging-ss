<?php

namespace App\Http\Controllers\Fisio\Berkas;

use Carbon\Carbon;
use App\Models\Rajal;
use App\Models\Pasien;
use App\Models\Fisioterapi;
use Illuminate\Http\Request;
use App\Models\BerkasFisioterapi;
use App\Http\Controllers\Controller;

class BerkasFisioController extends Controller
{

    protected $view;
    protected $prefix;
    protected $fisio;
    protected $berkasFisio;
    protected $pasien;
    protected $rajal;

    public function __construct(Fisioterapi $fisio)
    {
        $this->fisio = $fisio;
        $this->view = 'pages.fisioterapi.berkas.';
        $this->prefix = 'Fisioterapi Berkas';
        $this->berkasFisio = new BerkasFisioterapi();
        $this->pasien = new Pasien();
        $this->rajal = new Rajal();
    }

    public function  index(Request $request)
    {
        $title = $this->prefix . ' ' . 'Pasien';
        $no_mr = $request->input('no_mr');
        $data = $this->berkasFisio->getFisioterapiHistory($no_mr);
        
        // dd($data);
        return view($this->view . 'index', compact('title','data'));
    }
    
    public function berkas()
    {
        $title = $this->prefix . ' ' . 'Harian';
        // $biodata = $this->rajal->resumeMedisPasienByMR($noMR);
        return view($this->view . 'berkas', compact('title'));
    }
    
    public function cetak_rm_dokter($no_reg)
    {
        $asesmenDokter = $this->berkasFisio->getAsesmenDokter($no_reg);
        $lembarUjiFungsi = $this->berkasFisio->getLembarUjiFungsi($no_reg);
        $lembarSpkfr = $this->berkasFisio->getLembarSpkfr($no_reg);
        $biodata = $this->rajal->pasien_bynoreg($no_reg);
        $usia = Carbon::parse($biodata->TGL_LAHIR)->age;

        $title = $this->prefix . ' ' . 'Harian';
        // $biodata = $this->rajal->resumeMedisPasienByMR($noMR);
        return view($this->view . 'berkas', compact('title','asesmenDokter','lembarUjiFungsi','lembarSpkfr','biodata','usia'));
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
