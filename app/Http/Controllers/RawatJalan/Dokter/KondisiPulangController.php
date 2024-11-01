<?php

namespace App\Http\Controllers\RawatJalan\Dokter;

use App\Models\PoliMata;
use App\Models\Rekam_medis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Rajal;
use App\Models\RajalDokter;

class KondisiPulangController extends Controller
{
    protected $view;
    // protected $routeIndex;
    protected $prefix;
    protected $kondisiPulang;
    protected $rekam_medis;
    protected $PoliMata;
    protected $rajal;
    protected $rajaldokter;


    public function __construct()
    {

        // $this->kondisiPulang = $kondisiPulang;
        $this->view = 'pages.rj.dokter.';
        $this->PoliMata = new PoliMata();
        $this->rekam_medis = new Rekam_medis();
        $this->rajal = new Rajal();
        $this->rajaldokter = new RajalDokter();
    }

    // SKDP
    public function SkdpRS($noReg)
    {
        $biodata = $this->rekam_medis->getBiodata($noReg);
        // dd($biodata);
        $tanggalExpried = $this->rajal->getTanggal($noReg);
        $title = 'SKDP';
        $alasanSkdp = $this->rajal->getAlesanSkdp();

        return view($this->view . '.kondisiPulang.SKDP', compact('title', 'biodata', 'tanggalExpried', 'alasanSkdp'));
    }

    public function EditSkdpRS($noReg)
    {
        $biodata = $this->rekam_medis->getBiodata($noReg);
        // dd($biodata);
        $title = 'SKDP';
        $alasanSkdp = $this->rajal->getAlesanSkdp();
        $skdp = $this->rajal->getSkdp2($noReg);
        // dd($skdp);
        $rencanaSkdp = $this->rajal->get_rencana_skdp_by_noreg();

        return view($this->view . '.kondisiPulang.EditSKDP', compact('title', 'biodata', 'skdp', 'alasanSkdp', 'rencanaSkdp'));
    }

    public function SkdpAdd(Request $request)
    {
        try {

            DB::connection('pku')->beginTransaction();

            $AddSKDP = DB::connection('pku')->table('TAC_RJ_SKDP')->insert([
                'FS_KD_REG' => $request->input('FS_KD_REG'),
                'FS_SKDP_1' => $request->input('FS_SKDP_1'),
                'FS_SKDP_2' => $request->input('FS_SKDP_2') ?? '',
                'FS_SKDP_KET' => $request->input('FS_SKDP_KET') ?? '',
                'FS_SKDP_KONTROL' => $request->input('FS_SKDP_KONTROL') ?? '',
                'FS_SKDP_FASKES' => $request->input('FS_SKDP_FASKES'),
                'FS_PESAN' => $request->input('FS_PESAN'),
                'FS_RENCANA_KONTROL' => $request->input('FS_RENCANA_KONTROL'),
                'mdd' => date('Y-m-d'),
                'mdb' => auth()->user()->username,
            ]);

            if ($AddSKDP) {
                DB::connection('pku')->table('TAC_RJ_RUJUKAN')->where('FS_KD_REG', $request->input('FS_KD_REG'))->delete();
                DB::connection('pku')->table('TAC_RJ_PRB')->where('FS_KD_REG', $request->input('FS_KD_REG'))->delete();
            }

            DB::connection('pku')->commit();

            return redirect('pm/polimata/dokter')->with('success', 'Berhasil Ditambahkan!');
        } catch (\Exception $e) {
            //throw $th;
            DB::connection('pku')->rollBack();
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }
    public function SkdpEdit(Request $request, $noReg)
    {
        try {

            DB::connection('pku')->beginTransaction();


            $AddSKDP = DB::connection('pku')->table('TAC_RJ_SKDP')->where('FS_KD_REG', $noReg)->update([
                'FS_SKDP_1' => $request->input('FS_SKDP_1'),
                'FS_SKDP_2' => $request->input('FS_SKDP_2') ?? '',
                'FS_SKDP_KET' => $request->input('FS_SKDP_KET') ?? '',
                'FS_SKDP_KONTROL' => $request->input('FS_SKDP_KONTROL') ?? '',
                'FS_SKDP_FASKES' => $request->input('FS_SKDP_FASKES'),
                'FS_PESAN' => $request->input('FS_PESAN'),
                'FS_RENCANA_KONTROL' => $request->input('FS_RENCANA_KONTROL'),
                'mdd' => date('Y-m-d'),
                'mdb' => auth()->user()->username,
            ]);

            if ($AddSKDP) {
                DB::connection('pku')->table('TAC_RJ_RUJUKAN')->where('FS_KD_REG', $request->input('FS_KD_REG'))->delete();
                DB::connection('pku')->table('TAC_RJ_PRB')->where('FS_KD_REG', $request->input('FS_KD_REG'))->delete();
            }

            DB::connection('pku')->commit();

            $kode_dokter = auth()->user()->username;

            if ($kode_dokter) {
                return redirect('pm/polimata/dokter')->with('success', 'Berhasil Ditambahkan!');
            } else {
                return redirect('pm/polimata/perawat?kode_dokter=' . $request->input('KODE_DOKTER'))->with('success', 'Berhasil Ditambahkan!');
            }
        } catch (\Exception $e) {
            //throw $th;
            DB::connection('pku')->rollBack();
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    // Rawat Inap
    public function rawatInap($noReg)
    {
        $biodata = $this->rekam_medis->getBiodata($noReg);
        $title = 'Rawat Inap';
        $asasmen_dokter = $this->PoliMata->asasmenDokter($noReg);
        // dd($asasmen_dokter);

        // Data Master
        $masterLab = $this->rajaldokter->getMasterLab();
        $getLab = $this->rajaldokter->getLabByKodeReg($noReg);
        $masterRadiologi = $this->rajaldokter->getMasterRadiologi();
        $getRad = $this->rajaldokter->getRadByKodeReg($noReg);
        $getCekRad = $this->rajaldokter->getCekRad($noReg);

        $masterObat = $this->rajaldokter->getMasterObat();

        return view($this->view . '.kondisiPulang.rawatInap.Add', compact('biodata', 'title', 'asasmen_dokter', 'masterLab', 'noReg', 'getLab', 'masterRadiologi', 'getRad', 'getCekRad', 'masterObat'));
    }

    public function rawatInapStore(Request $request, $noReg)
    {
        try {

            $userEmr = $this->rajal->getUserEmr(auth()->user()->username);
            // dd($userEmr);

            DB::connection('pku')->beginTransaction();

            DB::connection('pku')->table('TAC_RI_MEDIS')->insert([
                'FS_KD_REG' => $request->input('FS_KD_REG'),
                'FS_KD_KP' => '',
                'FS_RIW_PENYAKIT_DAHULU' => '',
                'FS_RIW_PENYAKIT_DAHULU2' => '',
                'FS_STATUS_PSIK' => $request->input('FS_STATUS_PSIK'),
                'FS_STATUS_PSIK2' => $request->input('FS_STATUS_PSIK2') ? $request->input('FS_STATUS_PSIK2') : '',
                'FS_HUB_KELUARGA' => $request->input('FS_HUB_KELUARGA'),
                'FS_ANAMNESA' => $request->input('FS_ANAMNESA'),
                'FS_DIAGNOSA' => $request->input('FS_DIAGNOSA'),
                'FS_TINDAKAN' => $request->input('FS_TINDAKAN'),
                'FS_TERAPI' => $request->input('FS_TERAPI'),
                'FS_CATATAN_FISIK' => $request->input('FS_CATATAN_FISIK'),
                'FS_KD_MEDIS' => $request->input('FS_KD_MEDIS'),
                'FS_CARA_PULANG' => $request->input('FS_CARA_PULANG'),
                'FS_DAFTAR_MASALAH' => $request->input('FS_DAFTAR_MASALAH'),
                'FS_PLANNING_LAB' => $request->input('periksa_lab'),
                'FS_PLANNING_RAD' => $request->input('periksa_rad'),
                'FS_HASIL_PEMERIKSAAN_PENUNJANG' => $request->input('FS_HASIL_PEMERIKSAAN_PENUNJANG'),
                'FS_STATUS' => $request->input('FS_STATUS'),
                'FS_MR' => $request->input('FS_MR'),
                'FS_PESAN' => $request->input('FS_PESAN'),
                'FS_ALERGI' => $request->input('FS_ALERGI'),
                'FS_REAK_ALERGI' => $request->input('FS_REAK_ALERGI'),
                'KONJUNGTIVA' => $request->input('KONJUNGTIVA'),
                'DEVIASI' => $request->input('DEVIASI'),
                'SKELERA' => $request->input('SKELERA'),
                'JVP' => $request->input('JVP'),
                'BIBIR' => $request->input('BIBIR'),
                'MUKOSA' => $request->input('MUKOSA'),
                'THORAX' => $request->input('THORAX'),
                'JANTUNG' => $request->input('JANTUNG'),
                'ABDOMEN' => $request->input('ABDOMEN'),
                'PINGGANG' => $request->input('PINGGANG'),
                'EKS_ATAS' => $request->input('EKS_ATAS'),
                'EKS_BAWAH' => $request->input('EKS_BAWAH'),
                'FS_JAM_TRS' => $request->input('FS_JAM_TRS'),
                'mdb' => $userEmr->user_id,
                'mdd' => date('Y-m-d'),
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

            // Penunjang LAB & RADIOLOGI
            $periksa_lab = $request->input('periksa_lab');
            if (!empty($periksa_lab)) {
                foreach ($periksa_lab as $key => $value) {
                    DB::connection('pku')->table('ta_trs_kartu_periksa4')->insert([
                        'fn_no_urut' => $key,
                        'fs_kd_tarif' => $value,
                        'fs_kd_reg2' => $request->input('NO_REG'),
                    ]);
                }
            }

            $periksa_rad = $request->input('periksa_rad');
            $fs_bagian = $request->input('FS_BAGIAN');
            if (!empty($periksa_rad)) {
                foreach ($periksa_lab as $key => $value) {
                    DB::connection('pku')->table('ta_trs_kartu_periksa5')->insert([
                        'fn_no_urut' => $key,
                        'fs_kd_tarif' => $value,
                        'fs_kd_reg2' => $request->input('NO_REG'),
                        'fs_bagian' => $fs_bagian,
                    ]);
                }
            }
            DB::connection('pku')->commit();

            return redirect('pm/polimata/perawat?kode_dokter=' . $request->input('KODE_DOKTER'))->with('success', 'Data Berhasil Ditambahkan!');
        } catch (\Exception $e) {
            //throw $th;
            DB::connection('pku')->rollBack();
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    // Rujuk Internal
    public function rujukInternalRS($noReg)
    {
        $biodata = $this->rekam_medis->getBiodata($noReg);
        $title = 'Rujuk Internal RS';
        $dokters = $this->rajal->byKodeDokter();
        // dd($dokters);

        return view($this->view . '.kondisiPulang.rujukInternal.Add', compact('title', 'biodata', 'dokters'));
    }

    public function rujukInternalEdit($noReg)
    {
        $biodata = $this->rekam_medis->getBiodata($noReg);
        $title = 'Rujuk Internal RS';
        $dokters = $this->rajal->byKodeDokter();
        $rujuk = $this->rajal->editRujukInternal($noReg);
        // dd($rujuk);

        return view($this->view . '.kondisiPulang.rujukInternal.Edit', compact('title', 'biodata', 'dokters', 'rujuk'));
    }

    public function rujukInternalAdd(Request $request)
    {
        try {
            DB::connection('pku')->beginTransaction();

            $AddrujukanInternal = DB::connection('pku')->table('TAC_RJ_RUJUKAN')->insert([
                'FS_KD_REG' => $request->input('FS_KD_REG'),
                'FS_TUJUAN_RUJUKAN' => $request->input('FS_TUJUAN_RUJUKAN'),
                'FS_TUJUAN_RUJUKAN2' => $request->input('FS_TUJUAN_RUJUKAN2'),
                'FS_ALASAN_RUJUK' => $request->input('FS_ALASAN_RUJUK'),
                'mdd_date' => date('Y-m-d'),
                'mdd_time' => date('H:i:s'),
                'mdb' => auth()->user()->username,
            ]);

            if ($AddrujukanInternal) {
                DB::connection('pku')->table('TAC_RJ_SKDP')->where('FS_KD_REG', $request->input('FS_KD_REG'))->delete();
                DB::connection('pku')->table('TAC_RJ_PRB')->where('FS_KD_REG', $request->input('FS_KD_REG'))->delete();
            }

            DB::connection('pku')->commit();

            return redirect('pm/polimata/dokter')->with('success', 'Rujukan Berhasil Ditambahkan!');
        } catch (\Exception $e) {
            //throw $th;
            DB::connection('pku')->rollBack();
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function rujukInternalUpdate(Request $request)
    {
        try {
            DB::connection('pku')->beginTransaction();

            DB::connection('pku')->table('TAC_RJ_RUJUKAN')->where('FS_KD_REG', $request->input('FS_KD_REG'))->update([
                'FS_TUJUAN_RUJUKAN' => $request->input('FS_TUJUAN_RUJUKAN'),
                'FS_TUJUAN_RUJUKAN2' => $request->input('FS_TUJUAN_RUJUKAN2'),
                'FS_ALASAN_RUJUK' => $request->input('FS_ALASAN_RUJUK'),
                'mdd_date' => date('Y-m-d'),
                'mdd_time' => date('H:i:s'),
                'mdb' => auth()->user()->username,
            ]);

            DB::connection('pku')->commit();

            return redirect('pm/polimata/dokter')->with('success', 'Rujukan Berhasil DiEdit!');
        } catch (\Exception $e) {
            //throw $th;
            DB::connection('pku')->rollBack();
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    // Rujuk Luar RS
    public function rujukLuarRS($noReg)
    {
        $biodata = $this->rekam_medis->getBiodata($noReg);
        $title = 'Rujuk Luar RS';

        return view($this->view . '.kondisiPulang.rujukLuar.Add', compact('title', 'biodata'));
    }

    public function rujukLuarEdit($noReg)
    {
        $biodata = $this->rekam_medis->getBiodata($noReg);
        $title = 'Rujuk Luar RS';
        $rujuk = $this->rajal->editRujukInternal($noReg);

        return view($this->view . '.kondisiPulang.rujukLuar.Edit', compact('title', 'biodata', 'rujuk'));
    }

    public function rujukLuarAdd(Request $request)
    {
        try {
            DB::connection('pku')->beginTransaction();

            $AddrujukLuar = DB::connection('pku')->table('TAC_RJ_RUJUKAN')->insert([
                'FS_KD_REG' => $request->input('FS_KD_REG'),
                'FS_TUJUAN_RUJUKAN' => $request->input('FS_TUJUAN_RUJUKAN'),
                'FS_TUJUAN_RUJUKAN2' => $request->input('FS_TUJUAN_RUJUKAN2'),
                'FS_ALASAN_RUJUK' => $request->input('FS_ALASAN_RUJUK'),
                'mdd_date' => date('Y-m-d'),
                'mdd_time' => date('H:i:s'),
                'mdb' => auth()->user()->username,
            ]);

            if ($AddrujukLuar) {
                DB::connection('pku')->table('TAC_RJ_SKDP')->where('FS_KD_REG', $request->input('FS_KD_REG'))->delete();
                DB::connection('pku')->table('TAC_RJ_PRB')->where('FS_KD_REG', $request->input('FS_KD_REG'))->delete();
            }

            DB::connection('pku')->commit();

            return redirect('pm/polimata/dokter')->with('success', 'Berhasil Ditambahkan!');
        } catch (\Exception $e) {
            //throw $th;
            DB::connection('pku')->rollBack();
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function rujukLuarUpdate(Request $request)
    {
        try {
            DB::connection('pku')->beginTransaction();

            DB::connection('pku')->table('TAC_RJ_RUJUKAN')->where('FS_KD_REG', $request->input('FS_KD_REG'))->update([
                'FS_TUJUAN_RUJUKAN' => $request->input('FS_TUJUAN_RUJUKAN'),
                'FS_TUJUAN_RUJUKAN2' => $request->input('FS_TUJUAN_RUJUKAN2'),
                'FS_ALASAN_RUJUK' => $request->input('FS_ALASAN_RUJUK'),
                'mdd_date' => date('Y-m-d'),
                'mdd_time' => date('H:i:s'),
                'mdb' => auth()->user()->username,
            ]);

            DB::connection('pku')->commit();

            return redirect('pm/polimata/dokter')->with('success', 'Berhasil Ditambahkan!');
        } catch (\Exception $e) {
            //throw $th;
            DB::connection('pku')->rollBack();
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    // Faskes PRB
    public function faskesPRB($noReg)
    {
        $biodata = $this->rekam_medis->getBiodata($noReg);
        $kdTrs = $this->rajal->pasien_bynoreg($noReg);
        $title = 'Kembali Ke Faskes Primer';

        return view($this->view . '.kondisiPulang.faskesPRB.Add', compact('title', 'biodata', 'kdTrs'));
    }

    public function faskesPRBEdit($noReg)
    {
        $biodata = $this->rekam_medis->getBiodata($noReg);
        $kdTrs = $this->rajal->pasien_bynoreg($noReg);
        $title = 'Kembali Ke Faskes Primer';
        $prb = $this->rajal->editPRB($noReg);
        // dd($prb);

        return view($this->view . '.kondisiPulang.faskesPRB.Edit', compact('title', 'biodata', 'kdTrs', 'prb'));
    }

    public function faskesPRBAdd(Request $request)
    {
        try {
            DB::connection('pku')->beginTransaction();

            $AddPRB = DB::connection('pku')->table('TAC_RJ_PRB')->insert([
                'FS_KD_REG' => $request->input('FS_KD_REG'),
                'FS_KD_TRS' => $request->input('FS_KD_TRS'),
                'FS_TGL_PRB' => $request->input('FS_TGL_PRB'),
                'FS_TUJUAN' => $request->input('FS_TUJUAN'),
                'mdd_date' => date('Y-m-d'),
                'mdd_time' => date('H:i:s'),
                'mdb' => auth()->user()->username,
            ]);

            if ($AddPRB) {
                DB::connection('pku')->table('TAC_RJ_SKDP')->where('FS_KD_REG', $request->input('FS_KD_REG'))->delete();
                DB::connection('pku')->table('TAC_RJ_RUJUKAN')->where('FS_KD_REG', $request->input('FS_KD_REG'))->delete();
            }

            DB::connection('pku')->commit();

            return redirect('pm/polimata/dokter')->with('success', 'Berhasil Ditambahkan!');
        } catch (\Exception $e) {
            //throw $th;
            DB::connection('pku')->rollBack();
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function faskesPRBUpdate(Request $request)
    {
        try {
            DB::connection('pku')->beginTransaction();

            DB::connection('pku')->table('TAC_RJ_PRB')->where('FS_KD_REG', $request->input('FS_KD_REG'))->update([
                'FS_KD_TRS' => $request->input('FS_KD_TRS'),
                'FS_TGL_PRB' => $request->input('FS_TGL_PRB'),
                'FS_TUJUAN' => $request->input('FS_TUJUAN'),
                'mdd_date' => date('Y-m-d'),
                'mdd_time' => date('H:i:s'),
                'mdb' => auth()->user()->username,
            ]);

            DB::connection('pku')->commit();

            return redirect('pm/polimata/dokter')->with('success', 'Berhasil Ditambahkan!');
        } catch (\Exception $e) {
            //throw $th;
            DB::connection('pku')->rollBack();
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function index()
    {
        //
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
