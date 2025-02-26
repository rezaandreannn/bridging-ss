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
                $query->select('kode_register', 'tanggal', 'kode_dokter', 'jenis_operasi')
                    ->with([
                        'pendaftaran' => function ($query) {
                            $query->select('No_Reg', 'No_MR')
                                ->with(['registerPasien' => function ($query) {
                                    $query->select('No_MR', 'Nama_Pasien');
                                }]);
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
                $penandaans = $this->baseQuery()->limit('20')->get();
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
            ->where('kode_register', $kodeRegister)
            ->first();

        if ($penandaan) {
            return (object) [
                'id' => $penandaan->id,
                'kode_register' => $penandaan->kode_register,
                'tanggal' => optional($penandaan->booking)->tanggal,
                'gambar' => $penandaan->hasil_gambar,
                'no_mr' => optional($penandaan->booking->pendaftaran)->No_MR,
                'nama_pasien' => optional($penandaan->booking->pendaftaran->registerPasien)->Nama_Pasien,
                'tanggal_lahir' => optional($penandaan->booking->pendaftaran->registerPasien)->TGL_LAHIR,
                'asal_ruangan' => $penandaan->asal_ruangan,
                'nama_dokter' => optional($penandaan->booking->dokter)->Nama_Dokter,
                'ttd_dokter' => optional($penandaan->booking->ttdDokter)->ttd_dokter,
                'jenis_operasi' => $penandaan->jenis_operasi,
                'created_at' => $penandaan->created_at->format('Y-m-d H:i:s'),
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
            'asal_ruangan' => $data['asal_ruangan'],
            'jenis_operasi' => $data['jenis_operasi'],
            'created_by' => auth()->user()->id,
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
                    'asal_ruangan' => $data['asal_ruangan'],
                    'jenis_operasi' => $data['jenis_operasi'],
                    'updated_by' => auth()->user()->id,
                ]);
            });

            return $penandaan;
        } catch (\Throwable $th) {
            throw new Exception("Gagal memperbarui penandaan operasi: " . $th->getMessage());
        }
    }

    public function delete($kode_register)
    {
        // dd($kode_register);
        $idpenandaan = PenandaanOperasi::where('kode_register', $kode_register)->first();

        if ($idpenandaan) {
            // dd($id);
            $pathImage = 'public/operasi/penandaan-pasien/image/' . $idpenandaan->hasil_gambar;
            Storage::delete($pathImage);
            $deletePenandaan = PenandaanOperasi::find($idpenandaan->id);
            $deletePenandaan->delete();
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
                'jenis_operasi' => $item->jenis_operasi,
                'asal_ruangan' => $item->asal_ruangan,
                'no_mr' => optional($item->booking->pendaftaran)->No_MR,
                'nama_pasien' => optional($item->booking->pendaftaran->registerPasien)->Nama_Pasien,
                'nama_dokter' => optional($item->booking->dokter)->Nama_Dokter,
            ];
        }));
    }

    public function penandaanOperasi($date,$sessionBangsal,$kodeDokter){
   
        $db_rsmm = DB::connection('db_rsmm')->getDatabaseName();
        $sqlsrv = DB::connection('sqlsrv')->getDatabaseName();
        $bookings = DB::connection('pku')
            ->table('ok_booking_operasi as ob')
            ->leftJoin('ok_tanda_operasi as to', 'ob.kode_register', '=', 'to.kode_register')
            ->Join($db_rsmm . '.dbo.PENDAFTARAN as p', 'ob.kode_register', '=', 'p.No_REG')
            ->Join($db_rsmm . '.dbo.REGISTER_PASIEN as rp', 'p.No_MR', '=', 'rp.No_MR')
            ->Join($db_rsmm . '.dbo.DOKTER as d', 'ob.Kode_Dokter', '=', 'd.Kode_Dokter')
            ->leftJoin($db_rsmm . '.dbo.TR_KAMAR as tk', 'p.No_Reg', '=', 'tk.No_Reg')
            ->leftJoin($db_rsmm . '.dbo.M_RUANG as mr', 'tk.Kode_Ruang', '=', 'mr.Kode_Ruang')
            ->Join($sqlsrv . '.dbo.Users as u', 'ob.created_by', '=', 'u.id')
            ->select(
                'ob.id',
                'ob.kode_register',
                'p.Tanggal',
                'to.hasil_gambar',
                'ob.Tanggal as tanggal_booking',
                'p.No_MR',
                'rp.Nama_Pasien',
                'ob.asal_ruangan',
                'd.Nama_Dokter',
                'ob.jenis_operasi',
                'ob.terlaksana',
                'ob.rencana_operasi',
                'mr.Nama_Ruang',
                'mr.Kode_Ruang',
                'u.name',

            )
            ->where('p.Status','1');
       
            // kondisi jika sessionbangsal, tanggal dan kode dokter

        if ($sessionBangsal != null) {
            $bookings->where('mr.Kode_Bangsal', $sessionBangsal);
            $bookings->where('ob.Tanggal', $date);
            $bookings->where('tk.Status', '1');
        } else if ($kodeDokter == null){
            $bookings->where('ob.Tanggal', $date);
        } else if ($kodeDokter != null) {
            
            // Always filter by doctor and date
            $bookings->where('ob.Tanggal', $date);
            $bookings->where('ob.kode_dokter', $kodeDokter);
            
            // Check if there's a valid join with TR_KAMAR by ensuring No_Reg is not null
            $bookings->where(function($query) {
                $query->whereNull('tk.No_Reg')  // No join with TR_KAMAR (No_Reg is null)
                      ->orWhere('tk.Status', '1');  // Only apply status condition if there is a valid join
            });
        }
        
        $bookings = $bookings
        
            
            ->orderBy('ob.tanggal', 'DESC')
            ->get();

        return $this->mapDataPenandaan($bookings);
}

private function mapDataPenandaan($databookings)
{
    return collect($databookings->map(function ($item) {
 
        return (object) [
            'id' => $item->id,
            'kode_register' => $item->kode_register ?? '',
            'tanggal' => date('Y-m-d',strtotime($item->tanggal_booking)) ?? '',
            // 'tanggal_booking' => date('Y-m-d',strtotime($item->tanggal_booking)) ?? '',
            'no_mr' => $item->No_MR ?? '',
            'nama_pasien' => $item->Nama_Pasien ?? '',
            'gambar' => $item->hasil_gambar ?? '',
            'asal_ruangan' => $item->asal_ruangan ?? '',
            'nama_dokter' => $item->Nama_Dokter ?? '',
            'jenis_operasi' => $item->jenis_operasi ?? '',
            'terlaksana' => $item->terlaksana ?? '',
            'rencana_operasi' => $item->rencana_operasi ?? '',
            'created_by' => $item->name ?? '',
        ];
    }));
}
}
