<?php

namespace App\Http\Controllers\RawatJalan\Dokter;

use App\Models\Rajal;
use App\Models\Pasien;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RajalDokter;

class RajalDokterController extends Controller
{
    protected $view;
    protected $routeIndex;
    protected $prefix;
    protected $rajaldokter;
    protected $pasien;

    public function __construct(RajalDokter $rajaldokter)
    {

        $this->rajaldokter = $rajaldokter;
        $this->view = 'pages.rj.dokter.';
        $this->prefix = 'Rawat Jalan';
        $this->pasien = new Pasien;
    }

    public function index(Request $request)
    {
        $title = $this->prefix . ' ' . 'Dokter';
        $pasien = $this->rajaldokter->getPasienByDokter(auth()->user()->username);
    
        return view($this->view . 'index', compact('title', 'pasien'));
    }

    public function createAsesmen(Request $request)
    {
        
        $title = $this->prefix . ' ' . 'Pemeriksaan Dokter';
        $biodatas = $this->pasien->biodataPasienByMr($request->no_mr);
        $history = $this->rajaldokter->getHistoryPasien($request->no_mr);
        return view($this->view . 'add', compact('title', 'biodatas', 'history'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
 

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
