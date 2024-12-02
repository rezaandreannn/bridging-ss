<?php

namespace App\Services\Operasi;

use Exception;
use Illuminate\Support\Facades\DB;
use App\Models\Operasi\BookingOperasi;
use App\Models\Operasi\PenandaanOperasi;
use Illuminate\Support\Facades\Storage;

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

    public function byKodeBangsal($kodeBangsal = '')
    {
        $bookings = BookingOperasi::with([
            'pendaftaran.registerPasien',
            'pendaftaran.ruang.bangsal',
            'ruangan',
            'dokter',
        ])->get();

        $filtered = $bookings->filter(function ($booking) use ($kodeBangsal) {
            if (!empty($kodeBangsal)) {
                if (!empty($booking->pendaftaran->ruang)) {
                    $bangsal = optional($booking->pendaftaran->ruang->bangsal)->Kode_Bangsal;
                    return (string) $bangsal === (string) $kodeBangsal;
                }
            } else {
                $ruang = optional($booking->pendaftaran)->Kode_Ruang;
                return empty($ruang);
            }
        });

        return $this->mapData($filtered);
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

    public function get($kodeBangsal = '')
    {
        $bookings = BookingOperasi::with([
            'pendaftaran.registerPasien',
            'pendaftaran.ruang.bangsal',
            'ruangan',
            'dokter',
        ])->get();

        $filtered = $bookings->filter(function ($booking) use ($kodeBangsal) {
            if (!empty($kodeBangsal)) {
                if (!empty($booking->pendaftaran->ruang)) {
                    $bangsal = optional($booking->pendaftaran->ruang->bangsal)->Kode_Bangsal;
                    return (string) $bangsal === (string) $kodeBangsal;
                }
            } else {
                $ruang = optional($booking->pendaftaran)->Kode_Ruang;
                return empty($ruang);
            }
        });

        return $this->mapData($filtered);
    }

    public function byDate($date, $kodeBangsal)
    {
        $bookings = BookingOperasi::with([
            'pendaftaran.registerPasien',
            'pendaftaran.ruang.bangsal',
            'ruangan',
            'dokter',
        ])->get();

        $filtered = $bookings->filter(function ($booking) use ($date, $kodeBangsal) {
            if (!empty($kodeBangsal)) {
                if (!empty($booking->pendaftaran->ruang)) {
                    $bangsal = optional($booking->pendaftaran->ruang->bangsal)->Kode_Bangsal;

                    if ((string) $bangsal === (string) $kodeBangsal) {
                        $tanggal = $booking->tanggal;
                        return $tanggal && $tanggal == $date;
                    }
                }
            } else {
                $ruang = optional($booking->pendaftaran)->Kode_Ruang;
                $tanggal = $booking->tanggal;

                return empty($ruang) && ($tanggal && $tanggal == $date);
            }
        });

        return $this->mapData($filtered);
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
}
