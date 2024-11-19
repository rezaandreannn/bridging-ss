<?php

namespace App\Services\Operasi;

use Exception;
use Illuminate\Support\Facades\DB;
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
        return PenandaanOperasi::find($id);
    }


    public function byRegister($kodeRegister)
    {
        $penandaan = PenandaanOperasi::where('kode_register', $kodeRegister)
            ->get();

        return $penandaan;
    }

    public function unduhByRegister($kodeRegister)
    {
        $penandaan = PenandaanOperasi::with([
            'ttdTandaPasien' => function ($query) {
                $query->select('kode_register', 'ttd_pasien', 'nama_pasien');
            },
            'booking' => function ($query) {
                $query->with([
                    'pendaftaran' => function ($query) {
                        $query->select('No_Reg', 'No_MR')
                            ->with(['registerPasien' => function ($query) {
                                $query->select('No_MR', 'Nama_Pasien', 'ALAMAT', 'JENIS_KELAMIN', 'TGL_LAHIR');
                            }]);
                    },
                ]);
            }
        ])
            ->first();

        if ($penandaan) {
            return (object) [
                'id' => $penandaan->id,
                'kode_register' => $penandaan->kode_register,
                'tanggal' => optional($penandaan->booking)->tanggal,
                'gambar' => $penandaan->hasil_gambar,
                'ttd_pasien' => optional($penandaan->ttdTandaPasien)->ttd_pasien,
                'nama_ttd_pasien' => optional($penandaan->ttdTandaPasien)->nama_pasien,
                'no_mr' => optional($penandaan->booking->pendaftaran)->No_MR,
                'nama_pasien' => optional($penandaan->booking->pendaftaran->registerPasien)->Nama_Pasien,
                'tanggal_lahir' => optional($penandaan->booking->pendaftaran->registerPasien)->TGL_LAHIR,
                'ruang_operasi' => optional($penandaan->booking->ruangan)->nama_ruang,
                'nama_dokter' => optional($penandaan->booking->dokter)->Nama_Dokter,
                'nama_tindakan' => optional($penandaan->booking)->nama_tindakan,
                'jam_mulai' => optional($penandaan->booking)->jam_mulai,
                'jam_selesai' => optional($penandaan->booking)->jam_selesai,
            ];
        }

        return null;
    }

    public function insert(array $data)
    {
        $image_parts = explode(";base64,", $data['hasil_gambar']);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);

        // Use uniqid to generate a unique file name
        $file_name = uniqid($data['kode_register'] . '-' . 'tanda-operasi' . '-' . date('Y-m-d') . '-') . '.' . $image_type;

        // Save the image to storage
        Storage::put('public/operasi/penandaan-pasien/image/' . $file_name, $image_base64);

        $penandaan = PenandaanOperasi::create([
            'kode_register' => $data['kode_register'],
            'hasil_gambar' => $file_name,
            'jenis_operasi' => $data['jenis_operasi']
        ]);

        return $penandaan;
    }

    public function update($id, array $data)
    {
        try {
            // Mencari booking berdasarkan ID
            $penandaan = PenandaanOperasi::findOrFail($id);

            $image_parts = explode(";base64,", $data['hasil_gambar']);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);

            // Use uniqid to generate a unique file name
            $file_name = uniqid($data['kode_register'] . '-' . 'tanda-operasi' . '-' . date('Y-m-d') . '-') . '.' . $image_type;

            DB::transaction(function () use ($penandaan, $data, $file_name, $image_base64) {
                Storage::delete('public/operasi/penandaan-pasien/image/' . $penandaan->hasil_gambar);
                Storage::put('public/operasi/penandaan-pasien/image/' . $file_name, $image_base64);
                $penandaan->update([
                    'kode_register' => $data['kode_register'],
                    'hasil_gambar' => $file_name,
                    'jenis_operasi' => $data['jenis_operasi']
                ]);
            });

            return $penandaan;
        } catch (\Throwable $th) {
            throw new Exception("Gagal memperbarui penandaan operasi: " . $th->getMessage());
        }
    }

    public function delete($id)
    {
        $penandaan = PenandaanOperasi::find($id);

        if ($penandaan) {
            $pathImage = 'public/operasi/penandaan-pasien/image/' . $penandaan->hasil_gambar;
            Storage::delete($pathImage);
            $penandaan->delete();
        }
    }

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
