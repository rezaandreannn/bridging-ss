<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OperasiKamar extends Model
{
    use HasFactory;

    // Master Data Ruangan (OK)
    public function getRuang()
    {
        $data = DB::connection('pku')
            ->table('ok_ruangan')
            ->get();

        return $data;
    }

    public function getJadwalOperasi()
    {
        $data = DB::connection('pku')
            ->table('ok_booking_operasi')
            ->get();

        return $data;
    }
}
