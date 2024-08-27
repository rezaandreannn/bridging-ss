<?php

namespace App\Http\Controllers\Poli\Mata\Perawat;

use Carbon\Carbon;
use App\Models\Rajal;
use App\Models\Pasien;
use App\Models\Antrean;
use App\Models\PoliMata;
use App\Models\RajalDokter;
use App\Models\Rekam_medis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;

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
        return view($this->view . 'perawat.index', compact('title', 'pasien', 'dokters'));
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
        return view($this->view . 'perawat.addKeperawatan', compact('title', 'biodata', 'masalah_perawatan', 'rencana_perawatan', 'noReg'));
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

    public function cetakResep($noReg, $kode_transaksi)
    {
        $data = $this->poliMata->cetakResep($noReg, $kode_transaksi);
        // dd($data);
        $biodata = $this->rekam_medis->getBiodata($noReg);
        $antrian = $this->rekam_medis->getAntrianObat($kode_transaksi);
        // dd($antrian);
        $date = date('dMY');
        $tanggal = Carbon::now();

        $filename = 'resep-' . $date . '-' . $kode_transaksi;

        $pdf = PDF::loadview('pages.poli.mata.perawat.resep', ['data' => $data, 'biodata' => $biodata, 'tanggal' => $tanggal, 'antrian' => $antrian]);
        // Set paper size to A5
        $pdf->setPaper('A5');
        return $pdf->stream($filename . '.pdf');
    }

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

            // $userEmr = $this->rajal->getUserEmr(auth()->user()->username);
            // dd($userEmr);

            DB::connection('pku')->beginTransaction();

            $status_rj = DB::connection('pku')->table('TAC_RJ_STATUS')->insert([
                'FS_KD_REG' => $request->input('NO_REG'),
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
                'FS_KD_REG' => $request->input('NO_REG'),
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
                'FS_ANAMNESA' => $request->input('FS_ANAMNESA'),
                'FS_PENGELIHATAN' => $request->input('FS_PENGELIHATAN'),
                'FS_PENCIUMAN' => $request->input('FS_PENCIUMAN'),
                'FS_PENDENGARAN' => $request->input('FS_PENDENGARAN'),
                'FS_RIW_IMUNISASI' => $request->input('FS_RIW_IMUNISASI') ? $request->input('FS_RIW_IMUNISASI') : '0',
                'FS_RIW_IMUNISASI_KET' => $request->input('FS_RIW_IMUNISASI_KET') ? $request->input('FS_RIW_IMUNISASI_KET') : '0',
                'FS_RIW_TUMBUH' => $request->input('FS_RIW_TUMBUH')  ? $request->input('FS_RIW_TUMBUH') : '0',
                'FS_RIW_TUMBUH_KET' => $request->input('FS_RIW_TUMBUH_KET')  ? $request->input('FS_RIW_TUMBUH_KET') : '0',
                'FS_HIGH_RISK' => '',
                'FS_SKDP_FASKES' => $request->input('FS_SKDP_FASKES'),
                'mdb' => auth()->user()->username,
                'mdd' => date('Y-m-d'),
            ]);

            $pemeriksaan_fisik = DB::connection('pku')->table('TAC_RJ_VITAL_SIGN')->insert([
                'FS_KD_REG' => $request->input('NO_REG'),
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
                'FS_KD_REG' => $request->input('NO_REG'),
                'FS_CARA_BERJALAN1' => $request->input('FS_CARA_BERJALAN1'),
                'FS_CARA_BERJALAN2' => $request->input('FS_CARA_BERJALAN2'),
                'FS_CARA_DUDUK' => $request->input('FS_CARA_DUDUK'),
                'mdb' => date('Y-m-d'),
                'mdd' => auth()->user()->username,
            ]);

            DB::connection('pku')->table('poli_mata_asesmen')->insert([
                'NO_REG' => $request->input('NO_REG'),
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
                'NCT_TOD' => $request->input('NCT_TOD'),
                'NCT_TOS' => $request->input('NCT_TOS'),
                'REFLEK_CAHAYA' => $request->input('REFLEK_CAHAYA'),
                'PUPIL' => $request->input('PUPIL'),
                'LUMPUH' => $request->input('LUMPUH'),
                'PUSING' => $request->input('PUSING'),
                'created_at' => now(),
                'CREATE_BY' => auth()->user()->username,
            ]);

            $masalah_kep = $request->input('tujuan');
            if (!empty($masalah_kep)) {
                foreach ($masalah_kep as $value) {
                    $insert_masalah_kep = DB::connection('pku')->table('TAC_RJ_MASALAH_KEP')->insert([

                        'FS_KD_REG' => $request->input('NO_REG'),
                        'FS_KD_MASALAH_KEP' => $value,

                    ]);
                }
            }

            $rencana_kep = $request->input('tembusan');
            if (!empty($rencana_kep)) {
                foreach ($rencana_kep as $value) {
                    $insert_rencana_kep = DB::connection('pku')->table('TAC_RJ_REN_KEP')->insert([

                        'FS_KD_REG' => $request->input('NO_REG'),
                        'FS_KD_REN_KEP' => $value,

                    ]);
                }
            }
            DB::connection('pku')->commit();

            return redirect('pm/polimata/perawat?kode_dokter=' . $request->input('KODE_DOKTER'))->with('success', 'Data Pasien Added successfully!');
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

        return view($this->view . 'perawat.editKeperawatan', compact('title', 'masalah_perawatan', 'rencana_perawatan', 'biodata', 'asasmen_perawat', 'riwayat', 'masalah_perGet', 'rencana_perGet', 'noReg'));
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
        // $userEmr = $this->rajal->getUserEmr(auth()->user()->username);

        $alergi = DB::connection('db_rsmm')->table('REGISTER_PASIEN')->where('NO_MR', $request->input('NO_MR'))->update([
            'FS_ALERGI' => $request->input('FS_ALERGI'),
            'FS_REAK_ALERGI' => $request->input('FS_REAK_ALERGI'),
            'FS_RIW_PENYAKIT_DAHULU' => $request->input('FS_RIW_PENYAKIT_DAHULU'),
            'FS_RIW_PENYAKIT_DAHULU2' => $request->input('FS_RIW_PENYAKIT_DAHULU2'),
        ]);

        $riwayat = DB::connection('pku')->table('TAC_ASES_PER2')->where('FS_KD_REG', $noReg)->update([
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
            'FS_ANAMNESA' => $request->input('FS_ANAMNESA'),
            'FS_PENGELIHATAN' => $request->input('FS_PENGELIHATAN'),
            'FS_PENCIUMAN' => $request->input('FS_PENCIUMAN'),
            'FS_PENDENGARAN' => $request->input('FS_PENDENGARAN'),
            'FS_RIW_IMUNISASI' => $request->input('FS_RIW_IMUNISASI') ? $request->input('FS_RIW_IMUNISASI') : '0',
            'FS_RIW_IMUNISASI_KET' => $request->input('FS_RIW_IMUNISASI_KET') ? $request->input('FS_RIW_IMUNISASI_KET') : '0',
            'FS_RIW_TUMBUH' => $request->input('FS_RIW_TUMBUH')  ? $request->input('FS_RIW_TUMBUH') : '0',
            'FS_RIW_TUMBUH_KET' => $request->input('FS_RIW_TUMBUH_KET')  ? $request->input('FS_RIW_TUMBUH_KET') : '0',
            'FS_HIGH_RISK' => '',
            'FS_SKDP_FASKES' => $request->input('FS_SKDP_FASKES'),
            'mdb' => auth()->user()->username,
            'mdd' => date('Y-m-d'),
        ]);

        $pemeriksaan_fisik = DB::connection('pku')->table('TAC_RJ_VITAL_SIGN')->where('FS_KD_REG', $noReg)->update([
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

        $asesmen_jauh = DB::connection('pku')->table('TAC_RJ_JATUH')->where('FS_KD_REG', $noReg)->update([
            'FS_CARA_BERJALAN1' => $request->input('FS_CARA_BERJALAN1'),
            'FS_CARA_BERJALAN2' => $request->input('FS_CARA_BERJALAN2'),
            'FS_CARA_DUDUK' => $request->input('FS_CARA_DUDUK'),
            'mdb' => date('Y-m-d'),
            'mdd' => auth()->user()->username,
        ]);

        DB::connection('pku')->table('poli_mata_asesmen')->where('NO_REG', $noReg)->update([
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
            'NCT_TOD' => $request->input('NCT_TOD'),
            'NCT_TOS' => $request->input('NCT_TOS'),
            'REFLEK_CAHAYA' => $request->input('REFLEK_CAHAYA'),
            'PUPIL' => $request->input('PUPIL'),
            'LUMPUH' => $request->input('LUMPUH'),
            'PUSING' => $request->input('PUSING'),
            'updated_at' => now(),
            'UPDATE_BY' => auth()->user()->username,
        ]);

        $masalah_kep = $request->input('tujuan');
        DB::connection('pku')->table('TAC_RJ_MASALAH_KEP')->where('FS_KD_REG', $noReg)->delete();
        if (!empty($masalah_kep)) {
            foreach ($masalah_kep as $value) {
                $insert_masalah_kep = DB::connection('pku')->table('TAC_RJ_MASALAH_KEP')->insert([
                    'FS_KD_REG' => $noReg,
                    'FS_KD_MASALAH_KEP' => $value,
                ]);
            }
        }

        $rencana_kep = $request->input('tembusan');
        DB::connection('pku')->table('TAC_RJ_REN_KEP')->where('FS_KD_REG', $noReg)->delete();
        if (!empty($rencana_kep)) {
            foreach ($rencana_kep as $value) {
                $insert_rencana_kep = DB::connection('pku')->table('TAC_RJ_REN_KEP')->insert([
                    'FS_KD_REG' => $noReg,
                    'FS_KD_REN_KEP' => $value,
                ]);
            }
        }


        return redirect('pm/polimata/perawat?kode_dokter=' . $request->input('KODE_DOKTER'))->with('success', 'Edit successfully!');
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
