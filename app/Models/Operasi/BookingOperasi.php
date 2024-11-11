<?php

namespace App\Models\Operasi;

use App\Models\Simrs\Pendaftaran;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BookingOperasi extends Model
{
    use HasFactory;

    protected $connection = 'pku';
    protected $table = 'ok_booking_operasi';

    protected $with = ['pendaftaran', 'ruangan'];

    public function ruangan()
    {
        return $this->belongsTo(RuanganOperasi::class);
    }

    public function pendaftaran()
    {
        return $this->hasOne(Pendaftaran::class, 'No_Reg', 'kode_register');
    }
}
