<?php

namespace App\Http\Controllers\RawatJalan\Perawat;

use App\Models\Rajal;
use GuzzleHttp\Client;
use App\Models\Antrean;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AssesmenController extends Controller
{
    protected $view;
    protected $rajal;
    protected $routeIndex;
    protected $prefix;
    protected $antrean;
    protected $httpClient;
    protected $simrsUrlApi;

    public function __construct(Rajal $rajal)
    {
        $this->rajal = $rajal;
        $this->view = 'pages.rj.';
        $this->routeIndex = 'rj.index';
        $this->prefix = 'Rawat Jalan';
        $this->antrean = new Antrean();

        $this->httpClient = new Client([
            'headers' => [
                'Content-Type' => 'application/json'
            ],
        ]);
        $this->simrsUrlApi = env('SIMRS_BASE_URL');
    }

    public function index(Request $request)
    {
        $title = $this->prefix . ' ' . 'Index';

        $rajalModel = new Rajal();
        $kode_dokter = $request->input('kode_dokter');
        $dokters = $this->rajal->byKodeDokter();
        $data = $this->antrean->getData($kode_dokter);

        return view($this->view . 'index', compact('title', 'dokters', 'data', 'rajalModel'));
    }

    public function add($noReg)
    {
        $title = $this->prefix . ' ' . 'Add Data';
        $masalah_perawatan = $this->rajal->masalah_perawatan();
        $rencana_perawatan = $this->rajal->rencana_perawatan();
        $rajal = $this->rajal->pasien_bynoreg($noReg);

        return view($this->view . 'add', compact('title', 'masalah_perawatan', 'rencana_perawatan', 'rajal','noReg'));
    }

    //Tampilan Report PDF Resume Pasien
    public function resume($noMR)
    {
        $title = $this->prefix . ' ' . 'Resume Pasien';
        $data = $this->rajal->resumeMedisPasienByMR($noMR);
        $pasien = $this->rajal->profilMR($noMR);
        return view($this->view . 'resume', compact('title', 'data', 'pasien'));
    }

    // Cetak PDF Profil Ringkas Medis Rawat Jalan
    public function profilPDF($noMR)
    {
        $data = $this->rajal->resumeMedisPasienByMR($noMR);
        $pasien = $this->rajal->profilMR($noMR);

        $date = date('dMY');
        $filename = 'resumeMedis-' . $date . '-' . $noMR;

        $pdf = PDF::loadview('pages.rj.profil', ['data' => $data, 'pasien' => $pasien]);
        return $pdf->download($filename . '.pdf');
    }

    public function editSKDP($noReg)
    {
        $title = $this->prefix . ' ' . 'Edit SKDP';
        $rajal = $this->rajal->pasien_bynoreg($noReg);

        return view($this->view . 'editSKDP', compact('title', 'rajal'));
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
        // Make a POST request to the API endpoint
        // $request->validate([
        //     'FS_ANAMNESA' => 'required',
        //     'FS_EDUKASI' => 'required',
        //     'FS_SUHU' => 'required',
        //     'FS_NADI' => 'required',
        //     'FS_R' => 'required',
        //     'FS_TD' => 'required',
        //     'FS_TB' => 'required',
        //     'FS_BB' => 'required',
        //     'FS_NYERIP' => 'required',
        //     'FS_NYERIQ' => 'required',
        //     'FS_NYERIR' => 'required',
        //     'FS_NYERIS' => 'required',
        //     'FS_NYERIT' => 'required',
        //     'FS_NYERI' => 'required',
        //     'FS_CARA_BERJALAN1' => 'required',
        //     'FS_CARA_BERJALAN2' => 'required',
        //     'FS_CARA_DUDUK' => 'required',
        //     'intervensi1' => 'required',
        //     'intervensi2' => 'required',
        //     'FS_RIW_PENYAKIT_DAHULU' => 'required',
        //     'FS_RIW_PENYAKIT_DAHULU2' => 'required',
        //     'FS_ALERGI' => 'required',
        //     'FS_REAK_ALERGI' => 'required',
        //     'FS_STATUS_PSIK' => 'required',
        //     'FS_STATUS_PSIK2' => 'required',
        // ]);

   
        try {
            
            DB::beginTransaction();
            $status_rj = DB::connection('pku')->table('TAC_RJ_STATUS')->insert([

                'FS_KD_REG' => $request->input('FS_KD_REG'),
                'FS_STATUS' => '1',
                'FS_FORM' => '1',
                'FS_JNS_ASESMEN' => 'A',
                'mdb' => auth()->user()->name,
                'mdd' => now(),
    
            ]);

            $vital_sign = DB::connection('pku')->table('TAC_RJ_VITAL_SIGN')->insert([

                'FS_KD_REG' => $request->input('FS_KD_REG'),
                'FS_SUHU' => $request->input('FS_SUHU'),
                'FS_NADI' => $request->input('FS_NADI'),
                'FS_R' => $request->input('FS_R'),
                'FS_TD' => $request->input('FS_TD'),
                'FS_TB' => $request->input('FS_TB'),
                'FS_BB' => $request->input('FS_BB'),
                'FS_KD_MEDIS' => $request->input('KODE_DOKTER'),
                'mdb' => auth()->user()->name,
                'mdd' => date('Y-m-d'),
                'FS_JAM_TRS' => date('H:i:s'),
    
            ]);

            $nyeri = DB::connection('pku')->table('TAC_RJ_NYERI')->insert([

                'FS_KD_REG' => $request->input('FS_KD_REG'),
                'FS_NYERIP' => $request->input('FS_NYERIP'),
                'FS_NYERIQ' => $request->input('FS_NYERIQ'),
                'FS_NYERIR' => $request->input('FS_NYERIR'),
                'FS_NYERIS' => $request->input('FS_NYERIS'),
                'FS_NYERIT' => $request->input('FS_NYERIT'),
                'mdb' => auth()->user()->name,
                'mdd' => date('Y-m-d'), 
                'FS_NYERI' => $request->input('FS_NYERI'),
    
            ]);

            $jatuh = DB::connection('pku')->table('TAC_RJ_JATUH')->insert([

                'FS_KD_REG' => $request->input('FS_KD_REG'),
                'FS_CARA_BERJALAN1' => $request->input('FS_CARA_BERJALAN1'),
                'FS_CARA_BERJALAN2' => $request->input('FS_CARA_BERJALAN2'),
                'FS_CARA_DUDUK' => $request->input('FS_CARA_DUDUK'),
                'intervensi1' => $request->input('intervensi1')  ? 'Ya' : 'Tidak',
                'intervensi2' => $request->input('intervensi2')  ? 'Ya' : 'Tidak',
                'mdd' => auth()->user()->name,
                'mdb' => date('Y-m-d'), 
          
            ]);
            
            $asasmen_perawat = DB::connection('pku')->table('TAC_ASES_PER2')->insert([
                
                'FS_KD_REG' => $request->input('FS_KD_REG'),
                'FS_RIW_PENYAKIT_DAHULU' => '',
                'FS_RIW_PENYAKIT_DAHULU2' => '',
                'FS_RIW_PENYAKIT_KEL' => '',
                'FS_RIW_PENYAKIT_KEL2' => '',
                'FS_STATUS_PSIK' => $request->input('FS_STATUS_PSIK'),
                'FS_STATUS_PSIK2' => $request->input('FS_STATUS_PSIK2') ? $request->input('FS_STATUS_PSIK2') : '',
                'FS_HUB_KELUARGA' => $request->input('FS_HUB_KELUARGA'),
                'FS_ST_FUNGSIONAL' => $request->input('FS_ST_FUNGSIONAL'),
                'FS_AGAMA' => $request->input('FS_AGAMA'),
                'FS_NILAI_KHUSUS' => $request->input('FS_NILAI_KHUSUS'),
                'FS_NILAI_KHUSUS2' => $request->input('FS_NILAI_KHUSUS'),
                'FS_ANAMNESA' => $request->input('FS_ANAMNESA'),
                'FS_PENGELIHATAN' => $request->input('FS_PENGELIHATAN'),
                'FS_PENCIUMAN' => $request->input('FS_PENCIUMAN'),
                'FS_PENDENGARAN' => $request->input('FS_PENDENGARAN'),
                'FS_RIW_IMUNISASI' => $request->input('FS_RIW_IMUNISASI') ? $request->input('FS_RIW_IMUNISASI') : '0',
                'FS_RIW_IMUNISASI_KET' => $request->input('FS_RIW_IMUNISASI_KET') ? $request->input('FS_RIW_IMUNISASI_KET') : '0',
                'FS_RIW_TUMBUH' => $request->input('FS_RIW_TUMBUH')  ? $request->input('FS_RIW_TUMBUH') : '0',
                'FS_RIW_TUMBUH_KET' => $request->input('FS_RIW_TUMBUH_KET')  ? $request->input('FS_RIW_TUMBUH_KET') : '0',
                'FS_HIGH_RISK' => '',
                'FS_EDUKASI' => $request->input('FS_EDUKASI'),
                'FS_SKDP_FASKES' => $request->input('FS_SKDP_FASKES'),
                'mdb' => auth()->user()->name,
                'mdd' => date('Y-m-d'), 
                
            ]);
            
            
            $alergi = DB::connection('db_rsmm')->table('REGISTER_PASIEN')->where('NO_MR', $request->input('NO_MR'))->update([

                'FS_ALERGI' => $request->input('FS_ALERGI'),
                'FS_REAK_ALERGI' => $request->input('FS_REAK_ALERGI'),
                'FS_RIW_PENYAKIT_DAHULU' => $request->input('FS_RIW_PENYAKIT_DAHULU'),
                'FS_RIW_PENYAKIT_DAHULU2' => $request->input('FS_RIW_PENYAKIT_DAHULU2'),
            ]);
            
            $jatuh = DB::connection('pku')->table('TAC_RJ_NUTRISI')->insert([

                'FS_KD_REG' => $request->input('FS_KD_REG'),
                'FS_NUTRISI1' => $request->input('FS_NUTRISI1'),
                'FS_NUTRISI2' => $request->input('FS_NUTRISI2'),
                'FS_NUTRISI_ANAK1' => $request->input('FS_NUTRISI_ANAK1') ? $request->input('FS_NUTRISI_ANAK1') : '',
                'FS_NUTRISI_ANAK2' => $request->input('FS_NUTRISI_ANAK2')  ? $request->input('FS_NUTRISI_ANAK2') : '',
                'FS_NUTRISI_ANAK3' => $request->input('FS_NUTRISI_ANAK3')  ? $request->input('FS_NUTRISI_ANAK3') : '',
                'FS_NUTRISI_ANAK4' => $request->input('FS_NUTRISI_ANAK4')  ? $request->input('FS_NUTRISI_ANAK4') : '',
                'mdb' => auth()->user()->name,
                'mdd' => date('Y-m-d'), 
          
            ]);

            $masalah_kep = $request->input('tujuan');
            if (!empty($masalah_kep)) {
                foreach ($masalah_kep as $value) {
                    $insert_masalah_kep = DB::connection('pku')->table('TAC_RJ_MASALAH_KEP')->insert([

                        'FS_KD_REG' => $request->input('FS_KD_REG'),
                        'FS_KD_MASALAH_KEP' => $value,
                        
                    ]);
                }
            }
    
            $rencana_kep = $request->input('tembusan');
            if (!empty($rencana_kep)) {
                foreach ($rencana_kep as $value) {
                    $insert_rencana_kep = DB::connection('pku')->table('TAC_RJ_REN_KEP')->insert([

                        'FS_KD_REG' => $request->input('FS_KD_REG'),
                        'FS_KD_REN_KEP' => $value,
               
                    ]);
                }
            }
        

            DB::commit();
            var_dump('ok');
            die;
        }

        catch (\Exception $e) {
            //throw $th;
            DB::rollBack();
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }


     

        return redirect()->back()->with('success', 'Data Pasien Added successfully!');
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
    public function edit($noReg)
    {
        $title = $this->prefix . ' ' . 'Edit Data';
        $masalah_perawatan = $this->rajal->masalah_perawatan();
        $rencana_perawatan = $this->rajal->rencana_perawatan();

        $masalah_perGet = $this->rajal->masalahPerawatanGetByNoreg($noReg);
        $rencana_perGet = $this->rajal->rencanaPerawatanGetByNoreg($noReg);
        $rajal = $this->rajal->pasien_bynoreg($noReg);

        $asasmen_perawat = $this->rajal->asasmenPerawatGet($noReg);
        $riwayat = $this->rajal->riwayatGet($noReg);

        

        // dd($rencana_perGet);
        // die;

        return view($this->view . 'edit', compact('title', 'masalah_perawatan', 'rencana_perawatan', 'rajal', 'asasmen_perawat','riwayat','masalah_perGet','rencana_perGet'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $kode_reg)
    {


        $asasmen_perawat = DB::connection('pku')->table('TAC_ASES_PER2')->where('FS_KD_REG', $kode_reg)->update([
            'FS_RIW_PENYAKIT_DAHULU' => '',
            'FS_RIW_PENYAKIT_DAHULU2' => '',
            'FS_RIW_PENYAKIT_KEL' => '',
            'FS_RIW_PENYAKIT_KEL2' => '',
            'FS_STATUS_PSIK' => $request->input('FS_STATUS_PSIK'),
            'FS_STATUS_PSIK2' => $request->input('FS_STATUS_PSIK2') ? $request->input('FS_STATUS_PSIK2') : '',
            'FS_HUB_KELUARGA' => $request->input('FS_HUB_KELUARGA'),
            'FS_ST_FUNGSIONAL' => $request->input('FS_ST_FUNGSIONAL'),
            'FS_AGAMA' => $request->input('FS_AGAMA'),
            'FS_NILAI_KHUSUS' => $request->input('FS_NILAI_KHUSUS'),
            'FS_NILAI_KHUSUS2' => $request->input('FS_NILAI_KHUSUS'),
            'FS_ANAMNESA' => $request->input('FS_ANAMNESA'),
            'FS_PENGELIHATAN' => $request->input('FS_PENGELIHATAN'),
            'FS_PENCIUMAN' => $request->input('FS_PENCIUMAN'),
            'FS_PENDENGARAN' => $request->input('FS_PENDENGARAN'),
            'FS_RIW_IMUNISASI' => $request->input('FS_RIW_IMUNISASI') ? $request->input('FS_RIW_IMUNISASI') : '0',
            'FS_RIW_IMUNISASI_KET' => $request->input('FS_RIW_IMUNISASI_KET') ? $request->input('FS_RIW_IMUNISASI_KET') : '0',
            'FS_RIW_TUMBUH' => $request->input('FS_RIW_TUMBUH')  ? $request->input('FS_RIW_TUMBUH') : '0',
            'FS_RIW_TUMBUH_KET' => $request->input('FS_RIW_TUMBUH_KET')  ? $request->input('FS_RIW_TUMBUH_KET') : '0',
            'FS_HIGH_RISK' => '',
            'FS_EDUKASI' => $request->input('FS_EDUKASI'),
            'FS_SKDP_FASKES' => $request->input('FS_SKDP_FASKES'),
            'mdb' => auth()->user()->name,
            'mdd' => date('Y-m-d'),
        ]);

        $vital_sign = DB::connection('pku')->table('TAC_RJ_VITAL_SIGN')->where('FS_KD_REG', $kode_reg)->update([
            'FS_SUHU' => $request->input('FS_SUHU'),
            'FS_NADI' => $request->input('FS_NADI'),
            'FS_R' => $request->input('FS_R'),
            'FS_TD' => $request->input('FS_TD'),
            'FS_TB' => $request->input('FS_TB'),
            'FS_BB' => $request->input('FS_BB'),
            'mdb' => auth()->user()->name,
            'mdd' => date('Y-m-d'),

        ]);


        $nyeri = DB::connection('pku')->table('TAC_RJ_NYERI')->where('FS_KD_REG', $kode_reg)->update([
            'FS_NYERIP' => $request->input('FS_NYERIP'),
            'FS_NYERIQ' => $request->input('FS_NYERIQ'),
            'FS_NYERIR' => $request->input('FS_NYERIR'),
            'FS_NYERIS' => $request->input('FS_NYERIS'),
            'FS_NYERIT' => $request->input('FS_NYERIT'),
            'mdb' => auth()->user()->name,
            'mdd' => date('Y-m-d'),
            'FS_NYERI' => $request->input('FS_NYERI'),

        ]);
        
        $asasmen_jatuh = DB::connection('pku')->table('TAC_RJ_JATUH')->where('FS_KD_REG', $kode_reg)->update([
            'FS_CARA_BERJALAN1' => $request->input('FS_CARA_BERJALAN1'),
            'FS_CARA_BERJALAN2' => $request->input('FS_CARA_BERJALAN2'),
            'FS_CARA_DUDUK' => $request->input('FS_CARA_DUDUK'),
            'mdd' => auth()->user()->name,
            'mdb' => date('Y-m-d'),
            'intervensi1' => $request->input('intervensi1')  ? 'Ya' : 'Tidak',
            'intervensi2' => $request->input('intervensi2')  ? 'Ya' : 'Tidak',
            
        ]);
        
        
        // $alergi = DB::connection('db_rsmm')->table('REGISTER_PASIEN')->where('NO_MR', $request->input('NO_MR'))->update([
        //     'FS_ALERGI' => $request->input('FS_ALERGI'),
        //     'FS_REAK_ALERGI' => $request->input('FS_REAK_ALERGI'),
        //     'FS_RIW_PENYAKIT_DAHULU' => $request->input('FS_RIW_PENYAKIT_DAHULU'),
        //     'FS_RIW_PENYAKIT_DAHULU2' => $request->input('FS_RIW_PENYAKIT_DAHULU2'),
            
            
        // ]);
   
        $nutrisi = DB::connection('pku')->table('TAC_RJ_NUTRISI')->where('FS_KD_REG', $kode_reg)->update([
            'FS_NUTRISI1' => $request->input('FS_NUTRISI1'),
            'FS_NUTRISI2' => $request->input('FS_NUTRISI2'),
            'FS_NUTRISI_ANAK1' => $request->input('FS_NUTRISI_ANAK1') ? $request->input('FS_NUTRISI_ANAK1') : '',
            'FS_NUTRISI_ANAK2' => $request->input('FS_NUTRISI_ANAK2')  ? $request->input('FS_NUTRISI_ANAK2') : '',
            'FS_NUTRISI_ANAK3' => $request->input('FS_NUTRISI_ANAK3')  ? $request->input('FS_NUTRISI_ANAK3') : '',
            'FS_NUTRISI_ANAK4' => $request->input('FS_NUTRISI_ANAK4')  ? $request->input('FS_NUTRISI_ANAK4') : '',
            'mdb' => auth()->user()->name,
            'mdd' => date('Y-m-d'),

            
        ]);

        $masalah_kep = $request->input('tujuan');
        DB::connection('pku')->table('TAC_RJ_MASALAH_KEP')->where('FS_KD_REG', $kode_reg)->delete();
        if (!empty($masalah_kep)) {
            foreach ($masalah_kep as $value) {
                $insert_masalah_kep = DB::connection('pku')->table('TAC_RJ_MASALAH_KEP')->insert([

                    'FS_KD_REG' => $kode_reg,
                    'FS_KD_MASALAH_KEP' => $value,
                    
                ]);
            }
        }

        $rencana_kep = $request->input('tembusan');
        DB::connection('pku')->table('TAC_RJ_REN_KEP')->where('FS_KD_REG', $kode_reg)->delete();
        if (!empty($rencana_kep)) {
            foreach ($rencana_kep as $value) {
                $insert_rencana_kep = DB::connection('pku')->table('TAC_RJ_REN_KEP')->insert([

                    'FS_KD_REG' => $kode_reg,
                    'FS_KD_REN_KEP' => $value,
           
                ]);
            }
        }


        var_dump('ok');
    
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
