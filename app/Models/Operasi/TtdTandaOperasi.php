<?php

namespace App\Models\Operasi;

use App\Models\Simrs\Pendaftaran;
use App\Models\Simrs\RegisterPasien;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TtdTandaOperasi extends Model
{
    use HasFactory;

    protected $connection='pku';
    protected $table='ok_tanda_tangan_pasien';

    protected $with = ['booking'];

    public function booking()
    {
        return $this->belongsTo(BookingOperasi::class, 'kode_register', 'kode_register');
    }

    // public function register_pasien()
    // {
    //     return $this->belongsTo(RegisterPasien::class, 'No_Reg', 'kode_register');
    // }
}
