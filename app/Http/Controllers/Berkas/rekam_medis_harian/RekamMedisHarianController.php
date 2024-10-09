<?php

namespace App\Http\Controllers\Berkas\Rekam_medis_harian;

use Carbon\Carbon;
use App\Models\Rajal;
use App\Models\Pasien;
use App\Models\Fisioterapi;
use App\Models\RajalDokter;
use App\Models\RanapDokter;
use App\Models\Rekam_medis;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;

class RekamMedisHarianController extends Controller
{

    protected $view;
    protected $routeIndex;
    protected $prefix;
    protected $pasien;
    protected $rajal;
    protected $rajaldokter;
    protected $ranap;
    protected $rekam_medis;

    public function __construct(Rekam_medis $rekam_medis)
    {
        $this->rekam_medis = $rekam_medis;
        $this->view = 'pages.rekam_medis.harian.';
        $this->prefix = 'Riwayat Rekam Medis';
        $this->pasien = new Pasien;
        $this->rajal = new Rajal;
        $this->rajaldokter = new RajalDokter;
        $this->ranap = new RanapDokter;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $rekamMedisModel = new Rekam_medis;
        $title = $this->prefix . ' ' . 'Harian';
        $kode_dokter = $request->input('kode_dokter');
        $tanggal = $request->input('tanggal');
        $dokters = $this->rajal->byKodeDokter();
        // dd($dokters);
        $dataPasien = [];
        if ($kode_dokter != null and $kode_dokter != null) {
            $dataPasien = $this->rekam_medis->rekamMedisHarian($kode_dokter, $tanggal);
        }

        // dd($dataPasien);

        $tglSekarang = strtotime(date('Y-m-d'));
        $tglKemarin = date('Y-m-d', strtotime("-1 day", $tglSekarang));
        $userLogin = auth()->user()->username;
        // dd($dataPasien);


        return view($this->view . 'index', compact('title', 'dataPasien', 'dokters', 'tglKemarin', 'userLogin', 'rekamMedisModel'));
    }

    public function riwayat_pemeriksaan_pasien(Request $request)
    {
        //
        $title = $this->prefix . ' ' . 'List riwayat pemeriksaan pasien';
        $tanggal = $request->input('tanggal') ?? "";
        $no_mr = $request->input('no_mr') ?? "";
        $kode_dokter = $request->input('kode_dokter') ?? "";
        $cekAsesmenFisio = new Fisioterapi();
        $dokters = $this->rajal->byKodeDokter();
        $kode_dokter = auth()->user()->username;
        $history = $this->rajaldokter->getHistoryPemeriksaanPasien($no_mr,$tanggal,$kode_dokter);

        // $listpasien = $this->fisio->getPasienRehabMedisByTgl($kode_dokter, $tanggal);
        // dd($listpasien);
        $fisioterapi = new Fisioterapi();
        return view('pages.rj.dokter.riwayatPemeriksaanPasien', compact('title', 'fisioterapi','dokters','history','cekAsesmenFisio'));
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
