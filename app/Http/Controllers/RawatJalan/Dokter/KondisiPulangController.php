<?php

namespace App\Http\Controllers\RawatJalan\Dokter;

use App\Models\PoliMata;
use App\Models\Rekam_medis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Rajal;

class KondisiPulangController extends Controller
{
    protected $view;
    // protected $routeIndex;
    protected $prefix;
    protected $kondisiPulang;
    protected $rekam_medis;
    protected $PoliMata;
    protected $rajal;


    public function __construct()
    {

        // $this->kondisiPulang = $kondisiPulang;
        $this->view = 'pages.rj.dokter.';
        $this->PoliMata = new PoliMata();
        $this->rekam_medis = new Rekam_medis();
        $this->rajal = new Rajal();
    }

    // SKDP
    public function SkdpRS($noReg)
    {
        $biodata = $this->rekam_medis->getBiodata($noReg);
        // dd($biodata);
        $title = 'SKDP';
        $alasanSkdp = $this->rajal->getAlesanSkdp();

        return view($this->view . '.kondisiPulang.SKDP', compact('title', 'biodata', 'alasanSkdp'));
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
                'FS_SKDP_2' => $request->input('FS_SKDP_2'),
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

            return redirect('pm/polimata/perawat?kode_dokter=' . $request->input('KODE_DOKTER'))->with('success', 'Berhasil Ditambahkan!');
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

        return view($this->view . '.kondisiPulang.rujukInternal', compact('title', 'biodata', 'dokters'));
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

            return redirect('pm/polimata/dokter')->with('success', 'Berhasil Ditambahkan!');
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

        return view($this->view . '.kondisiPulang.rujukLuar', compact('title', 'biodata'));
    }

    public function rujukLuarAdd(Request $request)
    {
        try {
            DB::connection('pku')->beginTransaction();

            DB::connection('pku')->table('TAC_RJ_RUJUKAN')->insert([
                'FS_KD_REG' => $request->input('FS_KD_REG'),
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

        return view($this->view . '.kondisiPulang.faskesPRB', compact('title', 'biodata', 'kdTrs'));
    }

    public function faskesPRBAdd(Request $request)
    {
        try {
            DB::connection('pku')->beginTransaction();

            DB::connection('pku')->table('TAC_RJ_PRB')->insert([
                'FS_KD_REG' => $request->input('FS_KD_REG'),
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
