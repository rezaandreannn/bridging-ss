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
        $this->prefix = 'Poli';
    }

    public function index()
    {
        $title = $this->prefix . ' ' . 'Mata Dokter';
        $pasien = $this->rajaldokter->getPasienByDokterMata(auth()->user()->username);
        $poliMata = new PoliMata();
        // dd($pasien);
        return view($this->view . 'dokter.index', compact('title', 'pasien', 'poliMata'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add($noReg)
    {
        $title = $this->prefix . ' ' . 'Mata Assesmen Dokter';
        $biodata = $this->rekam_medis->getBiodata($noReg);
        $alasanSkdp = $this->rajal->getAlesanSkdp();
        $skdp = $this->rajal->getSkdp($noReg);
        $penyakitSekarang = $this->poliMata->getPenyakit();

        $asasmen_perawat = $this->poliMata->asasmenPerawatGet($noReg);
        // dd($asasmen_perawat);
        $refraksi = $this->poliMata->getRefraksi($noReg);
        // dd($refraksi);
        // dd($asasmen_perawat);

        // Data Master
        $masterLab = $this->rajaldokter->getMasterLab();
        $masterRadiologi = $this->rajaldokter->getMasterRadiologi();
        $masterObat = $this->rajaldokter->getMasterObat();

        $masalah_perawatan = $this->rajal->masalah_perawatan();
        $rencana_perawatan = $this->rajal->rencana_perawatan();

        $masalah_perGet = $this->rajal->masalahPerawatanGetByNoreg($noReg);
        $rencana_perGet = $this->rajal->rencanaPerawatanGetByNoreg($noReg);
        // dd($asasmen_perawat);
        return view($this->view . 'dokter.assesmenAwal', compact('title', 'biodata', 'refraksi', 'penyakitSekarang', 'alasanSkdp', 'skdp', 'asasmen_perawat', 'masterLab', 'masterRadiologi', 'masterObat', 'masalah_perGet', 'rencana_perGet', 'masalah_perawatan', 'rencana_perawatan', 'noReg'));
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

            DB::connection('pku')->table('TAC_RJ_SKDP')->insert([
                'FS_KD_REG' => $request->input('NO_REG'),
                'FS_SKDP_1' => $request->input('FS_SKDP_1'),
                'FS_SKDP_2' => $request->input('FS_SKDP_2'),
                'FS_SKDP_KET' => $request->input('FS_SKDP_KET') ?? '',
                'FS_SKDP_KONTROL' => $request->input('FS_SKDP_KONTROL') ?? '',
                'FS_SKDP_FASKES' => $request->input('FS_SKDP_FASKES'),
                'FS_PESAN' => $request->input('FS_PESAN'),
                'FS_RENCANA_KONTROL' => $request->input('FS_RENCANA_KONTROL'),
                'mdd' => date('Y-m-d'),
                'mdb' => auth()->user()->username,
            ]);

            DB::connection('pku')->table('TAC_RJ_MEDIS')->insert([
                'FS_KD_REG' => $request->input('NO_REG'),
                'FS_TERAPI' => $request->input('FS_TERAPI') ?? '',
                'FS_CARA_PULANG' => $request->input('FS_CARA_PULANG'),
                'mdd' => date('Y-m-d'),
                'mdb' => auth()->user()->username,
            ]);

            DB::connection('pku')->table('poli_mata_dokter')->insert([
                'NO_REG' => $request->input('NO_REG'),
                'anamnesa' => $request->input('anamnesa'),
                'RIWAYAT_SEKARANG' => is_array($request->input('RIWAYAT_SEKARANG'))
                    ? implode(',', $request->input('RIWAYAT_SEKARANG'))
                    : $request->input('RIWAYAT_SEKARANG'),
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
                'KONJUNGTIVA' => $request->input('KONJUNGTIVA'),
                'SKELERA' => $request->input('SKELERA'),
                'BIBIR_LIDAH' => $request->input('BIBIR_LIDAH'),
                'DIAGNOSA' => $request->input('DIAGNOSA'),
                'edukasi' => $request->input('edukasi'),
                'konsul' => $request->input('konsul'),
                'keterangan_konsul' => $request->input('keterangan_konsul'),
                'discharge' => $request->input('discharge'),
                'tonometri_od' => $request->input('tonometri_od'),
                'tonometri_os' => $request->input('tonometri_os'),
                'aplansi_od' => $request->input('aplansi_od'),
                'aplansi_os' => $request->input('aplansi_os'),
                'anel_od' => $request->input('anel_od'),
                'anel_os' => $request->input('anel_os'),
                'ekstremitas_od' => $request->input('ekstremitas_od'),
                'ekstremitas_os' => $request->input('ekstremitas_os'),
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
                ]);
            }
            // ------------------------------------------------ //

            $masalah_kep = $request->input('tujuan');
            DB::connection('pku')->table('TAC_RJ_MASALAH_KEP')->where('FS_KD_REG', $request->input('NO_REG'))->delete();
            if (!empty($masalah_kep)) {
                foreach ($masalah_kep as $value) {
                    $insert_masalah_kep = DB::connection('pku')->table('TAC_RJ_MASALAH_KEP')->insert([
                        'FS_KD_REG' => $request->input('NO_REG'),
                        'FS_KD_MASALAH_KEP' => $value,

                    ]);
                }
            }

            $rencana_kep = $request->input('tembusan');
            DB::connection('pku')->table('TAC_RJ_REN_KEP')->where('FS_KD_REG', $request->input('NO_REG'))->delete();
            if (!empty($rencana_kep)) {
                foreach ($rencana_kep as $value) {
                    $insert_rencana_kep = DB::connection('pku')->table('TAC_RJ_REN_KEP')->insert([

                        'FS_KD_REG' => $request->input('NO_REG'),
                        'FS_KD_REN_KEP' => $value,

                    ]);
                }
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

            return redirect('pm/polimata/dokter')->with('success', 'Edit Successfully!');
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
    public function edit(Request $request, $noReg)
    {
        $title = $this->prefix . ' ' . 'Mata Assesmen Dokter Edit';
        $biodata = $this->rekam_medis->getBiodata($noReg);
        $asasmen_dokter = $this->poliMata->asasmenDokter($noReg);
        // dd($asasmen_dokter);

        $penyakitSekarang = $this->poliMata->getPenyakit();

        // SKDP
        $alasanSkdp = $this->rajal->getAlesanSkdp();
        $skdp = $this->rajal->getSkdp($noReg);
        $rencanaSkdp = $this->rajal->get_rencana_skdp_by_noreg();

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


        $masalah_perawatan = $this->rajal->masalah_perawatan();
        $rencana_perawatan = $this->rajal->rencana_perawatan();

        $masalah_perGet = $this->rajal->masalahPerawatanGetByNoreg($noReg);
        $rencana_perGet = $this->rajal->rencanaPerawatanGetByNoreg($noReg);

        // dd($asasmen_perawat);
        return view($this->view . 'dokter.EditassesmenAwal', compact('title', 'biodata', 'penyakitSekarang', 'MataKanan', 'MataKiri', 'alasanSkdp', 'skdp', 'rencanaSkdp', 'asasmen_dokter', 'masterLab', 'getLab', 'masterRadiologi', 'getRad', 'getCekRad', 'masterObat', 'masalah_perGet', 'rencana_perGet', 'masalah_perawatan', 'rencana_perawatan', 'noReg'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // $userEmr = $this->rajal->getUserEmr(auth()->user()->username);
        try {
            DB::connection('pku')->beginTransaction();

            DB::connection('pku')->table('TAC_RJ_SKDP')->where('FS_KD_REG', $request->input('NO_REG'))->update([
                'FS_SKDP_1' => $request->input('FS_SKDP_1'),
                'FS_SKDP_2' => $request->input('FS_SKDP_2'),
                'FS_SKDP_KET' => $request->input('FS_SKDP_KET') ?? '',
                'FS_SKDP_KONTROL' => $request->input('FS_SKDP_KONTROL') ?? '',
                'FS_SKDP_FASKES' => $request->input('FS_SKDP_FASKES'),
                'FS_PESAN' => $request->input('FS_PESAN'),
                'FS_RENCANA_KONTROL' => $request->input('FS_RENCANA_KONTROL'),
                'mdd' => date('Y-m-d'),
                'mdb' => auth()->user()->username,
            ]);

            DB::connection('pku')->table('TAC_RJ_MEDIS')->where('FS_KD_REG', $request->input('NO_REG'))->update([
                'FS_KD_REG' => $request->input('NO_REG'),
                'FS_TERAPI' => $request->input('FS_TERAPI'),
                'mdd' => date('Y-m-d'),
                'mdb' => auth()->user()->username,
            ]);

            DB::connection('pku')->table('poli_mata_dokter')->where('NO_REG', $request->input('NO_REG'))->update([
                'NO_REG' => $request->input('NO_REG'),
                'anamnesa' => $request->input('anamnesa'),
                'RIWAYAT_SEKARANG' => is_array($request->input('RIWAYAT_SEKARANG'))
                    ? implode(',', $request->input('RIWAYAT_SEKARANG'))
                    : $request->input('RIWAYAT_SEKARANG'),
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
                'KONJUNGTIVA' => $request->input('KONJUNGTIVA'),
                'SKELERA' => $request->input('SKELERA'),
                'BIBIR_LIDAH' => $request->input('BIBIR_LIDAH'),
                'DIAGNOSA' => $request->input('DIAGNOSA'),
                'edukasi' => $request->input('edukasi'),
                'konsul' => $request->input('konsul'),
                'keterangan_konsul' => $request->input('keterangan_konsul'),
                'discharge' => $request->input('discharge'),
                'tonometri_od' => $request->input('tonometri_od'),
                'tonometri_os' => $request->input('tonometri_os'),
                'aplansi_od' => $request->input('aplansi_od'),
                'aplansi_os' => $request->input('aplansi_os'),
                'anel_od' => $request->input('anel_od'),
                'anel_os' => $request->input('anel_os'),
                'ekstremitas_od' => $request->input('ekstremitas_od'),
                'ekstremitas_os' => $request->input('ekstremitas_os'),
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

            $masalah_kep = $request->input('tujuan');
            DB::connection('pku')->table('TAC_RJ_MASALAH_KEP')->where('FS_KD_REG', $request->input('NO_REG'))->delete();
            if (!empty($masalah_kep)) {
                foreach ($masalah_kep as $value) {
                    $insert_masalah_kep = DB::connection('pku')->table('TAC_RJ_MASALAH_KEP')->insert([

                        'FS_KD_REG' => $request->input('NO_REG'),
                        'FS_KD_MASALAH_KEP' => $value,

                    ]);
                }
            }

            $rencana_kep = $request->input('tembusan');
            DB::connection('pku')->table('TAC_RJ_REN_KEP')->where('FS_KD_REG', $request->input('NO_REG'))->delete();
            if (!empty($rencana_kep)) {
                foreach ($rencana_kep as $value) {
                    $insert_rencana_kep = DB::connection('pku')->table('TAC_RJ_REN_KEP')->insert([

                        'FS_KD_REG' => $request->input('NO_REG'),
                        'FS_KD_REN_KEP' => $value,

                    ]);
                }
            }
            DB::connection('pku')->commit();

            return redirect('pm/polimata/dokter')->with('success', 'Edit Successfully!');
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
