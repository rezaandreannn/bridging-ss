<?php

namespace App\Services\Operasi\DataUmum;

use Exception;
use Illuminate\Support\Facades\DB;
use App\Models\Operasi\PostOperasi\AlatPostOperasi;
use App\Models\Operasi\PreOperasi\DataUmumPreOperasi;
use App\Models\Operasi\PreOperasi\TindakanPreOperasi;
use App\Models\Operasi\PostOperasi\TindakanPostOperasi;
use App\Models\Operasi\PreOperasi\VerifikasiPreOperasi;
use App\Models\Operasi\PreOperasi\PemeriksaanFisikPreOperasi;
use App\Models\Operasi\PostOperasi\PemeriksaanFisikPostOperasi;

class PreOperasiService
{

    public function findById($kode_register)
    {
        return [
            'tindakan' => TindakanPreOperasi::where('kode_register', $kode_register)->first(),
            'ttv' => PemeriksaanFisikPreOperasi::where('kode_register', $kode_register)->first(),
            'dataUmum' => DataUmumPreOperasi::where('kode_register', $kode_register)->first()
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

            $ttvPreOperasi = PemeriksaanFisikPreOperasi::create([
                'kode_register' => $data['kode_register'],
                'tinggi_badan' => $data['tinggi_badan'],
                'berat_badan' => $data['berat_badan'],
                'tekanan_darah' => $data['tekanan_darah'],
                'nadi' => $data['nadi'],
                'suhu' => $data['suhu'],
                'pernafasan' => $data['pernafasan'],
                'created_by' => auth()->user()->id
            ]);

            $dataUmumPreOperasi = DataUmumPreOperasi::create([
                'kode_register' => $data['kode_register'],
                'diagnosa' => $data['diagnosa'],
                'jenis_operasi' => $data['jenis_operasi'] ?? '',
                'nama_operator' => $data['nama_operator'],
                'puasa_jam' => $data['puasa_jam'] ?? '',
                'riwayat_asma' => !empty($data['riwayat_asma']) ? 1 : 0,
                'alergi' => $data['alergi'] ?? '',
                'antibiotik_profilaksis' => $data['antibiotik_profilaksis'] ?? '',
                'antibiotik_profilaksis_jam' => $data['antibiotik_profilaksis_jam'] ?? '',
                'premedikasi' => $data['premedikasi'] ?? '',
                'premedikasi_jam' => $data['premedikasi_jam'] ?? '',
                'ivfd' => $data['ivfd'] ?? '',
                'dc' => $data['dc'] ?? '',
                'assesmen_pra_bedah' => !empty($data['assesmen_pra_bedah']) ? 1 : 0,
                'informed_consent_bedah' => !empty($data['informed_consent_bedah']) ? 1 : 0,
                'informed_consent_anastesi' => !empty($data['informed_consent_anastesi']) ? 1 : 0,
                'edukasi_anastesi' => !empty($data['edukasi_anastesi']) ? 1 : 0,
                'darah' => $data['darah'] ?? '',
                'gol' => $data['gol'] ?? '',
                'obat' => $data['obat'] ?? '',
                'rontgen' => $data['rontgen'] ?? '',
                'created_by' => auth()->user()->id
            ]);

            DB::commit();

            return [
                'tindakan' => $tindakanPreOperasi,
                'ttv' => $ttvPreOperasi,
                'dataUmum' => $dataUmumPreOperasi,
            ];
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new Exception("Gagal menambahkan Data Pre Operasi: " . $th->getMessage());
        }
    }

    public function insertVerifPreOp($kode_register)
    {
        // dd($kode_register);
        DB::beginTransaction();
        try {
            
            $verifikasiAnastesiPreOp = VerifikasiPreOperasi::create([
                'kode_register' => $kode_register,
                'user_id' => auth()->user()->id,
                'created_by' => auth()->user()->id,

            ]);

        
            DB::commit();

            return $verifikasiAnastesiPreOp;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new Exception("Gagal memverivikasi Pre Operasi: " . $th->getMessage());
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
            $this->updateTable(TindakanPreOperasi::class, $kode_register, [
                'lapor_dokter' => $data['lapor_dokter'] ?? 0,
                'lapor_kamar' => $data['lapor_kamar'] ?? 0,
                'surat_izin_pembedahan' => $data['surat_izin_pembedahan'] ?? 0,
                'tandai_daerah_operasi' => $data['tandai_daerah_operasi'] ?? 0,
                'memakai_gelang_identitas' => $data['memakai_gelang_identitas'] ?? 0,
                'melepas_aksesoris' => $data['melepas_aksesoris'] ?? 0,
                'menghapus_aksesoris' => $data['menghapus_aksesoris'] ?? 0,
                'melakukan_oral_hygiene' => $data['melakukan_oral_hygiene'] ?? 0,
                'memasang_bidai' => $data['memasang_bidai'] ?? 0,
                'memasang_infuse' => $data['memasang_infuse'] ?? 0,
                'memasang_dc' => $data['memasang_dc'] ?? 0,
                'deskripsi_dc' => $data['deskripsi_dc'] ?? '',
                'memasang_ngt' => $data['memasang_ngt'] ?? 0,
                'deskripsi_ngt' => $data['deskripsi_ngt'] ?? '',
                'memasang_drainage' => $data['memasang_drainage'] ?? 0,
                'memasang_wsd' => $data['memasang_wsd'] ?? 0,
                'mencukur_daerah_operasi' => $data['mencukur_daerah_operasi'] ?? 0,
                'lainnya' => $data['lainnya'] ?? 0,
                'deskripsi_lainnya' => $data['deskripsi_lainnya'] ?? '',
                'penyakit_dm' => $data['penyakit_dm'] ?? 0,
                'penyakit_hipertensi' => $data['penyakit_hipertensi'] ?? 0,
                'penyakit_tb_paru' => $data['penyakit_tb_paru'] ?? 0,
                'penyakit_hiv' => $data['penyakit_hiv'] ?? 0,
                'penyakit_hepatitis' => $data['penyakit_hepatitis'] ?? 0,
                'updated_by' => auth()->user()->id
            ]);

            $this->updateTable(PemeriksaanFisikPreOperasi::class, $kode_register, [
                'tinggi_badan' => $data['tinggi_badan'] ?? '',
                'berat_badan' => $data['berat_badan'] ?? '',
                'tekanan_darah' => $data['tekanan_darah'] ?? '',
                'nadi' => $data['nadi'] ?? '',
                'suhu' => $data['suhu'] ?? '',
                'pernafasan' => $data['pernafasan'] ?? '',
                'updated_by' => auth()->user()->id
            ]);

            $this->updateTable(DataUmumPreOperasi::class, $kode_register, [
                'diagnosa' => $data['diagnosa'],
                'jenis_operasi' => $data['jenis_operasi'] ?? '',
                'nama_operator' => $data['nama_operator'] ?? '',
                'puasa_jam' => $data['puasa_jam'] ?? '',
                'riwayat_asma' => $data['riwayat_asma'] ?? 0,
                'alergi' => $data['alergi'] ?? '',
                'antibiotik_profilaksis' => $data['antibiotik_profilaksis'] ?? '',
                'antibiotik_profilaksis_jam' => $data['antibiotik_profilaksis_jam'] ?? '',
                'premedikasi' => $data['premedikasi'] ?? '',
                'premedikasi_jam' => $data['premedikasi_jam'] ?? '',
                'ivfd' => $data['ivfd'] ?? '',
                'dc' => $data['dc'] ?? '',
                'assesmen_pra_bedah' => $data['assesmen_pra_bedah'] ?? 0,
                'informed_consent_bedah' => $data['informed_consent_bedah'] ?? 0,
                'informed_consent_anastesi' => $data['informed_consent_anastesi'] ?? 0,
                'edukasi_anastesi' => $data['edukasi_anastesi'] ?? 0,
                'darah' => $data['darah'] ?? '',
                'gol' => $data['gol'] ?? '',
                'obat' => $data['obat'] ?? '',
                'rontgen' => $data['rontgen'] ?? '',
                'updated_by' => auth()->user()->id
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new Exception('Gagal memperbarui Data Post Operasi: ' . $e->getMessage());
        }
    }
}
