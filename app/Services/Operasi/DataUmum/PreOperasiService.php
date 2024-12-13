<?php

namespace App\Services\Operasi\DataUmum;

use Exception;
use Illuminate\Support\Facades\DB;
use App\Models\Operasi\PostOperasi\AlatPostOperasi;
use App\Models\Operasi\PreOperasi\TindakanPreOperasi;
use App\Models\Operasi\PostOperasi\TindakanPostOperasi;
use App\Models\Operasi\PostOperasi\PemeriksaanFisikPostOperasi;

class PreOperasiService
{

    public function findById($kode_register)
    {
        return [
            'tindakan' => TindakanPreOperasi::where('kode_register', $kode_register)->first(),
            'alat' => AlatPostOperasi::where('kode_register', $kode_register)->first(),
            'ttv' => PemeriksaanFisikPostOperasi::where('kode_register', $kode_register)->first()
        ];
    }

    public function insert(array $data)
    {
        DB::beginTransaction();
        try {
            $tindakanPreOperasi = TindakanPreOperasi::create([
                'kode_register' => $data['kode_register'],
                'lapor_dokter' => !empty($data['lapor_dokter']) ? 1 : 0,
                'lapor_kamar' => !empty($data['lapor_kamar']) ? 1 : 0,
                'surat_izin_pembedahan' => !empty($data['surat_izin_pembedahan']) ? 1 : 0,
                'tandai_daerah_operasi' => !empty($data['tandai_daerah_operasi']) ? 1 : 0,
                'memakai_gelang_identitas' => !empty($data['memakai_gelang_identitas']) ? 1 : 0,
                'melepas_aksesoris' => !empty($data['melepas_aksesoris']) ? 1 : 0,
                'menghapus_aksesoris' => !empty($data['menghapus_aksesoris']) ? 1 : 0,
                'melakukan_oral_hygiene' => !empty($data['melakukan_oral_hygiene']) ? 1 : 0,
                'memasang_bidai' => !empty($data['memasang_bidai']) ? 1 : 0,
                'memasang_infuse' => !empty($data['memasang_infuse']) ? 1 : 0,
                'memasang_dc' => !empty($data['memasang_dc']) ? 1 : 0,
                'deskripsi_dc' => $data['deskripsi_dc'] ?? '',
                'memasang_ngt' => !empty($data['memasang_ngt']) ? 1 : 0,
                'deskripsi_ngt' => $data['deskripsi_ngt'] ?? '',
                'memasang_drainage' => !empty($data['memasang_drainage']) ? 1 : 0,
                'memasang_wsd' => !empty($data['memasang_wsd']) ? 1 : 0,
                'mencukur_daerah_operasi' => !empty($data['mencukur_daerah_operasi']) ? 1 : 0,
                'lainnya' => !empty($data['lainnya']) ? 1 : 0,
                'deskripsi_lainnya' => $data['deskripsi_lainnya'] ?? '',
                'penyakit_dm' => !empty($data['penyakit_dm']) ? 1 : 0,
                'penyakit_hipertensi' => !empty($data['penyakit_hipertensi']) ? 1 : 0,
                'penyakit_tb_paru' => !empty($data['penyakit_tb_paru']) ? 1 : 0,
                'penyakit_hiv' => !empty($data['penyakit_hiv']) ? 1 : 0,
                'penyakit_hepatitis' => !empty($data['penyakit_hepatitis']) ? 1 : 0,
                'created_by' => auth()->user()->id
            ]);

            DB::commit();

            return [
                'tindakan' => $tindakanPreOperasi,
            ];
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new Exception("Gagal menambahkan Data Pre Operasi: " . $th->getMessage());
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

            // Update Table Tindakan Post Operasi
            $this->updateTable(TindakanPostOperasi::class, $kode_register, [
                'lapor_dokter' => $data['lapor_dokter'] ?? 0,
                'lapor_kamar' => $data['lapor_kamar'] ?? 0,
                'surat_izin_pembedahan' => $data['surat_izin_pembedahan'] ?? 0,
                'tandai_daerah_operasi' => $data['tandai_daerah_operasi'] ?? 0,
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

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new Exception('Gagal memperbarui Data Post Operasi: ' . $e->getMessage());
        }
    }
}
