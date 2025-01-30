<?php

namespace App\Models\Operasi;

use App\Models\MasterData\TtdDokter;
use App\Models\Simrs\Pendaftaran;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PenandaanOperasi extends Model
{
    use HasFactory;

    protected $connection = 'pku';
    protected $table = 'ok_tanda_operasi';

    // mass assigment
    protected $fillable = [
        'kode_register',
        'hasil_gambar',
        'jenis_operasi',
        'asal_ruangan',
        'created_by',
        'updated_by'
    ];

    public function booking()
    {
        return $this->hasOne(BookingOperasi::class, 'kode_register', 'kode_register');
    }

    public function ttdTandaPasien()
    {
        return $this->hasOne(TtdTandaOperasi::class, 'kode_register', 'kode_register');
    }

}
