<?php

namespace App\Services\Operasi\LaporanOperasi;

use Exception;
use App\Models\Simrs\Dokter;
use Illuminate\Support\Facades\DB;
use App\Models\Operasi\BookingOperasi;
use App\Models\Operasi\LaporanOperasi;
use Illuminate\Support\Facades\Storage;
use App\Models\Operasi\PenandaanOperasi;

class LaporanOperasiService
{
    private function baseQuery()
    {
        return BookingOperasi::with([
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

 

    public function byRegister($kodeRegister)
    {
        $databookings = $this->baseQuery()
            ->where('kode_register', $kodeRegister)
            ->get();
        return $this->mapData($databookings);
    }

    public function findById($id)
    {
        return BookingOperasi::find($id);
    }

    public function insert(array $data)
    {
        
        try {
            $laporanoperasi = LaporanOperasi::create([
                'kode_register' => $data['kode_register'],
                'tanggal' => $data['tanggal'],
                'diagnosa_pre_op' => $data['diagnosa_pre_op'],
                'diagnosa_post_op' => $data['diagnosa_post_op'],
                'jaringan_dieksekusi' => $data['jaringan_dieksekusi'],
                'mulai_operasi' => $data['mulai_operasi'] ?? '',
                'selesai_operasi' => $data['selesai_operasi'] ?? '',
                'lama_operasi' => $data['lama_operasi'] ?? '',
                'permintaan_pa' => $data['permintaan_pa'],
                'laporan_operasi' => $data['laporan_operasi'],
                'created_by' => auth()->user()->id,
                // 'cara_masuk' => $data['cara_masuk'] ?? ''
            ]);

            return $laporanoperasi;
        } catch (\Throwable $th) {
            throw new Exception("Gagal menambahkan laporan operasi: " . $th->getMessage());
        }
    }

    public function update($id, array $data)
    {
        try {
            // Mencari booking berdasarkan ID
            $booking = BookingOperasi::findOrFail($id);

            // Melakukan update data
            $booking->update([
                'kode_register' => $data['kode_register'],
                'tanggal' => $data['tanggal'],
                'ruangan_id' => $data['ruangan_id'],
                'nama_tindakan' => $data['nama_tindakan'],
                'kode_dokter' => $data['kode_dokter'],
                'jam_mulai' => $data['jam_mulai'] ?? '',
                'jam_selesai' => $data['jam_selesai'] ?? ''
                // 'cara_masuk' => $data['cara_masuk'] ?? ''
            ]);

            return $booking;
        } catch (\Throwable $th) {
            throw new Exception("Gagal memperbarui booking: " . $th->getMessage());
        }
    }

    public function delete($id)
    {
        $data = BookingOperasi::find($id);
        return $data->delete();
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

    private function mapData($databookings)
    {
        return collect($databookings->map(function ($item) {
            return (object) [
                'id' => $item->id,
                'kode_register' => $item->kode_register,
                'tanggal' => $item->tanggal,
                'no_mr' => optional($item->pendaftaran)->No_MR,
                'nama_pasien' => optional($item->pendaftaran->registerPasien)->Nama_Pasien,
                'ruang_operasi' => optional($item->ruangan)->nama_ruang,
                'nama_dokter' => optional($item->dokter)->Nama_Dokter,
                'nama_tindakan' => $item->nama_tindakan,
                'terlaksana' => $item->terlaksana,
                'jam_mulai' => $item->jam_mulai,
                'jam_selesai' => $item->jam_selesai,
                'cara_masuk' => $item->cara_masuk
            ];
        }));
    }
    

    // get data asisten anastesi

    public function getAsistenOperasi(){
        $data = Dokter::where('Jenis_Profesi','ASISTEN OPERASI')->get();
        return $this->mapDataAsisten($data);
    }
    
    public function getSpesialisAnastesi(){
        $data = Dokter::where('Spesialis','SPESIALIS ANASTESI')->get();
        return $this->mapDataAsisten($data);
    }

    public function getPenataAsisten(){
        $data = Dokter::where('Jenis_Profesi','PENATA ANESTESI')->get();
        return $this->mapDataAsisten($data);
    }

    private function mapDataAsisten($dataAsistens)
    {
        return collect($dataAsistens->map(function ($item) {
            return (object) [
                'kode_dokter' => $item->Kode_Dokter,
                'jenis_profesi' => $item->Jenis_Profesi,
                'nama_asisten' => $item->Nama_Dokter
            ];
        }));
    }
}
