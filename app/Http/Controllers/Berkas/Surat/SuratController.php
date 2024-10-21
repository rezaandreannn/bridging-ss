<?php

namespace App\Http\Controllers\Berkas\Surat;

use App\Models\Rajal;
use App\Models\Surat;
use App\Models\RajalDokter;
use App\Models\Rekam_medis;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SuratController extends Controller
{
    protected $view;
    protected $routeIndex;
    protected $prefix;
    protected $poliMata;
    protected $rajaldokter;
    protected $rajal;
    protected $surat;
    protected $rekam_medis;

    public function __construct(Surat $surat)
    {
        $this->rajaldokter = new RajalDokter();
        $this->rekam_medis = new Rekam_medis;
        $this->rajal = new Rajal;
        $this->surat = $surat;
        $this->view = 'pages.surat.';
        $this->prefix = 'Surat';
    }

    public function index(Request $request)
    {
        $title = $this->prefix . ' ' . 'Sakit/SKD';
        $kode_dokter = auth()->user()->username;
        $pasien = $this->rajaldokter->getPasienByDokterMata(auth()->user()->username);
        // dd($pasienKonsul);
        $surat = new Surat();
        // dd($pasien);
        return view($this->view . 'dokter.index', compact('title', 'pasien', 'poliMata', 'pasienKonsul'));
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
