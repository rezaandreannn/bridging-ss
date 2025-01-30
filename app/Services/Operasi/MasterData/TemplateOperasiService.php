<?php

namespace App\Services\Operasi\MasterData;

use App\Models\Operasi\MasterData\TemplateOperasi;
use Exception;
use Illuminate\Support\Facades\DB;
use App\Models\Operasi\PreOperasi\TindakanPreOperasi;
use App\Models\Operasi\PreOperasi\DataUmumPreOperasi;
use App\Models\Operasi\PreOperasi\PemeriksaanFisikPreOperasi;

class TemplateOperasiService
{

    public function findById($id)
    {
        return TemplateOperasi::find($id);
    }

    public function TemplateId($id)
    {
        return TemplateOperasi::where('macam_operasi', $id)->first();
    }

    public function delete($id)
    {
        $data = TemplateOperasi::find($id);
        return $data->delete();
    }


    public function insert(array $data)
    {
        DB::beginTransaction();
        try {

            $template = TemplateOperasi::create([
                'macam_operasi' => $data['macam_operasi'],
                'kode_dokter' => $data['kode_dokter'],
                'laporan_operasi' => $data['laporan_operasi'],
            ]);

            DB::commit();

            return $template;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new Exception("Gagal menambahkan Data Template Operasi: " . $th->getMessage());
        }
    }

    private function updateTable(string $modelClass, string $id, array $fields)
    {
        // Fetch the existing record
        $record = $modelClass::where('id', $id)->first();

        // If no record exists, create a new one
        if (!$record) {
            $fields['id'] = $id;
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


    public function update($id, array $data)
    {
        DB::beginTransaction();
        try {

            // Update Table Tindakan Post Operasi
            $this->updateTable(TemplateOperasi::class, $id, [
                'macam_operasi' => $data['macam_operasi'] ?? '',
                'kode_dokter' => $data['kode_dokter'] ?? '',
                'laporan_operasi' => $data['laporan_operasi'] ?? '',
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new Exception('Gagal memperbarui Data Post Operasi: ' . $e->getMessage());
        }
    }
}
