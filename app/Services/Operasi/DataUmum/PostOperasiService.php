<?php

namespace App\Services\Operasi\DataUmum;

use App\Models\Operasi\PostOperasi\AlatPostOperasi;
use App\Models\Operasi\PostOperasi\DataUmumPostOperasi;
use App\Models\Operasi\PostOperasi\PemeriksaanFisikPostOperasi;
use App\Models\Operasi\PostOperasi\TindakanPostOperasi;
use Exception;
use Illuminate\Support\Facades\DB;

class PostOperasiService
{

    public function findById($kode_register)
    {
        return [
            'tindakan' => TindakanPostOperasi::where('kode_register', $kode_register)->first(),
            'alat' => AlatPostOperasi::where('kode_register', $kode_register)->first(),
            'ttv' => PemeriksaanFisikPostOperasi::where('kode_register', $kode_register)->first(),
            'dataUmum'=> DataUmumPostOperasi::where('kode_register', $kode_register)->first()
        ];
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
