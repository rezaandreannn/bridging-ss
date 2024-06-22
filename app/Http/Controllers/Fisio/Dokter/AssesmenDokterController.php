<?php

namespace App\Http\Controllers\Fisio\Dokter;

use App\Models\Pasien;
use GuzzleHttp\Client;
use App\Models\JenisFisio;
use App\Models\Fisioterapi;
use App\Models\TandaTangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AssesmenDokterController extends Controller
{
    protected $view;
    protected $routeIndex;
    protected $prefix;
    protected $fisio;
    protected $pasien;
    protected $jenisFisio;
    protected $ttd;
    protected $httpClient;
    protected $simrsUrlApi;

    public function __construct(Fisioterapi $fisio)
    {

        $this->fisio = $fisio;
        $this->view = 'pages.fisioterapi.';
        $this->routeIndex = 'cppt.fisio';
        $this->prefix = 'Fisioterapi';
        $this->pasien = new Pasien;
        $this->jenisFisio = new JenisFisio;
        $this->ttd = new TandaTangan;

        $this->httpClient = new Client([
            'headers' => [
                'Content-Type' => 'application/json'
            ],
        ]);
        $this->simrsUrlApi = env('SIMRS_BASE_URL');
    }

    public function index()
    {
        //
        $listpasien = $this->fisio->getPasienRehabMedis();

        // dd($listpasien);
        // die;

        $title = $this->prefix . ' ' . 'List Pasien';
        return view($this->view . 'dokter.index', compact('title', 'listpasien'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($NoMr)
    {
        //
        $lastKodeTransaksiByMr = DB::connection('pku')
            ->table('TRANSAKSI_FISIOTERAPI')
            ->where('NO_MR_PASIEN', $NoMr)
            ->orderBy('ID_TRANSAKSI', 'DESC')
            ->limit('1')
            ->first();

        $lastKodeTransaksi = DB::connection('pku')
            ->table('TRANSAKSI_FISIOTERAPI')
            ->orderBy('ID_TRANSAKSI', 'DESC')
            ->limit('1')
            ->first();

        $kode = 'F';
        if (!$lastKodeTransaksiByMr) {
            $noTerakhir = (int)substr($lastKodeTransaksi->KODE_TRANSAKSI_FISIO, 2);
            $noTerakhir += 1;
            $nomorUrut = sprintf('%06s', $noTerakhir);
        } else {
            $noTerakhir = (int)substr($lastKodeTransaksiByMr->KODE_TRANSAKSI_FISIO, 2);
            $nomorUrut = sprintf('%06s', $noTerakhir);
        }

        $kode_transaksi_fisio = $kode . '-' . $nomorUrut;

        $jenisterapifisio = DB::connection('pku')->table('TAC_COM_FISIOTERAPI_MASTER')->get();
        $biodatas = $this->pasien->biodataPasienByMr($NoMr);

        // dd($biodatas);
        // die;
        $title = $this->prefix . ' ' . 'Assesmen Dokter';
        return view($this->view . 'dokter.createAsesmen', compact('title', 'biodatas', 'jenisterapifisio', 'kode_transaksi_fisio'));
    }

    public function createUjiFungsi($NoMr)
    {
        $biodatas = $this->pasien->biodataPasienByMr($NoMr);

        $title = $this->prefix . ' ' . 'Lembar Uji Fungsi';
        return view($this->view . 'dokter.lembarUjiFungsi', compact('title', 'biodatas'));
    }

    public function storeUjiFungsi(Request $request)
    {

        $lembarUjiFungsi = DB::connection('pku')->table('lembar_uji_fungsi_fisioterapi')->insert([
            'diagnosis_fungsional' => $request->input('diagnosis_fungsional'),
            'prosedur_kfr' => $request->input('prosedur_kfr'),
            'hasil_pemeriksaan' => $request->input('hasil_pemeriksaan'),
            'kesimpulan' => $request->input('kesimpulan'),
            'rekomendasi' => $request->input('rekomendasi'),
            'create_by' => auth()->user()->username,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        var_dump('ok');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $validatedData = $request->validate([
            'anamnesa' => 'required',
        ]);

        try {
            DB::connection('pku')->beginTransaction();

            $jenis_terapi = $request->input('jenis_terapi_fisio');
            if (!empty($jenis_terapi)) {
                foreach ($jenis_terapi as $value) {
                    $terapi = DB::connection('pku')->table('tr_jenis_fisioterapi')->insert([

                        'no_registrasi' => $request->input('no_registrasi'),
                        'kode_tr_fisio' => $request->input('kode_transaksi_fisio'),
                        'id_jenis_fisioterapi' => $value,

                    ]);;
                }
            }

            $time = date('H:i:s');
            $asesmen_dokter = DB::connection('pku')->table('asesmen_dokter_fisioterapi')->insert([
                'no_registrasi' => $request->input('no_registrasi'),
                'kode_transaksi_fisio' => $request->input('kode_transaksi_fisio'),
                'tanggal' => $request->input('tanggal'),
                'jam' => $time,
                'cara_datang' => $request->input('cara_datang'),
                'deskripsi_cara_datang' => $request->input('deskripsi_cara_datang'),
                'anamnesa' => $request->input('anamnesa'),
                'keadaan_umum' => $request->input('keadaan_umum'),
                'kesadaran' => $request->input('kesadaran'),
                'tekanan_darah' => $request->input('tekanan_darah'),
                'nadi' => $request->input('nadi'),
                'respirasi' => $request->input('respirasi'),
                'suhu' => $request->input('suhu'),
                'berat_badan' => $request->input('berat_badan'),
                'prothesa' => $request->input('prothesa'),
                'orthosis' => $request->input('orthosis'),
                'status_psikologi' => $request->input('status_psikologi'),
                'status_mental' => $request->input('status_mental'),
                'diagnosa_klinis' => $request->input('diagnosa_klinis'),
                'rencana_tindakan' => $request->input('rencana_tindakan'),
                'jenis_tindakan' => $request->input('jenis_tindakan') ? $request->input('jenis_tindakan') : null,
                'rencana_rujukan' => $request->input('rencana_rujukan'),
                'deskripsi_rujukan' => $request->input('deskripsi_rujukan') ? $request->input('deskripsi_rujukan') : null,
                'rencana_konsul' => $request->input('rencana_konsul'),
                'deskripsi_konsul' => $request->input('deskripsi_konsul') ? $request->input('deskripsi_konsul') : null,
                'anjuran_terapi' => $request->input('anjuran_terapi'),
                'evaluasi_terapi' => $request->input('evaluasi_terapi'),
                'deskripsi_rujukan' => $request->input('deskripsi_rujukan'),
                'create_by' => auth()->user()->username
            ]);

            // Commit transaksi
            DB::connection('pku')->commit();

            return redirect()->route('add.ujifungsi', ['NoMr' => $request->input('NO_MR')]);
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::connection('pku')->rollback();

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
