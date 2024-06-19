<?php

namespace App\Http\Controllers\Fisio\Dokter;

use App\Models\Pasien;
use GuzzleHttp\Client;
use App\Models\JenisFisio;
use App\Models\Fisioterapi;
use App\Models\TandaTangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

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
        $lastKodeTransaksiByMr = DB::connection('pku')
            ->table('TRANSAKSI_FISIOTERAPI')
            ->where('NO_MR_PASIEN', $NoMr)
            ->orderBy('ID_TRANSAKSI', 'DESC')
            ->limit('1')
            ->first();

        $lastKodeTransaksi = DB::connection('pku')
            ->table('TRANSAKSI_FISIOTERAPI')
            ->orderBy('ID_TRANSAKSI', 'DESC')
            ->limit('1')
            ->first();

        $kode = 'F';
        if (!$lastKodeTransaksiByMr) {
            $noTerakhir = (int)substr($lastKodeTransaksi->KODE_TRANSAKSI_FISIO, 2);
            $noTerakhir += 1;
            $nomorUrut = sprintf('%06s', $noTerakhir);
        } else {
            $noTerakhir = (int)substr($lastKodeTransaksiByMr->KODE_TRANSAKSI_FISIO, 2);
            $nomorUrut = sprintf('%06s', $noTerakhir);
        }

        $kode_transaksi_fisio = $kode . '-' . $nomorUrut;

        $jenisterapifisio = DB::connection('pku')->table('TAC_COM_FISIOTERAPI_MASTER')->get();
        $biodatas = $this->pasien->biodataPasienByMr($NoMr);
        
        // dd($biodatas);
        // die;
        $title = $this->prefix . ' ' . 'Assesmen Dokter';
        return view($this->view . 'dokter.form', compact('title','biodatas','jenisterapifisio','kode_transaksi_fisio'));
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
