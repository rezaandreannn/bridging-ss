<?php

namespace App\Http\Controllers\RawatJalan\Dokter;

use Carbon\Carbon;
use App\Models\Rajal;
use App\Models\Pasien;
use App\Models\RajalDokter;
use App\Models\Rekam_medis;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Rules\UniqueInConnection;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class RajalDokterController extends Controller
{
    protected $view;
    protected $routeIndex;
    protected $prefix;
    protected $rajaldokter;
    protected $pasien;
    protected $rekam_medis;

    public function __construct(RajalDokter $rajaldokter)
    {
        $this->rajaldokter = $rajaldokter;
        $this->view = 'pages.rj.dokter.';
        $this->prefix = 'Rawat Jalan';
        $this->pasien = new Pasien;
        $this->rekam_medis = new Rekam_medis;
    }
    public function index(Request $request)
    {
        $title = $this->prefix . ' ' . 'Dokter';
        $pasien = $this->rajaldokter->getPasienByDokter(auth()->user()->username);

        // dd($pasien);
        return view($this->view . 'index', compact('title', 'pasien'));
    }


    public function createAsesmen($noReg, $noMR)
    {
        $dokterModel = new RajalDokter();

        $title = $this->prefix . ' ' . 'Pemeriksaan Dokter';
        $no_reg = $noReg;
        $masterLab = $this->rajaldokter->getMasterLab();
        $masterRadiologi = $this->rajaldokter->getMasterRadiologi();
        $masterObat = $this->rajaldokter->getMasterObat();
        $asesmenPerawat = $this->rajaldokter->getAsesmenPerawat($noReg);
        // dd($asesmenPerawat);
        $getHasilLab = $this->rajaldokter->getHasilLab($noReg);
        $vitalSign = $this->rajaldokter->getVitalSign($noReg);
        $skalaNyeri = $this->rajaldokter->getSkalaNyeri($noReg);
        // $masterIcd10 = $this->rajaldokter->getIcd10Dokter();
        // dd($masterIcd10);
        $biodatas = $this->pasien->biodataPasienByMr($noMR);
        $history = $this->rajaldokter->getHistoryPasien($noMR);

        return view($this->view . 'add', compact('title', 'biodatas', 'history', 'dokterModel','masterLab','masterRadiologi','masterObat','asesmenPerawat','getHasilLab','vitalSign','skalaNyeri','no_reg'));
    }

    public function copyDokter($noReg, $noMR)
    {
        $dokterModel = new RajalDokter();
        $title = $this->prefix . ' ' . 'Copy Dokter';
        $biodatas = $this->pasien->biodataPasienByMr($noMR);

        return view($this->view . 'copyDokter', compact('title', 'biodatas', 'dokterModel'));
    }

    public function cetakRM($noReg)
    {
        $resep = $this->rajaldokter->resep($noReg);
        $lab = $this->rajaldokter->lab($noReg);
        $rad = $this->rajaldokter->radiologi($noReg);
        $biodata = $this->rekam_medis->getBiodata($noReg);
        // Cetak PDF
        $date = date('dMY');
        $tanggal = Carbon::now();
        $filename = 'RM -' . $date;

        $title = $this->prefix . ' ' . 'Cetak RM';

        $pdf = PDF::loadview('pages.rj.dokter.cetak.rm', ['tanggal' => $tanggal, 'title' => $title, 'resep' => $resep, 'lab' => $lab, 'rad' => $rad, 'biodata' => $biodata]);
        $pdf->setPaper('A4');
        return $pdf->stream($filename . '.pdf');
    }

    public function resepDokter($noReg)
    {
        $data = $this->rajaldokter->resep($noReg);
        $biodata = $this->rekam_medis->getBiodata($noReg);
        // Cetak PDF
        $date = date('dMY');
        $tanggal = Carbon::now();
        $filename = 'Resep-' . $date;

        $title = $this->prefix . ' ' . 'Resep';

        $pdf = PDF::loadview('pages.rj.dokter.cetak.resep', ['tanggal' => $tanggal, 'title' => $title, 'data' => $data, 'biodata' => $biodata]);
        $pdf->setPaper('A4');
        return $pdf->stream($filename . '.pdf');
    }

    public function labDokter($noReg)
    {
        $data = $this->rajaldokter->lab($noReg);
        $biodata = $this->rekam_medis->getBiodata($noReg);
        // Cetak PDF
        $date = date('dMY');
        $tanggal = Carbon::now();
        $filename = 'Lab-' . $date;

        $title = $this->prefix . ' ' . 'Lab';

        $pdf = PDF::loadview('pages.rj.dokter.cetak.lab', ['tanggal' => $tanggal, 'title' => $title, 'data' => $data, 'biodata' => $biodata]);
        $pdf->setPaper('A4');
        return $pdf->stream($filename . '.pdf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // dd('ok');
          // Make a POST request to the API endpoint
          $request->validate([
            'kode_reg' => [
                'required',
                new UniqueInConnection('TAC_RJ_MEDIS', 'FS_KD_REG', 'pku')
            ],
            'anamnesa' => 'required',
            'diagnosa' => 'required',
            'planning' => 'max:255',
  

        ]);
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
