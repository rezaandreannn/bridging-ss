<?php

namespace App\Services\Operasi;

use Exception;
use Illuminate\Support\Facades\DB;
use App\Models\Operasi\BookingOperasi;
use App\Models\Operasi\TtdTandaOperasi;
use Illuminate\Support\Facades\Storage;


class TtdTandaOperasiService
{
    private function baseQuery()
    {
        return TtdTandaOperasi::with([
            'booking' => function ($query) {
                $query->select('kode_register', 'tanggal')->with([
                    'pendaftaran' => function ($query) {
                        $query->select('No_Reg', 'No_MR')->with([
                            'registerPasien' => function ($query) {
                                $query->select('No_MR','Nama_Pasien');
                            }
                        ]);
                    }
                ]);
            }
        ]);
    }


    public function get()
    {
        $ttdpasiens = $this->baseQuery()->get();
        return $this->mapData($ttdpasiens);
    }

    public function findById($id)
    {
        return TtdTandaOperasi::find($id);
    }

    public function byDate($date)
    {
        $ttdpasiens = $this->baseQuery($date)
            ->get();
        return $ttdpasiens;
    }

    public function insert(array $data)
    {
        $image_parts = explode(";base64,", $data['ttd_pasien']);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);

        // Use uniqid to generate a unique file name
        $file_name = uniqid($data['kode_register'] . '-' . 'ttd-pasien' . '-' . date('Y-m-d') . '-') . '.' . $image_type;

        if ($data['pasien'] == 1) {
            $nama = $data['nama_keluarga'];
        }

        $nama_pasien = $nama ?? $data['nama_pasien'];
        $data['nama_pasien'] = $nama_pasien;
        $data['ttd_pasien'] = $file_name;
        $data['created_at'] = date('Y-m-d');
        $data['updated_at'] = date('Y-m-d');


        try {
            // Save the image to storage
            $ttdtandapasien = TtdTandaOperasi::create([
                'kode_register' => $data['kode_register'],
                'nama_pasien' => $data['nama_pasien'],
                'ttd_pasien' => $data['ttd_pasien'],
                'created_at' => $data['created_at'],
                'updated_at' => $data['updated_at']
            ]);

            Storage::put('public/operasi/penandaan-pasien/ttd/' . $file_name, $image_base64);

            return $ttdtandapasien;
        } catch (\Throwable $th) {
            throw new Exception("Gagal menambahkan booking: " . $th->getMessage());
        }
    }


    public function update($id, array $data)
    {
        $image_parts = explode(";base64,", $data['ttd_pasien']);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);

        // Use uniqid to generate a unique file name
        $file_name = uniqid($data['kode_register'] . '-' . 'ttd-pasien' . '-' . date('Y-m-d') . '-') . '.' . $image_type;

        try {
            // Mencari booking berdasarkan ID
            $ttdtandapasien = TtdTandaOperasi::findOrFail($id);
            // jika gambar sudah ada lakukan hapus
            if ($ttdtandapasien->ttd_pasien) {
                Storage::delete('public/operasi/penandaan-pasien/ttd/' . $ttdtandapasien->ttd_pasien);
            }
            // Melakukan update data
            $ttdtandapasien->update([
                'kode_register' => $data['kode_register'],
                'nama_pasien' => $data['nama_pasien'],
                'ttd_pasien' => $file_name,
                'updated_at' => $data['updated_at']
            ]);

            Storage::put('public/operasi/penandaan-pasien/ttd/' . $file_name, $image_base64);

            return $ttdtandapasien;
        } catch (\Throwable $th) {
            throw new Exception("Gagal memperbarui booking: " . $th->getMessage());
        }
    }

    public function delete($id)
    {
        $ttdtandapasien = TtdTandaOperasi::find($id);
            // hapus penandaan
        
            if ($ttdtandapasien) {
                $path = 'public/operasi/penandaan-pasien/ttd/' .  $ttdtandapasien->ttd_pasien;
                Storage::delete($path);
                $ttdtandapasien->delete();
            }

        return $ttdtandapasien->delete();
    }

    private function mapData($ttdpasiens)
    {
        return collect($ttdpasiens->map(function ($item) {
            return (object) [
                'id' => $item->id,
                'kode_register' => $item->kode_register ?? '',
                'ttd_pasien' => $item->ttd_pasien ?? '',
                'created_at' => $item->created_at->format('Y-m-d H:i:s') ?? '',
                'no_mr' => optional($item->booking->pendaftaran)->No_MR ?? '',
                'nama_pasien' => $item->booking->pendaftaran->registerPasien->Nama_Pasien ?? '',
                'nama_penanda_tangan' => $item->nama_pasien ?? '',
                'tanggal_operasi' => optional($item->booking)->tanggal ?? ''
            ];
        }));
    }
}
