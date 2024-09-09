<?php

namespace App\Http\Controllers\igd;

use App\Models\Rajal;
use App\Models\Pasien;
use App\Models\LayananIgd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TriaseController extends Controller
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
        $this->view = 'pages.igd.triase.';
        $this->pasien = new Pasien;
        $this->rajal = new Rajal;
    }
    
    public function index()
    {
        //
        $title = 'Triase IGD';
        // $biodata = $this->rajal->pasien_bynoreg($noReg);
        return view($this->view . 'index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title = 'Add Triase IGD';
        // $biodata = $this->rajal->pasien_bynoreg($noReg);
        return view($this->view . 'add', compact('title'));
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
