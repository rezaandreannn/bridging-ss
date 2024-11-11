<?php

namespace App\Models\Simrs;

use App\Models\Operasi\BookingOperasi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dokter extends Model
{
    use HasFactory;

    protected $connection = 'db_rsmm';
    protected $table = 'dokter';

    public function bookings()
    {
        return $this->hasMany(BookingOperasi::class, 'Kode_Dokter', 'kode_dokter');
    }
}
