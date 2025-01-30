<?php

namespace App\Models\Operasi\PraBedah;

use App\Models\MasterData\TtdPerawat;
use App\Models\Operasi\BookingOperasi;
use App\Models\Operasi\TtdTandaOperasi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AssesmenPraBedah extends Model
{
    use HasFactory;

    protected $connection = 'pku';
    protected $table = 'ok_assesmen_pra_bedah';

    protected $fillable = [
        'kode_register',
        'anamnesa',
        'pemeriksaan_fisik',
        'diagnosa',
        'planning',
        'created_by',
        'updated_by'
    ];

    public function booking()
    {
        return $this->hasOne(BookingOperasi::class, 'kode_register', 'kode_register');
    }

    public function ttdPasien()
    {
        return $this->hasOne(TtdTandaOperasi::class, 'kode_register', 'kode_register');
    }

    public function praBedahBerkas()
    {
        return $this->hasOne(VerifikasiPraBedahBerkas::class, 'kode_register', 'kode_register');
    }

    public function praBedahDarah()
    {
        return $this->hasOne(VerifikasiPraBedahDarah::class, 'kode_register', 'kode_register');
    }

    public function praBedahEkg()
    {
        return $this->hasOne(VerifikasiPraBedahEkg::class, 'kode_register', 'kode_register');
    }

    public function praBedahLab()
    {
        return $this->hasOne(VerifikasiPraBedahLab::class, 'kode_register', 'kode_register');
    }

    public function praBedahObat()
    {
        return $this->hasOne(VerifikasiPraBedahObat::class, 'kode_register', 'kode_register');
    }

    public function praBedahRadiologi()
    {
        return $this->hasOne(VerifikasiPraBedahRadiologi::class, 'kode_register', 'kode_register');
    }

    public function praBedahOther()
    {
        return $this->hasOne(VerifikasiPraBedahOther::class, 'kode_register', 'kode_register');
    }
}
