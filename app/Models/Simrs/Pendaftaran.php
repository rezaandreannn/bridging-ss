<?php

namespace App\Models\Simrs;

use App\Models\Operasi\BookingOperasi;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $connection = 'db_rsmm';
    protected $table = 'PENDAFTARAN';

    // protected $with = ['registerPasien', 'ruang', 'biayaDetails'];

    public function registerPasien()
    {
        return $this->hasOne(RegisterPasien::class, 'No_MR', 'No_MR');
    }

    public function ruang()
    {
        return $this->belongsTo(Ruang::class, 'Kode_Ruang', 'Kode_Ruang');
    }

    public function biayaDetails()
    {
        return $this->hasMany(TrBiayaRinci::class, 'No_Reg', 'No_Reg');
    }
}
