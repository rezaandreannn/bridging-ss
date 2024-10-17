<?php

namespace App\Http\Controllers\Berkas\Rekam_medis_by_mr;

use Carbon\Carbon;
use App\Models\Rajal;
use App\Models\Pasien;
use App\Models\RajalDokter;
use App\Models\RanapDokter;
use App\Models\Rekam_medis;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use App\Models\RawatInap;

class RekamMedisByMrController extends Controller
{
    protected $view;
    protected $routeIndex;
    protected $prefix;
    protected $pasien;
    protected $rajal;
    protected $ranap;
    protected $rekam_medis;
    protected $rajaldokter;
    protected $rawatinap;

    public function __construct(Rekam_medis $rekam_medis)
    {
        $this->rekam_medis = $rekam_medis;
        $this->view = 'pages.rekam_medis.bymr.';
        $this->prefix = 'Riwayat Rekam Medis';
        $this->pasien = new Pasien;
        $this->rajal = new Rajal;
        $this->ranap = new RanapDokter;
        $this->rajaldokter = new RajalDokter;
        $this->rawatinap = new RawatInap;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = $this->prefix . ' ' . 'By No MR';
        $nomr = $request->input('nomr');
        $biodatas = $this->pasien->biodataPasienByMr($nomr);
        $dataPasien = [];
        if ($nomr != null) {
            $dataPasien = $this->rekam_medis->rekamMediByMr($nomr);
        }
        // dd($dataPasien);

        $cek_mr = 'false';
        if ($biodatas != null) {
            $cek_mr = 'true';
        }
        return view($this->view . 'index', compact('title', 'biodatas', 'cek_mr', 'dataPasien'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function detail_cppt($noReg)
    {
        $title = $this->prefix . ' ' . 'Berkas Cppt';
        $biodata = $this->rajal->pasien_bynoreg($noReg);
        $cppt = $this->rekam_medis->detailCpptByNoreg($noReg);

        // dd($cppt);


        return view($this->view . 'detailBerkas', compact('title', 'biodata', 'medis', 'perawat', 'bidan', 'rencana', 'resume'));
    }

    public function resumeRanap($noReg)
    {
        $biodata = $this->rawatinap->biodataPasienRanap($noReg);

        $resumePasienRanap = $this->rawatinap->resumePasienRanapByNoreg($noReg);
        // dd($resumePasienRanap);
        $resumeDiagnosa = $this->rawatinap->resumeDiagnosaSekunder($noReg);
        $resumeIdikasi = $this->rawatinap->resumeIdikasi($noReg);
        $resumeDiet = $this->rawatinap->resumeDiet($noReg);
        $resumeTindakan = $this->rawatinap->resumeTindakan($noReg);
        $resumeTerapiPulang = $this->rawatinap->resumeTerapiPulang($noReg);

        if ($resumePasienRanap == null) {
            return redirect()->back()->with('warning', 'Data Resume belum di inputkan di EMR!');
        }
        // Cetak PDF
        $date = date('dMY');
        $tanggal = Carbon::now();
        $filename = 'RM -' . $date;

        $title = 'Cetak RM';

        $pdf = PDF::loadview('pages.rekam_medis.bymr.resumeRanap', ['tanggal' => $tanggal, 'title' => $title, 'biodata' => $biodata, 'resumePasienRanap' => $resumePasienRanap, 'resumeDiagnosa' => $resumeDiagnosa, 'resumeDiet' => $resumeDiet, 'resumeIdikasi' => $resumeIdikasi,  'resumeTindakan' => $resumeTindakan, 'resumeTerapiPulang' => $resumeTerapiPulang]);
        $pdf->setPaper('A4');
        return $pdf->stream($filename . '.pdf');
    }

    public function resumeRajal($noReg)
    {
        $resep = $this->rajaldokter->resep($noReg);
        $labs = $this->rajaldokter->lab($noReg);
        $biodata = $this->rekam_medis->getBiodata($noReg);
        $asesmenPerawat = $this->rekam_medis->cetakRmRajal($noReg);
        $asesmenDokterRj = $this->rekam_medis->asesmenDokterRjBynoReg($noReg);
        // dd($asesmenDokterRj);
        // Cetak PDF
        $date = date('dMY');
        $tanggal = Carbon::now();
        $filename = 'RM -' . $date;

        $title = 'Cetak RM';

        $pdf = PDF::loadview('pages.rekam_medis.bymr.resumeRajal', ['tanggal' => $tanggal, 'title' => $title, 'labs' => $labs, 'resep' => $resep, 'biodata' => $biodata, 'asesmenPerawat' => $asesmenPerawat, 'asesmenDokterRj' => $asesmenDokterRj]);
        $pdf->setPaper('A4');
        return $pdf->stream($filename . '.pdf');
    }

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
