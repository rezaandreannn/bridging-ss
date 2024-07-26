<?php

namespace App\Http\Controllers\Fisio;

use Carbon\Carbon;
use App\Models\Rajal;
use App\Models\Pasien;
use App\Models\Fisioterapi;
use App\Models\Rekam_medis;
use Illuminate\Http\Request;
use App\Models\BerkasFisioterapi;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;

class InformedConcentController extends Controller
{
    protected $view;
    protected $prefix;
    protected $fisio;
    protected $berkasFisio;
    protected $pasien;
    protected $rajal;
    protected $rekam_medis;

    public function __construct(Fisioterapi $fisio)
    {
        $this->fisio = $fisio;
        $this->view = 'pages.fisioterapi.informed_concent.';
        $this->prefix = 'Informed Concent Fisioterapi';
        $this->berkasFisio = new BerkasFisioterapi();
        $this->pasien = new Pasien();
        $this->rajal = new Rajal();
        $this->rekam_medis = new Rekam_medis();
    }

    public function index()
    {
        //
        $listpasien = $this->fisio->pasienCpptdanFisioterapiList();


        $fisioModel = new Fisioterapi();

        $title = $this->prefix . ' ' . 'Index';
        return view($this->view . 'index', compact('title', 'listpasien', 'fisioModel'));
    }

    public function create_rujukan(Request $request)
    {
        //
        $title = 'Surat Rujukan Fisioterapi Index';
        $noreg = $request->input('no_reg');
        // $biodata = $this->rajal->resumeMedisPasienByMR($noMR);
        return view('pages.fisioterapi.surat_rujukan.add', compact('title', 'noreg'));
    }

    public function store_rujukan(Request $request)
    {
        //
        $kode_dokter = DB::connection('db_rsmm')->table('pendaftaran')->select('Kode_Dokter')->where('No_Reg', $request->input('kode_registrasi'))->first();


        $data = DB::connection('pku')->table('fis_surat_rujukan')->insert([

            'kode_registrasi' => $request->input('kode_registrasi'),
            'tujuan_rujukan' => $request->input('tujuan_rujukan'),
            'alamat_rujukan' => $request->input('alamat_rujukan'),
            'lama_perawatan' => $request->input('lama_perawatan'),
            'anamnesa' => $request->input('anamnesa'),
            'pemeriksaan_fisik' => $request->input('pemeriksaan_fisik'),
            'hasil_pemeriksaan_penunjang' => $request->input('hasil_pemeriksaan_penunjang'),
            'diagnosa' => $request->input('diagnosa'),
            'terapi_yang_diberikan' => $request->input('terapi_yang_diberikan'),
            'alasan_rujuk' => $request->input('alasan_rujuk'),
            'nohp_tujuan' => $request->input('nohp_tujuan'),
            'dokter_rujuk' => $kode_dokter->Kode_Dokter,
            'create_by' => auth()->user()->id,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        // dd($data);
        return redirect()->route('informed_concent.index')->with('success', 'Informed Concent Berhasil Ditambahkan!');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function cetakPersetujuan($noReg)
    {
        $biodata = $this->rekam_medis->getBiodata($noReg);
        $date = date('dMY');
        $tanggal = Carbon::now();

        $filename = 'Persetujuan-' . $date . '-' . $noReg;
        $pdf = PDF::loadview('pages.fisioterapi.cetak.lembarPersetujuan', ['biodata' => $biodata, 'tanggal' => $tanggal]);
        // Set paper size to A5
        $pdf->setPaper('F4');
        return $pdf->stream($filename . '.pdf');
    }

    public function create(Request $request)
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

        $informed_concent = DB::connection('pku')->table('INFORMED_CONCENT_FISIOTERAPI')->insert([
            'KODE_REGISTER' => $request->input('KODE_REGISTER'),
            'CREATE_AT' => date('Y-m-d'),
            'CREATE_BY' => auth()->user()->id,
            'IDENTIFIKASI' => $request->input('IDENTIFIKASI'),
            'RUANGAN' => $request->input('RUANGAN'),
            'JAM' => date('G:i:s')
        ]);

        if ($informed_concent) {
            return redirect()->route('informed_concent.index')->with('success', 'Informed Concent Berhasil Ditambahkan!');
        } else {
            return redirect()->route('informed_concent.index')->with('danger', 'Informed Concent Gagal Ditambahkan!');
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
