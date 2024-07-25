<?php

namespace App\Http\Controllers\Poli\Mata;

use App\Models\Pasien;
use App\Models\PoliMata;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AssesmenMataController extends Controller
{

    protected $view;
    protected $routeIndex;
    protected $prefix;
    protected $poliMata;
    protected $pasien;
    protected $rekam_medis;

    public function __construct(PoliMata $poliMata)
    {
        $this->poliMata = $poliMata;
        $this->view = 'pages.poli.mata.';
        $this->prefix = 'Poli';
        $this->pasien = new Pasien;
    }

    public function index()
    {
        $title = $this->prefix . ' ' . 'Mata';
        return view($this->view . 'index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function assesmenKeperawatan($noMR)
    {
        $title = $this->prefix . ' ' . 'Mata Assesmen Keperawatan';
        $biodatas = $this->pasien->biodataPasienByMr($noMR);
        return view($this->view . 'assesmenKeperawatan', compact('title', 'biodatas'));
    }

    public function create($noMR)
    {
        $title = $this->prefix . ' ' . 'Mata Assesmen Awal';
        $biodatas = $this->pasien->biodataPasienByMr($noMR);
        return view($this->view . 'assesmenAwal', compact('title', 'biodatas'));
    }

    public function assesmenMata($noMR)
    {
        $title = $this->prefix . ' ' . 'Mata Assesmen Pemeriksaan';
        $biodatas = $this->pasien->biodataPasienByMr($noMR);
        return view($this->view . 'assesmenMata', compact('title', 'biodatas'));
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
