<?php

namespace App\Services\Operasi;


use Illuminate\Support\Facades\Storage;
use App\Models\Operasi\PenandaanOperasi;

class PenandaanOperasiService
{
    private function baseQuery()
    {
        return PenandaanOperasi::with([
            'booking' => function ($query) {
                $query->select('kode_register', 'tanggal', 'ruangan_id', 'kode_dokter', 'nama_tindakan')
                    ->with([
                        'pendaftaran' => function ($query) {
                            $query->select('No_Reg', 'No_MR')
                                ->with(['registerPasien' => function ($query) {
                                    $query->select('No_MR', 'Nama_Pasien');
                                }]);
                        },
                        'ruangan' => function ($query) {
                            $query->select('id', 'kode_ruang', 'nama_ruang');
                        },
                        'dokter' => function ($query) {
                            $query->select('Kode_Dokter', 'Nama_Dokter');
                        }
                    ]);
            }
        ]);
    }

    public function get()
    {
        $penandaans = $this->baseQuery()->get();
        return $this->mapData($penandaans);
    }

    public function findById($id)
    {
        $penandaan = PenandaanOperasi::find($id);
        return $this->mapData($penandaan);
    }


    public function byRegister($kodeRegister)
    {
        $penandaan = PenandaanOperasi::where('kode_register', $kodeRegister)
            ->get();

        return $penandaan;
    }

    public function byRegisterWithTtd($kodeRegister) {}

    public function insert(array $data)
    {
        $image_parts = explode(";base64,", $data['hasil_gambar']);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);

        // Use uniqid to generate a unique file name
        $file_name = uniqid($data['kode_register'] . '-' . 'tanda-operasi' . '-' . date('Y-m-d') . '-') . '.' . $image_type;

        // Save the image to storage
        Storage::put('public/operasi/penandan-lokasi-pasien' . $file_name, $image_base64);

        $penandaan = PenandaanOperasi::create([
            'kode_register' => $data['kode_register'],
            'hasil_gambar' => $file_name,
            'jenis_operasi' => $data['jenis_operasi']
        ]);

        return $penandaan;
    }
    public function update($id, array $data) {}
    public function delete($id) {}

    private function mapData($penandaans)
    {
        return collect($penandaans->map(function ($item) {
            return (object) [
                'id' => $item->id,
                'kode_register' => $item->kode_register,
                'tanggal' => optional($item->booking)->tanggal,
                'gambar' => $item->hasil_gambar,
                'no_mr' => optional($item->booking->pendaftaran)->No_MR,
                'nama_pasien' => optional($item->booking->pendaftaran->registerPasien)->Nama_Pasien,
                'ruang_operasi' => optional($item->booking->ruangan)->nama_ruang,
                'nama_dokter' => optional($item->booking->dokter)->Nama_Dokter,
                'nama_tindakan' => optional($item->booking)->nama_tindakan
            ];
        }));
    }
}
