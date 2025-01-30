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

    public function index2(Request $request)
    {
        $title = $this->prefix . ' ' . 'Mata';
        $kode_dokter = $request->input('kode_dokter');
        $dokters = $this->poliMata->getDokterMata();
        $tanggal = $request->input('tanggal');

        $pasien = [];
        if ($kode_dokter != null and $kode_dokter != null) {
            $pasien = $this->rekam_medis->rekamMedisHarian($kode_dokter, $tanggal);
        }
        // dd($pasien);
        $poliMata = new PoliMata();
        return view($this->view . 'perawat.index2', compact('title', 'pasien', 'dokters', 'poliMata'));
    }

    // --------- Riwayat Rekam Medis ------------ //
    public function berkas(Request $request)
    {
        $title = $this->prefix . ' ' . 'Mata Riwayat Rekam Medis';
        $kode_dokter = $request->input('kode_dokter');
        $tanggal = $request->input('tanggal');
        $dokters = $this->poliMata->getDokterMata();
        // $pasien = $this->antrean->getDataPasienRajal($kode_dokter);
        $dataPasien = [];
        if ($kode_dokter != null and $kode_dokter != null) {
            $dataPasien = $this->rekam_medis->rekamMedisHarian($kode_dokter, $tanggal);
        }
        $poliMata = new PoliMata();
        return view($this->view . 'cetak.berkas', compact('title', 'dataPasien', 'dokters', 'poliMata'));
    }

    // ----------------------------------------- //

    // --------- REFRAKSI OPTISI --------------- //
    public function refraksi(Request $request)
    {
        $title = $this->prefix . ' ' . 'Mata';
        $tanggal = $request->input('tanggal');
        if ($tanggal == null) {
            $tanggal = date('Y-m-d');
        }
        $kode_dokter = $request->input('kode_dokter');
        $dokters = $this->poliMata->getDokterMata();
        $today = \Carbon\Carbon::today()->toDateString(); // Format to YYYY-MM-DD

        $refraksi = DB::connection('pku')
            ->table('poli_mata_refraksi')
            ->whereDate('created_at', $today) // Adjust the date field as necessary
            ->get();
        // dd($refraksi);
        $pasien = $this->antrean->getDataPasienRajalPoliMata($kode_dokter);
        $pasienKonsul = $this->rajaldokter->getPasienByDokterMataRujukInternal($kode_dokter, $tanggal);
        // dd($pasienKonsul);
        $poliMata = new PoliMata();
        return view($this->view . 'refraksi.index', compact('title', 'pasien', 'dokters', 'poliMata', 'refraksi', 'pasienKonsul'));
    }

    public function refraksiStore(Request $request)
    {
        try {

            // $userEmr = $this->rajal->getUserEmr(auth()->user()->username);
            // dd($userEmr);

            DB::connection('pku')->beginTransaction();

            DB::connection('pku')->table('poli_mata_refraksi')->insert([
                'NO_REG' => $request->input('NO_REG'),
                'VISUS_OD' => $request->input('VISUS_OD'),
                'VISUS_OS' => $request->input('VISUS_OS'),
                'ADD_OD' => $request->input('ADD_OD'),
                'ADD_OS' => $request->input('ADD_OS'),
                'NCT_TOD' => $request->input('NCT_TOD'),
                'NCT_TOS' => $request->input('NCT_TOS'),
                'created_at' => now(),
                'CREATE_REFRAKSI' => auth()->user()->username,
            ]);

            DB::connection('pku')->commit();
            // return redirect('pm/polimata/perawat?kode_dokter=' . $request->input('KODE_DOKTER'))->with('success', 'Data Berhasil Masuk!!');
            return redirect()->back()->with('success', 'Data Berhasil Masuk!!');
        } catch (\Exception $e) {
            //throw $th;
            DB::connection('pku')->rollBack();
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function refraksiUpdate(Request $request, $noReg)
    {
        try {

            // $userEmr = $this->rajal->getUserEmr(auth()->user()->username);
            // dd($userEmr);

            DB::connection('pku')->beginTransaction();

            DB::connection('pku')->table('poli_mata_refraksi')->where('NO_REG', $noReg)->update([
                'VISUS_OD' => $request->input('VISUS_OD'),
                'VISUS_OS' => $request->input('VISUS_OS'),
                'ADD_OD' => $request->input('ADD_OD'),
                'ADD_OS' => $request->input('ADD_OS'),
                'NCT_TOD' => $request->input('NCT_TOD'),
                'NCT_TOS' => $request->input('NCT_TOS'),
                'updated_at' => now(),
                'UPDATE_REFRAKSI' => auth()->user()->username,
            ]);

            DB::connection('pku')->commit();
            return redirect()->back()->with('success', 'Data berhasil diedit!!');
            // return redirect()->route('poliMata.refraksi')->with('success', 'Data Berhasil Masuk!!');
        } catch (\Exception $e) {
            //throw $th;
            DB::connection('pku')->rollBack();
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    // -----------------------------------------

    public function index(Request $request)
    {
        $title = $this->prefix . ' ' . 'Mata';
        $kode_dokter = $request->input('kode_dokter');
        $dokters = $this->poliMata->getDokterMata();
        $pasien = $this->antrean->getDataPasienRajal($kode_dokter);
        // dd($pasien);
        $poliMata = new PoliMata();
        return view($this->view . 'perawat.index', compact('title', 'pasien', 'dokters', 'poliMata'));
    }

    public function Add($noReg)
    {
        $title = $this->prefix . ' ' . 'Mata Assesmen Keperawatan';
        $biodata = $this->rekam_medis->getBiodata($noReg);

        // $masterLab = $this->rajaldokter->getMasterLab();
        // $masterRadiologi = $this->rajaldokter->getMasterRadiologi();

        $masalah_perawatan = $this->rajal->masalah_perawatan();
        $rencana_perawatan = $this->rajal->rencana_perawatan();
        // dd($rencana_perawatan);
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

    public function cetakRM($noReg)
    {
        $resep = $this->rajaldokter->resep($noReg);

        $labs = $this->rajaldokter->lab($noReg);
        $rads = $this->rajaldokter->radiologi($noReg);
        $biodata = $this->rekam_medis->getBiodata($noReg);

        $asasmen_perawat = $this->poliMata->asasmenPerawatGet($noReg);
        // dd($asasmen_perawat);
        $asasmen_dokter = $this->poliMata->asasmenDokter($noReg);

        if ($asasmen_perawat == null && $asasmen_dokter == null) {
            return redirect()->back()->with('warning', 'data rekam medis belum di inputkan di EMR!');
        }

        $gambarMataKiri = $this->poliMata->getGambarMataKiri($noReg);
        $gambarMataKanan = $this->poliMata->getGambarMataKanan($noReg);

        $masalahKeperawatan = $this->rekam_medis->masalahKepByNoreg($noReg);
        $rencanaKeperawatan = $this->rekam_medis->rencanaKepByNoreg($noReg);

        // Cetak PDF
        $date = date('dMY');
        $tanggal = Carbon::now();
        $filename = 'RM -' . $date;

        $title = 'Cetak RM';

        $pdf = PDF::loadview('pages.poli.mata.cetak.rm', ['tanggal' => $tanggal, 'mataKiri' => $gambarMataKiri, 'mataKanan' => $gambarMataKanan, 'title' => $title, 'resep' => $resep, 'labs' => $labs, 'rads' => $rads, 'biodata' => $biodata, 'perawat' => $asasmen_perawat, 'masalahKeperawatan' => $masalahKeperawatan, 'rencanaKeperawatan' => $rencanaKeperawatan, 'dokter' => $asasmen_dokter]);
        $pdf->setPaper('A4');
        return $pdf->stream($filename . '.pdf');
    }

    public function cetakRMKonsul($noReg)
    {
        $resep = $this->rajaldokter->resep($noReg);

        $labs = $this->rajaldokter->lab($noReg);
        $rads = $this->rajaldokter->radiologi($noReg);
        $biodata = $this->rekam_medis->getBiodata($noReg);

        $asasmen_perawat = $this->rekam_medis->cetakRmRajal($noReg);
        $asasmen_dokter = $this->poliMata->asasmenDokter($noReg);
        // dd($asasmen_dokter);

        if ($asasmen_dokter == null) {
            return redirect()->back()->with('warning', 'data rekam medis belum di inputkan di EMR!');
        }

        $gambarMataKiri = $this->poliMata->getGambarMataKiri($noReg);
        $gambarMataKanan = $this->poliMata->getGambarMataKanan($noReg);

        $masalahKeperawatan = $this->rekam_medis->masalahKepByNoreg($noReg);
        $rencanaKeperawatan = $this->rekam_medis->rencanaKepByNoreg($noReg);

        // Cetak PDF
        $date = date('dMY');
        $tanggal = Carbon::now();
        $filename = 'RM -' . $date;

        $title = 'Cetak RM';

        $pdf = PDF::loadview('pages.poli.mata.cetak.rmKonsul', ['tanggal' => $tanggal, 'mataKiri' => $gambarMataKiri, 'mataKanan' => $gambarMataKanan, 'title' => $title, 'resep' => $resep, 'labs' => $labs, 'rads' => $rads, 'biodata' => $biodata, 'perawat' => $asasmen_perawat, 'masalahKeperawatan' => $masalahKeperawatan, 'rencanaKeperawatan' => $rencanaKeperawatan, 'dokter' => $asasmen_dokter]);
        $pdf->setPaper('A4');
        return $pdf->stream($filename . '.pdf');
    }

    public function cetakResume($noReg)
    {
        $resep = $this->rajaldokter->resep($noReg);

        $labs = $this->rajaldokter->lab($noReg);
        $rads = $this->rajaldokter->radiologi($noReg);
        $biodata = $this->rekam_medis->getBiodata($noReg);

        $gambarMataKiri = $this->poliMata->getGambarMataKiri($noReg);
        $gambarMataKanan = $this->poliMata->getGambarMataKanan($noReg);

        $asasmen_perawat = $this->poliMata->asasmenPerawatGet($noReg);
        $asasmen_dokter = $this->poliMata->asasmenDokter($noReg);
        // dd($asasmen_dokter);

        // Cetak PDF
        $date = date('dMY');
        $tanggal = Carbon::now();
        $filename = 'Resume -' . $date;

        $title = 'Cetak RM';

        $pdf = PDF::loadview('pages.poli.mata.cetak.resumeRajal', ['tanggal' => $tanggal, 'title' => $title, 'mataKiri' => $gambarMataKiri, 'mataKanan' => $gambarMataKanan, 'resep' => $resep, 'labs' => $labs, 'rads' => $rads, 'biodata' => $biodata, 'perawat' => $asasmen_perawat, 'dokter' => $asasmen_dokter]);
        $pdf->setPaper('A4');
        return $pdf->stream($filename . '.pdf');
    }

    public function cetakSKDP($noReg, $kode_transaksi)
    {
        $resep = $this->poliMata->cetakResep($noReg, $kode_transaksi);

        $data = DB::connection('pku')
            ->table('TAC_RJ_SKDP as a')
            ->leftJoin('TAC_COM_PARAMETER_SKDP_ALASAN as b', 'a.FS_SKDP_1', '=', 'b.FS_KD_TRS')
            ->leftJoin('TAC_COM_PARAMETER_SKDP_RENCANA as c', 'a.FS_SKDP_2', '=', 'c.FS_KD_TRS')
            ->leftJoin('poli_mata_dokter as poli', 'a.FS_KD_REG', '=', 'poli.NO_REG')
            ->select(
                'a.*',
                'b.FS_NM_SKDP_ALASAN',
                'c.FS_NM_SKDP_RENCANA',
                'poli.DIAGNOSA',
            )
            ->where('a.FS_KD_REG', $noReg)
            ->first();
        // dd($data);
        $biodata = $this->rekam_medis->getBiodata($noReg);

        // Cetak PDF
        $date = date('dMY');
        $tanggal = Carbon::now();
        $filename = 'SKDP -' . $date;

        $title = 'Cetak RM';

        $pdf = PDF::loadview('pages.poli.mata.cetak.cetakSKDP', ['tanggal' => $tanggal, 'title' => $title, 'resep' => $resep, 'data' => $data, 'biodata' => $biodata]);
        $pdf->setPaper('A5');
        return $pdf->stream($filename . '.pdf');
    }

    public function cetakRujukRS($noReg, $kode_transaksi)
    {
        $resep = $this->rekam_medis->cetakResep($noReg, $kode_transaksi);
        // dd($resep);
        // Data Rujukan RS
        $dbpku = DB::connection('db_rsmm')->getDatabaseName();
        $data = DB::connection('pku')
            ->table('TAC_RJ_RUJUKAN as a')
            ->leftJoin('poli_mata_dokter as poli', 'a.FS_KD_REG', '=', 'poli.NO_REG')
            ->leftJoin($dbpku . '.dbo.DOKTER as c', 'a.FS_TUJUAN_RUJUKAN', '=', 'c.KODE_DOKTER')
            ->select(
                'a.*',
                'poli.diagnosa',
                'c.NAMA_DOKTER'
            )
            ->where('a.FS_KD_REG', $noReg)
            ->first();

        // $data = $this->rekam_medis->cetakRujukan($noReg);

        $biodata = $this->rekam_medis->getBiodata($noReg);
        $date = date('dMY');
        $tanggal = Carbon::now();

        $filename = 'Rujukan-' . $date . '-' . $noReg;

        $pdf = PDF::loadview('pages.poli.mata.cetak.rujukanRS', ['data' => $data, 'biodata' => $biodata, 'resep' => $resep, 'tanggal' => $tanggal]);
        // Set paper size to A5
        $pdf->setPaper('A4');
        return $pdf->stream($filename . '.pdf');
    }

    public function cetakRujukanInternal($noReg, $kode_transaksi)
    {
        $resep = $this->rekam_medis->cetakResep($noReg, $kode_transaksi);
        // dd($resep);
        // Data Rujukan Internal
        $dbpku = DB::connection('db_rsmm')->getDatabaseName();
        $data = DB::connection('pku')
            ->table('TAC_RJ_RUJUKAN as a')
            ->leftJoin('poli_mata_dokter as poli', 'a.FS_KD_REG', '=', 'poli.NO_REG')
            ->leftJoin($dbpku . '.dbo.DOKTER as c', 'a.FS_TUJUAN_RUJUKAN', '=', 'c.KODE_DOKTER')
            ->select(
                'a.*',
                'poli.diagnosa',
                'c.NAMA_DOKTER'
            )
            ->where('a.FS_KD_REG', $noReg)
            ->first();

        // Data PRB
        $noPRB = DB::connection('pku')
            ->table('TAC_RJ_MEDIS as a')
            ->select(
                'a.FS_KD_TRS',
            )
            ->where('a.FS_KD_REG', $noReg)
            ->first();

        // $noPRB = $this->rekam_medis->getNoPRB($noReg);
        $biodata = $this->rekam_medis->getBiodata($noReg);
        // dd($biodata);
        $date = date('dMY');
        $tanggal = Carbon::now();

        $filename = 'Rujukan-' . $date . '-' . $noReg;

        $pdf = PDF::loadview('pages.poli.mata.cetak.rujukanInternal', ['data' => $data, 'biodata' => $biodata, 'resep' => $resep, 'tanggal' => $tanggal, 'noPRB' => $noPRB]);
        // Set paper size to A5
        $pdf->setPaper('A4');
        return $pdf->stream($filename . '.pdf');
    }

    public function store(Request $request)
    {
        $request->validate([
            'FS_ANAMNESA' => 'max:255|required',
            'suhu' => 'required',
            'nadi' => 'required',
            'respirasi' => 'required',
            'td' => 'required',
            'FS_CARA_BERJALAN1' => 'required',
            'FS_CARA_BERJALAN2' => 'required',
            'FS_CARA_DUDUK' => 'required',
        ]);

        try {

            $userEmr = $this->rajal->getUserEmr(auth()->user()->username);
            // dd($userEmr);

            DB::connection('pku')->beginTransaction();

            DB::connection('pku')->table('TAC_RJ_STATUS')->insert([
                'FS_KD_REG' => $request->input('NO_REG'),
                'FS_STATUS' => '1',
                'FS_FORM' => '1',
                'FS_JNS_ASESMEN' => 'A',
                'mdb' => $userEmr->user_id,
                'mdd' => now(),
            ]);

            DB::connection('db_rsmm')->table('REGISTER_PASIEN')->where('NO_MR', $request->input('NO_MR'))->update([
                'FS_ALERGI' => $request->input('FS_ALERGI'),
                'FS_REAK_ALERGI' => $request->input('FS_REAK_ALERGI'),
                'FS_RIW_PENYAKIT_DAHULU' => $request->input('FS_RIW_PENYAKIT_DAHULU'),
                'FS_RIW_PENYAKIT_DAHULU2' => $request->input('FS_RIW_PENYAKIT_DAHULU2'),
            ]);

            DB::connection('pku')->table('TAC_ASES_PER2')->insert([
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
                'mdb' => $userEmr->user_id,
                'mdd' => date('Y-m-d'),
            ]);

            DB::connection('pku')->table('TAC_RJ_VITAL_SIGN')->insert([
                'FS_KD_REG' => $request->input('NO_REG'),
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

            DB::connection('pku')->table('TAC_RJ_JATUH')->insert([
                'FS_KD_REG' => $request->input('NO_REG'),
                'FS_CARA_BERJALAN1' => $request->input('FS_CARA_BERJALAN1'),
                'FS_CARA_BERJALAN2' => $request->input('FS_CARA_BERJALAN2'),
                'FS_CARA_DUDUK' => $request->input('FS_CARA_DUDUK'),
                'mdb' => date('Y-m-d'),
                'mdd' => $userEmr->user_id,
            ]);

            DB::connection('pku')->table('poli_mata_asesmen')->insert([
                'NO_REG' => $request->input('NO_REG'),
                // 'RIWAYAT_SEKARANG' => is_array($request->input('RIWAYAT_SEKARANG'))
                //     ? implode(',', $request->input('RIWAYAT_SEKARANG'))
                //     : $request->input('RIWAYAT_SEKARANG'),
                'RIWAYAT_SEKARANG' => $request->input('RIWAYAT_SEKARANG'),
                'KEADAAN_UMUM' => $request->input('KEADAAN_UMUM'),
                'KESADARAN' => $request->input('KESADARAN'),
                'STATUS_MENTAL' => $request->input('STATUS_MENTAL'),
                'LINGKAR_KEPALA' => $request->input('LINGKAR_KEPALA'),
                'STATUS_GIZI' => $request->input('STATUS_GIZI'),
                'CACAT' => $request->input('CACAT'),
                'ADL' => $request->input('ADL'),
                'REFLEK_CAHAYA' => $request->input('REFLEK_CAHAYA'),
                'PUPIL' => $request->input('PUPIL'),
                'LUMPUH' => $request->input('LUMPUH'),
                'PUSING' => $request->input('PUSING'),
                'created_at' => now(),
                'CREATE_BY' => $userEmr->user_id,
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

        $penyakitSekarang = $this->poliMata->getPenyakit();

        $masalah_perGet = $this->rajal->masalahPerawatanGetByNoreg($noReg);
        $rencana_perGet = $this->rajal->rencanaPerawatanGetByNoreg($noReg);
        $biodata = $this->rajal->pasien_bynoreg($noReg);

        $asasmen_perawat = $this->poliMata->asasmenPerawatGet($noReg);
        // dd($asasmen_perawat);
        $riwayat = $this->rajal->riwayatGet($noReg);

        return view($this->view . 'perawat.editKeperawatan', compact('title', 'masalah_perawatan', 'rencana_perawatan', 'penyakitSekarang', 'biodata', 'asasmen_perawat', 'riwayat', 'masalah_perGet', 'rencana_perGet', 'noReg'));
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
        $userEmr = $this->rajal->getUserEmr(auth()->user()->username);

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
            'mdb' => $userEmr->user_id,
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
            'mdb' => $userEmr->user_id,
            'mdd' => date('Y-m-d'),
            'FS_JAM_TRS' => date('H:i:s'),
        ]);

        $asesmen_jauh = DB::connection('pku')->table('TAC_RJ_JATUH')->where('FS_KD_REG', $noReg)->update([
            'FS_CARA_BERJALAN1' => $request->input('FS_CARA_BERJALAN1'),
            'FS_CARA_BERJALAN2' => $request->input('FS_CARA_BERJALAN2'),
            'FS_CARA_DUDUK' => $request->input('FS_CARA_DUDUK'),
            'mdb' => date('Y-m-d'),
            'mdd' => $userEmr->user_id,
        ]);


        DB::connection('pku')->table('poli_mata_asesmen')->where('NO_REG', $noReg)->update([
            // 'RIWAYAT_SEKARANG' => is_array($request->input('RIWAYAT_SEKARANG'))
            //     ? implode(',', $request->input('RIWAYAT_SEKARANG'))
            //     : $request->input('RIWAYAT_SEKARANG'),
            'RIWAYAT_SEKARANG' => $request->input('RIWAYAT_SEKARANG'),
            'KEADAAN_UMUM' => $request->input('KEADAAN_UMUM'),
            'KESADARAN' => $request->input('KESADARAN'),
            'STATUS_MENTAL' => $request->input('STATUS_MENTAL'),
            'LINGKAR_KEPALA' => $request->input('LINGKAR_KEPALA'),
            'STATUS_GIZI' => $request->input('STATUS_GIZI'),
            'CACAT' => $request->input('CACAT'),
            'ADL' => $request->input('ADL'),
            'REFLEK_CAHAYA' => $request->input('REFLEK_CAHAYA'),
            'PUPIL' => $request->input('PUPIL'),
            'LUMPUH' => $request->input('LUMPUH'),
            'PUSING' => $request->input('PUSING'),
            'updated_at' => now(),
            'UPDATE_BY' => $userEmr->user_id,
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


        return redirect('pm/polimata/perawat?kode_dokter=' . $request->input('KODE_DOKTER'))->with('success', 'Edit data berhasil!!');
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
