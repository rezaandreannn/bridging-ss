<?php

namespace App\Models\Operasi;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BookingOperasi extends Model
{
    use HasFactory;

    protected $connection = 'pku';
    protected $table = 'ok_booking_operasi';



    // Relasi
    public function ruangan()
    {
        return $this->belongsTo(RuanganOperasi::class);
    }
    // Batas Relasi


    public function getJadwalOperasi()
    {
        $data = DB::connection('pku')
            ->table('ok_booking_operasi')
            ->get();

        return $data;
    }
}
