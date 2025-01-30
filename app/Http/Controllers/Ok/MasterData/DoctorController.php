<?php

namespace App\Http\Controllers\OK\MasterData;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Operasi\MasterData\TemplateOperasi;
use App\Services\SimRs\DokterService;

class DoctorController extends Controller
{
    protected $doctorService;

    public function __construct()
    {
        $this->doctorService = new DokterService();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors = $this->doctorService->byBedahOperasi();
        $title = 'data dokter';

        return view('pages.ok.master.doctor.index', compact('doctors', 'title'));
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
    public function show($code)
    {
        $title = 'Detail dokter';
        $findDoctor = $this->doctorService->byCode($code);

        $TemplateByCodeDoctor = TemplateOperasi::where('kode_dokter', $code)->get();


        return view('pages.ok.master.doctor.detail', compact('title', 'findDoctor', 'TemplateByCodeDoctor'));
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
