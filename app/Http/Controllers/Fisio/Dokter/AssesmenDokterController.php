<?php

namespace App\Http\Controllers\Fisio\Dokter;

use App\Models\Pasien;
use App\Models\JenisFisio;
use App\Models\Fisioterapi;
use App\Models\TandaTangan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;

class AssesmenDokterController extends Controller
{
    protected $view;
    protected $routeIndex;
    protected $prefix;
    protected $fisio;
    protected $pasien;
    protected $jenisFisio;
    protected $ttd;
    protected $httpClient;
    protected $simrsUrlApi;

    public function __construct(Fisioterapi $fisio)
    {

        $this->fisio = $fisio;
        $this->view = 'pages.fisioterapi.';
        $this->routeIndex = 'cppt.fisio';
        $this->prefix = 'Fisioterapi';
        $this->pasien = new Pasien;
        $this->jenisFisio = new JenisFisio;
        $this->ttd = new TandaTangan;

        $this->httpClient = new Client([
            'headers' => [
                'Content-Type' => 'application/json'
            ],
        ]);
        $this->simrsUrlApi = env('SIMRS_BASE_URL');
    }
    
    public function index()
    {
        //
        $listpasien = $this->fisio->getPasienRehabMedis();

        // dd($listpasien);
        // die;

        $title = $this->prefix . ' ' . 'List Pasien';
        return view($this->view . 'dokter.index', compact('title', 'listpasien'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($NoMr)
    {
        //
        $biodatas = $this->pasien->biodataPasienByMr($NoMr);
        // dd($biodatas);
        // die;
        $title = $this->prefix . ' ' . 'Assesmen Dokter';
        return view($this->view . 'dokter.form', compact('title','biodatas'));
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
