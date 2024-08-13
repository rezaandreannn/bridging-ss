<?php

namespace App\Http\Controllers\Poli\Mata\Perawat;

use App\Models\Rajal;
use App\Models\Pasien;
use App\Models\Antrean;
use App\Models\PoliMata;
use App\Models\RajalDokter;
use App\Models\Rekam_medis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AssesmenMataController extends Controller
{

    protected $view;
    protected $routeIndex;
    protected $prefix;
    protected $poliMata;
    protected $pasien;
    protected $rajaldokter;
    protected $rajal;
    protected $rekam_medis;
    protected $antrean;

    public function __construct(PoliMata $poliMata)
    {
        $this->rajaldokter = new RajalDokter;
        $this->rajal = new Rajal;
        $this->rekam_medis = new Rekam_medis;
        $this->poliMata = $poliMata;
        $this->view = 'pages.poli.mata.';
        $this->prefix = 'Poli';
        $this->pasien = new Pasien;
        $this->antrean = new Antrean();
    }

    public function index(Request $request)
    {
        $title = $this->prefix . ' ' . 'Mata';
        $kode_dokter = $request->input('kode_dokter');
        $dokters = $this->poliMata->getDokterMata();
        $pasien = $this->antrean->getDataPasienRajal($kode_dokter);
        // dd($pasien);
        return view($this->view . 'index', compact('title', 'pasien', 'dokters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Add($noReg)
    {
        $title = $this->prefix . ' ' . 'Mata Assesmen Keperawatan';
        $biodata = $this->rekam_medis->getBiodata($noReg);
        $masalah_perawatan = $this->rajal->masalah_perawatan();
        $rencana_perawatan = $this->rajal->rencana_perawatan();
        return view($this->view . 'addKeperawatan', compact('title', 'biodata', 'masalah_perawatan', 'rencana_perawatan', 'noReg'));
    }

    public function create($noReg)
    {
        $title = $this->prefix . ' ' . 'Mata Assesmen Awal';
        $biodata = $this->rekam_medis->getBiodata($noReg);
        return view($this->view . 'assesmenAwal', compact('title', 'biodata'));
    }

    public function assesmenMata($noReg)
    {
        $title = $this->prefix . ' ' . 'Mata Assesmen Pemeriksaan';
        $biodata = $this->rekam_medis->getBiodata($noReg);
        return view($this->view . 'assesmenMata', compact('title', 'biodata'));
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
        $request->validate([
            'suhu' => 'required',
            'nadi' => 'required',
            'respirasi' => 'required',
            'td' => 'required',
        ]);

        try {

            $userEmr = $this->rajal->getUserEmr(auth()->user()->username);

            DB::connection('pku')->beginTransaction();

            $status_rj = DB::connection('pku')->table('TAC_RJ_STATUS')->insert([
                'FS_KD_REG' => $request->input('FS_KD_REG'),
                'FS_STATUS' => '1',
                'FS_FORM' => '1',
                'FS_JNS_ASESMEN' => 'A',
                'mdb' => $userEmr->user_id,
                'mdd' => now(),
            ]);

            $alergi = DB::connection('db_rsmm')->table('REGISTER_PASIEN')->where('NO_MR', $request->input('NO_MR'))->update([
                'FS_ALERGI' => $request->input('FS_ALERGI'),
                'FS_REAK_ALERGI' => $request->input('FS_REAK_ALERGI'),
                'FS_RIW_PENYAKIT_DAHULU' => $request->input('FS_RIW_PENYAKIT_DAHULU'),
                'FS_RIW_PENYAKIT_DAHULU2' => $request->input('FS_RIW_PENYAKIT_DAHULU2'),
            ]);

            $riwayat = DB::connection('pku')->table('TAC_ASES_PER2')->insert([
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
                'PERNIKAHAN' => $request->input('PERNIKAHAN'),
                'JOB' => $request->input('JOB'),
                'SUKU' => $request->input('SUKU'),
                'FS_NILAI_KHUSUS' => $request->input('FS_NILAI_KHUSUS'),
                'FS_NILAI_KHUSUS2' => $request->input('FS_NILAI_KHUSUS'),
                'FS_ANAMNESA' => $request->input('anamnesa'),
                'FS_PENGELIHATAN' => $request->input('FS_PENGELIHATAN'),
                'FS_PENCIUMAN' => $request->input('FS_PENCIUMAN'),
                'FS_PENDENGARAN' => $request->input('FS_PENDENGARAN'),
                'FS_RIW_IMUNISASI' => $request->input('FS_RIW_IMUNISASI') ? $request->input('FS_RIW_IMUNISASI') : '0',
                'FS_RIW_IMUNISASI_KET' => $request->input('FS_RIW_IMUNISASI_KET') ? $request->input('FS_RIW_IMUNISASI_KET') : '0',
                'FS_RIW_TUMBUH' => $request->input('FS_RIW_TUMBUH')  ? $request->input('FS_RIW_TUMBUH') : '0',
                'FS_RIW_TUMBUH_KET' => $request->input('FS_RIW_TUMBUH_KET')  ? $request->input('FS_RIW_TUMBUH_KET') : '0',
                'FS_HIGH_RISK' => '',
                'FS_EDUKASI' => $request->input('pemeriksaan_fisik'),
                'FS_SKDP_FASKES' => $request->input('FS_SKDP_FASKES'),
                'mdb' => $userEmr->user_id,
                'mdd' => date('Y-m-d'),
            ]);

            $pemeriksaan_fisik = DB::connection('pku')->table('TAC_RJ_VITAL_SIGN')->insert([
                'FS_KD_REG' => $request->input('FS_KD_REG'),
                'FS_SUHU' => $request->input('suhu'),
                'FS_NADI' => $request->input('nadi'),
                'FS_R' => $request->input('respirasi'),
                'FS_TD' => $request->input('td'),
                'FS_TB' => $request->input('tb'),
                'FS_BB' => $request->input('bb'),
                'FS_KD_MEDIS' => $request->input('KODE_DOKTER'),
                'mdb' => $userEmr->user_id,
                'mdd' => date('Y-m-d'),
                'FS_JAM_TRS' => date('H:i:s'),
            ]);

            $asesmen_jauh = DB::connection('pku')->table('TAC_RJ_JATUH')->insert([
                'FS_KD_REG' => $request->input('FS_KD_REG'),
                'FS_CARA_BERJALAN1' => $request->input('FS_CARA_BERJALAN1'),
                'FS_CARA_BERJALAN2' => $request->input('FS_CARA_BERJALAN2'),
                'FS_CARA_DUDUK' => $request->input('FS_CARA_DUDUK'),
                'mdb' => $userEmr->user_id,
                'mdd' => date('Y-m-d'),
            ]);

            DB::connection('pku')->table('poli_mata_asesmen')->insert([
                'FS_KD_REG' => $request->input('FS_KD_REG'),
                'KEADAAN_UMUM' => $request->input('KEADAAN_UMUM'),
                'KESADARAN' => $request->input('KESADARAN'),
                'STATUS_MENTAL' => $request->input('KESADARAN'),
                'LINGKAR_KEPALA' => $request->input('LINGKAR_KEPALA'),
                'STATUS_GIZI' => $request->input('STATUS_GIZI'),
                'CACAT' => $request->input('CACAT'),
                'ADL' => $request->input('ADL'),
                'VISUS_OD' => $request->input('VISUS_OD'),
                'VISUS_OS' => $request->input('VISUS_OS'),
                'REFLEK_CAHAYA' => $request->input('REFLEK_CAHAYA'),
                'PUPIL' => $request->input('PUPIL'),
                'LUMPUH' => $request->input('LUMPUH'),
                'PUSING' => $request->input('PUSING'),
                'PROTESA' => $request->input('PROTESA'),
                'CREATE_BY' => $userEmr->user_id,
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
            DB::connection('pku')->commit();

            return redirect('rj/rawat_jalan?kode_dokter=' . $request->input('KODE_DOKTER'))->with('success', 'Data Pasien Added successfully!');
        } catch (\Exception $e) {
            //throw $th;
            DB::connection('pku')->rollBack();
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
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
        $title = $this->prefix . ' ' . 'Mata Edit Data';
        $masalah_perawatan = $this->rajal->masalah_perawatan();
        $rencana_perawatan = $this->rajal->rencana_perawatan();

        $masalah_perGet = $this->rajal->masalahPerawatanGetByNoreg($noReg);
        $rencana_perGet = $this->rajal->rencanaPerawatanGetByNoreg($noReg);
        $biodata = $this->rajal->pasien_bynoreg($noReg);

        $asasmen_perawat = $this->poliMata->asasmenPerawatGet($noReg);
        // dd($asasmen_perawat);
        $riwayat = $this->rajal->riwayatGet($noReg);
        // dd($riwayat);

        $selected = false;
        foreach ($masalah_perawatan as $mp) {
            foreach ($masalah_perGet as  $value) {
                if ($mp->FS_KD_DAFTAR_DIAGNOSA == $value->FS_KD_MASALAH_KEP) {
                    $selected = true;
                    break;
                }
            }
        }
        return view($this->view . 'editKeperawatan', compact('title', 'masalah_perawatan', 'rencana_perawatan', 'biodata', 'asasmen_perawat', 'riwayat', 'masalah_perGet', 'rencana_perGet', 'noReg'));
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
