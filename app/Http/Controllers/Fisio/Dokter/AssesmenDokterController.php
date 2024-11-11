<?php

namespace App\Http\Controllers\Fisio\Dokter;

use App\Models\Rajal;
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
    protected $rajal;
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
        $this->rajal = new Rajal;

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
        // dd($listpasien);
        $fisioterapi = new Fisioterapi();
        $title = $this->prefix . ' ' . 'List Pasien';
        return view($this->view . 'dokter.index', compact('title', 'listpasien', 'fisioterapi'));
    }

    public function riwayat_pemeriksaan_fisio(Request $request)
    {
        //
        $tanggal = date('Y-m-d');
        if ($request->input('tanggal') != null) {
            $tanggal = $request->input('tanggal');
        }
        $kode_dokter = auth()->user()->username;

        $listpasien = $this->fisio->getPasienRehabMedisByTgl($kode_dokter, $tanggal);
        // dd($listpasien);
        $fisioterapi = new Fisioterapi();
        $title = $this->prefix . ' ' . 'List riwayat pasien by tanggal';
        return view($this->view . 'dokter.riwayatPemeriksaanByTgl.index', compact('title', 'listpasien', 'fisioterapi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create($NoMr)
    // {
    //     //

    //     $lastKodeTransaksiByMr = DB::connection('pku')
    //         ->table('TRANSAKSI_FISIOTERAPI')
    //         ->where('NO_MR_PASIEN', $NoMr)
    //         ->orderBy('ID_TRANSAKSI', 'DESC')
    //         ->limit('1')
    //         ->first();

    //     $lastKodeTransaksi = DB::connection('pku')
    //         ->table('TRANSAKSI_FISIOTERAPI')
    //         ->orderBy('ID_TRANSAKSI', 'DESC')
    //         ->limit('1')
    //         ->first();

    //     $kode = 'F';
    //     if (!$lastKodeTransaksiByMr) {
    //         if (!$lastKodeTransaksi) {
    //             $nomorUrut = "000001";
    //         } else {
    //             $noTerakhir = (int)substr($lastKodeTransaksi->KODE_TRANSAKSI_FISIO, 2);
    //             $noTerakhir += 1;
    //             $nomorUrut = sprintf('%06s', $noTerakhir);
    //         }
    //     } else {
    //         $noTerakhir = (int)substr($lastKodeTransaksiByMr->KODE_TRANSAKSI_FISIO, 2);
    //         $nomorUrut = sprintf('%06s', $noTerakhir);
    //     }

    //     $kode_transaksi_fisio = $kode . '-' . $nomorUrut;

    //     $jenisterapifisio = DB::connection('pku')->table('TAC_COM_FISIOTERAPI_MASTER')->get();

    //     $biodatas = $this->pasien->biodataPasienByMr($NoMr);
    //     $ttv = DB::connection('pku')->table('TAC_RJ_VITAL_SIGN')->where('FS_KD_REG', $biodatas->No_Reg)->first();
    //     $asesmen_perawat = DB::connection('pku')->table('TAC_ASES_PER2')->where('FS_KD_REG', $biodatas->No_Reg)->first();
    //     $history = $this->rajaldokter->getHistoryPasien($NoMr);
    //     $diagnosisMedis = $this->fisio->getDiagnosisMedis();

    //     // dd($biodatas);
    //     // die;
    //     $title = $this->prefix . ' ' . 'Assesmen Dokter';
    //     return view($this->view . 'dokter.asesmenDokter.createAsesmen', compact('title', 'biodatas', 'jenisterapifisio', 'kode_transaksi_fisio', 'ttv', 'asesmen_perawat', 'history','diagnosisMedis'));
    // }



    public function create_new($NoMr, $noReg)
    {
        //

        // $lastKodeTransaksiByMr = DB::connection('pku')
        //     ->table('TRANSAKSI_FISIOTERAPI')
        //     ->where('NO_MR_PASIEN', $NoMr)
        //     ->orderBy('ID_TRANSAKSI', 'DESC')
        //     ->limit('1')
        //     ->first();

        // $lastKodeTransaksi = DB::connection('pku')
        //     ->table('TRANSAKSI_FISIOTERAPI')
        //     ->orderBy('ID_TRANSAKSI', 'DESC')
        //     ->limit('1')
        //     ->first();

        // $kode = 'F';
        // if (!$lastKodeTransaksiByMr) {
        //     if (!$lastKodeTransaksi) {
        //         $nomorUrut = "000001";
        //     } else {
        //         $noTerakhir = (int)substr($lastKodeTransaksi->KODE_TRANSAKSI_FISIO, 2);
        //         $noTerakhir += 1;
        //         $nomorUrut = sprintf('%06s', $noTerakhir);
        //     }
        // } else {
        //     $noTerakhir = (int)substr($lastKodeTransaksiByMr->KODE_TRANSAKSI_FISIO, 2);
        //     $nomorUrut = sprintf('%06s', $noTerakhir);
        // }

        // $kode_transaksi_fisio = $kode . '-' . $nomorUrut;

        $jenisterapifisio = DB::connection('pku')->table('TAC_COM_FISIOTERAPI_MASTER')->get();

        // $biodatas = $this->pasien->biodataPasienByMr($NoMr);
        $biodatas = $this->rajal->pasien_bynoreg($noReg);
        // dd($biodatas);
        $ttv = DB::connection('pku')->table('TAC_RJ_VITAL_SIGN')->where('FS_KD_REG', $biodatas->NO_REG)->first();
        $asesmen_perawat = DB::connection('pku')->table('TAC_ASES_PER2')->where('FS_KD_REG', $biodatas->NO_REG)->first();
        $history = $this->rajaldokter->getHistoryPasienFisio($NoMr);
        // dd($history);
        $diagnosisMedis = $this->fisio->getDiagnosisMedis();

        $cekAsesmenFisio = new Fisioterapi();

        // dd($biodatas);
        // die;
        $title = $this->prefix . ' ' . 'Assesmen Dokter';
        return view($this->view . 'dokter.asesmenDokter.createAsesmenNew', compact('title', 'biodatas', 'jenisterapifisio', 'ttv', 'asesmen_perawat', 'history', 'diagnosisMedis', 'cekAsesmenFisio'));
    }

    public function copy_riwayat($noMr, $noRegBaru, $noRegLama)
    {

        $jenisterapifisio = DB::connection('pku')->table('TAC_COM_FISIOTERAPI_MASTER')->get();

        // $biodatas = $this->pasien->biodataPasienByMr($NoMr);
        $biodatas = $this->rajal->pasien_bynoreg($noRegBaru);

        $biodataLama = $this->rajal->pasien_bynoreg($noRegLama);
        // dd($biodatas);
        $ttv = DB::connection('pku')->table('TAC_RJ_VITAL_SIGN')->where('FS_KD_REG', $biodatas->NO_REG)->first();
        $asesmen_perawat = DB::connection('pku')->table('TAC_ASES_PER2')->where('FS_KD_REG', $biodatas->NO_REG)->first();
        $asesmenDokterGet = DB::connection('pku')->table('fis_asesmen_dokter')->where('no_registrasi', $noRegLama)->first();
        $lembarUjiFungsiGet = DB::connection('pku')->table('fis_lembar_uji_fungsi')->where('no_registrasi', $noRegLama)->first();
        $lembarSpkfr = DB::connection('pku')->table('fis_lembar_spkfr')->where('no_registrasi', $noRegLama)->first();
        // dd($asesmenDokterGet);
        $title = $this->prefix . ' ' . 'Assesmen Dokter';
        return view($this->view . 'dokter.asesmenDokter.copyRiwayatAsesmen', compact('title', 'biodatas', 'jenisterapifisio', 'ttv', 'asesmen_perawat', 'asesmenDokterGet', 'lembarUjiFungsiGet', 'lembarSpkfr', 'biodataLama'));;
    }

    public function editAsesmen($NoMr, $noReg)
    {


        $jenisterapifisio = DB::connection('pku')->table('TAC_COM_FISIOTERAPI_MASTER')->get();

        $biodatas = $this->rajal->pasien_bynoreg($noReg);
        $ttv = DB::connection('pku')->table('TAC_RJ_VITAL_SIGN')->where('FS_KD_REG', $biodatas->NO_REG)->first();
        $asesmenDokterGet = DB::connection('pku')->table('fis_asesmen_dokter')->where('no_registrasi', $biodatas->NO_REG)->first();
        // dd($asesmenDokterGet);
        $terapiFisioGet = DB::connection('pku')->table('fis_tr_jenis')->where('no_registrasi', $biodatas->NO_REG)->get();
        // $diagnosisKlinis = $this->fisio->getDiagnosisKlinis();
        $diagnosisMedis = $this->fisio->getDiagnosisMedis();
        $lembarUjiFungsiGet = DB::connection('pku')->table('fis_lembar_uji_fungsi')->where('no_registrasi', $biodatas->NO_REG)->first();
        $lembarSpkfr = DB::connection('pku')->table('fis_lembar_spkfr')->where('no_registrasi', $biodatas->NO_REG)->first();


        $title = $this->prefix . ' ' . 'Edit Assesmen Dokter';
        return view($this->view . 'dokter.asesmenDokter.editAsesmen', compact('title', 'biodatas', 'jenisterapifisio', 'asesmenDokterGet', 'terapiFisioGet', 'diagnosisMedis', 'lembarUjiFungsiGet', 'lembarSpkfr'));
    }

    public function editRiwayatAsesmen($NoMr, $noReg)
    {
        $jenisterapifisio = DB::connection('pku')->table('TAC_COM_FISIOTERAPI_MASTER')->get();
        $biodatas = $this->rajal->pasien_bynoreg($noReg);
        $ttv = DB::connection('pku')->table('TAC_RJ_VITAL_SIGN')->where('FS_KD_REG', $biodatas->NO_REG)->first();
        $asesmenDokterGet = DB::connection('pku')->table('fis_asesmen_dokter')->where('no_registrasi', $biodatas->NO_REG)->first();
        // dd($asesmenDokterGet);
        $terapiFisioGet = DB::connection('pku')->table('fis_tr_jenis')->where('no_registrasi', $biodatas->NO_REG)->get();
        // $diagnosisKlinis = $this->fisio->getDiagnosisKlinis();
        $diagnosisMedis = $this->fisio->getDiagnosisMedis();
        $lembarUjiFungsiGet = DB::connection('pku')->table('fis_lembar_uji_fungsi')->where('no_registrasi', $biodatas->NO_REG)->first();
        $lembarSpkfr = DB::connection('pku')->table('fis_lembar_spkfr')->where('no_registrasi', $biodatas->NO_REG)->first();


        $title = $this->prefix . ' ' . 'Edit Riwayat Assesmen Dokter';
        return view($this->view . 'dokter.riwayatPemeriksaanByTgl.editRiwayatAsesmen', compact('title', 'biodatas', 'jenisterapifisio', 'asesmenDokterGet', 'terapiFisioGet', 'diagnosisMedis', 'lembarUjiFungsiGet', 'lembarSpkfr'));
    }

   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   

    public function store_new(Request $request)
    {

        // dd('ok');

        $validatedData = $request->validate([
            'anamnesa' => 'required',
            'diagnosa_klinis' => 'required',
            'tekanan_darah' => 'required',
            'nadi' => 'required',
            'respirasi' => 'required',
            'suhu' => 'required',
            'berat_badan' => 'required',
            'jenis_terapi_fisio' => 'required',

        ]);

        try {
            DB::connection('pku')->beginTransaction();

            if ($request->input('orthosis') != null) {
                // dd($request->input('orthosis'));
                $order_alkes = DB::connection('pku')->table('fis_order_alkes')->insert([
                    'no_registrasi' => $request->input('no_registrasi'),
                    'jenis_alat' => $request->input('orthosis'),
                    'jenis_rawat' => 'Rawat Jalan',
                    'ruangan_rawat' => 'SPESIALIS REHABILITASI MEDIK',
                    'tanggal_masuk' => $request->input('tanggal'),
                    'tanggal_pulang' => $request->input('tanggal'),
                    'create_by' => auth()->user()->username,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);

                // dd('ok');
            }


            $time = date('H:i:s');
            $asesmen_dokter = DB::connection('pku')->table('fis_asesmen_dokter')->insert([
                'no_registrasi' => $request->input('no_registrasi'),
                'kode_transaksi_fisio' => '',
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
                'terapi' => $request->input('jenis_terapi_fisio'),
                'rencana_tindakan' => 'Ya',
                'jenis_tindakan' =>  null,
                'rencana_rujukan' => $request->input('rencana_rujukan'),
                'deskripsi_rujukan' => $request->input('deskripsi_rujukan') ? $request->input('deskripsi_rujukan') : null,
                'rencana_konsul' => 'Ya',
                'deskripsi_konsul' => '',
                'anjuran_terapi' => $request->input('anjuran_terapi'),
                'evaluasi_terapi' => $request->input('evaluasi_terapi'),
                'deskripsi_rujukan' => $request->input('deskripsi_rujukan'),
                'create_by' => auth()->user()->username,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            $lembarUjiFungsi = DB::connection('pku')->table('fis_lembar_uji_fungsi')->insert([
                'no_registrasi' => $request->input('no_registrasi'),
                'kode_transaksi_fisio' => '',
                'diagnosis_fungsional' => $request->input('diagnosa_klinis'),
                'prosedur_kfr' => $request->input('prosedur_kfr'),
                'kesimpulan' => $request->input('kesimpulan'),
                'rekomendasi' => $request->input('rekomendasi'),
                'edukasi' => $request->input('edukasi'),
                'create_by' => auth()->user()->username,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            $spkfr = DB::connection('pku')->table('fis_lembar_spkfr')->insert([
                'no_registrasi' => $request->input('no_registrasi'),
                'kode_transaksi_fisio' => '',
                'pemeriksaan_fisik' => $request->input('prosedur_kfr'),
                'diagnosis_medis' => $request->input('diagnosa_klinis'),
                'diagnosis_fungsi' => $request->input('kesimpulan'),
                'tata_laksana_kfr' => $request->input('jenis_terapi_fisio'),
                'penyakit_akibat_kerja' => $request->input('penyakit_akibat_kerja'),
                'deskripsi_akibat_kerja' => $request->input('deskripsi_akibat_kerja'),
                'create_by' => auth()->user()->username,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            // Commit transaksi
            DB::connection('pku')->commit();

            // return redirect()->route('add.ujifungsi', ['NoMr' => $request->input('NO_MR')])->with('success', 'Asesmen Berhasil Ditambahkan!');
            return redirect('fisioterapi/perawat/transaksi_fisio?no_mr=' . $request->input('NO_MR'))->with('success', 'Asesmen Berhasil Ditambahkan!');
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
            'diagnosa_klinis' => 'required',
            'tekanan_darah' => 'required',
            'nadi' => 'required',
            'respirasi' => 'required',
            'suhu' => 'required',
            'berat_badan' => 'required',

        ]);

        try {
            DB::connection('pku')->beginTransaction();

            // $jenis_terapi = $request->input('jenis_terapi_fisio');
            // if (!empty($jenis_terapi)) {
            //     $terapiDelete = DB::connection('pku')->table('fis_tr_jenis')->where('no_registrasi', $request->input('no_registrasi'))->delete();
            //     foreach ($jenis_terapi as $value) {
            //         $terapi = DB::connection('pku')->table('fis_tr_jenis')->insert([

            //             'no_registrasi' => $request->input('no_registrasi'),
            //             'kode_tr_fisio' => $request->input('kode_transaksi_fisio'),
            //             'id_jenis_fisioterapi' => $value,
            //             'created_at' => date('Y-m-d H:i:s'),
            //             'updated_at' => date('Y-m-d H:i:s'),

            //         ]);;
            //     }
            // }

            if ($request->input('orthosis') != null) {
                // dd($request->input('orthosis'));
                $cek_alat = $this->rajal->cek_order_alkes($request->input('no_registrasi'));
                if ($cek_alat == true) {
                    $order_alkes = DB::connection('pku')->table('fis_order_alkes')->where('no_registrasi', $request->input('no_registrasi'))->update([
                        'no_registrasi' => $request->input('no_registrasi'),
                        'jenis_alat' => $request->input('orthosis'),
                        'jenis_rawat' => 'Rawat Jalan',
                        'ruangan_rawat' => 'SPESIALIS REHABILITASI MEDIK',
                        'tanggal_masuk' => $request->input('tanggal'),
                        'tanggal_pulang' => $request->input('tanggal'),
                        'create_by' => auth()->user()->username,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
                } else {
                    $order_alkes = DB::connection('pku')->table('fis_order_alkes')->insert([
                        'no_registrasi' => $request->input('no_registrasi'),
                        'jenis_alat' => $request->input('orthosis'),
                        'jenis_rawat' => 'Rawat Jalan',
                        'ruangan_rawat' => 'SPESIALIS REHABILITASI MEDIK',
                        'tanggal_masuk' => $request->input('tanggal'),
                        'tanggal_pulang' => $request->input('tanggal'),
                        'create_by' => auth()->user()->username,
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
                }


                // dd('ok');
            } else {
                $data = DB::connection('pku')->table('fis_order_alkes')->where('no_registrasi', $request->input('no_registrasi'))->delete();
            }

            $asesmen_dokter_update = DB::connection('pku')->table('fis_asesmen_dokter')->where('no_registrasi', $request->input('no_registrasi'))->update([
                'kode_transaksi_fisio' => '',
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
                'terapi' => $request->input('jenis_terapi_fisio'),
                'rencana_rujukan' => $request->input('rencana_rujukan'),
                'deskripsi_rujukan' => $request->input('deskripsi_rujukan') ? $request->input('deskripsi_rujukan') : null,
                'rencana_konsul' => 'Ya',
                'deskripsi_konsul' => '',
                'anjuran_terapi' => $request->input('anjuran_terapi'),
                'evaluasi_terapi' => $request->input('evaluasi_terapi'),
                'deskripsi_rujukan' => $request->input('deskripsi_rujukan'),
                'create_by' => auth()->user()->username,
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            $lembarUjiFungsi = DB::connection('pku')->table('fis_lembar_uji_fungsi')->where('no_registrasi', $request->input('no_registrasi'))->update([

                'kode_transaksi_fisio' => '',
                'diagnosis_fungsional' => $request->input('diagnosa_klinis'),
                'prosedur_kfr' => $request->input('prosedur_kfr'),
                'kesimpulan' => $request->input('kesimpulan'),
                'rekomendasi' => $request->input('rekomendasi'),
                'edukasi' => $request->input('edukasi'),
                'create_by' => auth()->user()->username,

                'updated_at' => date('Y-m-d H:i:s')
            ]);

            $spkfr = DB::connection('pku')->table('fis_lembar_spkfr')->where('no_registrasi', $request->input('no_registrasi'))->update([

                'kode_transaksi_fisio' => '',
                'pemeriksaan_fisik' => $request->input('prosedur_kfr'),
                'diagnosis_medis' => $request->input('diagnosa_klinis'),
                'diagnosis_fungsi' => $request->input('kesimpulan'),
                'tata_laksana_kfr' => $request->input('jenis_terapi_fisio'),
                'penyakit_akibat_kerja' => $request->input('penyakit_akibat_kerja'),
                'deskripsi_akibat_kerja' => $request->input('deskripsi_akibat_kerja'),
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

    public function riwayatFisioupdate(Request $request)
    {

        // dd('edit ok');
        $validatedData = $request->validate([
            'anamnesa' => 'required',
            'diagnosa_klinis' => 'required',
            'tekanan_darah' => 'required',
            'nadi' => 'required',
            'respirasi' => 'required',
            'suhu' => 'required',
            'berat_badan' => 'required',

        ]);

        try {
            DB::connection('pku')->beginTransaction();


            if ($request->input('orthosis') != null) {
                // dd($request->input('orthosis'));
                $cek_alat = $this->rajal->cek_order_alkes($request->input('no_registrasi'));
                if ($cek_alat == true) {
                    $order_alkes = DB::connection('pku')->table('fis_order_alkes')->where('no_registrasi', $request->input('no_registrasi'))->update([
                        'no_registrasi' => $request->input('no_registrasi'),
                        'jenis_alat' => $request->input('orthosis'),
                        'jenis_rawat' => 'Rawat Jalan',
                        'ruangan_rawat' => 'SPESIALIS REHABILITASI MEDIK',
                        'tanggal_masuk' => $request->input('tanggal'),
                        'tanggal_pulang' => $request->input('tanggal'),
                        'create_by' => auth()->user()->username,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
                } else {
                    $order_alkes = DB::connection('pku')->table('fis_order_alkes')->insert([
                        'no_registrasi' => $request->input('no_registrasi'),
                        'jenis_alat' => $request->input('orthosis'),
                        'jenis_rawat' => 'Rawat Jalan',
                        'ruangan_rawat' => 'SPESIALIS REHABILITASI MEDIK',
                        'tanggal_masuk' => $request->input('tanggal'),
                        'tanggal_pulang' => $request->input('tanggal'),
                        'create_by' => auth()->user()->username,
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
                }


                // dd('ok');
            } else {
                $data = DB::connection('pku')->table('fis_order_alkes')->where('no_registrasi', $request->input('no_registrasi'))->delete();
            }

            $asesmen_dokter_update = DB::connection('pku')->table('fis_asesmen_dokter')->where('no_registrasi', $request->input('no_registrasi'))->update([
                'kode_transaksi_fisio' => '',
                'anamnesa' => $request->input('anamnesa'),
                'tekanan_darah' => $request->input('tekanan_darah'),
                'nadi' => $request->input('nadi'),
                'respirasi' => $request->input('respirasi'),
                'suhu' => $request->input('suhu'),
                'berat_badan' => $request->input('berat_badan'),
                'prothesa' => $request->input('prothesa'),
                'orthosis' => $request->input('orthosis'),
                'diagnosa_klinis' => $request->input('diagnosa_klinis'),
                'terapi' => $request->input('jenis_terapi_fisio'),
                'rencana_rujukan' => $request->input('rencana_rujukan'),
                'deskripsi_rujukan' => $request->input('deskripsi_rujukan') ? $request->input('deskripsi_rujukan') : null,
                'rencana_konsul' => 'Ya',
                'deskripsi_konsul' => '',
                'anjuran_terapi' => $request->input('anjuran_terapi'),
                'evaluasi_terapi' => $request->input('evaluasi_terapi'),
                'deskripsi_rujukan' => $request->input('deskripsi_rujukan'),
                'create_by' => auth()->user()->username,
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            if ($asesmen_dokter_update) {
                $cppt_update = DB::connection('pku')->table('TR_CPPT_FISIOTERAPI')->where('no_registrasi', $request->input('no_registrasi'))->update([
                    'DIAGNOSA' => $request->input('diagnosa_klinis'),
                    'TEKANAN_DARAH' => $request->input('tekanan_darah'),
                    'NADI' => $request->input('nadi'),
                    'SUHU' => $request->input('suhu'),
                    'ANAMNESA' => $request->input('anamnesa')
                ]);
            }

            $lembarUjiFungsi = DB::connection('pku')->table('fis_lembar_uji_fungsi')->where('no_registrasi', $request->input('no_registrasi'))->update([

                'kode_transaksi_fisio' => '',
                'diagnosis_fungsional' => $request->input('diagnosa_klinis'),
                'prosedur_kfr' => $request->input('prosedur_kfr'),
                'kesimpulan' => $request->input('kesimpulan'),
                'rekomendasi' => $request->input('rekomendasi'),
                'edukasi' => $request->input('edukasi'),
                'create_by' => auth()->user()->username,

                'updated_at' => date('Y-m-d H:i:s')
            ]);

            $spkfr = DB::connection('pku')->table('fis_lembar_spkfr')->where('no_registrasi', $request->input('no_registrasi'))->update([

                'kode_transaksi_fisio' => '',
                'pemeriksaan_fisik' => $request->input('prosedur_kfr'),
                'diagnosis_medis' => $request->input('diagnosa_klinis'),
                'diagnosis_fungsi' => $request->input('kesimpulan'),
                'tata_laksana_kfr' => $request->input('jenis_terapi_fisio'),
                'penyakit_akibat_kerja' => $request->input('penyakit_akibat_kerja'),
                'deskripsi_akibat_kerja' => $request->input('deskripsi_akibat_kerja'),
                'create_by' => auth()->user()->username,

                'updated_at' => date('Y-m-d H:i:s')
            ]);

            // Commit transaksi
            DB::connection('pku')->commit();

            return redirect('fisioterapi/dokter/riwayat_pasien?tanggal=' . $request->input('tanggal'))->with('success', 'Asesmen Berhasil Diperbarui!');
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
