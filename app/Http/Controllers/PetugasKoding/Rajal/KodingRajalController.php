<?php

namespace App\Http\Controllers\PetugasKoding\Rajal;

use App\Models\Rajal;
use App\Models\Koding;
use App\Models\Pasien;
use App\Models\Antrean;
use App\Models\RajalDokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class KodingRajalController extends Controller
{
    protected $view;
    protected $rajal;
    protected $routeIndex;
    protected $prefix;
    protected $antrean;
    protected $pasien;
    protected $koding;
    protected $rajaldokter;
    protected $httpClient;
    protected $simrsUrlApi;

    public function __construct(Rajal $rajal)
    {
        $this->rajaldokter = new RajalDokter;
        $this->koding = new Koding;
        $this->rajal = $rajal;
        $this->view = 'pages.koding.';
        $this->routeIndex = 'koding.index';
        $this->prefix = 'Rawat Jalan';
        $this->antrean = new Antrean();
        $this->pasien = new Pasien();

  
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $title = $this->prefix . ' ' . 'Index';


        $rajalModel = new Rajal();
        $kode_dokter = $request->input('kode_dokter');
        $tanggal = $request->input('tanggal');
        $dokters = $this->rajal->byKodeDokter();


        $data = $this->antrean->getDataPasienRajalDiagnosa($kode_dokter,$tanggal);

        // menampilkan role user yang login
        // $user = auth()->user()->roles->pluck('name')[0]; 

        // dd($users->roles[0]->name);
        // die;


        return view($this->view . 'rawatJalan.index', compact('title', 'dokters', 'data', 'rajalModel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($noReg)
    {

        // dd($noReg);
        //
        $title = $this->prefix . ' ' . 'Add Data';
        $masterIcd10 = $this->rajaldokter->getIcd10();
        $getAsesmenDokter = $this->koding->getAsesmenDokter($noReg);
        // dd($getAsesmenDokter);

        $biodata = $this->rajal->pasien_bynoreg($noReg);

        return view($this->view . 'rawatJalan.addDiagnosa', compact('title', 'biodata', 'noReg','masterIcd10','getAsesmenDokter'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $noReg)
    {
        //
        $kode_icd10 = DB::connection('bridging_ss')->table('satusehat_condition')->insert([
            'kode_register' => $noReg,
            'kode_diagnosa' => $request->input('kode_diagnosa'),
            'created_at' => $request->input('tanggal').' '.$request->input('jam'),
        ]);

        if($kode_icd10){
            return redirect('koding/kodingDiagnosa/rajal/list?kode_dokter=' . $request->input('kode_dokter').'&tanggal='.$request->input('tanggal'))->with('success', 'Data successfully!');
        }
        else{
            return redirect('koding/kodingDiagnosa/rajal/list?kode_dokter=' . $request->input('kode_dokter').'&tanggal='.$request->input('tanggal'))->with('danger', 'Gagal Simpan!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($noReg)
    {
        //
        $title = $this->prefix . ' ' . 'Add Data';
        $masterIcd10 = $this->rajaldokter->getIcd10();
        $getDataCondition = $this->koding->getDataCondition($noReg);
        $getAsesmenDokter = $this->koding->getAsesmenDokter($noReg);
        // dd($masterIcd10);

        $biodata = $this->rajal->pasien_bynoreg($noReg);

        return view($this->view . 'rawatJalan.editDiagnosa', compact('title', 'biodata', 'noReg','masterIcd10','getAsesmenDokter','getDataCondition'));
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
    public function update(Request $request, $noReg)
    {
        //
        // dd($request->input('tanggal'));
        $kode_icd10 = DB::connection('bridging_ss')->table('satusehat_condition')->where('kode_register',$noReg)->update([
            'kode_diagnosa' => $request->input('kode_diagnosa'),
            'updated_at' => date('Y-m-d h:i:s'),
        ]);

        if($kode_icd10){
            return redirect('koding/kodingDiagnosa/rajal/list?kode_dokter=' . $request->input('kode_dokter').'&tanggal='.$request->input('tanggal'))->with('success', 'Data successfully!');
        }
        else{
            return redirect('koding/kodingDiagnosa/rajal/list?kode_dokter=' . $request->input('kode_dokter').'&tanggal='.$request->input('tanggal'))->with('danger', 'Gagal Simpan!');
        }
   
      
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