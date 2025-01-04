<?php

namespace App\Services\MasterData;

use Exception;
use Illuminate\Support\Facades\DB;
use App\Models\Operasi\BookingOperasi;
use App\Models\Operasi\PenandaanOperasi;
use Illuminate\Support\Facades\Storage;
use App\Models\MasterData\TandaTanganDokter;
use App\Models\MasterData\TtdDokter;

class TandaTanganDokterService
{

    private function baseQuery()
    {
        if ((auth()->user()->roles->pluck('name')[0]) != 'super-admin'){
            $kode_dokter = auth()->user()->username;
            return TtdDokter::with([
                'dokter' => function ($query) {
                    $query->select('Kode_Dokter', 'Nama_Dokter','Jenis_Profesi','Spesialis')
                    ->where('Jenis_Profesi','DOKTER SPESIALIS');
                },
            ])
            ->where('kode_dokter',$kode_dokter)
            ->get();
        } 
        else{
            return TtdDokter::with([
                'dokter' => function ($query) {
                    $query->select('Kode_Dokter', 'Nama_Dokter','Jenis_Profesi','Spesialis')
                    ->where('Jenis_Profesi','DOKTER SPESIALIS');
                },
            ])
            ->get();
        }
    }

    public function get()
    {
        $tandatangandokter = $this->baseQuery();
        return $this->mapData($tandatangandokter);
    }

    public function findById($id)
    {
        return TtdDokter::find($id);
    }



    public function insert(array $data)
    {
        $image_parts = explode(";base64,", $data['ttd_dokter']);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);

        // Use uniqid to generate a unique file name
        $file_name = uniqid($data['kode_dokter'] . '-' . 'ttd_dokter' . '-' . date('Y-m-d') . '-') . '.' . $image_type;

        $data['ttd_dokter'] = $file_name;
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');

        try {
            $ttddokter = TtdDokter::create([
                'kode_dokter' => $data['kode_dokter'],
                'ttd_dokter' => $data['ttd_dokter'],
                'created_at' => $data['created_at'],
                'updated_at' => $data['updated_at'],
                // 'cara_masuk' => $data['cara_masuk'] ?? ''
            ]);

            Storage::put('public/ttd/dokter/' . $file_name, $image_base64);

            return $ttddokter;
        } catch (\Throwable $th) {
            throw new Exception("Gagal menambahkan tanda tangan: " . $th->getMessage());
        }
    }

    public function update($id, array $data)
    {
        $image_parts = explode(";base64,", $data['ttd_dokter']);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);

        // Use uniqid to generate a unique file name
        $file_name = uniqid($data['kode_dokter'] . '-' . 'ttd_dokter' . '-' . date('Y-m-d') . '-') . '.' . $image_type;

        try {
            // Mencari booking berdasarkan ID
            $ttddokter = TtdDokter::findOrFail($id);
            if ($ttddokter->ttd_dokter) {
                Storage::delete('public/ttd/dokter/' . $ttddokter->ttd_dokter);
            }
            // Melakukan update data
            $ttddokter->update([
                'kode_dokter' => $data['kode_dokter'],
                'ttd_dokter' => $file_name,
                'updated_at' => $data['updated_at']
            ]);
            
            Storage::put('public/ttd/dokter/' . $file_name, $image_base64);

            return $ttddokter;
        } catch (\Throwable $th) {
            throw new Exception("Gagal memperbarui tanda tangan: " . $th->getMessage());
        }
    }

    public function delete($id)
    {

        try{

            $data = TtdDokter::find($id);
            

            if ($data) {
                $pathImage = 'public/ttd/dokter/' . $data->ttd_dokter;
                Storage::delete($pathImage);
                return $data->delete();
            }

        } catch (\Throwable $th) {
            //throw $th;
            throw new Exception("Gagal menghapus tanda tangan: " . $th->getMessage());
        }
    }

    public function deleteWithRelations($id)
    {
        $booking = BookingOperasi::find($id);
        if ($booking) {
            $bookingKodeRegister = $booking->kode_register;

            // where by kode register in model penandaan
            $penandaan = PenandaanOperasi::where('kode_register', $bookingKodeRegister)->first();

            // hapus booking
            $booking->delete();

            // hapus penandaan
            if ($penandaan) {
                $path = 'public/operasi/' .  $penandaan->hasil_gambar;
                Storage::delete($path);
                $penandaan->delete();
            }
        }
    }

    private function mapData($ttddokter)
    {
        return collect($ttddokter->map(function ($item) {
            return (object) [
                'id' => $item->id,
                'kode_dokter' => $item->kode_dokter,
                'ttd_dokter' => $item->ttd_dokter,
                'nama_dokter' => optional($item->dokter)->Nama_Dokter,
                'spesialis' => optional($item->dokter)->Spesialis,
                'jenis_profesi' => optional($item->dokter)->Jenis_Profesi,
                'created_at' => optional($item->created_at)->format('Y-m-d H:i:s'),
                'updated_at' => optional($item->updated_at)->format('Y-m-d H:i:s')
            ];
        }));
    }
}
