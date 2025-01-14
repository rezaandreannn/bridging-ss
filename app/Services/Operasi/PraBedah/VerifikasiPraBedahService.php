<?php

namespace App\Services\Operasi\PraBedah;

use Exception;
use Illuminate\Support\Facades\DB;
use App\Models\Operasi\PraBedah\VerifikasiPraBedahEkg;
use App\Models\Operasi\PraBedah\VerifikasiPraBedahLab;
use App\Models\Operasi\PraBedah\VerifikasiPraBedahObat;
use App\Models\Operasi\PraBedah\VerifikasiPraBedahDarah;
use App\Models\Operasi\PraBedah\VerifikasiPraBedahBerkas;
use App\Models\Operasi\PraBedah\VerifikasiPraBedahOther;
use App\Models\Operasi\PraBedah\VerifikasiPraBedahRadiologi;
use App\Models\Operasi\PraBedah\VerifikasiPraBedahRontgen;

class VerifikasiPraBedahService
{
    // private function baseQuery($kode_register)
    // {
    //     return [
    //         'berkas' => VerifikasiPraBedahBerkas::where('kode_register', $kode_register)->first(),
    //         'darah' => VerifikasiPraBedahDarah::where('kode_register', $kode_register)->first(),
    //         'ekg' => VerifikasiPraBedahEkg::where('kode_register', $kode_register)->first(),
    //         'lab' => VerifikasiPraBedahLab::where('kode_register', $kode_register)->first(),
    //         'obat' => VerifikasiPraBedahObat::where('kode_register', $kode_register)->first(),
    //         'rontgen' => VerifikasiPraBedahRontgen::where('kode_register', $kode_register)->first()
    //     ];
    // }

    // public function get($kode_register)
    // {
    //     return $this->baseQuery($kode_register);
    // }

    // private function mapData($assesmens)
    // {
    //     return collect($assesmens->map(function ($item) {
    //         return (object) [
    //             'id' => $item->id,
    //             'kode_register' => $item->kode_register,
    //             'tanggal' => optional($item->booking)->tanggal,
    //             'anamnesa' => $item->anamnesa,
    //             'pemeriksaan_fisik' => $item->pemeriksaan_fisik,
    //             'diagnosa' => $item->diagnosa,
    //             'no_mr' => optional($item->booking->pendaftaran)->No_MR,
    //             'nama_pasien' => optional($item->booking->pendaftaran->registerPasien)->Nama_Pasien,
    //             'ruang_operasi' => optional($item->booking->ruangan)->nama_ruang,
    //             'nama_dokter' => optional($item->booking->dokter)->Nama_Dokter,
    //             'nama_tindakan' => optional($item->booking)->nama_tindakan
    //         ];
    //     }));
    // }

    public function findById($kode_register)
    {
        return [
            'berkas' => VerifikasiPraBedahBerkas::where('kode_register', $kode_register)->first(),
            'obat' => VerifikasiPraBedahObat::where('kode_register', $kode_register)->first(),
            'ekg' => VerifikasiPraBedahEkg::where('kode_register', $kode_register)->first(),
            'lab' => VerifikasiPraBedahLab::where('kode_register', $kode_register)->first(),
            'radiologi' => VerifikasiPraBedahRadiologi::where('kode_register', $kode_register)->first(),
            'darah' => VerifikasiPraBedahDarah::where('kode_register', $kode_register)->first(),
            'other' => VerifikasiPraBedahOther::where('kode_register', $kode_register)->first(),
        ];
    }

    // public function insert(array $data)
    // {
    //     DB::beginTransaction();
    //     try {
    //         // Insert Table Berkas
    //         if (!empty($data['status_pasien']) || !empty($data['assesmen_pra_bedah']) || !empty($data['penandaan_lokasi']) || !empty($data['informed_consent_bedah']) || !empty($data['informed_consent_anastesi']) || !empty($data['assesmen_pra_anastesi_sedasi']) || !empty($data['edukasi_anastesi'])) {
    //             VerifikasiPraBedahBerkas::create([
    //                 'kode_register' => $data['kode_register'],
    //                 'status_pasien' => !empty($data['status_pasien']) ? 1 : 0,
    //                 'assesmen_pra_bedah' => !empty($data['assesmen_pra_bedah']) ? 1 : 0,
    //                 'penandaan_lokasi' => !empty($data['penandaan_lokasi']) ? 1 : 0,
    //                 'informed_consent_bedah' => !empty($data['informed_consent_bedah']) ? 1 : 0,
    //                 'informed_consent_anastesi' => !empty($data['informed_consent_anastesi']) ? 1 : 0,
    //                 'assesmen_pra_anastesi_sedasi' => !empty($data['assesmen_pra_anastesi_sedasi']) ? 1 : 0,
    //                 'edukasi_anastesi' => !empty($data['edukasi_anastesi']) ? 1 : 0,
    //             ]);
    //         }

    //         // Insert Table Darah (Hanya jika ada data terkait)
    //         if (!empty($data['darah']) || !empty($data['jumlah']) || !empty($data['gol']) || !empty($data['deskripsi_darah'])) {
    //             VerifikasiPraBedahDarah::create([
    //                 'kode_register' => $data['kode_register'],
    //                 'darah' => !empty($data['darah']) ? 1 : 0,
    //                 'jumlah' => $data['jumlah'] ?? '',
    //                 'gol' => $data['gol'] ?? '',
    //                 'deskripsi' => $data['deskripsi_darah'] ?? '',
    //             ]);
    //         }

    //         // Insert Table EKG (Hanya jika ada data terkait)
    //         if (!empty($data['ekg']) || !empty($data['deskripsi_ekg'])) {
    //             VerifikasiPraBedahEkg::create([
    //                 'kode_register' => $data['kode_register'],
    //                 'ekg' => !empty($data['ekg']) ? 1 : 0,
    //                 'deskripsi' => $data['deskripsi_ekg'] ?? '',
    //             ]);
    //         }

    //         // Insert Table Lab (Hanya jika ada data terkait)
    //         if (!empty($data['laboratorium']) || !empty($data['lab_hemoglobin']) || !empty($data['lab_leukosit']) || !empty($data['lab_trombosit']) || !empty($data['lab_hematrokit']) || !empty($data['lab_bt']) || !empty($data['lab_ct'])) {
    //             VerifikasiPraBedahLab::create([
    //                 'kode_register' => $data['kode_register'],
    //                 'laboratorium' => !empty($data['laboratorium']) ? 1 : 0,
    //                 'lab_hemoglobin' => $data['lab_hemoglobin'] ?? '',
    //                 'lab_leukosit' => $data['lab_leukosit'] ?? '',
    //                 'lab_trombosit' => $data['lab_trombosit'] ?? '',
    //                 'lab_hematrokit' => $data['lab_hematrokit'] ?? '',
    //                 'lab_bt' => $data['lab_bt'] ?? '',
    //                 'lab_ct' => $data['lab_ct'] ?? '',
    //             ]);
    //         }

    //         // Insert Table Obat (Hanya jika ada data terkait)
    //         if (!empty($data['obat']) || !empty($data['deskripsi_obat'])) {
    //             VerifikasiPraBedahObat::create([
    //                 'kode_register' => $data['kode_register'],
    //                 'obat' => !empty($data['obat']) ? 1 : 0,
    //                 'deskripsi' => $data['deskripsi_obat'] ?? '',
    //             ]);
    //         }

    //         // Insert Table Rontgen (Hanya jika ada data terkait)
    //         if (!empty($data['rontgen']) || !empty($data['deskripsi_rontgen'])) {
    //             VerifikasiPraBedahRontgen::create([
    //                 'kode_register' => $data['kode_register'],
    //                 'rontgen' => !empty($data['rontgen']) ? 1 : 0,
    //                 'deskripsi' => $data['deskripsi_rontgen'] ?? '',
    //             ]);
    //         }

    //         // Commit the transaction
    //         DB::commit();
    //     } catch (\Throwable $th) {
    //         DB::rollBack();
    //         // Throw a descriptive exception
    //         throw new Exception("Gagal menambahkan Verifikasi Pra Bedah: " . $th->getMessage(), 0, $th);
    //     }
    // }

    public function insert(array $data)
    {
        DB::beginTransaction();
        try {
            $praBedahBerkas = VerifikasiPraBedahBerkas::create([
                'kode_register' => $data['kode_register'],
                'status_pasien' => !empty($data['status_pasien']) ? 1 : 0,
                'assesmen_pra_bedah' => !empty($data['assesmen_pra_bedah']) ? 1 : 0,
                'penandaan_lokasi' => !empty($data['penandaan_lokasi']) ? 1 : 0,
                'informed_consent_bedah' => !empty($data['informed_consent_bedah']) ? 1 : 0,
                'informed_consent_anastesi' => !empty($data['informed_consent_anastesi']) ? 1 : 0,
                'assesmen_pra_anastesi_sedasi' => !empty($data['assesmen_pra_anastesi_sedasi']) ? 1 : 0,
                'edukasi_anastesi' => !empty($data['edukasi_anastesi']) ? 1 : 0,
                'created_by' => auth()->user()->id
            ]);

            $praBedahDarah = VerifikasiPraBedahDarah::create([
                'kode_register' => $data['kode_register'],
                'darah' => !empty($data['darah']) ? 1 : 0,
                'jumlah' => $data['jumlah'] ?? '',
                'gol' => $data['gol'] ?? '',
                'deskripsi' => $data['deskripsi_darah'] ?? '',
                'created_by' => auth()->user()->id
            ]);

            $praBedahEkg = VerifikasiPraBedahEkg::create([
                'kode_register' => $data['kode_register'],
                'ekg' => !empty($data['ekg']) ? 1 : 0,
                'deskripsi' => $data['deskripsi_ekg'] ?? '',
                'created_by' => auth()->user()->id
            ]);

            $praBedahLab = VerifikasiPraBedahLab::create([
                'kode_register' => $data['kode_register'],
                'laboratorium' => !empty($data['laboratorium']) ? 1 : 0,
                'lab_hemoglobin' => $data['lab_hemoglobin'] ?? '',
                'lab_leukosit' => $data['lab_leukosit'] ?? '',
                'lab_trombosit' => $data['lab_trombosit'] ?? '',
                'lab_hematrokit' => $data['lab_hematrokit'] ?? '',
                'lab_bt' => $data['lab_bt'] ?? '',
                'lab_ct' => $data['lab_ct'] ?? '',
                'created_by' => auth()->user()->id
            ]);

            $praBedahObat = VerifikasiPraBedahObat::create([
                'kode_register' => $data['kode_register'],
                'obat' => !empty($data['obat']) ? 1 : 0,
                'deskripsi' => $data['deskripsi_obat'] ?? '',
                'created_by' => auth()->user()->id
            ]);

            $praBedahRadiologi = VerifikasiPraBedahRadiologi::create([
                'kode_register' => $data['kode_register'],
                'radiologi' => !empty($data['radiologi']) ? 1 : 0,
                'deskripsi' => $data['deskripsi_radiologi'] ?? '',
                'created_by' => auth()->user()->id
            ]);



            DB::commit();

            return [
                'berkas' => $praBedahBerkas,
                'darah' => $praBedahDarah,
                'ekg' => $praBedahEkg,
                'lab' => $praBedahLab,
                'obat' => $praBedahObat,
                'radiologi' => $praBedahRadiologi,
            ];
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new Exception("Gagal menambahkan Verifikasi Pra Bedah: " . $th->getMessage());
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

            // Update Table Berkas
            $this->updateTable(VerifikasiPraBedahBerkas::class, $kode_register, [
                'status_pasien' => $data['status_pasien'] ?? 0,
                'assesmen_pra_bedah' => $data['assesmen_pra_bedah'] ?? 0,
                'penandaan_lokasi' => $data['penandaan_lokasi'] ?? 0,
                'informed_consent_bedah' => $data['informed_consent_bedah'] ?? 0,
                'informed_consent_anastesi' => $data['informed_consent_anastesi'] ?? 0,
                'assesmen_pra_anastesi_sedasi' => $data['assesmen_pra_anastesi_sedasi'] ?? 0,
                'edukasi_anastesi' => $data['edukasi_anastesi'] ?? 0,
                'updated_by' => auth()->user()->id
            ]);

            // Update Table Darah
            $this->updateTable(VerifikasiPraBedahDarah::class, $kode_register, [
                'darah' => $data['darah'] ?? 0,
                'jumlah' => $data['jumlah'] ?? '',
                'gol' => $data['gol'] ?? '',
                'deskripsi' => $data['deskripsi_darah'] ?? '',
                'updated_by' => auth()->user()->id
            ]);

            $this->updateTable(VerifikasiPraBedahEkg::class, $kode_register, [
                'ekg' => $data['ekg'] ?? 0,
                'deskripsi' => $data['deskripsi_ekg'] ?? '',
                'updated_by' => auth()->user()->id
            ]);

            $this->updateTable(VerifikasiPraBedahLab::class, $kode_register, [
                'laboratorium' => $data['laboratorium'] ?? 0,
                'lab_hemoglobin' => $data['lab_hemoglobin'] ?? '',
                'lab_leukosit' => $data['lab_leukosit'] ?? '',
                'lab_trombosit' => $data['lab_trombosit'] ?? '',
                'lab_hematrokit' => $data['lab_hematrokit'] ?? '',
                'lab_bt' => $data['lab_bt'] ?? '',
                'lab_ct' => $data['lab_ct'] ?? '',
                'updated_by' => auth()->user()->id
            ]);

            $this->updateTable(VerifikasiPraBedahObat::class, $kode_register, [
                'obat' => $data['obat'] ?? 0,
                'deskripsi' => $data['deskripsi_obat'] ?? '',
                'updated_by' => auth()->user()->id
            ]);

            $this->updateTable(VerifikasiPraBedahRadiologi::class, $kode_register, [
                'radiologi' => $data['radiologi'] ?? 0,
                'deskripsi' => $data['deskripsi_radiologi'] ?? '',
                'updated_by' => auth()->user()->id
            ]);

            $this->updateTable(VerifikasiPraBedahOther::class, $kode_register, [
                'estimasi_waktu' => $data['estimasi_waktu'] ?? '',
                'rencana_tindakan' => $data['rencana_tindakan'] ?? '',
                'updated_by' => auth()->user()->id
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new Exception('Gagal memperbarui Verifikasi Pra Bedah: ' . $e->getMessage());
        }
    }

    // public function update($kode_register, array $data)
    // {
    //     try {
    //         // Update Table Berkas
    //         $berkas = VerifikasiPraBedahBerkas::where('kode_register', $kode_register)->first();
    //         if ($berkas) {
    //             $berkas->update([
    //                 'status_pasien' => $data['status_pasien'] ?? $berkas->status_pasien,
    //                 'assesmen_pra_bedah' => $data['assesmen_pra_bedah'] ?? $berkas->assesmen_pra_bedah,
    //                 'penandaan_lokasi' => $data['penandaan_lokasi'] ?? $berkas->penandaan_lokasi,
    //                 'informed_consent_bedah' => $data['informed_consent_bedah'] ?? $berkas->informed_consent_bedah,
    //                 'informed_consent_anastesi' => $data['informed_consent_anastesi'] ?? $berkas->informed_consent_anastesi,
    //                 'assesmen_pra_anastesi_sedasi' => $data['assesmen_pra_anastesi_sedasi'] ?? $berkas->assesmen_pra_anastesi_sedasi,
    //                 'edukasi_anastesi' => $data['edukasi_anastesi'] ?? $berkas->edukasi_anastesi,
    //             ]);
    //         }

    //         // Update Table Darah
    //         $darah = VerifikasiPraBedahDarah::where('kode_register', $kode_register)->first();
    //         if ($darah) {
    //             $darah->update([
    //                 'darah' => $data['darah'] ?? $darah->darah,
    //                 'jumlah' => $data['jumlah'] ?? $darah->jumlah,
    //                 'gol' => $data['gol'] ?? $darah->gol,
    //                 'deskripsi' => $data['deskripsi_darah'] ?? $darah->deskripsi,
    //             ]);
    //         }

    //         // Update Table EKG
    //         $ekg = VerifikasiPraBedahEkg::where('kode_register', $kode_register)->first();
    //         if ($ekg) {
    //             $ekg->update([
    //                 'ekg' => $data['ekg'] ?? $ekg->ekg,
    //                 'deskripsi' => $data['deskripsi_ekg'] ?? $ekg->deskripsi,
    //             ]);
    //         }

    //         // Update Table Lab
    //         $lab = VerifikasiPraBedahLab::where('kode_register', $kode_register)->first();
    //         if ($lab) {
    //             $lab->update([
    //                 'laboratorium' => $data['laboratorium'] ?? $lab->laboratorium,
    //                 'lab_hemoglobin' => $data['lab_hemoglobin'] ?? $lab->lab_hemoglobin,
    //                 'lab_leukosit' => $data['lab_leukosit'] ?? $lab->lab_leukosit,
    //                 'lab_trombosit' => $data['lab_trombosit'] ?? $lab->lab_trombosit,
    //                 'lab_hematrokit' => $data['lab_hematrokit'] ?? $lab->lab_hematrokit,
    //                 'lab_bt' => $data['lab_bt'] ?? $lab->lab_bt,
    //                 'lab_ct' => $data['lab_ct'] ?? $lab->lab_ct,
    //             ]);
    //         }

    //         // Update Table Obat
    //         $obat = VerifikasiPraBedahObat::where('kode_register', $kode_register)->first();
    //         if ($obat) {
    //             $obat->update([
    //                 'obat' => $data['obat'] ?? $obat->obat,
    //                 'deskripsi' => $data['deskripsi_obat'] ?? $obat->deskripsi,
    //             ]);
    //         }

    //         // Update Table Rontgen
    //         $rontgen = VerifikasiPraBedahRontgen::where('kode_register', $kode_register)->first();
    //         if ($rontgen) {
    //             $rontgen->update([
    //                 'rontgen' => $data['rontgen'] ?? $rontgen->rontgen,
    //                 'deskripsi' => $data['deskripsi_rontgen'] ?? $rontgen->deskripsi,
    //             ]);
    //         }
    //     } catch (Exception $e) {
    //         throw new Exception("Gagal memperbarui data: " . $e->getMessage());
    //     }
    // }

}
