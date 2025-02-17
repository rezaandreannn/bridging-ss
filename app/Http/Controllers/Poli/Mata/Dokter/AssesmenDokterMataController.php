<?php

namespace App\Http\Controllers\Poli\Mata\Dokter;

use App\Models\Rajal;
use App\Models\PoliMata;
use App\Models\RajalDokter;
use App\Models\Rekam_medis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AssesmenDokterMataController extends Controller
{
    protected $view;
    protected $routeIndex;
    protected $prefix;
    protected $poliMata;
    protected $rajaldokter;
    protected $rajal;
    protected $rekam_medis;

    public function __construct(PoliMata $poliMata)
    {
        $this->rajaldokter = new RajalDokter();
        $this->rekam_medis = new Rekam_medis;
        $this->rajal = new Rajal;
        $this->poliMata = $poliMata;
        $this->view = 'pages.poli.mata.';
        $this->prefix = 'Poli Mata';
    }

    // Copy Riwayat Pasien
    public function copy_riwayat($noMr, $noRegBaru, $noRegLama)
    {
        $biodata = $this->rajal->pasien_bynoreg($noRegBaru);

        $biodataLama = $this->rajal->pasien_bynoreg($noRegLama);
        // dd($biodata);
        $ttv = DB::connection('pku')->table('TAC_RJ_VITAL_SIGN')->where('FS_KD_REG', $biodata->NO_REG)->first();
        $medis = DB::connection('pku')->table('TAC_RJ_MEDIS')->where('FS_KD_REG', $noRegLama)->first();
        // dd($medis);
        $asesmen_perawat = DB::connection('pku')->table('TAC_ASES_PER2')->where('FS_KD_REG', $biodata->NO_REG)->first();
        $perawat_mata = DB::connection('pku')->table('poli_mata_asesmen')->where('NO_REG', $biodata->NO_REG)->first();
        $MataKiri = DB::connection('pku')->table('poli_mata_gambar')
            ->select(
                'DESKRIPSI',
            )
            ->where('NO_REG', $noRegLama)
            ->where('TIPE', 'Mata Kiri')
            ->first();
        $MataKanan = DB::connection('pku')->table('poli_mata_gambar')
            ->select(
                'DESKRIPSI',
            )
            ->where('NO_REG', $noRegLama)
            ->where('TIPE', 'Mata Kanan')
            ->first();
        $refraksi = DB::connection('pku')->table('poli_mata_refraksi')->where('NO_REG', $biodata->NO_REG)->first();
        $refraksiLama = DB::connection('pku')->table('poli_mata_refraksi')->where('NO_REG', $noRegLama)->first();
        $asesmenDokterGet = DB::connection('pku')->table('poli_mata_dokter')->where('NO_REG', $noRegLama)->first();

        $masterObat = $this->rajaldokter->getMasterObat();
        // dd($perawat_mata);
        $title = $this->prefix . ' ' . 'Copy Assesmen Dokter';
        return view($this->view . 'dokter.copyRiwayatAsesmen', compact('title', 'biodata', 'ttv', 'MataKiri', 'MataKanan', 'refraksiLama', 'medis', 'masterObat', 'perawat_mata', 'asesmen_perawat', 'refraksi', 'asesmenDokterGet', 'biodataLama', 'noRegBaru'));;
    }

    // -----------------------------------------------------------------------------

    public function index2(Request $request)
    {
        $title = $this->prefix . ' ' . 'Mata Dokter';
        $tanggal = $request->input('tanggal');

        $kode_dokter = auth()->user()->username;
        $pasien = $this->rekam_medis->rekamMedisHarian($kode_dokter, $tanggal);
        // $pasienKonsul = $this->rajaldokter->getPasienByDokterMataRujukInternal($kode_dokter, $tanggal);
        $poliMata = new PoliMata();
        // dd($pasien);
        return view($this->view . 'dokter.index2', compact('title', 'pasien', 'poliMata'));
    }

    public function index(Request $request)
    {
        $title = $this->prefix . ' ' . 'Mata Dokter';
        $tanggal = $request->input('tanggal');
        if ($tanggal == null) {
            $tanggal = date('Y-m-d');
        }
        $kode_dokter = auth()->user()->username;
        $pasien = $this->rajaldokter->getPasienByDokterMata(auth()->user()->username);
        // dd($pasien);
        $pasienKonsul = $this->rajaldokter->getPasienByDokterMataRujukInternal($kode_dokter, $tanggal);
        // dd($pasienKonsul);
        $poliMata = new PoliMata();
        // dd($pasien);
        return view($this->view . 'dokter.index', compact('title', 'pasien', 'poliMata', 'pasienKonsul'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add($noReg, $NoMr)
    {
        $title = $this->prefix . ' ' . 'Mata Assesmen Dokter';
        $biodata = $this->rekam_medis->getBiodata($noReg);
        $alasanSkdp = $this->rajal->getAlesanSkdp();
        $skdp = $this->rajal->getSkdp($noReg);
        $penyakitSekarang = $this->poliMata->getPenyakit();

        $asasmen_perawat = $this->poliMata->asasmenPerawatGet($noReg);
        // dd($asasmen_perawat);
        $refraksi = $this->poliMata->getRefraksi($noReg);

        $history = $this->rajaldokter->getHistoryPasienPoliMata($NoMr);
        // dd($history);

        $cekAsesmenMata = new PoliMata();

        // Data Master
        $masterLab = $this->rajaldokter->getMasterLab();
        $masterRadiologi = $this->rajaldokter->getMasterRadiologi();
        $masterObat = $this->rajaldokter->getMasterObat();

        // dd($asasmen_perawat);
        return view($this->view . 'dokter.assesmenAwal', compact('title', 'biodata', 'cekAsesmenMata', 'history', 'refraksi', 'alasanSkdp', 'skdp', 'asasmen_perawat', 'masterLab', 'masterRadiologi', 'masterObat', 'noReg'));
    }

    public function konsul($noReg)
    {
        $title = $this->prefix . ' ' . 'Mata Assesmen Dokter';
        $biodata = $this->rekam_medis->getBiodata($noReg);

        $asasmen_perawat = $this->rajal->asasmenPerawatKonsul($noReg);
        // dd($asasmen_perawat);
        $refraksi = $this->poliMata->getRefraksi($noReg);
        // Data Master
        $masterLab = $this->rajaldokter->getMasterLab();
        $masterRadiologi = $this->rajaldokter->getMasterRadiologi();
        $masterObat = $this->rajaldokter->getMasterObat();
        // dd($asasmen_perawat);
        return view($this->view . 'dokter.assesmenKonsul', compact('title', 'biodata', 'refraksi', 'asasmen_perawat', 'masterLab', 'masterRadiologi', 'masterObat',  'noReg'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the input
        $request->validate([
            'NO_REG' => 'required',
            'DESKRIPSI_KIRI' => 'nullable|string',
            'DESKRIPSI_KANAN' => 'nullable|string',
        ]);

        // dd($request->mata_kiri);
        // $userEmr = $this->rajal->getUserEmr(auth()->user()->username);
        try {
            DB::connection('pku')->beginTransaction();

            DB::connection('pku')->table('TAC_RJ_MEDIS')->insert([
                'FS_KD_REG' => $request->input('NO_REG'),
                'FS_TERAPI' => $request->input('FS_TERAPI') ?? '',
                'FS_KD_MEDIS' => auth()->user()->username,
                'FS_CARA_PULANG' => $request->input('FS_CARA_PULANG'),
                'mdd' => date('Y-m-d'),
                'mdb' => auth()->user()->username,
            ]);

            DB::connection('pku')->table('poli_mata_refraksi')->where('NO_REG', $request->input('NO_REG'))->update([
                'VISUS_OD' => $request->input('VISUS_OD'),
                'VISUS_OS' => $request->input('VISUS_OS'),
                'ADD_OD' => $request->input('ADD_OD'),
                'ADD_OS' => $request->input('ADD_OS'),
                'NCT_TOD' => $request->input('NCT_TOD'),
                'NCT_TOS' => $request->input('NCT_TOS'),
                'updated_at' => now(),
                'UPDATE_REFRAKSI' => auth()->user()->username,
            ]);

            DB::connection('pku')->table('poli_mata_dokter')->insert([
                'NO_REG' => $request->input('NO_REG'),
                'anamnesa' => $request->input('anamnesa'),
                'RIWAYAT_SEKARANG' => $request->input('RIWAYAT_SEKARANG'),
                // 'RIWAYAT_SEKARANG' => is_array($request->input('RIWAYAT_SEKARANG'))
                //     ? implode(',', $request->input('RIWAYAT_SEKARANG'))
                //     : $request->input('RIWAYAT_SEKARANG'),
                'status_psikologi' => $request->input('status_psikologi'),
                'keadaan_umum' => $request->input('keadaan_umum'),
                'kesadaran' => $request->input('kesadaran'),
                'status_mental' => $request->input('status_mental'),
                'tekanan_darah' => $request->input('tekanan_darah'),
                'nadi' => $request->input('nadi'),
                'respirasi' => $request->input('respirasi'),
                'suhu' => $request->input('suhu'),
                'berat_badan' => $request->input('berat_badan'),
                'tinggi_badan' => $request->input('tinggi_badan'),
                'DIAGNOSA' => $request->input('DIAGNOSA'),
                'edukasi' => $request->input('edukasi'),
                'konsul' => $request->input('konsul'),
                'keterangan_konsul' => $request->input('keterangan_konsul'),
                'created_at' => now(),
                'CREATE_BY' => auth()->user()->username,
            ]);

            // ------------------- Gambar Mata Kiri ----------------- //
            if ($request->signed_kiri != '') {
                $image_parts = explode(";base64,", $request->signed_kiri);
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];
                $image_base64 = base64_decode($image_parts[1]);

                // Use uniqid to generate a unique file name
                $file_name = uniqid($request->input('NO_REG') . '-' . 'Mata-Kiri' . '-' . date('Y-m-d') . '-') . '.' . $image_type;

                // Save the image to storage
                Storage::put('public/gambar_mata/' . $file_name, $image_base64);

                // Insert data into the database
                DB::connection('pku')->table('poli_mata_gambar')->insert([
                    'NO_REG' => $request->input('NO_REG'),
                    'GAMBAR' => $file_name,
                    'DESKRIPSI' => $request->input('DESKRIPSI_KIRI'),
                    'TIPE' => 'Mata Kiri',
                    'CREATE_BY' => auth()->user()->username,
                    'created_at' => now(),
                ]);
            } else {
                DB::connection('pku')->table('poli_mata_gambar')->insert([
                    'NO_REG' => $request->input('NO_REG'),
                    'GAMBAR' => null, // or set a default value if appropriate
                    'DESKRIPSI' => $request->input('DESKRIPSI_KIRI'),
                    'TIPE' => 'Mata Kiri',
                    'CREATE_BY' => auth()->user()->username,
                    'created_at' => now(),
                ]);
            }
            // -------------------------------------------------- //

            // ----------------- Gambar Mata Kanan -------------- //
            if ($request->signed_kanan != '') {
                $image_parts = explode(";base64,", $request->signed_kanan);
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];
                $image_base64 = base64_decode($image_parts[1]);

                // Use uniqid to generate a unique file name
                $file_name = uniqid($request->input('NO_REG') . '-' . 'Mata-Kanan' . '-' . date('Y-m-d') . '-') . '.' . $image_type;

                // Save the image to storage
                Storage::put('public/gambar_mata/' . $file_name, $image_base64);

                // Insert data into the database
                DB::connection('pku')->table('poli_mata_gambar')->insert([
                    'NO_REG' => $request->input('NO_REG'),
                    'GAMBAR' => $file_name,
                    'DESKRIPSI' => $request->input('DESKRIPSI_KANAN'),
                    'TIPE' => 'Mata Kanan',
                    'CREATE_BY' => auth()->user()->username,
                    'created_at' => now(),
                ]);
            } else {
                DB::connection('pku')->table('poli_mata_gambar')->insert([
                    'NO_REG' => $request->input('NO_REG'),
                    'GAMBAR' => null,
                    'DESKRIPSI' => $request->input('DESKRIPSI_KANAN'),
                    'TIPE' => 'Mata Kanan',
                    'CREATE_BY' => auth()->user()->username,
                    'created_at' => now(),
                ]);
            }

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


            if ($request->input('FS_CARA_PULANG') == '0') {
                return redirect('pm/polimata/dokter')->with('success', 'Berhasil Ditambahkan!');
            } elseif ($request->input('FS_CARA_PULANG') == '2') {
                return redirect()->route('kondisiPulang.SkdpRS', ['noReg' => $request->input('NO_REG')])->with('success', 'Berhasil Ditambahkan!');
            } elseif ($request->input('FS_CARA_PULANG') == '3') {
                return redirect('pm/polimata/dokter')->with('success', 'Berhasil Ditambahkan!');
                // return redirect()->route('kondisiPulang.rawatInap', ['noReg' => $request->input('NO_REG')])->with('success', 'Berhasil Ditambahkan!');
            } elseif ($request->input('FS_CARA_PULANG') == '4') {
                return redirect()->route('kondisiPulang.rujukLuarRS', ['noReg' => $request->input('NO_REG')])->with('success', 'Berhasil Ditambahkan!');
            } elseif ($request->input('FS_CARA_PULANG') == '6') {
                return redirect()->route('kondisiPulang.rujukInternalRS', ['noReg' => $request->input('NO_REG')])->with('success', 'Berhasil Ditambahkan!');
            } elseif ($request->input('FS_CARA_PULANG') == '7') {
                return redirect()->route('kondisiPulang.faskesPRB', ['noReg' => $request->input('NO_REG')])->with('success', 'Berhasil Ditambahkan!');
            } else {
                return redirect('pm/polimata/dokter')->with('success', 'Berhasil Ditambahkan!');
            }
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

        $title = $this->prefix . ' ' . 'Mata Assesmen Dokter Edit';
        $biodata = $this->rekam_medis->getBiodata($noReg);
        $asasmen_dokter = $this->poliMata->asasmenDokter($noReg);
        // $penyakitSekarang = $this->poliMata->getPenyakit();

        // Data Master
        $masterLab = $this->rajaldokter->getMasterLab();
        $getLab = $this->rajaldokter->getLabByKodeReg($noReg);
        $masterRadiologi = $this->rajaldokter->getMasterRadiologi();
        $getRad = $this->rajaldokter->getRadByKodeReg($noReg);
        $getCekRad = $this->rajaldokter->getCekRad($noReg);
        // dd($getCekRad);

        $masterObat = $this->rajaldokter->getMasterObat();
        // Gambar Mata
        $MataKiri = $this->poliMata->getMataKiri($noReg);
        // dd($MataKiri);
        $MataKanan = $this->poliMata->getMataKanan($noReg);


        // dd($asasmen_perawat);
        return view($this->view . 'dokter.EditassesmenAwal', compact('title', 'biodata', 'MataKanan', 'MataKiri', 'asasmen_dokter', 'masterLab', 'getLab', 'masterRadiologi', 'getRad', 'getCekRad', 'masterObat', 'noReg'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function cekSKDP($noReg)
    {
        return DB::connection('pku')->table('TAC_RJ_SKDP')->where('FS_KD_REG', $noReg)->exists();
    }

    public function cekRujukan($noReg)
    {
        return DB::connection('pku')->table('TAC_RJ_RUJUKAN')->where('FS_KD_REG', $noReg)->exists();
    }
    public function cekPRB($noReg)
    {
        return DB::connection('pku')->table('TAC_RJ_PRB')->where('FS_KD_REG', $noReg)->exists();
    }



    public function update(Request $request)
    {
        // $userEmr = $this->rajal->getUserEmr(auth()->user()->username);
        try {
            DB::connection('pku')->beginTransaction();

            DB::connection('pku')->table('TAC_RJ_MEDIS')->where('FS_KD_REG', $request->input('NO_REG'))->update([
                'FS_KD_REG' => $request->input('NO_REG'),
                'FS_TERAPI' => $request->input('FS_TERAPI') ?? '',
                'FS_CARA_PULANG' => $request->input('FS_CARA_PULANG'),
                'mdd' => date('Y-m-d'),
                'mdb' => auth()->user()->username,
            ]);

            DB::connection('pku')->table('poli_mata_refraksi')->where('NO_REG', $request->input('NO_REG'))->update([
                'VISUS_OD' => $request->input('VISUS_OD'),
                'VISUS_OS' => $request->input('VISUS_OS'),
                'ADD_OD' => $request->input('ADD_OD'),
                'ADD_OS' => $request->input('ADD_OS'),
                'NCT_TOD' => $request->input('NCT_TOD'),
                'NCT_TOS' => $request->input('NCT_TOS'),
                'updated_at' => now(),
                'UPDATE_REFRAKSI' => auth()->user()->username,
            ]);

            DB::connection('pku')->table('poli_mata_dokter')->where('NO_REG', $request->input('NO_REG'))->update([
                'anamnesa' => $request->input('anamnesa'),
                'RIWAYAT_SEKARANG' => $request->input('RIWAYAT_SEKARANG'),
                // 'RIWAYAT_SEKARANG' => is_array($request->input('RIWAYAT_SEKARANG'))
                //     ? implode(',', $request->input('RIWAYAT_SEKARANG'))
                //     : $request->input('RIWAYAT_SEKARANG'),
                'status_psikologi' => $request->input('status_psikologi'),
                'keadaan_umum' => $request->input('keadaan_umum'),
                'kesadaran' => $request->input('kesadaran'),
                'status_mental' => $request->input('status_mental'),
                'tekanan_darah' => $request->input('tekanan_darah'),
                'nadi' => $request->input('nadi'),
                'respirasi' => $request->input('respirasi'),
                'suhu' => $request->input('suhu'),
                'berat_badan' => $request->input('berat_badan'),
                'tinggi_badan' => $request->input('tinggi_badan'),
                'DIAGNOSA' => $request->input('DIAGNOSA'),
                'edukasi' => $request->input('edukasi'),
                'konsul' => $request->input('konsul'),
                'keterangan_konsul' => $request->input('keterangan_konsul'),
                'created_at' => now(),
                'CREATE_BY' => auth()->user()->username,
            ]);

            // ------------------- Gambar Mata Kiri ----------------- //
            if ($request->signed_kiri != '') {
                $image_parts = explode(";base64,", $request->signed_kiri);
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];
                $image_base64 = base64_decode($image_parts[1]);

                // Use uniqid to generate a unique file name
                $file_name_kiri = uniqid($request->input('NO_REG') . '-' . 'Mata-Kiri' . '-' . date('Y-m-d') . '-') . '.' . $image_type;

                // Retrieve the current record to get the old file name
                $gambar_kiri = DB::connection('pku')->table('poli_mata_gambar')
                    ->where('id', $request->input('id_kiri'))
                    ->where('TIPE', 'Mata Kiri')
                    ->first();

                if ($gambar_kiri) {
                    // Hapus gambar lama dari storage
                    Storage::delete('public/gambar_mata/' . $gambar_kiri->GAMBAR);
                    // Simpan gambar baru ke storage
                    Storage::put('public/gambar_mata/' . $file_name_kiri, $image_base64);
                    // Update the database record
                    DB::connection('pku')->table('poli_mata_gambar')->where('id', $request->input('id_kiri'))->update([
                        'NO_REG' => $request->input('NO_REG'),
                        'GAMBAR' => $file_name_kiri,
                        'DESKRIPSI' => $request->input('DESKRIPSI_KIRI'),
                        'TIPE' => 'Mata Kiri',
                        'UPDATE_BY' => auth()->user()->username,
                    ]);
                }
            }
            // -------------------------------------------------- //

            // ----------------- Gambar Mata Kanan -------------- //
            if ($request->signed_kanan != '') {
                $image_parts = explode(";base64,", $request->signed_kanan);
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];
                $image_base64 = base64_decode($image_parts[1]);

                // Use uniqid to generate a unique file name
                $file_name_kanan = uniqid($request->input('NO_REG') . '-' . 'Mata-Kanan' . '-' . date('Y-m-d') . '-') . '.' . $image_type;

                // Retrieve the current record to get the old file name
                $gambar_kanan = DB::connection('pku')->table('poli_mata_gambar')
                    ->where('id', $request->input('id_kanan'))
                    ->where('TIPE', 'Mata Kanan')
                    ->first();

                if ($gambar_kanan) {
                    // Hapus gambar lama dari storage
                    Storage::delete('public/gambar_mata/' . $gambar_kanan->GAMBAR);
                    // Simpan gambar baru ke storage
                    Storage::put('public/gambar_mata/' . $file_name_kanan, $image_base64);
                    // Update the database record
                    DB::connection('pku')->table('poli_mata_gambar')->where('id', $request->input('id_kanan'))->update([
                        'NO_REG' => $request->input('NO_REG'),
                        'GAMBAR' => $file_name_kanan,
                        'DESKRIPSI' => $request->input('DESKRIPSI_KANAN'),
                        'TIPE' => 'Mata Kanan',
                        'UPDATE_BY' => auth()->user()->username,
                    ]);
                }
            }

            // ------------------------------------------------ //


            $periksa_lab = $request->input('periksa_lab');
            DB::connection('pku')->table('ta_trs_kartu_periksa4')->where('fs_kd_reg2', $request->input('NO_REG'))->delete();
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
            DB::connection('pku')->table('ta_trs_kartu_periksa5')->where('fs_kd_reg2', $request->input('NO_REG'))->delete();
            if (!empty($periksa_rad)) {
                foreach ($periksa_rad as $key => $value) {
                    DB::connection('pku')->table('ta_trs_kartu_periksa5')->insert([
                        'fn_no_urut' => $key,
                        'fs_kd_tarif' => $value,
                        'fs_kd_reg2' => $request->input('NO_REG'),
                        'fs_bagian' => $fs_bagian,
                    ]);
                }
            }

            DB::connection('pku')->commit();

            $noReg = $request->input('NO_REG');
            if ($request->input('FS_CARA_PULANG') == '0') {
                return redirect('pm/polimata/dokter')->with('success', 'Berhasil DiEdit!');
            } elseif ($request->input('FS_CARA_PULANG') == '2') {
                if (!empty($noReg) && $this->cekSKDP($noReg)) {
                    return redirect()->route('kondisiPulang.EditSkdpRS', ['noReg' => $request->input('NO_REG')])->with('success', 'Berhasil DiEdit!');
                } else {
                    return redirect()->route('kondisiPulang.SkdpRS', ['noReg' => $request->input('NO_REG')])->with('success', 'Berhasil DiEdit!');
                }
            } elseif ($request->input('FS_CARA_PULANG') == '4') {
                if (!empty($noReg) && $this->cekRujukan($noReg)) {
                    return redirect()->route('kondisiPulang.rujukLuarEdit', ['noReg' => $request->input('NO_REG')])->with('success', 'Berhasil DiEdit!');
                } else {
                    return redirect()->route('kondisiPulang.rujukLuarRS', ['noReg' => $request->input('NO_REG')])->with('success', 'Berhasil DiEdit!');
                }
            } elseif ($request->input('FS_CARA_PULANG') == '6') {
                if (!empty($noReg) && $this->cekRujukan($noReg)) {
                    return redirect()->route('kondisiPulang.rujukInternalEdit', ['noReg' => $request->input('NO_REG')])->with('success', 'Berhasil DiEdit!');
                } else {
                    return redirect()->route('kondisiPulang.rujukInternalRS', ['noReg' => $request->input('NO_REG')])->with('success', 'Berhasil Ditambahkan!');
                }
            } elseif ($request->input('FS_CARA_PULANG') == '7') {
                if (!empty($noReg) && $this->cekPRB($noReg)) {
                    return redirect()->route('kondisiPulang.faskesPRBEdit', ['noReg' => $request->input('NO_REG')])->with('success', 'Berhasil DiEdit!');
                } else {
                    return redirect()->route('kondisiPulang.faskesPRB', ['noReg' => $request->input('NO_REG')])->with('success', 'Berhasil DiEdit!');
                }
            } else {
                return redirect('pm/polimata/dokter')->with('success', 'Berhasil DiEdit!');
            }
        } catch (\Exception $e) {
            //throw $th;
            DB::connection('pku')->rollBack();
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
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
