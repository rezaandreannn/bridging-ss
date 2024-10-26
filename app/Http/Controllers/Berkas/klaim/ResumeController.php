<?php

namespace App\Http\Controllers\Berkas\klaim;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rajal;
use App\Models\Pasien;
use App\Models\Fisioterapi;
use App\Models\PoliMata;
use App\Models\RajalDokter;
use App\Models\RanapDokter;
use App\Models\Rekam_medis;

class ResumeController extends Controller
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
        $this->view = 'pages.rekam_medis.resume.';
        $this->prefix = 'Riwayat Resume';
        $this->pasien = new Pasien;
        $this->rajal = new Rajal;
        $this->rajaldokter = new RajalDokter;
        $this->ranap = new RanapDokter;
    }

    public function resumeRajal(Request $request)
    {
        $rekamMedisModel = new Rekam_medis;
        $poliMata = new PoliMata();
        $title = $this->prefix . ' ' . 'Rawat Jalan';
        $kode_dokter = $request->input('kode_dokter');
        $tanggal = $request->input('tanggal');
        $dokters = $this->rajal->byKodeDokter();
        // dd($dokters);
        $dataPasien = [];
        if ($kode_dokter != null and $kode_dokter != null) {
            $dataPasien = $this->rekam_medis->rekamMedisHarian($kode_dokter, $tanggal);
        }
        // dd($dataPasien);


        return view($this->view . 'rajal', compact('title', 'dataPasien', 'dokters', 'rekamMedisModel', 'poliMata'));
    }

    public function resumeRanap(Request $request)
    {
        $title = $this->prefix . ' ' . 'Rawat Inap';
        $nomr = $request->input('nomr');
        $biodatas = $this->pasien->biodataPasienByMr($nomr);
        $dataPasien = [];
        if ($nomr != null) {
            $dataPasien = $this->rekam_medis->rekamMediByMrRanap($nomr);
        }
        // dd($dataPasien);

        $cek_mr = 'false';
        if ($biodatas != null) {
            $cek_mr = 'true';
        }
        return view($this->view . 'ranap', compact('title', 'biodatas', 'cek_mr', 'dataPasien'));
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
