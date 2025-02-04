<?php

namespace App\Services\Operasi\PraBedah;

use Exception;
use Illuminate\Support\Facades\DB;
use App\Models\Operasi\PraBedah\AssesmenPraBedah;
use App\Models\Operasi\PraBedah\VerifikasiPraBedahOther;

class AssesmenPraBedahService
{
    private function baseQuery()
    {
        return AssesmenPraBedah::with([
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

    public function cetakBerkas($kode_register)
    {
        $result = AssesmenPraBedah::with([
            'praBedahDarah' => function ($query) {
                $query->select(
                    'kode_register',
                    'darah',
                    'jumlah',
                    'gol',
                    'deskripsi'
                );
            },
            'praBedahBerkas' => function ($query) {
                $query->select(
                    'kode_register',
                    'status_pasien',
                    'assesmen_pra_bedah',
                    'penandaan_lokasi',
                    'informed_consent_bedah',
                    'informed_consent_anastesi',
                    'assesmen_pra_anastesi_sedasi',
                    'edukasi_anastesi',
                    'created_by'
                )->with([
                    'user' => function ($query) {
                        $query->select('id', 'name');
                    }
                ]);
            },

            'praBedahEkg' => function ($query) {
                $query->select(
                    'kode_register',
                    'ekg',
                    'deskripsi'
                );
            },

            'praBedahLab' => function ($query) {
                $query->select(
                    'kode_register',
                    'laboratorium',
                    'lab_hemoglobin',
                    'lab_leukosit',
                    'lab_trombosit',
                    'lab_hematrokit',
                    'lab_bt',
                    'lab_ct',
                );
            },

            'praBedahObat' => function ($query) {
                $query->select(
                    'kode_register',
                    'obat',
                    'deskripsi'
                );
            },

            'praBedahRadiologi' => function ($query) {
                $query->select(
                    'kode_register',
                    'radiologi',
                    'deskripsi'
                );
            },

            'praBedahOther' => function ($query) {
                $query->select(
                    'kode_register',
                    'estimasi_waktu',
                    'rencana_tindakan'
                );
            },

            'booking' => function ($query) {
                $query->with([
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
                ]);
            },
        ])
            ->where('kode_register', $kode_register)
            ->first();

        if ($result) {
            return (object) [
                'id' => $result->id,
                'kode_register' => $result->kode_register,
                'anamnesa' => $result->anamnesa,
                'pemeriksaan_fisik' => $result->pemeriksaan_fisik,
                'diagnosa' => $result->diagnosa,
                'planning' => $result->planning,
                'tanggal' => optional($result->booking)->tanggal,
                'jam_mulai' => optional($result->booking)->jam_mulai,
                'jam_selesai' => optional($result->booking)->jam_selesai,
                'no_mr' => optional($result->booking->pendaftaran)->No_MR,
                'nama_pasien' => optional($result->booking->pendaftaran->registerPasien)->Nama_Pasien,
                'tanggal_lahir' => optional($result->booking->pendaftaran->registerPasien)->TGL_LAHIR,
                'jenis_kelamin' => optional($result->booking->pendaftaran->registerPasien)->JENIS_KELAMIN,
                'nama_dokter' => optional($result->booking->dokter)->Nama_Dokter,
                // Tanda Tangan
                'ttd_pasien' => optional($result->ttdPasien)->ttd_pasien,
                'nama_ttd_pasien' => optional($result->ttdPasien)->nama_pasien,
                'ttd_dokter' => optional($result->booking->ttdDokter)->ttd_dokter,
                // Berkas
                'status_pasien' => optional($result->praBedahBerkas)->status_pasien,
                'assesmen_pra_bedah' => optional($result->praBedahBerkas)->assesmen_pra_bedah,
                'penandaan_lokasi' => optional($result->praBedahBerkas)->penandaan_lokasi,
                'informed_consent_bedah' => optional($result->praBedahBerkas)->informed_consent_bedah,
                'informed_consent_anastesi' => optional($result->praBedahBerkas)->informed_consent_anastesi,
                'assesmen_pra_anastesi_sedasi' => optional($result->praBedahBerkas)->assesmen_pra_anastesi_sedasi,
                'created_by' => optional(optional($result->praBedahBerkas)->user)->id > 0
                    ? optional($result->praBedahBerkas->user)->name
                    : NULL,
                // Darah
                'darah' => optional($result->praBedahDarah)->darah,
                'jumlah' => optional($result->praBedahDarah)->jumlah,
                'gol' => optional($result->praBedahDarah)->gol,
                'deskripsi_darah' => optional($result->praBedahDarah)->deskripsi,
                // Ekg
                'ekg' => optional($result->praBedahEkg)->ekg,
                'deskripsi_ekg' => optional($result->praBedahEkg)->deskripsi,
                // Lab
                'laboratorium' => optional($result->praBedahLab)->laboratorium,
                'lab_hemoglobin' => optional($result->praBedahLab)->lab_hemoglobin,
                'lab_leukosit' => optional($result->praBedahLab)->lab_leukosit,
                'lab_trombosit' => optional($result->praBedahLab)->lab_trombosit,
                'lab_hematrokit' => optional($result->praBedahLab)->lab_hematrokit,
                'lab_bt' => optional($result->praBedahLab)->lab_bt,
                'lab_ct' => optional($result->praBedahLab)->lab_ct,
                // Obat
                'obat' => optional($result->praBedahObat)->obat,
                'deskripsi_obat' => optional($result->praBedahObat)->deskripsi,
                // Radiologi
                'radiologi' => optional($result->praBedahRadiologi)->radiologi,
                'deskripsi_radiologi' => optional($result->praBedahRadiologi)->deskripsi,
                // Other
                'estimasi_waktu' => optional($result->praBedahOther)->estimasi_waktu,
                'rencana_tindakan' => optional($result->praBedahOther)->rencana_tindakan,

            ];
        }

        return null;
    }


    public function findById($kodeRegister)
    {
        return [
            'assesmen' => AssesmenPraBedah::where('kode_register', $kodeRegister)->first(),
            'other' => VerifikasiPraBedahOther::where('kode_register', $kodeRegister)->first(),
        ];
    }


    public function byRegister($kodeRegister)
    {
        $assesmen = AssesmenPraBedah::where('kode_register', $kodeRegister)
            ->get();

        return $assesmen;
    }

    public function insert(array $data)
    {
        DB::beginTransaction();
        try {
            $assesmen = AssesmenPraBedah::create([
                'kode_register' => $data['kode_register'],
                'anamnesa' => $data['anamnesa'],
                'pemeriksaan_fisik' => $data['pemeriksaan_fisik'],
                'diagnosa' => $data['diagnosa'],
                'planning' => $data['planning'],
                'created_by' => auth()->user()->id
            ]);

            $praBedahOther = VerifikasiPraBedahOther::create([
                'kode_register' => $data['kode_register'],
                'estimasi_waktu' => $data['estimasi_waktu'] ?? '',
                'rencana_tindakan' => $data['rencana_tindakan'] ?? '',
                'created_by' => auth()->user()->id
            ]);

            DB::commit();

            return [
                'assesmen' => $assesmen,
                'other' => $praBedahOther,
            ];
        } catch (\Throwable $th) {
            throw new Exception("Gagal menambahkan Assesmen Pra Bedah: " . $th->getMessage());
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
            $this->updateTable(AssesmenPraBedah::class, $kode_register, [
                'anamnesa' => $data['anamnesa'] ?? '',
                'pemeriksaan_fisik' => $data['pemeriksaan_fisik'] ?? '',
                'diagnosa' => $data['diagnosa'] ?? '',
                'planning' => $data['planning'] ?? '',
                'updated_by' => auth()->user()->id
            ]);

            $this->updateTable(VerifikasiPraBedahOther::class, $kode_register, [
                'estimasi_waktu' => $data['estimasi_waktu'] ?? '',
                'rencana_tindakan' => $data['rencana_tindakan'] ?? '',
                'updated_by' => auth()->user()->id
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new Exception('Gagal memperbarui Data Assesmen Pra Bedah: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        $data = AssesmenPraBedah::find($id);
        return $data->delete();
    }

    public function getLabByKodeReg($kodeRegister)
    {
        $result = DB::connection('db_rsmm')
            ->table('TR_MASTER_LAB as tml')
            ->join('TR_DETAIL_LAB as tdl', 'tdl.Id_Lab', '=', 'tml.Id_Lab')
            ->join('LAB_HASIL as lh', 'lh.Kode_Hasil', '=', 'tdl.Kode_Hasil')
            ->select('tml.No_Reg', 'tml.Tanggal', 'tdl.Hasil', 'lh.PEMERIKSAAN')
            ->where('tml.No_Reg', $kodeRegister)
            ->whereNotNull('tdl.Hasil')
            ->where('tdl.Hasil', '!=', '')
            ->where('tml.Tanggal', function ($query) {
                $query->selectRaw('MAX(tml_sub.Tanggal)')
                    ->from('TR_MASTER_LAB as tml_sub')
                    ->whereColumn('tml_sub.No_Reg', 'tml.No_Reg');
            });


        return $result->get();
    }
}
