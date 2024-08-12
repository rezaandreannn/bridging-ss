<?php

namespace App\Http\Controllers\RawatInap\Detail;

use Carbon\Carbon;
use App\Models\Rajal;
use App\Models\Pasien;
use App\Models\RanapDokter;
use App\Models\Rekam_medis;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;

class BerkasRanapController extends Controller
{
    protected $view;
    protected $routeIndex;
    protected $prefix;
    protected $pasien;
    protected $rajal;
    protected $ranap;
    protected $rekam_medis;

    public function __construct(Rekam_medis $rekam_medis)
    {
        $this->rekam_medis = $rekam_medis;
        $this->view = 'pages.ranap.berkas.';
        $this->prefix = 'Rawat Inap';
        $this->pasien = new Pasien;
        $this->rajal = new Rajal;
        $this->ranap = new RanapDokter;
    }

    public function index($noReg)
    {
        $title = $this->prefix . ' ' . 'Berkas';
        $biodata = $this->rajal->pasien_bynoreg($noReg);
        $medis = $this->ranap->dataMedis($noReg);
        $perawat = $this->ranap->dataPerawat($noReg);
        // dd($perawat);
        $bidan = $this->ranap->dataBidan($noReg);
        $rencana = $this->ranap->dataRencanaPulang($noReg);
        $resume = $this->ranap->dataResume($noReg);

        return view($this->view . 'detailBerkas', compact('title', 'biodata', 'medis', 'perawat', 'bidan', 'rencana', 'resume'));
    }

    public function AssesmenAwalKeperawatanRanap($noReg)
    {
        $biodata = $this->rekam_medis->getBiodata($noReg);
        // ----- Rajal ----- //
        $assesmenPerawat = $this->rajal->assesmenPerawatIGD($noReg);
        $perawat = $this->ranap->dataPerawat($noReg);
        // dd($perawat);
        $masalahKeperawatan = $this->rekam_medis->masalahKepByNoreg($noReg);
        $rencanaKeperawatan = $this->rekam_medis->rencanaKepByNoreg($noReg);

        // Cetak PDF
        $date = date('dMY');
        $tanggal = Carbon::now();
        $filename = 'RM -' . $date;

        $title = 'Cetak RM';

        $pdf = PDF::loadview('pages.ranap.berkas.keperawatanRanap', ['tanggal' => $tanggal, 'perawat' => $perawat, 'title' => $title, 'assesmenPerawat' => $assesmenPerawat, 'biodata' => $biodata, 'masalahKeperawatan' => $masalahKeperawatan, 'rencanaKeperawatan' => $rencanaKeperawatan]);
        $pdf->setPaper('A4');
        return $pdf->stream($filename . '.pdf');
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
