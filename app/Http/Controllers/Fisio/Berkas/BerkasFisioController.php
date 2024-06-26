<?php

namespace App\Http\Controllers\Fisio\Berkas;

use App\Models\Pasien;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Fisioterapi;
use App\Models\Rajal;

class BerkasFisioController extends Controller
{

    protected $view;
    protected $prefix;
    protected $fisio;
    protected $rajal;

    public function __construct(Fisioterapi $fisio)
    {
        $this->fisio = $fisio;
        $this->view = 'pages.fisioterapi.berkas.';
        $this->prefix = 'Fisioterapi Berkas';
        $this->rajal = new Rajal;
    }

    public function  index()
    {
        $title = $this->prefix . ' ' . 'Pasien';
        return view($this->view . 'index', compact('title'));
    }

    public function berkas()
    {
        $title = $this->prefix . ' ' . 'Harian';
        // $biodata = $this->rajal->resumeMedisPasienByMR($noMR);
        return view($this->view . 'berkas', compact('title'));
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
