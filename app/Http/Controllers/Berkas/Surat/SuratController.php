<?php

namespace App\Http\Controllers\Berkas\Surat;

use Carbon\Carbon;
use App\Models\Rajal;
use App\Models\Surat;
use App\Models\RajalDokter;
use App\Models\Rekam_medis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;

class SuratController extends Controller
{
    protected $view;
    protected $routeIndex;
    protected $prefix;
    protected $poliMata;
    protected $rajaldokter;
    protected $rajal;
    protected $surat;
    protected $rekam_medis;

    public function __construct(Surat $surat)
    {
        $this->rajaldokter = new RajalDokter();
        $this->rekam_medis = new Rekam_medis;
        $this->rajal = new Rajal;
        $this->surat = $surat;
        $this->view = 'pages.surat.';
        $this->prefix = 'Surat';
    }

    public function index(Request $request)
    {
        $title = $this->prefix . ' ' . 'Sakit/SKD';
        $kode_dokter = auth()->user()->username;
        $pasien = $this->rajaldokter->getPasienBySuratPoli(auth()->user()->username);
        // dd($pasien);
        $surat = new Surat();
        // dd($pasien);
        return view($this->view . 'index', compact('title', 'pasien', 'surat'));
    }

    // ------------------ Surat Sakit ------------------------------
    public function addSuratSakit($noReg)
    {
        $title = $this->prefix . ' ' . 'Sakit';
        $biodata = $this->rekam_medis->getBiodata($noReg);
        return view($this->view . 'addSurat', compact('title', 'biodata'));
    }

    public function suratSakitStore(Request $request)
    {
        try {

            DB::connection('pku')->beginTransaction();

            DB::connection('pku')->table('SURAT_SAKIT')->insert([
                'FS_KD_REG' => $request->input('FS_KD_REG'),
                'SEKOLAH' => $request->input('sekolah'),
                'PEKERJAAN' => $request->input('pekerjaan'),
                'TGLMULAI' => $request->input('tglmulai'),
                'JUMLAHHARI' => $request->input('jumlahhari'),
                'mdd' => date('Y-m-d'),
                'mdb' => auth()->user()->username,
            ]);

            DB::connection('pku')->commit();

            return redirect('surat/medis')->with('success', 'Berhasil Ditambahkan!');
        } catch (\Exception $e) {
            //throw $th;
            DB::connection('pku')->rollBack();
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function editSuratSakit($noReg)
    {
        $title = $this->prefix . ' ' . 'Sakit';
        $biodata = $this->rekam_medis->getBiodata($noReg);
        $surat = $this->surat->getSurat($noReg);
        // dd($surat);
        return view($this->view . 'editSurat', compact('title', 'biodata', 'surat', 'noReg'));
    }

    public function updateSuratSakit(Request $request, $noReg)
    {
        try {
            DB::connection('pku')->beginTransaction();

            DB::connection('pku')->table('SURAT_SAKIT')->where('FS_KD_REG', $noReg)->update([
                'SEKOLAH' => $request->input('sekolah'),
                'PEKERJAAN' => $request->input('pekerjaan'),
                'TGLMULAI' => $request->input('tglmulai'),
                'JUMLAHHARI' => $request->input('jumlahhari'),
                'mdd' => date('Y-m-d'),
                'mdb' => auth()->user()->username,
            ]);

            DB::connection('pku')->commit();
            return redirect('surat/medis')->with('success', 'Berhasil Diedit!!');
        } catch (\Exception $e) {
            //throw $th;
            DB::connection('pku')->rollBack();
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function cetakSuratSakit($noReg)
    {
        $surat = $this->surat->getSurat($noReg);
        $biodata = $this->rekam_medis->getBiodata($noReg);
        // dd($biodata);

        // Cetak PDF
        $date = date('dMY');
        $tanggal = Carbon::now();
        $filename = 'SuratSakit -' . $date;

        $title = 'Cetak Surat Sakit';

        $pdf = PDF::loadview('pages.surat.cetakSuratSakit', ['tanggal' => $tanggal, 'title' => $title, 'surat' => $surat, 'biodata' => $biodata]);
        $pdf->setPaper('A5');
        return $pdf->stream($filename . '.pdf');
    }
    // ---------------------------------------------------------------


    // ----------------- Surat Keterangan Dokter ---------------------
    public function addSkd($noReg)
    {
        $title = $this->prefix . ' ' . 'Keterangan Dokter';
        $biodata = $this->rekam_medis->getBiodata($noReg);
        return view($this->view . 'addSkd', compact('title', 'biodata'));
    }

    public function SkdStore(Request $request)
    {
        try {
            $ceknomormax = $this->surat->get_max_nomor_skd();
            $no = $ceknomormax->nomax;
            $nomorsurat = $no + 1;

            DB::connection('pku')->beginTransaction();

            DB::connection('pku')->table('SURAT_KET_DOKTER')->insert([
                'FS_KD_REG' => $request->input('FS_KD_REG'),
                'PEKERJAAN' => $request->input('PEKERJAAN'),
                'FS_BB' => $request->input('FS_BB'),
                'FS_TB' => $request->input('FS_TB'),
                'FS_TD' => $request->input('FS_TD'),
                'BUTA_WARNA' => $request->input('BUTA_WARNA'),
                'KACAMATA' => $request->input('KACAMATA'),
                'TUJUANSURAT' => $request->input('TUJUANSURAT'),
                'NO_SURAT' => $nomorsurat,
                'mdd' => date('Y-m-d'),
                'mdb' => auth()->user()->username,
            ]);

            DB::connection('pku')->commit();

            return redirect('surat/medis')->with('success', 'Berhasil Ditambahkan!');
        } catch (\Exception $e) {
            //throw $th;
            DB::connection('pku')->rollBack();
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function editSkd($noReg)
    {
        $title = $this->prefix . ' ' . 'Sakit';
        $biodata = $this->rekam_medis->getBiodata($noReg);
        $skd = $this->surat->getSkd($noReg);
        // dd($skd);
        return view($this->view . 'editSkd', compact('title', 'biodata', 'skd', 'noReg'));
    }

    public function updateSkd(Request $request, $noReg)
    {
        try {
            DB::connection('pku')->beginTransaction();

            DB::connection('pku')->table('SURAT_KET_DOKTER')->where('FS_KD_REG', $noReg)->update([
                'PEKERJAAN' => $request->input('PEKERJAAN'),
                'FS_BB' => $request->input('FS_BB'),
                'FS_TB' => $request->input('FS_TB'),
                'FS_TD' => $request->input('FS_TD'),
                'BUTA_WARNA' => $request->input('BUTA_WARNA'),
                'KACAMATA' => $request->input('KACAMATA'),
                'TUJUANSURAT' => $request->input('TUJUANSURAT'),
                'mdd' => date('Y-m-d'),
                'mdb' => auth()->user()->username,
            ]);

            DB::connection('pku')->commit();
            return redirect('surat/medis')->with('success', 'Berhasil Diedit!!');
        } catch (\Exception $e) {
            //throw $th;
            DB::connection('pku')->rollBack();
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function cetakSkd($noReg)
    {
        $skd = $this->surat->getSkd($noReg);
        $biodata = $this->rekam_medis->getBiodata($noReg);
        // dd($biodata);

        // Cetak PDF
        $date = date('dMY');
        $tanggal = Carbon::now();
        $filename = 'Skd -' . $date;

        $title = 'Cetak Surat Keterangan Dokter';

        $pdf = PDF::loadview('pages.surat.cetakSkd', ['tanggal' => $tanggal, 'title' => $title, 'skd' => $skd, 'biodata' => $biodata]);
        $pdf->setPaper('A5');
        return $pdf->stream($filename . '.pdf');
    }

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
