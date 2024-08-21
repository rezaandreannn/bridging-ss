<?php

namespace App\Http\Controllers\Poli\Mata\Dokter;

use App\Models\Rajal;
use App\Models\PoliMata;
use App\Models\RajalDokter;
use App\Models\Rekam_medis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AssesmenDokterMataController extends Controller
{
    protected $view;
    protected $routeIndex;
    protected $prefix;
    protected $poliMata;
    protected $rajaldokter;
    protected $rajal;
    protected $rekam_medis;

    public function __construct(PoliMata $poliMata)
    {
        $this->rajaldokter = new RajalDokter();
        $this->rekam_medis = new Rekam_medis;
        $this->rajal = new Rajal;
        $this->poliMata = $poliMata;
        $this->view = 'pages.poli.mata.';
        $this->prefix = 'Poli';
    }

    public function index()
    {
        $title = $this->prefix . ' ' . 'Mata Dokter';
        $pasien = $this->rajaldokter->getPasienByDokter(auth()->user()->username);
        return view($this->view . 'dokter.index', compact('title', 'pasien'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add($noReg)
    {
        $title = $this->prefix . ' ' . 'Mata Assesmen Dokter';
        $biodata = $this->rekam_medis->getBiodata($noReg);
        $asasmen_perawat = $this->poliMata->asasmenPerawatGet($noReg);
        // dd($asasmen_perawat);

        $masalah_perawatan = $this->rajal->masalah_perawatan();
        $rencana_perawatan = $this->rajal->rencana_perawatan();

        $masalah_perGet = $this->rajal->masalahPerawatanGetByNoreg($noReg);
        $rencana_perGet = $this->rajal->rencanaPerawatanGetByNoreg($noReg);

        $selected = false;
        foreach ($masalah_perawatan as $mp) {
            foreach ($masalah_perGet as  $value) {
                if ($mp->FS_KD_DAFTAR_DIAGNOSA == $value->FS_KD_MASALAH_KEP) {
                    $selected = true;
                    break;
                }
            }
        }
        // dd($asasmen_perawat);
        return view($this->view . 'dokter.assesmenAwal', compact('title', 'biodata', 'asasmen_perawat', 'masalah_perGet', 'rencana_perGet', 'masalah_perawatan', 'rencana_perawatan', 'noReg'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $userEmr = $this->rajal->getUserEmr(auth()->user()->username);
        try {
            DB::connection('pku')->beginTransaction();

            DB::connection('pku')->table('TAC_RJ_STATUS')->where('FS_KD_REG', $request->input('FS_KD_REG'))->update([
                'FS_STATUS' => '1',
                'FS_FORM' => '1',
                'FS_JNS_ASESMEN' => 'A',
                'mdb' => auth()->user()->username,
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
                // 'FS_HUB_KELUARGA' => $request->input('FS_HUB_KELUARGA'),
                // 'FS_ST_FUNGSIONAL' => $request->input('FS_ST_FUNGSIONAL'),
                'FS_AGAMA' => $request->input('FS_AGAMA'),
                'PERNIKAHAN' => $request->input('PERNIKAHAN'),
                'JOB' => $request->input('JOB'),
                'SUKU' => $request->input('SUKU'),
                // 'FS_NILAI_KHUSUS' => $request->input('FS_NILAI_KHUSUS'),
                // 'FS_NILAI_KHUSUS2' => $request->input('FS_NILAI_KHUSUS'),
                'FS_ANAMNESA' => $request->input('FS_ANAMNESA'),
                // 'FS_PENGELIHATAN' => $request->input('FS_PENGELIHATAN'),
                // 'FS_PENCIUMAN' => $request->input('FS_PENCIUMAN'),
                // 'FS_PENDENGARAN' => $request->input('FS_PENDENGARAN'),
                'FS_RIW_IMUNISASI' => $request->input('FS_RIW_IMUNISASI') ? $request->input('FS_RIW_IMUNISASI') : '0',
                'FS_RIW_IMUNISASI_KET' => $request->input('FS_RIW_IMUNISASI_KET') ? $request->input('FS_RIW_IMUNISASI_KET') : '0',
                'FS_RIW_TUMBUH' => $request->input('FS_RIW_TUMBUH')  ? $request->input('FS_RIW_TUMBUH') : '0',
                'FS_RIW_TUMBUH_KET' => $request->input('FS_RIW_TUMBUH_KET')  ? $request->input('FS_RIW_TUMBUH_KET') : '0',
                'FS_HIGH_RISK' => '',
                'FS_EDUKASI' => $request->input('FS_EDUKASI'),
                'FS_SKDP_FASKES' => $request->input('FS_SKDP_FASKES'),
                'mdb' => auth()->user()->username,
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
                'mdb' => auth()->user()->username,
                'mdd' => date('Y-m-d'),
                'FS_JAM_TRS' => date('H:i:s'),
            ]);

            $asesmen_jauh = DB::connection('pku')->table('TAC_RJ_JATUH')->insert([
                'FS_KD_REG' => $request->input('FS_KD_REG'),
                'FS_CARA_BERJALAN1' => $request->input('FS_CARA_BERJALAN1'),
                'FS_CARA_BERJALAN2' => $request->input('FS_CARA_BERJALAN2'),
                'FS_CARA_DUDUK' => $request->input('FS_CARA_DUDUK'),
                'mdb' => date('Y-m-d'),
                'mdd' => auth()->user()->username,
            ]);

            DB::connection('pku')->table('poli_mata_asesmen')->insert([
                'FS_KD_REG' => $request->input('FS_KD_REG'),
                'RIWAYAT_SEKARANG' => $request->input('RIWAYAT_SEKARANG'),
                'KEADAAN_UMUM' => $request->input('KEADAAN_UMUM'),
                'KESADARAN' => $request->input('KESADARAN'),
                'STATUS_MENTAL' => $request->input('STATUS_MENTAL'),
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
                'CREATE_BY' => auth()->user()->username,
            ]);

            DB::connection('pku')->table('poli_mata_asesmen_dokter')->insert([
                'FS_KD_REG' => $request->input('FS_KD_REG'),
                'KONJUNGTIVA' => $request->input('KONJUNGTIVA'),
                'SKELERA' => $request->input('SKELERA'),
                'BIBIR_LIDAH' => $request->input('BIBIR_LIDAH'),
                'palpebra_kiri' => $request->input('palpebra_kiri'),
                'palpebra_kanan' => $request->input('palpebra_kanan'),
                'conjuctiva_kiri' => $request->input('conjuctiva_kiri'),
                'conjuctiva_kanan' => $request->input('conjuctiva_kanan'),
                'cornea_kiri' => $request->input('cornea_kiri'),
                'cornea_kanan' => $request->input('cornea_kanan'),
                'coa_kiri' => $request->input('coa_kiri'),
                'coa_kanan' => $request->input('coa_kanan'),
                'iris_kiri' => $request->input('iris_kiri'),
                'iris_kanan' => $request->input('iris_kanan'),
                'pupil_kiri' => $request->input('pupil_kiri'),
                'pupil_kanan' => $request->input('pupil_kanan'),
                'lensa_kanan' => $request->input('lensa_kanan'),
                'lensa_kiri' => $request->input('lensa_kiri'),
                'vitreosh_kanan' => $request->input('vitreosh_kanan'),
                'vitreosh_kiri' => $request->input('vitreosh_kiri'),
                'biometri_kiri' => $request->input('biometri_kiri'),
                'biometri_kanan' => $request->input('biometri_kanan'),
                'discharge' => $request->input('discharge'),
                'tonometri_od' => $request->input('tonometri_od'),
                'tonometri_os' => $request->input('tonometri_os'),
                'aplansi_od' => $request->input('aplansi_od'),
                'aplansi_os' => $request->input('aplansi_os'),
                'anel_od' => $request->input('anel_od'),
                'anel_os' => $request->input('anel_os'),
                'ekstremitas_od' => $request->input('ekstremitas_od'),
                'ekstremitas_os' => $request->input('ekstremitas_os '),
                'CREATE_BY' => auth()->user()->username,
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

            return redirect('pm/polimata/dokter')->with('success', 'Edit Successfully!');
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
    public function update(Request $request, $noReg) {}

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
