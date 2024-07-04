<?php

namespace App\Http\Controllers\RawatJalan\Dokter;

use App\Models\Rajal;
use App\Models\Pasien;
use App\Models\RajalDokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

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


    public function createAsesmen($noReg, $noMR)
    {
        $dokterModel = new RajalDokter();
        $title = $this->prefix . ' ' . 'Pemeriksaan Dokter';
        $biodatas = $this->pasien->biodataPasienByMr($noMR);
        $history = $this->rajaldokter->getHistoryPasien($noMR);
        return view($this->view . 'add', compact('title', 'biodatas', 'history', 'dokterModel'));
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
