<?php

namespace App\Services\Operasi;

use Exception;
use Illuminate\Support\Facades\DB;
use App\Models\Operasi\BookingOperasi;

class BookingOperasiService
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

    public function biodata($noReg)
    {
        return BookingOperasi::with([
            'pendaftaran' => function ($query) {
                $query->select('No_Reg', 'No_MR')
                    ->with(['registerPasien' => function ($query) {
                        $query->select('No_MR', 'Nama_Pasien', 'ALAMAT', 'JENIS_KELAMIN', 'TGL_LAHIR');
                    }]);
            },
            'ruangan' => function ($query) {
                $query->select('id', 'kode_ruang', 'nama_ruang');
            },
            'dokter' => function ($query) {
                $query->select('Kode_Dokter', 'Nama_Dokter');
            }
        ])
            ->where('kode_register', $noReg)
            ->first();
    }

    public function get()
    {
        $databookings = $this->baseQuery()->get();
        return $this->mapData($databookings);
    }

    public function byDate($date)
    {
        $databookings = $this->baseQuery()
            ->whereDate('tanggal', $date)
            ->get();
        return $this->mapData($databookings);
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
            $booking = BookingOperasi::create([
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
            throw new Exception("Gagal menambahkan booking: " . $th->getMessage());
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
        $data->delete();
    }

    public function deleteWithRelation($id) {}

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
}
