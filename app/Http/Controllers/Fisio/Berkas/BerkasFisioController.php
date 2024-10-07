<?php

namespace App\Http\Controllers\Fisio\Berkas;

use Carbon\Carbon;
use App\Models\Rajal;
use App\Models\Pasien;
use App\Models\Fisioterapi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\BerkasFisioterapi;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BerkasFisioController extends Controller
{
    protected $view;
    protected $prefix;
    protected $fisio;
    protected $berkasFisio;
    protected $pasien;
    protected $rajal;

    public function __construct(Fisioterapi $fisio)
    {
        $this->fisio = $fisio;
        $this->view = 'pages.fisioterapi.berkas.';
        $this->prefix = 'Fisioterapi Berkas';
        $this->berkasFisio = new BerkasFisioterapi();
        $this->pasien = new Pasien();
        $this->rajal = new Rajal();
    }

    public function  index(Request $request)
    {
        $title = $this->prefix . ' ' . 'Pasien';
        $no_mr = $request->input('no_mr');
        $berkasfisio = new BerkasFisioterapi();
        $pasienSpkfr = $this->berkasFisio->getFisioterapiHistorySpkfr($no_mr);
        $pasienAlkes = $this->berkasFisio->getFisioterapAlkes($no_mr);
        $fisioterapi = $this->berkasFisio->getFisioterapiHistoryFisioterapi($no_mr);

        // dd($pasienAlkes);
        return view($this->view . 'index', compact('title', 'fisioterapi','berkasfisio','pasienSpkfr','pasienAlkes'));
    }

    public function berkas()
    {
        $title = $this->prefix . ' ' . 'Harian';
        // $biodata = $this->rajal->resumeMedisPasienByMR($noMR);
        return view($this->view . 'berkas', compact('title'));
    }

    public function getFisioterapiDetailByDokter($no_reg)
    {
        $cekCpptFisio = $this->berkasFisio->getCpptFisioByNoreg($no_reg);
       
        $fisioterapiDetail = $this->berkasFisio->getFisioterapiByPelayananDokter($cekCpptFisio->ID_TRANSAKSI_FISIO);
        // dd($fisioterapiDetail);
        return view('partials.modal-detail-pasien-fisioterapi', ['fisioterapiDetail' => $fisioterapiDetail]);
    }

    public function cppt_list($no_mr = "", $no_reg)
    {
        // dd('ok');
        $title = $this->prefix . ' ' . 'Form CPPT';
        $fisioModel = new Fisioterapi();
        $biodatas = $this->berkasFisio->biodataPasienByMr($no_mr);
        // dd($biodatas);
        // die;
        $idTransaksiCppt = $this->berkasFisio->getIdTransaksiFisio($no_reg);
        if ($idTransaksiCppt == null) {
            // dd('ok');
            $transaksis = $this->berkasFisio->transaksiFisioByMr($no_mr);
            return view($this->view . 'cppt', compact('title', 'biodatas', 'transaksis', 'fisioModel'))
            ->with('warning', 'Data rekam medis belum di inputkan di EMR!');
        }
        
        // dd($idTransaksiCppt);
        $idTransaksi = $idTransaksiCppt->ID_TRANSAKSI_FISIO;
        $transaksis = $this->berkasFisio->transaksiFisioByMrLast($no_mr,$idTransaksi);
        return view($this->view . 'cppt', compact('title', 'biodatas', 'transaksis', 'fisioModel'));
    }

    public function buktiPelayananOrderAlkes($no_reg)
    {

        // dd('ok');
        // Cetak PDF
        $date = date('dMY');
        $filename = 'Pelayanan-' . $date;

        $title = $this->prefix . ' ' . 'Alat';
        $biodata = $this->rajal->pasien_bynoreg($no_reg);
        $alkes = $this->berkasFisio->cetakBerkasAlkes($no_reg);
        // $biodata = $this->pasien->biodataPasienByMr($no_reg);
        $usia = Carbon::parse($biodata->TGL_LAHIR)->age;
        $ttdPasien = $this->berkasFisio->getTtdPasienByMr($biodata->NO_MR);
        $ttdPasienByNoreg = $this->berkasFisio->getTtdPasienByNoReg($no_reg);

        // dd($ttdPasienByNoreg);

        $pdf = PDF::loadview('pages.fisioterapi.cetak.pelayananAlat', ['title' => $title, 'biodata' => $biodata, 'usia' => $usia, 'alkes'=>$alkes, 'ttdPasien'=>$ttdPasien, 'ttdPasienByNoreg'=>$ttdPasienByNoreg]);
        $pdf->setPaper('A4');
        return $pdf->stream($filename . '.pdf');
    }

    public function cetak_rm_dokter($no_reg)
    {
        set_time_limit(300);
        $asesmenDokter = $this->berkasFisio->getAsesmenDokter($no_reg);
        if($asesmenDokter == null){
            return redirect()->back()->with('warning', 'data rekam medis belum di inputkan di EMR!');
        }
        $namaDokter = DB::connection('db_rsmm')->table('DOKTER')->select('Nama_Dokter')->where('Kode_Dokter', $asesmenDokter->create_by)->first();
        $terapis = $this->berkasFisio->getTerapiDokter($no_reg);

        $lembarUjiFungsi = $this->berkasFisio->getLembarUjiFungsi($no_reg);
        $lembarSpkfr = $this->berkasFisio->getLembarSpkfr($no_reg);
        $biodata = $this->rajal->pasien_bynoreg($no_reg);
        $ttdPasien = $this->berkasFisio->getTtdPasienByMr($biodata->NO_MR);
        // dd($ttdPasien);

        $usia = Carbon::parse($biodata->TGL_LAHIR)->age;


        // Cetak PDF
        $date = date('dMY');
        $tanggal = Carbon::now();
        $filename = $biodata->NO_MR . '-Fisioterapi-' . $date;

        $title = $this->prefix . ' ' . 'Harian';

        $pdf = PDF::loadview('pages.fisioterapi.berkas.formulir', ['tanggal' => $tanggal, 'title' => $title, 'asesmenDokter' => $asesmenDokter, 'lembarUjiFungsi' => $lembarUjiFungsi, 'lembarSpkfr' => $lembarSpkfr, 'biodata' => $biodata, 'usia' => $usia, 'namaDokter' => $namaDokter, 'ttdPasien' => $ttdPasien, 'terapis' => $terapis]);
        $pdf->setPaper('A4');
        return $pdf->stream($filename . '.pdf');
    }

    public function cetak_rujukan(Request $request)
    {
        // Cetak PDF
        $biodata = $this->rajal->pasien_bynoreg($request->no_reg);
        $date = date('dMY');
        $tanggal = Carbon::now();
        $filename = 'SuratRujukan-' . $biodata->NO_MR . '-' . $date;

        $title = $this->prefix . ' ' . 'Harian';
        $usia = Carbon::parse($biodata->TGL_LAHIR)->age;

        $surat_rujukan = $this->fisio->getSuratRujukan($request->no_reg);
        // dd($surat_rujukan);

        $pdf = PDF::loadview('pages.fisioterapi.cetak.rujukan', ['tanggal' => $tanggal, 'title' => $title, 'surat_rujukan' => $surat_rujukan, 'usia' => $usia, 'biodata' => $biodata]);
        $pdf->setPaper('A4');
        return $pdf->stream($filename . '.pdf');
    }

    public function cetak_informed(Request $request)
    {
        // Cetak PDF
        $date = date('dMY');
        $tanggal = Carbon::now();
        $filename = 'Informed-' . $date;

        $title = $this->prefix . ' ' . 'Harian';
        $biodata = $this->rajal->pasien_bynoreg($request->no_reg);
        $usia = Carbon::parse($biodata->TGL_LAHIR)->age;

        $ttdPasien = DB::connection('pku')->table('TTD_PASIEN_MASTER')->select('IMAGE')->where('NO_MR_PASIEN', $biodata->NO_MR)->first();
        $informed_concent = $this->fisio->getInformedConcent($request->no_reg);
        // dd($informed_concent);

        $pdf = PDF::loadview('pages.fisioterapi.cetak.informedConcent', ['tanggal' => $tanggal, 'title' => $title, 'biodata' => $biodata, 'informed_concent' => $informed_concent, 'usia' => $usia, 'ttdPasien' => $ttdPasien]);
        $pdf->setPaper('A4');
        return $pdf->stream($filename . '.pdf');
    }



    public function create()
    {
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
