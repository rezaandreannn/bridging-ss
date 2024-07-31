<?php

namespace App\Http\Controllers\Fisio\Dokter;

use App\Models\Pasien;
use GuzzleHttp\Client;
use App\Models\JenisFisio;
use App\Models\Fisioterapi;
use App\Models\RajalDokter;
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
    protected $rajaldokter;
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
        $this->rajaldokter = new RajalDokter;
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
        $listpasien = $this->fisio->getPasienRehabMedis(auth()->user()->username);
        $fisioterapi = new Fisioterapi();
        $title = $this->prefix . ' ' . 'List Pasien';
        return view($this->view . 'dokter.index', compact('title', 'listpasien', 'fisioterapi'));
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
            if (!$lastKodeTransaksi) {
                $nomorUrut = "000001";
            } else {
                $noTerakhir = (int)substr($lastKodeTransaksi->KODE_TRANSAKSI_FISIO, 2);
                $noTerakhir += 1;
                $nomorUrut = sprintf('%06s', $noTerakhir);
            }
        } else {
            $noTerakhir = (int)substr($lastKodeTransaksiByMr->KODE_TRANSAKSI_FISIO, 2);
            $nomorUrut = sprintf('%06s', $noTerakhir);
        }

        $kode_transaksi_fisio = $kode . '-' . $nomorUrut;

        $jenisterapifisio = DB::connection('pku')->table('TAC_COM_FISIOTERAPI_MASTER')->get();

        $biodatas = $this->pasien->biodataPasienByMr($NoMr);
        $ttv = DB::connection('pku')->table('TAC_RJ_VITAL_SIGN')->where('FS_KD_REG', $biodatas->No_Reg)->first();
        $asesmen_perawat = DB::connection('pku')->table('TAC_ASES_PER2')->where('FS_KD_REG', $biodatas->No_Reg)->first();
        $history = $this->rajaldokter->getHistoryPasien($NoMr);

        // dd($biodatas);
        // die;
        $title = $this->prefix . ' ' . 'Assesmen Dokter';
        return view($this->view . 'dokter.asesmenDokter.createAsesmen', compact('title', 'biodatas', 'jenisterapifisio', 'kode_transaksi_fisio', 'ttv', 'asesmen_perawat', 'history'));
    }

    public function editAsesmen($NoMr)
    {


        $jenisterapifisio = DB::connection('pku')->table('TAC_COM_FISIOTERAPI_MASTER')->get();

        $biodatas = $this->pasien->biodataPasienByMr($NoMr);
        $ttv = DB::connection('pku')->table('TAC_RJ_VITAL_SIGN')->where('FS_KD_REG', $biodatas->No_Reg)->first();
        $asesmenDokterGet = DB::connection('pku')->table('fis_asesmen_dokter')->where('no_registrasi', $biodatas->No_Reg)->first();
        $terapiFisioGet = DB::connection('pku')->table('fis_tr_jenis')->where('no_registrasi', $biodatas->No_Reg)->get();

        $title = $this->prefix . ' ' . 'Edit Assesmen Dokter';
        return view($this->view . 'dokter.asesmenDokter.editAsesmen', compact('title', 'biodatas', 'jenisterapifisio', 'asesmenDokterGet', 'terapiFisioGet'));
    }

    public function createUjiFungsi($NoMr)
    {
        $biodatas = $this->pasien->biodataPasienByMr($NoMr);
        $asesmenDokterGet = DB::connection('pku')->table('fis_asesmen_dokter')->where('no_registrasi', $biodatas->No_Reg)->first();

        $title = $this->prefix . ' ' . 'Lembar Uji Fungsi';
        return view($this->view . 'dokter.lembarUjiFungsi.lembarUjiFungsi', compact('title', 'biodatas', 'asesmenDokterGet'));
    }

    public function editUjiFungsi($NoMr)
    {
        $biodatas = $this->pasien->biodataPasienByMr($NoMr);
        $lembarUjiFungsiGet = DB::connection('pku')->table('fis_lembar_uji_fungsi')->where('no_registrasi', $biodatas->No_Reg)->first();
        // dd($lembarUjiFungsiGet);

        $title = $this->prefix . ' ' . 'Lembar Uji Fungsi';
        return view($this->view . 'dokter.lembarUjiFungsi.editLembarUjiFungsi', compact('title', 'biodatas', 'lembarUjiFungsiGet'));
    }

    public function storeUjiFungsi(Request $request)
    {
        $validatedData = $request->validate([
            'diagnosis_fungsional' => 'required',
        ]);

        try {
            DB::connection('pku')->beginTransaction();

            $lembarUjiFungsi = DB::connection('pku')->table('fis_lembar_uji_fungsi')->insert([
                'no_registrasi' => $request->input('no_registrasi'),
                'kode_transaksi_fisio' => $request->input('kode_transaksi_fisio'),
                'diagnosis_fungsional' => $request->input('diagnosis_fungsional'),
                'prosedur_kfr' => $request->input('prosedur_kfr'),
                'hasil_pemeriksaan' => $request->input('hasil_pemeriksaan'),
                'kesimpulan' => $request->input('kesimpulan'),
                'rekomendasi' => $request->input('rekomendasi'),
                'create_by' => auth()->user()->username,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);


            DB::connection('pku')->commit();

            return redirect('fisioterapi/perawat/transaksi_fisio?no_mr=' . $request->input('no_mr'))->with('success', 'Lembar Uji Fungsi Berhasil Ditambahkan!');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::connection('pku')->rollback();

            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function updateUjiFungsi(Request $request)
    {
        try {
            DB::connection('pku')->beginTransaction();

            $lembarUjiFungsi = DB::connection('pku')->table('fis_lembar_uji_fungsi')->where('no_registrasi', $request->input('no_registrasi'))->update([
                'no_registrasi' => $request->input('no_registrasi'),
                'kode_transaksi_fisio' => $request->input('kode_transaksi_fisio'),
                'diagnosis_fungsional' => $request->input('diagnosis_fungsional'),
                'prosedur_kfr' => $request->input('prosedur_kfr'),
                'hasil_pemeriksaan' => $request->input('hasil_pemeriksaan'),
                'kesimpulan' => $request->input('kesimpulan'),
                'rekomendasi' => $request->input('rekomendasi'),
                'create_by' => auth()->user()->username,
                'updated_at' => date('Y-m-d H:i:s')
            ]);


            DB::connection('pku')->commit();

            return redirect()->route('list_pasiens.dokter')->with('success', 'Lembar Uji Fungsi Berhasil Diperbarui!');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::connection('pku')->rollback();

            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function lembarSpkfr($NoMr)
    {
        $biodatas = $this->pasien->biodataPasienByMr($NoMr);
        $asesmenDokter = DB::connection('pku')->table('fis_asesmen_dokter')->where('no_registrasi', $biodatas->No_Reg)->first();


        $title = $this->prefix . ' ' . 'Lembar SPKFR';
        return view($this->view . 'dokter.lembarSpkfr.lembarSpkfr', compact('title', 'biodatas', 'asesmenDokter'));
    }

    public function storeSpkfr(Request $request)
    {


        $validatedData = $request->validate([
            'pemeriksaan_fisik' => 'required',
        ]);

        try {
            DB::connection('pku')->beginTransaction();


            $spkfr = DB::connection('pku')->table('fis_lembar_spkfr')->insert([
                'no_registrasi' => $request->input('no_registrasi'),
                'kode_transaksi_fisio' => $request->input('kode_transaksi_fisio'),
                'pemeriksaan_fisik' => $request->input('pemeriksaan_fisik'),
                'diagnosis_medis' => $request->input('diagnosis_medis'),
                'diagnosis_fungsi' => $request->input('diagnosis_fungsi'),
                'tata_laksana_kfr' => $request->input('tata_laksana_kfr'),
                'penyakit_akibat_kerja' => $request->input('penyakit_akibat_kerja'),
                'deskripsi_akibat_kerja' => $request->input('deskripsi_akibat_kerja'),
                'create_by' => auth()->user()->username,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            // Commit transaksi
            DB::connection('pku')->commit();

            return redirect()->route('list_pasiens.dokter')->with('success', 'Spkfr Berhasil Ditambahkan!');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::connection('pku')->rollback();

            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function editLembarSpkfr($NoMr)
    {
        $biodatas = $this->pasien->biodataPasienByMr($NoMr);
        $asesmenDokter = DB::connection('pku')->table('fis_asesmen_dokter')->where('no_registrasi', $biodatas->No_Reg)->first();
        $lembarSpkfr = DB::connection('pku')->table('fis_lembar_spkfr')->where('no_registrasi', $biodatas->No_Reg)->first();


        $title = $this->prefix . ' ' . 'Edit Lembar SPKFR';
        return view($this->view . 'dokter.lembarSpkfr.editLembarSpkfr', compact('title', 'biodatas', 'lembarSpkfr', 'asesmenDokter'));
    }

    public function updateSpkfr(Request $request)
    {



        $validatedData = $request->validate([
            'pemeriksaan_fisik' => 'required',
        ]);

        try {
            DB::connection('pku')->beginTransaction();


            $spkfr = DB::connection('pku')->table('fis_lembar_spkfr')->where('no_registrasi', $request->input('no_registrasi'))->update([
                'no_registrasi' => $request->input('no_registrasi'),
                'kode_transaksi_fisio' => $request->input('kode_transaksi_fisio'),
                'pemeriksaan_fisik' => $request->input('pemeriksaan_fisik'),
                'diagnosis_medis' => $request->input('diagnosis_medis'),
                'diagnosis_fungsi' => $request->input('diagnosis_fungsi'),
                'tata_laksana_kfr' => $request->input('tata_laksana_kfr'),
                'penyakit_akibat_kerja' => $request->input('penyakit_akibat_kerja'),
                'deskripsi_akibat_kerja' => $request->input('deskripsi_akibat_kerja'),
                'create_by' => auth()->user()->username,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            // Commit transaksi
            DB::connection('pku')->commit();

            return redirect()->route('list_pasiens.dokter')->with('success', 'Spkfr Berhasil Diperbarui!');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::connection('pku')->rollback();

            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
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
                    $terapi = DB::connection('pku')->table('fis_tr_jenis')->insert([

                        'no_registrasi' => $request->input('no_registrasi'),
                        'kode_tr_fisio' => $request->input('kode_transaksi_fisio'),
                        'id_jenis_fisioterapi' => $value,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),

                    ]);;
                }
            }
            $time = date('H:i:s');
            $asesmen_dokter = DB::connection('pku')->table('fis_asesmen_dokter')->insert([
                'no_registrasi' => $request->input('no_registrasi'),
                'kode_transaksi_fisio' => $request->input('kode_transaksi_fisio'),
                'tanggal' => $request->input('tanggal'),
                'jam' => $request->input('jam'),
                'anamnesa' => $request->input('anamnesa'),
                'tekanan_darah' => $request->input('tekanan_darah'),
                'nadi' => $request->input('nadi'),
                'respirasi' => $request->input('respirasi'),
                'suhu' => $request->input('suhu'),
                'berat_badan' => $request->input('berat_badan'),
                'prothesa' => $request->input('prothesa'),
                'orthosis' => $request->input('orthosis'),
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
                'create_by' => auth()->user()->username,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            // Commit transaksi
            DB::connection('pku')->commit();

            return redirect()->route('add.ujifungsi', ['NoMr' => $request->input('NO_MR')])->with('success', 'Asesmen Berhasil Ditambahkan!');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::connection('pku')->rollback();

            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'anamnesa' => 'required',
        ]);

        try {
            DB::connection('pku')->beginTransaction();

            $jenis_terapi = $request->input('jenis_terapi_fisio');
            if (!empty($jenis_terapi)) {
                $terapiDelete = DB::connection('pku')->table('fis_tr_jenis')->where('no_registrasi', $request->input('no_registrasi'))->delete();
                foreach ($jenis_terapi as $value) {
                    $terapi = DB::connection('pku')->table('fis_tr_jenis')->insert([

                        'no_registrasi' => $request->input('no_registrasi'),
                        'kode_tr_fisio' => $request->input('kode_transaksi_fisio'),
                        'id_jenis_fisioterapi' => $value,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),

                    ]);;
                }
            }

            $asesmen_dokter_update = DB::connection('pku')->table('fis_asesmen_dokter')->where('no_registrasi', $request->input('no_registrasi'))->update([
                'kode_transaksi_fisio' => $request->input('kode_transaksi_fisio'),
                'tanggal' => $request->input('tanggal'),
                'jam' => $request->input('jam'),
                'anamnesa' => $request->input('anamnesa'),
                'tekanan_darah' => $request->input('tekanan_darah'),
                'nadi' => $request->input('nadi'),
                'respirasi' => $request->input('respirasi'),
                'suhu' => $request->input('suhu'),
                'berat_badan' => $request->input('berat_badan'),
                'prothesa' => $request->input('prothesa'),
                'orthosis' => $request->input('orthosis'),
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
                'create_by' => auth()->user()->username,
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            // Commit transaksi
            DB::connection('pku')->commit();

            return redirect()->route('list_pasiens.dokter')->with('success', 'Asesmen Berhasil Diperbarui!');
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
