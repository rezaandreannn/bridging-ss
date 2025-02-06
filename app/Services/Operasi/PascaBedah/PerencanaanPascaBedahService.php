<?php

namespace App\Services\Operasi\PascaBedah;

use App\Models\Operasi\PascaBedah\PerencanaanPascaBedah;
use Exception;
use Illuminate\Support\Facades\DB;

class PerencanaanPascaBedahService
{
    private function baseQuery()
    {
        return PerencanaanPascaBedah::with([
            'booking' => function ($query) {
                $query->select('kode_register', 'tanggal', 'ruangan_id', 'kode_dokter', 'jenis_operasi')
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

    public function cetak($kode_register)
    {
        $result = PerencanaanPascaBedah::with([
            'booking' => function ($query) {
                $query->select('kode_register', 'tanggal', 'kode_dokter', 'jenis_operasi')->with([
                    'pendaftaran' => function ($query) {
                        $query->select('No_Reg', 'No_MR')
                            ->with(['registerPasien' => function ($query) {
                                $query->select(
                                    'No_MR',
                                    'Nama_Pasien',
                                    'ALAMAT',
                                    'JENIS_KELAMIN',
                                    DB::raw("FORMAT(TGL_LAHIR, 'yyyy-MM-dd') as TGL_LAHIR")
                                );
                            }]);
                    },
                    'dokter' => function ($query) {
                        $query->select('Kode_Dokter', 'Nama_Dokter');
                    }
                ]);
            }
        ])
            ->where('kode_register', $kode_register)
            ->first();

        if ($result) {
            return (object) [
                'id' => $result->id,
                'kode_register' => $result->kode_register,
                'tingkat_perawatan' => $result->tingkat_perawatan,
                'monitoring_ttv_start' => $result->monitoring_ttv_start,
                'monitoring_ttv_end' => $result->monitoring_ttv_end,
                'konsultasi_pelayanan' => $result->konsultasi_pelayanan,
                'terapi' => $result->terapi,
                'tanggal' => optional($result->booking)->tanggal,
                'no_mr' => optional($result->booking->pendaftaran)->No_MR,
                'nama_pasien' => optional($result->booking->pendaftaran->registerPasien)->Nama_Pasien,
                'tanggal_lahir' => optional($result->booking->pendaftaran->registerPasien)->TGL_LAHIR,
                'jenis_kelamin' => optional($result->booking->pendaftaran->registerPasien)->JENIS_KELAMIN,
                'nama_dokter' => optional($result->booking->dokter)->Nama_Dokter,
                'created_at' => $result->created_at->format('Y-m-d H:i:s'),

            ];
        }

        return null;
    }

    public function detailPascaBedah($kode_register)
    {
        $result = PerencanaanPascaBedah::with([
            'booking' => function ($query) {
                $query->select('kode_register', 'tanggal', 'kode_dokter', 'jenis_operasi')->with([
                    'pendaftaran' => function ($query) {
                        $query->select('No_Reg', 'No_MR')
                            ->with(['registerPasien' => function ($query) {
                                $query->select(
                                    'No_MR',
                                    'Nama_Pasien',
                                    'ALAMAT',
                                    'JENIS_KELAMIN',
                                    DB::raw("FORMAT(TGL_LAHIR, 'yyyy-MM-dd') as TGL_LAHIR")
                                );
                            }]);
                    },
                    'dokter' => function ($query) {
                        $query->select('Kode_Dokter', 'Nama_Dokter');
                    }
                ]);
            }
        ])
            ->where('kode_register', $kode_register)
            ->get();

        if ($result) {
            return collect($result->map(function ($item) {
                return (object) [
                    'id' => $item->id,
                    'kode_register' => $item->kode_register,
                    'tingkat_perawatan' => $item->tingkat_perawatan,
                    'monitoring_ttv_start' => $item->monitoring_ttv_start,
                    'monitoring_ttv_end' => $item->monitoring_ttv_end,
                    'konsultasi_pelayanan' => $item->konsultasi_pelayanan,
                    'terapi' => $item->terapi,
                    'tanggal' => optional($item->booking)->tanggal,
                    'no_mr' => optional($item->booking->pendaftaran)->No_MR,
                    'nama_pasien' => optional($item->booking->pendaftaran->registerPasien)->Nama_Pasien,
                    'tanggal_lahir' => optional($item->booking->pendaftaran->registerPasien)->TGL_LAHIR,
                    'jenis_kelamin' => optional($item->booking->pendaftaran->registerPasien)->JENIS_KELAMIN,
                    'nama_dokter' => optional($item->booking->dokter)->Nama_Dokter,
                    'created_at' => $item->created_at->format('Y-m-d H:i:s'),
                ];
            }));
        
        }

        return null;
    }


    public function findById($kodeRegister)
    {
        return PerencanaanPascaBedah::where('kode_register', $kodeRegister)->first();
    }


    public function byRegister($kodeRegister)
    {
        $pascaBedah = PerencanaanPascaBedah::where('kode_register', $kodeRegister)
            ->get();

        return $pascaBedah;
    }

    public function insert(array $data)
    {
        DB::beginTransaction();
        try {
            $pascaBedah = PerencanaanPascaBedah::create([
                'kode_register' => $data['kode_register'],
                'tingkat_perawatan' => $data['tingkat_perawatan'],
                'monitoring_ttv_start' => $data['monitoring_ttv_start'],
                'monitoring_ttv_end' => $data['monitoring_ttv_end'],
                'konsultasi_pelayanan' => $data['konsultasi_pelayanan'],
                'terapi' => $data['terapi'],
                'created_by' => auth()->user()->id
            ]);

            DB::commit();

            return $pascaBedah;
        } catch (\Throwable $th) {
            throw new Exception("Gagal menambahkan Data Pasca Bedah: " . $th->getMessage());
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
            $this->updateTable(PerencanaanPascaBedah::class, $kode_register, [
                'tingkat_perawatan' => $data['tingkat_perawatan'] ?? '',
                'monitoring_ttv_start' => $data['monitoring_ttv_start'] ?? '',
                'monitoring_ttv_end' => $data['monitoring_ttv_end'] ?? '',
                'konsultasi_pelayanan' => $data['konsultasi_pelayanan'] ?? '',
                'terapi' => $data['terapi'] ?? '',
                'updated_by' => auth()->user()->id
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new Exception('Gagal memperbarui Data Pasca Bedah: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        $data = PerencanaanPascaBedah::find($id);
        return $data->delete();
    }
}
