<?php

namespace App\Services\SimRs;

use App\Models\Simrs\Pendaftaran;
use Carbon\Carbon;

class PendaftaranService
{
    public function byStatusActive()
    {
        $month = Date('m');
        $year = Date('Y');

        $endDate = date('Y-m-d');
        $startDate = date('Y-m-d', strtotime('-10 day', strtotime($endDate)));

        // dd($startDate);

        $pendaftaran = Pendaftaran::with([
            'registerPasien' => function ($query) {
                $query->select('No_MR', 'Nama_Pasien');
            }
        ])
            ->select('No_MR', 'No_Reg')
            ->where('Status', 1)
            ->whereBetween('Tanggal', [$startDate, $endDate])
            ->get();

        return collect($pendaftaran->map(function ($item) {
            return (object) [
                'kode_register' => $item->No_Reg,
                'no_mr' => $item->No_MR,
                'nama_pasien' => optional($item->registerPasien)->Nama_Pasien,
            ];
        }));
    }
}
