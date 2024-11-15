<?php

namespace App\Services\Operasi;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Operasi\PenandaanOperasi;

class PenandaanOperasiService
{
    public function get()
    {
        return PenandaanOperasi::all();
    }

    public function byRegister($kodeRegister) {}
    public function byRegisterWithTtd($kodeRegister) {}

    public function insert(array $data)
    {
        $image_parts = explode(";base64,", $data['gambar']);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);

        // Use uniqid to generate a unique file name
        $file_name = uniqid($data['kode_register'] . '-' . 'ttd-pasien' . '-' . date('Y-m-d') . '-') . '.' . $image_type;

        // Save the image to storage
        Storage::put('public/ttd/penandaan-operasi-pasien/' . $file_name, $image_base64);

        dd($file_name);
    }
    public function update($id, array $data) {}
    public function delete($id) {}
}
