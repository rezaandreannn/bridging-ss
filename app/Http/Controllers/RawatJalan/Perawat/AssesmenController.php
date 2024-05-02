<?php

namespace App\Http\Controllers\RawatJalan\Perawat;

use App\Models\Rajal;
use App\Models\Antrean;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;

class AssesmenController extends Controller
{
    protected $view;
    protected $rajal;
    protected $routeIndex;
    protected $prefix;
    protected $antrean;
    protected $httpClient;
    protected $simrsUrlApi;

    public function __construct(Rajal $rajal)
    {
        $this->rajal = $rajal;
        $this->view = 'pages.rj.';
        $this->routeIndex = 'rj.index';
        $this->prefix = 'Rawat Jalan';
        $this->antrean = new Antrean();

        $this->httpClient = new Client([
            'headers' => [
                'Content-Type' => 'application/json'
            ],
        ]);
        $this->simrsUrlApi = env('SIMRS_BASE_URL');
    }

    public function index(Request $request)
    {
        $title = $this->prefix . ' ' . 'Index';

        $rajalModel = new Rajal();
        $kode_dokter = $request->input('kode_dokter');
        $dokters = $this->rajal->byKodeDokter();
        $data = $this->antrean->getData($kode_dokter);

        return view($this->view . 'index', compact('title', 'dokters', 'data', 'rajalModel'));
    }

    public function add($noReg)
    {
        $title = $this->prefix . ' ' . 'Add Data';
        $masalah_perawatan = $this->rajal->masalah_perawatan();
        $rencana_perawatan = $this->rajal->rencana_perawatan();
        $rajal = $this->rajal->pasien_bynoreg($noReg);

        return view($this->view . 'add', compact('title', 'masalah_perawatan', 'rencana_perawatan', 'rajal'));
    }

    //Tampilan Report PDF Resume Pasien
    public function resume($noMR)
    {
        $title = $this->prefix . ' ' . 'Resume Pasien';
        $data = $this->rajal->resumeMedisPasienByMR($noMR);
        $pasien = $this->rajal->profilMR($noMR);
        return view($this->view . 'resume', compact('title', 'data', 'pasien'));
    }

    // Cetak PDF Profil Ringkas Medis Rawat Jalan
    public function profilPDF($noMR)
    {
        $data = $this->rajal->resumeMedisPasienByMR($noMR);
        $pasien = $this->rajal->profilMR($noMR);

        $date = date('dMY');
        $filename = 'resumeMedis-' . $date . '-' . $noMR;

        $pdf = PDF::loadview('pages.rj.profil', ['data' => $data, 'pasien' => $pasien]);
        return $pdf->download($filename . '.pdf');
    }

    public function editSKDP($noReg)
    {
        $title = $this->prefix . ' ' . 'Edit SKDP';
        $rajal = $this->rajal->pasien_bynoreg($noReg);

        return view($this->view . 'editSKDP', compact('title', 'rajal'));
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
        // Make a POST request to the API endpoint

        $response = $this->httpClient->post('http://192.168.40.166:8080/api.simrs/rawatjalan/perawat/asasmen_perawat', [
            'json' => [
                'FS_ANAMNESA' => $request->input('FS_ANAMNESA'),
                'FS_EDUKASI' => $request->input('FS_EDUKASI'),
                'FS_SUHU' => $request->input('FS_SUHU'),
                'FS_NADI' => $request->input('FS_NADI'),
                'FS_R' => $request->input('FS_R'),
                'FS_TD' => $request->input('FS_TD'),
                'FS_TB' => $request->input('FS_TB'),
                'FS_BB' => $request->input('FS_BB'),
                'FS_NYERIP' => $request->input('FS_NYERIP'),
                'FS_NYERIQ' => $request->input('FS_NYERIQ'),
                'FS_NYERIR' => $request->input('FS_NYERIR'),
                'FS_NYERIS' => $request->input('FS_NYERIS'),
                'FS_NYERIT' => $request->input('FS_NYERIT'),
                'FS_NYERI' => $request->input('FS_NYERI'),
                'FS_CARA_BERJALAN1' => $request->input('FS_CARA_BERJALAN1'),
                'FS_CARA_BERJALAN2' => $request->input('FS_CARA_BERJALAN2'),
                'FS_CARA_DUDUK' => $request->input('FS_CARA_DUDUK'),
                'intervensi1' => $request->input('intervensi1') ? 'Ya' : 'Tidak',
                'intervensi2' => $request->input('intervensi2') ? 'Ya' : 'Tidak',
                'FS_RIW_PENYAKIT_DAHULU' => $request->input('FS_RIW_PENYAKIT_DAHULU'),
                'FS_RIW_PENYAKIT_DAHULU2' => $request->input('FS_RIW_PENYAKIT_DAHULU2'),
                'FS_ALERGI' => $request->input('FS_ALERGI'),
                'FS_REAK_ALERGI' => $request->input('FS_REAK_ALERGI'),
                'FS_STATUS_PSIK' => $request->input('FS_STATUS_PSIK'),
                'FS_STATUS_PSIK2' => $request->input('FS_STATUS_PSIK2'),
                'FS_HUB_KELUARGA' => $request->input('FS_HUB_KELUARGA'),
                'FS_ST_FUNGSIONAL' => $request->input('FS_ST_FUNGSIONAL'),
                'FS_PENGELIHATAN' => $request->input('FS_PENGELIHATAN'),
                'FS_PENCIUMAN' => $request->input('FS_PENCIUMAN'),
                'FS_PENDENGARAN' => $request->input('FS_PENDENGARAN'),
                'FS_NUTRISI1' => $request->input('FS_NUTRISI1'),
                'FS_NUTRISI2' => $request->input('FS_NUTRISI2'),
                'FS_AGAMA' => $request->input('FS_AGAMA'),
                'FS_NILAI_KHUSUS' => $request->input('FS_NILAI_KHUSUS'),
                'FS_SKDP_FASKES' => $request->input('FS_SKDP_FASKES'),
                'FS_KD_MEDIS' => $request->input('FS_KD_MEDIS'),
                'mdd_jatuh' => $request->input('mdd_jatuh'),
                'mdb_jatuh' => $request->input('mdb_jatuh'),
                'mdb' => $request->input('mdb'),
                'mdd' => $request->input('mdd'),
                'FS_KD_MASALAH_KEP' => $request->input('FS_KD_MASALAH_KEP'),
                'FS_KD_REN_KEP' => $request->input('FS_KD_REN_KEP'),
            ]
        ]);
        $responseData = $response->getBody()->getContents();

        dd($responseData);

        return redirect()->back()->with('success', 'Data Pasien Added successfully!');
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
        $title = $this->prefix . ' ' . 'Edit Data';
        $masalah_perawatan = $this->rajal->masalah_perawatan();
        $rencana_perawatan = $this->rajal->rencana_perawatan();
        $rajal = $this->rajal->pasien_bynoreg($noReg);

        return view($this->view . 'edit', compact('title', 'masalah_perawatan', 'rencana_perawatan', 'rajal'));
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
