<?php

namespace App\Services\Operasi\DataUmum;

use Exception;
use Illuminate\Support\Facades\DB;
use App\Models\Operasi\PostOperasi\AlatPostOperasi;
use App\Models\Operasi\PostOperasi\DataUmumPostOperasi;
use App\Models\Operasi\PostOperasi\TindakanPostOperasi;
use App\Models\Operasi\PostOperasi\VerifikasiPostOperasi;
use App\Models\Operasi\PostOperasi\PemeriksaanFisikPostOperasi;

class PostOperasiService
{

    public function findById($kode_register)
    {
        return [
            'tindakan' => TindakanPostOperasi::where('kode_register', $kode_register)->first(),
            'alat' => AlatPostOperasi::where('kode_register', $kode_register)->first(),
            'ttv' => PemeriksaanFisikPostOperasi::where('kode_register', $kode_register)->first(),
            'dataUmum' => DataUmumPostOperasi::where('kode_register', $kode_register)->first()
        ];
    }

    public function cetakBerkas($kode_register)
    {
        $result = DataUmumPostOperasi::with([
            'postTindakan' => function ($query) {
                $query->select(
                    'kode_register',
                    'status_pasien',
                    'catatan_anestesi',
                    'laporan_pembedahan',
                    'perencanaan_pasca_medis',
                    'checklist_keselamatan_pasien',
                    'checklist_monitoring',
                    'askep_perioperatif',
                    'lembar_pemantauan',
                    'formulir_pemeriksaan',
                    'sampel_pemeriksaan',
                    'foto_rontgen',
                    'resep',
                    'lainnya',
                    'deskripsi_lainnya',
                );
            },
            'postAlat' => function ($query) {
                $query->select(
                    'kode_register',
                    'ngt',
                    'drain',
                    'tampon_hidung',
                    'tampon_gigi',
                    'tampon_abdomen',
                    'tampon_vagina',
                    'tranfusi',
                    'ivfd',
                    'deskripsi_ivfd',
                    'kompres_luka',
                    'dc',
                    'lainnya',
                    'deskripsi_lainnya',
                );
            },

            'postPemeriksaanFisik' => function ($query) {
                $query->select(
                    'kode_register',
                    'keadaan_umum',
                    'kesadaran',
                    'tekanan_darah',
                    'nadi',
                    'suhu',
                    'pernafasan',
                    'instruksi_dokter'
                );
            },

            'preTindakan' => function ($query) {
                $query->select(
                    'kode_register',
                    'lapor_dokter',
                    'lapor_kamar',
                    'surat_izin_pembedahan',
                    'tandai_daerah_operasi',
                    'memakai_gelang_identitas',
                    'melepas_aksesoris',
                    'menghapus_aksesoris',
                    'melakukan_oral_hygiene',
                    'memasang_bidai',
                    'memasang_infuse',
                    'memasang_dc',
                    'deskripsi_dc',
                    'memasang_ngt',
                    'deskripsi_ngt',
                    'memasang_drainage',
                    'memasang_wsd',
                    'mencukur_daerah_operasi',
                    'lainnya',
                    'deskripsi_lainnya',
                    'penyakit_dm',
                    'penyakit_hipertensi',
                    'penyakit_tb_paru',
                    'penyakit_hiv',
                    'penyakit_hepatitis',
                );
            },

            'prePemeriksaanFisik' => function ($query) {
                $query->select(
                    'kode_register',
                    'tinggi_badan',
                    'berat_badan',
                    'tekanan_darah',
                    'nadi',
                    'suhu',
                    'pernafasan',
                );
            },

            'preDataUmum' => function ($query) {
                $query->select(
                    'kode_register',
                    'diagnosa',
                    'jenis_operasi',
                    'nama_operator',
                    'puasa_jam',
                    'riwayat_asma',
                    'alergi',
                    'antibiotik_profilaksis',
                    'antibiotik_profilaksis_jam',
                    'premedikasi',
                    'premedikasi_jam',
                    'ivfd',
                    'dc',
                    'assesmen_pra_bedah',
                    'edukasi_anastesi',
                    'informed_consent_bedah',
                    'informed_consent_anastesi',
                    'darah',
                    'gol',
                    'obat',
                    'rontgen',
                    'created_by'
                )->with([
                    'user' => function ($query) {
                        $query->select('id', 'name');
                    }
                ]);
            },

            'booking' => function ($query) {
                $query->with([
                    'pendaftaran' => function ($query) {
                        $query->select('No_Reg', 'No_MR')
                            ->with(['registerPasien' => function ($query) {
                                $query->select(
                                    'No_MR',
                                    'Nama_Pasien',
                                    'ALAMAT',
                                    'JENIS_KELAMIN',
                                    DB::raw("FORMAT(TGL_LAHIR, 'yyyy-MM-dd') as TGL_LAHIR")
                                );
                            }]);
                    },
                ]);
            },
        ])
            ->where('kode_register', $kode_register)
            ->first();

        if ($result) {
            return (object) [
                'id' => $result->id,
                'kode_register' => $result->kode_register,
                'diagnosa_prabedah' => $result->diagnosa_prabedah,
                'diagnosa_pascabedah' => $result->diagnosa_pascabedah,
                'jenis_operasi_post' => $result->jenis_operasi,
                'dokter_operator' => $result->dokter_operator,
                'asisten_bedah' => $result->asisten_bedah,
                'jam_operasi' => $result->jam_operasi,
                'jenis_anastesi' => $result->jenis_anastesi,
                'dokter_anastesi' => $result->dokter_anastesi,
                'asisten_anastesi' => $result->asisten_anastesi,
                'created_by_post' => $result->created_by,
                'created_by_post' => $result->user->id > 0
                    ? $result->user->name
                    : NULL,
                'no_mr' => optional($result->booking->pendaftaran)->No_MR,
                'nama_pasien' => optional($result->booking->pendaftaran->registerPasien)->Nama_Pasien,
                'tanggal_lahir' => optional($result->booking->pendaftaran->registerPasien)->TGL_LAHIR,
                'jenis_kelamin' => optional($result->booking->pendaftaran->registerPasien)->JENIS_KELAMIN,
                'nama_dokter' => optional($result->booking->dokter)->Nama_Dokter,
                // Post Tindakan
                'status_pasien' => optional($result->postTindakan)->status_pasien,
                'catatan_anestesi' => optional($result->postTindakan)->catatan_anestesi,
                'laporan_pembedahan' => optional($result->postTindakan)->laporan_pembedahan,
                'perencanaan_pasca_medis' => optional($result->postTindakan)->perencanaan_pasca_medis,
                'checklist_keselamatan_pasien' => optional($result->postTindakan)->checklist_keselamatan_pasien,
                'checklist_monitoring' => optional($result->postTindakan)->checklist_monitoring,
                'askep_perioperatif' => optional($result->postTindakan)->askep_perioperatif,
                'lembar_pemantauan' => optional($result->postTindakan)->lembar_pemantauan,
                'formulir_pemeriksaan' => optional($result->postTindakan)->formulir_pemeriksaan,
                'sampel_pemeriksaan' => optional($result->postTindakan)->sampel_pemeriksaan,
                'foto_rontgen_post' => optional($result->postTindakan)->foto_rontgen,
                'resep' => optional($result->postTindakan)->resep,
                'lainnya' => optional($result->postTindakan)->lainnya,
                'deskripsi_lainnya' => optional($result->postTindakan)->deskripsi_lainnya,
                // Post Alat
                'ngt' => optional($result->postAlat)->ngt,
                'drain' => optional($result->postAlat)->drain,
                'tampon_hidung' => optional($result->postAlat)->tampon_hidung,
                'tampon_gigi' => optional($result->postAlat)->tampon_gigi,
                'tampon_abdomen' => optional($result->postAlat)->tampon_abdomen,
                'tampon_vagina' => optional($result->postAlat)->tampon_vagina,
                'tranfusi' => optional($result->postAlat)->tranfusi,
                'ivfd_post' => optional($result->postAlat)->ivfd,
                'deskripsi_ivfd_post' => optional($result->postAlat)->deskripsi_ivfd,
                'kompres_luka' => optional($result->postAlat)->kompres_luka,
                'dc_post' => optional($result->postAlat)->dc,
                'lainnya' => optional($result->postAlat)->lainnya,
                'deskripsi_lainnya' => optional($result->postAlat)->deskripsi_lainnya,
                // Post Pemeriksaan Fisik
                'keadaan_umum_post' => optional($result->postPemeriksaanFisik)->keadaan_umum,
                'kesadaran_post' => optional($result->postPemeriksaanFisik)->kesadaran,
                'tekanan_darah_post' => optional($result->postPemeriksaanFisik)->tekanan_darah,
                'nadi_post' => optional($result->postPemeriksaanFisik)->nadi,
                'suhu_post' => optional($result->postPemeriksaanFisik)->suhu,
                'pernafasan_post' => optional($result->postPemeriksaanFisik)->pernafasan,
                'instruksi_dokter' => optional($result->postPemeriksaanFisik)->instruksi_dokter,
                // Pre Tindakan
                'lapor_dokter' => optional($result->preTindakan)->lapor_dokter,
                'lapor_kamar' => optional($result->preTindakan)->lapor_kamar,
                'surat_izin_pembedahan' => optional($result->preTindakan)->surat_izin_pembedahan,
                'tandai_daerah_operasi' => optional($result->preTindakan)->tandai_daerah_operasi,
                'memakai_gelang_identitas' => optional($result->preTindakan)->memakai_gelang_identitas,
                'melepas_aksesoris' => optional($result->preTindakan)->melepas_aksesoris,
                'menghapus_aksesoris' => optional($result->preTindakan)->menghapus_aksesoris,
                'melakukan_oral_hygiene' => optional($result->preTindakan)->melakukan_oral_hygiene,
                'memasang_bidai' => optional($result->preTindakan)->memasang_bidai,
                'memasang_infuse' => optional($result->preTindakan)->memasang_infuse,
                'memasang_dc' => optional($result->preTindakan)->memasang_dc,
                'deskripsi_dc' => optional($result->preTindakan)->deskripsi_dc,
                'memasang_ngt' => optional($result->preTindakan)->memasang_ngt,
                'deskripsi_ngt' => optional($result->preTindakan)->deskripsi_ngt,
                'memasang_drainage' => optional($result->preTindakan)->memasang_drainage,
                'memasang_wsd' => optional($result->preTindakan)->memasang_wsd,
                'mencukur_daerah_operasi' => optional($result->preTindakan)->mencukur_daerah_operasi,
                'lainnya' => optional($result->preTindakan)->lainnya,
                'deskripsi_lainnya' => optional($result->preTindakan)->deskripsi_lainnya,
                'penyakit_dm' => optional($result->preTindakan)->penyakit_dm,
                'penyakit_hipertensi' => optional($result->preTindakan)->penyakit_hipertensi,
                'penyakit_tb_paru' => optional($result->preTindakan)->penyakit_tb_paru,
                'penyakit_hiv' => optional($result->preTindakan)->penyakit_hiv,
                'penyakit_hepatitis' => optional($result->preTindakan)->penyakit_hepatitis,
                // Pre Pemeriksaan Fisik
                'tinggi_badan' => optional($result->prePemeriksaanFisik)->tinggi_badan,
                'berat_badan' => optional($result->prePemeriksaanFisik)->berat_badan,
                'tekanan_darah' => optional($result->prePemeriksaanFisik)->tekanan_darah,
                'nadi' => optional($result->prePemeriksaanFisik)->nadi,
                'suhu' => optional($result->prePemeriksaanFisik)->suhu,
                'pernafasan' => optional($result->prePemeriksaanFisik)->pernafasan,
                // Pre Data Umum
                'diagnosa' => optional($result->preDataUmum)->diagnosa,
                'created_by_pre' => optional(optional($result->preDataUmum)->user)->id > 0
                    ? optional($result->preDataUmum->user)->name
                    : NULL,
                'jenis_operasi' => optional($result->preDataUmum)->jenis_operasi,
                'nama_operator' => optional($result->preDataUmum)->nama_operator,
                'deskripsi' => optional($result->preDataUmum)->deskripsi,
                'puasa_jam' => optional($result->preDataUmum)->puasa_jam,
                'riwayat_asma' => optional($result->preDataUmum)->riwayat_asma,
                'alergi' => optional($result->preDataUmum)->alergi,
                'antibiotik_profilaksis' => optional($result->preDataUmum)->antibiotik_profilaksis,
                'antibiotik_profilaksis_jam' => optional($result->preDataUmum)->antibiotik_profilaksis_jam,
                'premedikasi' => optional($result->preDataUmum)->premedikasi,
                'premedikasi_jam' => optional($result->preDataUmum)->premedikasi_jam,
                'ivfd' => optional($result->preDataUmum)->ivfd,
                'dc' => optional($result->preDataUmum)->dc,
                'assesmen_pra_bedah' => optional($result->preDataUmum)->assesmen_pra_bedah,
                'edukasi_anastesi' => optional($result->preDataUmum)->edukasi_anastesi,
                'informed_consent_bedah' => optional($result->preDataUmum)->informed_consent_bedah,
                'informed_consent_anastesi' => optional($result->preDataUmum)->informed_consent_anastesi,
                'darah' => optional($result->preDataUmum)->darah,
                'gol' => optional($result->preDataUmum)->gol,
                'obat' => optional($result->preDataUmum)->obat,
                'rontgen' => optional($result->preDataUmum)->rontgen,
            ];
        }

        return null;
    }

    public function insert(array $data)
    {
        DB::beginTransaction();
        try {


            // pisahkan array dengan koma menjadi string
            $asisten_bedah = $data['asisten_bedah'] ?? '';
            $data['asisten_bedah'] = $asisten_bedah;
            if (!empty($asisten_bedah)) {
                $data['asisten_bedah'] = implode(', ', $asisten_bedah);
            }

            $asisten_anastesi = $data['asisten_anastesi'] ?? '';
            $data['asisten_anastesi'] = $asisten_anastesi;
            if (!empty($asisten_anastesi)) {
                $data['asisten_anastesi'] = implode(', ', $asisten_anastesi);
            }
            $dokter_anastesi = $data['dokter_anastesi'] ?? '';
            $data['dokter_anastesi'] = $dokter_anastesi;
            if (!empty($dokter_anastesi)) {
                $data['dokter_anastesi'] = implode(', ', $dokter_anastesi);
            }



            $data_umum_post_op = DataUmumPostOperasi::create([
                'kode_register' => $data['kode_register'],
                'diagnosa_prabedah' => $data['diagnosa_prabedah'],
                'diagnosa_pascabedah' => $data['diagnosa_pascabedah'],
                'jenis_operasi' => $data['jenis_operasi'],
                'dokter_operator' => $data['dokter_operator'],
                'asisten_bedah' => $data['asisten_bedah'],
                'jam_operasi' => $data['jam_operasi'],
                'jenis_anastesi' => $data['jenis_anastesi'],
                'dokter_anastesi' => $data['dokter_anastesi'],
                'asisten_anastesi' => $data['asisten_anastesi'],
                'created_by' => auth()->user()->id
            ]);


            $tindakanPostOperasi = TindakanPostOperasi::create([
                'kode_register' => $data['kode_register'],
                'status_pasien' => !empty($data['status_pasien']) ? 1 : 0,
                'catatan_anestesi' => !empty($data['catatan_anestesi']) ? 1 : 0,
                'laporan_pembedahan' => !empty($data['laporan_pembedahan']) ? 1 : 0,
                'perencanaan_pasca_medis' => !empty($data['perencanaan_pasca_medis']) ? 1 : 0,
                'checklist_keselamatan_pasien' => !empty($data['checklist_keselamatan_pasien']) ? 1 : 0,
                'checklist_monitoring' => !empty($data['checklist_monitoring']) ? 1 : 0,
                'askep_perioperatif' => !empty($data['askep_perioperatif']) ? 1 : 0,
                'lembar_pemantauan' => !empty($data['lembar_pemantauan']) ? 1 : 0,
                'formulir_pemeriksaan' => !empty($data['formulir_pemeriksaan']) ? 1 : 0,
                'sampel_pemeriksaan' => !empty($data['sampel_pemeriksaan']) ? 1 : 0,
                'foto_rontgen' => !empty($data['foto_rontgen']) ? 1 : 0,
                'resep' => !empty($data['resep']) ? 1 : 0,
                'lainnya' => !empty($data['lainnya']) ? 1 : 0,
                'deskripsi_lainnya' => $data['deskripsi_lainnya'] ?? '',
                'created_by' => auth()->user()->id
            ]);

            $alatPostOperasi = AlatPostOperasi::create([
                'kode_register' => $data['kode_register'],
                'ngt' => !empty($data['ngt']) ? 1 : 0,
                'drain' => !empty($data['drain']) ? 1 : 0,
                'tampon_hidung' => !empty($data['tampon_hidung']) ? 1 : 0,
                'tampon_gigi' => !empty($data['tampon_gigi']) ? 1 : 0,
                'tampon_abdomen' => !empty($data['tampon_abdomen']) ? 1 : 0,
                'tampon_vagina' => !empty($data['tampon_vagina']) ? 1 : 0,
                'tranfusi' => !empty($data['tranfusi']) ? 1 : 0,
                'ivfd' => !empty($data['ivfd']) ? 1 : 0,
                'deskripsi_ivfd' => $data['deskripsi_ivfd'] ?? '',
                'kompres_luka' => !empty($data['kompres_luka']) ? 1 : 0,
                'dc' => !empty($data['dc']) ? 1 : 0,
                'lainnya' => !empty($data['lainnya']) ? 1 : 0,
                'deskripsi_lainnya' => $data['deskripsi_lainnya'] ?? '',
                'created_by' => auth()->user()->id
            ]);

            $ttvPostOperasi = PemeriksaanFisikPostOperasi::create([
                'kode_register' => $data['kode_register'],
                'keadaan_umum' => $data['keadaan_umum'],
                'kesadaran' => $data['kesadaran'],
                'tekanan_darah' => $data['tekanan_darah'],
                'nadi' => $data['nadi'],
                'suhu' => $data['suhu'],
                'pernafasan' => $data['pernafasan'],
                'instruksi_dokter' => $data['instruksi_dokter'],
                'created_by' => auth()->user()->id
            ]);

            DB::commit();

            return [
                'data_umum_post_op' => $data_umum_post_op,
                'tindakan' => $tindakanPostOperasi,
                'alat' => $alatPostOperasi,
                'ttv' => $ttvPostOperasi
            ];
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new Exception("Gagal menambahkan Data Post Operasi: " . $th->getMessage());
        }
    }

    public function insertVerifPostOp($kode_register)
    {
        // dd($kode_register);
        DB::beginTransaction();
        try {

            $verifikasiRuanganPostOp = VerifikasiPostOperasi::create([
                'kode_register' => $kode_register,
                'user_id' => auth()->user()->id,
                'created_by' => auth()->user()->id,

            ]);


            DB::commit();

            return $verifikasiRuanganPostOp;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new Exception("Gagal memverifikasi Post Operasi: " . $th->getMessage());
        }
    }

    private function updateTable(string $modelClass, string $kodeRegister, array $fields)
    {
        // Fetch the existing record
        $record = $modelClass::where('kode_register', $kodeRegister)->first();

        // If no record exists, create a new one
        if (!$record) {
            $fields['kode_register'] = $kodeRegister;
            $modelClass::create($fields);
            return;
        }

        // Update the record only if there are changes
        $updatedFields = [];
        foreach ($fields as $key => $value) {
            if (array_key_exists($key, $record->getAttributes()) && $record->{$key} !== $value) {
                $updatedFields[$key] = $value;
            }
        }

        if (!empty($updatedFields)) {
            $record->update($updatedFields);
        }
    }


    public function update($kode_register, array $data)
    {
        DB::beginTransaction();
        try {

            // pisahkan array dengan koma menjadi string
            $asisten_bedah = $data['asisten_bedah'] ?? '';
            $data['asisten_bedah'] = $asisten_bedah;
            if (!empty($asisten_bedah)) {
                $data['asisten_bedah'] = implode(', ', $asisten_bedah);
            }

            $asisten_anastesi = $data['asisten_anastesi'] ?? '';
            $data['asisten_anastesi'] = $asisten_anastesi;
            if (!empty($asisten_anastesi)) {
                $data['asisten_anastesi'] = implode(', ', $asisten_anastesi);
            }
            $dokter_anastesi = $data['dokter_anastesi'] ?? '';
            $data['dokter_anastesi'] = $dokter_anastesi;
            if (!empty($dokter_anastesi)) {
                $data['dokter_anastesi'] = implode(', ', $dokter_anastesi);
            }

            // Update Table Tindakan Post Operasi
            $this->updateTable(DataUmumPostOperasi::class, $kode_register, [
                'diagnosa_prabedah' => $data['diagnosa_prabedah'],
                'diagnosa_pascabedah' => $data['diagnosa_pascabedah'],
                'jenis_operasi' => $data['jenis_operasi'],
                'dokter_operator' => $data['dokter_operator'],
                'asisten_bedah' => $data['asisten_bedah'],
                'jam_operasi' => $data['jam_operasi'],
                'jenis_anastesi' => $data['jenis_anastesi'],
                'dokter_anastesi' => $data['dokter_anastesi'],
                'asisten_anastesi' => $data['asisten_anastesi'],
                'updated_by' => auth()->user()->id
            ]);

            $this->updateTable(TindakanPostOperasi::class, $kode_register, [
                'status_pasien' => $data['status_pasien'] ?? 0,
                'catatan_anestesi' => $data['catatan_anestesi'] ?? 0,
                'laporan_pembedahan' => $data['laporan_pembedahan'] ?? 0,
                'perencanaan_pasca_medis' => $data['perencanaan_pasca_medis'] ?? 0,
                'checklist_keselamatan_pasien' => $data['checklist_keselamatan_pasien'] ?? 0,
                'checklist_monitoring' => $data['checklist_monitoring'] ?? 0,
                'askep_perioperatif' => $data['askep_perioperatif'] ?? 0,
                'lembar_pemantauan' => $data['lembar_pemantauan'] ?? 0,
                'formulir_pemeriksaan' => $data['formulir_pemeriksaan'] ?? 0,
                'sampel_pemeriksaan' => $data['sampel_pemeriksaan'] ?? 0,
                'foto_rontgen' => $data['foto_rontgen'] ?? 0,
                'resep' => $data['resep'] ?? 0,
                'lainnya' => $data['lainnya'] ?? 0,
                'deskripsi_lainnya' => $data['deskripsi_lainnya'] ?? '',
                'updated_by' => auth()->user()->id
            ]);

            // Update Table Alat Post Operasi
            $this->updateTable(AlatPostOperasi::class, $kode_register, [
                'ngt' => $data['ngt'] ?? 0,
                'drain' => $data['drain'] ?? 0,
                'tampon_hidung' => $data['tampon_hidung'] ?? 0,
                'tampon_gigi' => $data['tampon_gigi'] ?? 0,
                'tampon_abdomen' => $data['tampon_abdomen'] ?? 0,
                'tampon_vagina' => $data['tampon_vagina'] ?? 0,
                'tranfusi' => $data['tranfusi'] ?? 0,
                'ivfd' => $data['ivfd'] ?? 0,
                'deskripsi_ivfd' => $data['deskripsi_ivfd'] ?? '',
                'kompres_luka' => $data['kompres_luka'] ?? 0,
                'dc' => $data['dc'] ?? 0,
                'lainnya' => $data['lainnya'] ?? 0,
                'deskripsi_lainnya' => $data['deskripsi_lainnya'] ?? '',
                'updated_by' => auth()->user()->id
            ]);

            $this->updateTable(PemeriksaanFisikPostOperasi::class, $kode_register, [
                'keadaan_umum' => $data['keadaan_umum'] ?? '',
                'kesadaran' => $data['kesadaran'] ?? '',
                'tekanan_darah' => $data['tekanan_darah'] ?? '',
                'nadi' => $data['nadi'] ?? '',
                'suhu' => $data['suhu'] ?? '',
                'pernafasan' => $data['pernafasan'] ?? '',
                'instruksi_dokter' => $data['instruksi_dokter'] ?? '',
                'updated_by' => auth()->user()->id
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new Exception('Gagal memperbarui Data Post Operasi: ' . $e->getMessage());
        }
    }
}
