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
            },
            'user' => function ($query) {
                $query->select('id', 'name');
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

    public function byDate($date, $kodeBangsal = "", $kodeDokter = "")
    {
        if (!empty($kodeBangsal)) {
            $bookings = BookingOperasi::with([
                'pendaftaran.registerPasien',  
                'transaksiKamar' => function($query) {
                    $query->where('Status', 1);
                },
                'transaksiKamar.ruang.bangsal', 
                'dokter',  
            ])
            ->get();

            // dd($bookings);

            // Filter bookings berdasarkan kondisi yang diberikan
            $filtered = $bookings->filter(function ($booking) use ($date, $kodeBangsal) {
                // Ambil transaksiKamar pertama jika ada
                $transaksiKamar = $booking->transaksiKamar->first();

                // Cek apakah transaksiKamar ada
            if(!empty($booking->pendaftaran->ruang)){
                    
                if ($transaksiKamar && !empty($kodeBangsal)) {
                    // Cek apakah transaksiKamar punya ruang dan bangsal
                    $bangsal = optional($transaksiKamar->ruang->bangsal)->Kode_Bangsal;

                    if ((string) $bangsal === (string) $kodeBangsal) {
                        $tanggal = $booking->tanggal;
                        return $kodeBangsal && $tanggal == $date;
                    }
                } else {
                    // Jika kodeBangsal kosong, cek Ruang dan tanggal
                    $ruang = optional($booking->pendaftaran)->Kode_Ruang;
                    $tanggal = $booking->tanggal;

                    return empty($ruang) && ($tanggal && $tanggal == $date);
                }
            }

                return false;  // Jika tidak memenuhi kondisi
            });

            // jika tidak ada bangsal
        } else if (!empty($kodeDokter)) {
            $bookings = BookingOperasi::with([
                'pendaftaran.registerPasien',
                'dokter',
            ])->get();

            $filtered = $bookings->filter(function ($booking) use ($date, $kodeDokter) {
                $dokter = $booking->kode_dokter;

                if ($kodeDokter != null) {

                    if ((string) $dokter ===  $kodeDokter) {
                        $tanggal = $booking->tanggal;
                        return $tanggal && $tanggal == $date;
                    }
                }
            });
        } else {
            $bookings = BookingOperasi::with([
                'pendaftaran.registerPasien',
                'dokter',
            ])->get();
            // dd('ok');
            $filtered = $bookings->filter(function ($booking) use ($date) {

                $tanggal = $booking->tanggal;
                return $tanggal && $tanggal == $date;
            });

            // $filtered = $this->baseQuery()->get();
        }
        return $this->mapData($filtered);
    }

    public function byPasienAktif($date, $kodeBangsal = "", $kodeDokter = "")
    {
        if (!empty($kodeBangsal)) {
            $bookings = BookingOperasi::with([
                'pendaftaran.registerPasien',  
                'transaksiKamar' => function($query) {
                    $query->where('Status', 1);
                },
                'transaksiKamar.ruang.bangsal', 
                'dokter',  
            ])
            ->get();

            $filtered = $bookings->filter(function ($booking) use ($kodeBangsal) {
                if (!empty($kodeBangsal)) {

                    $transaksiKamar = $booking->transaksiKamar->first();

                    // Cek apakah transaksiKamar ada
                if(!empty($booking->pendaftaran->ruang)){
                        
                    if ($transaksiKamar && !empty($kodeBangsal)) {
                        // Cek apakah transaksiKamar punya ruang dan bangsal
                        $bangsal = optional($transaksiKamar->ruang->bangsal)->Kode_Bangsal;
    
                        if ((string) $bangsal === (string) $kodeBangsal) {
                            $statusAktif = $booking->pendaftaran->Status == '1';
                            return $kodeBangsal && $statusAktif;
                        }
                    } else {
                        // Jika kodeBangsal kosong, cek Ruang dan tanggal
                        $ruang = optional($booking->pendaftaran)->Kode_Ruang;
                        $statusAktif = $booking->pendaftaran->Status == '1';
    
                        return empty($ruang) && ($statusAktif);
                    }
                }
      
                } else {
                    $ruang = optional($booking->pendaftaran)->Kode_Ruang;
                    $statusAktif = $booking->pendaftaran->Status == '1';

                    return empty($ruang) && ($statusAktif);
                }
            });
        } else {
            $bookings = BookingOperasi::with([
                'pendaftaran.registerPasien',
                'pendaftaran.ruang.bangsal',
                'dokter',
            ])->get();

            $filtered = $bookings->filter(function ($booking) use ($date, $kodeDokter) {
                  // looping filter
                  $tanggal = $booking->tanggal;
                  
                  // looping filter   
                //   dd($kodedokter);

                    if ((string) $tanggal ===  $date) {
                        if(!empty($kodeDokter)){
                            $kodedokter = $booking->kode_dokter;
                            $statusAktif = $booking->pendaftaran->Status == '1';
                            $tanggal = $booking->tanggal;
                            return $kodedokter == $kodeDokter && $statusAktif;
                        }
                        $statusAktif = $booking->pendaftaran->Status == '1';
                        return $tanggal && $statusAktif;
                    }
        
            });
        } 

        // dd ($bookings);
        return $this->mapData($filtered);
    }

    public function byDateFormDokter($date, $kodeDokter = "")
    {
        if (!empty($kodeDokter)) {
            $bookings = BookingOperasi::with([
                'pendaftaran.registerPasien',
                'dokter',
            ])->get();

            $filtered = $bookings->filter(function ($booking) use ($date, $kodeDokter) {
                $dokter = $booking->kode_dokter;

                if ($kodeDokter != null) {

                    if ((string) $dokter ===  $kodeDokter) {
                        $tanggal = $booking->tanggal;
                        return $tanggal && $tanggal == $date;
                    }
                }
            });
        } else {
            $bookings = BookingOperasi::with([
                'pendaftaran.registerPasien',
                'dokter',
            ])->get();
            // dd('ok');
            $filtered = $bookings->filter(function ($booking) use ($date) {

                $tanggal = $booking->tanggal;
                return $tanggal && $tanggal == $date;
            });

            // $filtered = $this->baseQuery()->get();
        }
        return $this->mapData($filtered);
    }

    public function byDateFormDokterCadangan($date, $kodeDokter = "")
    {
        if (!empty($kodeDokter)) {
        
        $db_rsmm = DB::connection('db_rsmm')->getDatabaseName();
        $sqlsrv = DB::connection('sqlsrv')->getDatabaseName();
        $bookings = DB::connection('pku')
            ->table('ok_booking_operasi as ob')
            ->Join($db_rsmm . '.dbo.PENDAFTARAN as p', 'ob.kode_register', '=', 'p.No_REG')
            ->Join($db_rsmm . '.dbo.REGISTER_PASIEN as rp', 'p.No_MR', '=', 'rp.No_MR')
            ->Join($db_rsmm . '.dbo.DOKTER as d', 'ob.Kode_Dokter', '=', 'd.Kode_Dokter')
            ->Join($sqlsrv . '.dbo.Users as u', 'ob.created_by', '=', 'u.id')
            ->select(
                'ob.id',
                'ob.kode_register',
                'p.Tanggal',
                'p.No_MR',
                'rp.Nama_Pasien',
                'ob.asal_ruangan',
                'd.Nama_Dokter',
                'ob.jenis_operasi',
                'ob.terlaksana',
                'ob.rencana_operasi',
                'u.name',

            )
            ->where('ob.tanggal',$date)
            ->where('ob.kode_dokter',$kodeDokter)
            ->get();
        } 
        return $this->mapDataCadangan($bookings);
    }

    public function byDateFormIbsCadangan($date, $kodeDokter = "")
    {
        if (empty($kodeDokter)) {
        
        $db_rsmm = DB::connection('db_rsmm')->getDatabaseName();
        $sqlsrv = DB::connection('sqlsrv')->getDatabaseName();
        $bookings = DB::connection('pku')
            ->table('ok_booking_operasi as ob')
            ->Join($db_rsmm . '.dbo.PENDAFTARAN as p', 'ob.kode_register', '=', 'p.No_REG')
            ->Join($db_rsmm . '.dbo.REGISTER_PASIEN as rp', 'p.No_MR', '=', 'rp.No_MR')
            ->Join($db_rsmm . '.dbo.DOKTER as d', 'ob.Kode_Dokter', '=', 'd.Kode_Dokter')
            ->Join($sqlsrv . '.dbo.Users as u', 'ob.created_by', '=', 'u.id')
            ->select(
                'ob.id',
                'ob.kode_register',
                'p.Tanggal',
                'p.No_MR',
                'rp.Nama_Pasien',
                'ob.asal_ruangan',
                'd.Nama_Dokter',
                'ob.jenis_operasi',
                'ob.terlaksana',
                'ob.rencana_operasi',
                'u.name',

            )
            ->where('ob.tanggal',$date)
            ->get();
        } 
        return $this->mapDataCadangan($bookings);
    }

    // public function pascaBedahCekStatus( $kodeBangsal = "")
    // {
    //     if (!empty($kodeBangsal)) {
    //         $bookings = BookingOperasi::with([
    //             'pendaftaran.registerPasien',
    //             'pendaftaran.ruang.bangsal',
    //             'dokter',
    //         ])->get();

    //         $filtered = $bookings->filter(function ($booking) use ($kodeBangsal) {
    //             if (!empty($kodeBangsal)) {
    //                 if (!empty($booking->pendaftaran->ruang)) {
    //                     $bangsal = optional($booking->pendaftaran->ruang->bangsal)->Kode_Bangsal;

    //                     if ((string) $bangsal === (string) $kodeBangsal) {
    //                         $statusAktif = $booking->pendaftaran->Status == '1';
    //                         return $kodeBangsal && $statusAktif;
    //                     }
    //                 }
    //             } else {
    //                 $ruang = optional($booking->pendaftaran)->Kode_Ruang;
    //                 $statusAktif = $booking->pendaftaran->Status == '1';

    //                 return empty($ruang) && ($statusAktif);
    //             }
    //         });
    //     } else {
    //         $bookings = BookingOperasi::with([
    //             'pendaftaran.registerPasien',
    //             'pendaftaran.ruang.bangsal',
    //             'dokter',
    //         ])->get();
    //         // dd('ok');
    //         $filtered = $bookings->filter(function ($booking) use ($kodeBangsal) {

    //             return $kodeBangsal;
    //         });

    //         // $filtered = $this->baseQuery()->get();
    //     }
    //     return $this->mapData($filtered);
    // }

    public function byDokterOrAdmin($date, $kodeDokter)
    {
        $bookings = BookingOperasi::with([
            'pendaftaran.registerPasien',
            'pendaftaran.ruang.bangsal',
            'ruangan',
            'dokter',
        ])->get();


        $filterDateAndDokter = $bookings->filter(function ($booking) use ($date, $kodeDokter) {
            $dokter = $booking->kode_dokter;

            if ($kodeDokter != null) {

                if ((string) $dokter ===  $kodeDokter) {
                    $tanggal = $booking->tanggal;
                    return $tanggal && $tanggal == $date;
                }
            }
        });

        $filteredBukanDokter = $bookings->filter(function ($booking) use ($date) {
            $tanggal = $booking->tanggal;

            if ((string) $tanggal ===  $date) {
                $tanggal = $booking->tanggal;
                return $tanggal && $tanggal == $date;
            }
        });

        $filtered = ctype_digit($kodeDokter) ? $filterDateAndDokter : $filteredBukanDokter;

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

    public function findByRegister($kodeRegister)
    {
        return BookingOperasi::where('kode_register', $kodeRegister)->first();
    }

    public function insert(array $data)
    {
        try {
            $booking = BookingOperasi::create([
                'kode_register' => $data['kode_register'],
                'tanggal' => $data['tanggal'],
                'asal_ruangan' => $data['asal_ruangan'],
                // 'jenis_operasi' => $data['jenis_operasi'],
                'kode_dokter' => $data['kode_dokter'],
                'rencana_operasi' => $data['rencana_operasi'] ?? '',
                'created_by' => auth()->user()->id,
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
                'asal_ruangan' => $data['asal_ruangan'],
                // 'jenis_operasi' => $data['jenis_operasi'],
                'kode_dokter' => $data['kode_dokter'],
                'rencana_operasi' => $data['rencana_operasi'] ?? '',
                'updated_by' => auth()->user()->id,
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
            
            $transaksiKamar = $item->transaksiKamar->first();
            if ($transaksiKamar) {
                // Cek apakah transaksiKamar punya ruang dan bangsal
                $ruangan = optional($transaksiKamar->ruang)->Nama_Ruang;
            }
            else {
                $ruangan = '';

            }

            return (object) [
                'id' => $item->id,
                'kode_register' => $item->kode_register,
                'tanggal' => $item->tanggal,
                'no_mr' => optional($item->pendaftaran)->No_MR,
                'nama_pasien' => optional($item->pendaftaran->registerPasien)->Nama_Pasien ?? '',
                'asal_ruangan' => $item->asal_ruangan,
                'nama_dokter' => optional($item->dokter)->Nama_Dokter,
                'nama_ruangan' => $ruangan,
                'jenis_operasi' => $item->jenis_operasi,
                'terlaksana' => $item->terlaksana,
                'rencana_operasi' => $item->rencana_operasi,
                'cara_masuk' => $item->cara_masuk,
                'created_by' => optional($item->user)->name ?? '',
            ];
        }));
    }

    private function mapDataCadangan($databookings)
    {
        return collect($databookings->map(function ($item) {
     
            return (object) [
                'id' => $item->id,
                'kode_register' => $item->kode_register ?? '',
                'tanggal' => $item->Tanggal ?? '',
                'no_mr' => $item->No_MR ?? '',
                'nama_pasien' => $item->Nama_Pasien ?? '',
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
