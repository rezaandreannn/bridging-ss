<?php

namespace App\Services\Operasi;

use App\Models\Operasi\TtdTandaOperasi;
use Exception;
use Illuminate\Support\Facades\DB;


class TtdTandaOperasiService
{
    private function baseQuery()
    {
        return TtdTandaOperasi::with([
            'booking' => function ($query){
                $query->select('kode_register','tanggal')->with([
                    'pendaftaran' => function ($query){
                        $query->select('No_Reg','No_MR')-> with ([
                            'registerPasien' => function($query){
                                $query->select('No_MR','Nama_Pasien');
                            }
                        ]);
                    }
                ]);
            }
        ]);
    }

    public function get()
    {
        $ttdpasiens = $this->baseQuery()->get();
        return $this->mapData($ttdpasiens);
    }

    public function byDate($date)
    {
        $ttdpasiens = $this->baseQuery()
            ->whereDate('tanggal', $date)
            ->get();
        return $this->mapData($ttdpasiens);
    }

    private function mapData($ttdpasiens)
    {
        return collect($ttdpasiens->map(function ($item) {
            return (object) [
                'id' => $item->id,
                'kode_register' => $item->kode_register,
                'ttd_pasien' => $item->ttd_pasien,
                'created_at' => $item->created_at->format('Y-m-d H:i:s'),
                'no_mr' => optional($item->booking->pendaftaran)->No_MR,
                'nama_pasien' => optional($item->booking->pendaftaran->registerPasien)->Nama_Pasien
            ];
        }));
    }
}