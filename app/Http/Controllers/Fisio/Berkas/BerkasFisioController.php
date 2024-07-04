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
        $data = $this->berkasFisio->getFisioterapiHistory($no_mr);

        // dd($data);
        return view($this->view . 'index', compact('title', 'data'));
    }

    public function berkas()
    {
        $title = $this->prefix . ' ' . 'Harian';
        // $biodata = $this->rajal->resumeMedisPasienByMR($noMR);
        return view($this->view . 'berkas', compact('title'));
    }

    public function cppt_list($no_mr = "")
    {
        $fisioModel = new Fisioterapi();
        $biodatas = $this->pasien->biodataPasienByMr($no_mr);
        // dd($biodatas);
        // die;
        $transaksis = $this->fisio->transaksiFisioByMr($no_mr);
        $title = $this->prefix . ' ' . 'Form CPPT';
        return view($this->view . 'cppt', compact('title', 'biodatas', 'transaksis', 'fisioModel'));
    }

    public function cetak_rm_dokter($no_reg)
    {
        set_time_limit(300);
        $asesmenDokter = $this->berkasFisio->getAsesmenDokter($no_reg);
        $namaDokter = DB::connection('db_rsmm')->table('DOKTER')->select('Nama_Dokter')->where('Kode_Dokter', $asesmenDokter->create_by)->first();

        $lembarUjiFungsi = $this->berkasFisio->getLembarUjiFungsi($no_reg);
        $lembarSpkfr = $this->berkasFisio->getLembarSpkfr($no_reg);
        $biodata = $this->rajal->pasien_bynoreg($no_reg);
        $ttdPasien = DB::connection('pku')->table('TTD_PASIEN_MASTER')->select('IMAGE')->where('NO_MR_PASIEN', $biodata->NO_MR)->first();

        $usia = Carbon::parse($biodata->TGL_LAHIR)->age;


        // Cetak PDF
        $date = date('dMY');
        $tanggal = Carbon::now();
        $filename = $biodata->NO_MR . '-Fisioterapi-' . $date;

        $title = $this->prefix . ' ' . 'Harian';

        $pdf = PDF::loadview('pages.fisioterapi.berkas.formulir', ['tanggal' => $tanggal, 'title' => $title, 'asesmenDokter' => $asesmenDokter, 'lembarUjiFungsi' => $lembarUjiFungsi, 'lembarSpkfr' => $lembarSpkfr, 'biodata' => $biodata, 'usia' => $usia, 'namaDokter' => $namaDokter, 'ttdPasien' => $ttdPasien]);
        $pdf->setPaper('A4');
        return $pdf->stream($filename . '.pdf');
    }

    public function rujukan()
    {
        // Cetak PDF
        $date = date('dMY');
        $tanggal = Carbon::now();
        $filename = 'Rujukan-' . $date;

        $title = $this->prefix . ' ' . 'Harian';

        $pdf = PDF::loadview('pages.fisioterapi.berkas.rujukan', ['tanggal' => $tanggal, 'title' => $title]);
        $pdf->setPaper('A4');
        return $pdf->stream($filename . '.pdf');
    }

    public function informed()
    {
        // Cetak PDF
        $date = date('dMY');
        $tanggal = Carbon::now();
        $filename = 'Informed-' . $date;

        $title = $this->prefix . ' ' . 'Harian';

        $pdf = PDF::loadview('pages.fisioterapi.berkas.informed', ['tanggal' => $tanggal, 'title' => $title]);
        $pdf->setPaper('A4');
        return $pdf->stream($filename . '.pdf');
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
