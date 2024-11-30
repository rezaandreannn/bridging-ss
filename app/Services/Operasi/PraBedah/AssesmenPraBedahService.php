<?php

namespace App\Services\Operasi\PraBedah;

use Exception;
use App\Models\Operasi\PraBedah\AssesmenPraBedah;

class AssesmenPraBedahService
{
    private function baseQuery()
    {
        return AssesmenPraBedah::with([
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
        $assesmen = $this->baseQuery()->get();
        return $this->mapData($assesmen);
    }

    public function findById($id)
    {
        return AssesmenPraBedah::find($id);
    }


    public function byRegister($kodeRegister)
    {
        $assesmen = AssesmenPraBedah::where('kode_register', $kodeRegister)
            ->get();

        return $assesmen;
    }

    public function insert(array $data)
    {
        try {
            $assesmen = AssesmenPraBedah::create([
                'kode_register' => $data['kode_register'],
                'anamnesa' => $data['anamnesa'],
                'pemeriksaan_fisik' => $data['pemeriksaan_fisik'],
                'diagnosa' => $data['diagnosa'],
            ]);

            return $assesmen;
        } catch (\Throwable $th) {
            throw new Exception("Gagal menambahkan Assesmen Pra Bedah: " . $th->getMessage());
        }
    }

    public function update($id, array $data)
    {
        try {
            // Mencari booking berdasarkan ID
            $assesmen = AssesmenPraBedah::findOrFail($id);

            // Melakukan update data
            $assesmen->update([
                'kode_register' => $data['kode_register'],
                'anamnesa' => $data['anamnesa'],
                'pemeriksaan_fisik' => $data['pemeriksaan_fisik'],
                'diagnosa' => $data['diagnosa'],
            ]);

            return $assesmen;
        } catch (\Throwable $th) {
            throw new Exception("Gagal memperbarui Assesmen Pra Bedah: " . $th->getMessage());
        }
    }

    public function delete($id)
    {
        $data = AssesmenPraBedah::find($id);
        return $data->delete();
    }

    private function mapData($assesmens)
    {
        return collect($assesmens->map(function ($item) {
            return (object) [
                'id' => $item->id,
                'kode_register' => $item->kode_register,
                'tanggal' => optional($item->booking)->tanggal,
                'anamnesa' => $item->anamnesa,
                'pemeriksaan_fisik' => $item->pemeriksaan_fisik,
                'diagnosa' => $item->diagnosa,
                'no_mr' => optional($item->booking->pendaftaran)->No_MR,
                'nama_pasien' => optional($item->booking->pendaftaran->registerPasien)->Nama_Pasien,
                'ruang_operasi' => optional($item->booking->ruangan)->nama_ruang,
                'nama_dokter' => optional($item->booking->dokter)->Nama_Dokter,
                'nama_tindakan' => optional($item->booking)->nama_tindakan
            ];
        }));
    }
}
