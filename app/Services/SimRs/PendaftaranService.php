<?php

namespace App\Services\SimRs;

use Carbon\Carbon;
use App\Models\Simrs\Pendaftaran;
use Illuminate\Support\Facades\DB;

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

    public function byStatusActive2()
    {
        $month = Date('m');
        $year = Date('Y');

        $endDate = date('Y-m-d');
        $startDate = date('Y-m-d', strtotime('-10 day', strtotime($endDate)));

        // dd($startDate);
        $pendaftaran = DB::connection('db_rsmm')
            ->table('PENDAFTARAN as p')
            ->Join('REGISTER_PASIEN as rp', 'p.No_MR', '=', 'rp.No_MR')
            ->select(
                'p.No_Reg',
                'p.No_MR',
                'rp.Nama_Pasien'
            )
            ->whereBetween('p.Tanggal', [$startDate, $endDate])
            ->where('p.Status', '1')
            ->get();



        return collect($pendaftaran->map(function ($item) {
            return (object) [
                'kode_register' => $item->No_Reg,
                'no_mr' => $item->No_MR,
                'nama_pasien' => $item->Nama_Pasien,
            ];
        }));
    }
}
