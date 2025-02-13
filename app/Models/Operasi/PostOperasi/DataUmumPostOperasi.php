<?php

namespace App\Models\Operasi\PostOperasi;

use App\Models\User;
use App\Models\Operasi\BookingOperasi;
use Illuminate\Database\Eloquent\Model;
use App\Models\Operasi\PreOperasi\DataUmumPreOperasi;
use App\Models\Operasi\PreOperasi\TindakanPreOperasi;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Operasi\PreOperasi\PemeriksaanFisikPreOperasi;

class DataUmumPostOperasi extends Model
{
    use HasFactory;

    protected $connection = 'pku';
    protected $table = 'ok_data_umum_post_operasi';

    protected $fillable = [
        'kode_register',
        'diagnosa_prabedah',
        'diagnosa_pascabedah',
        'jenis_operasi',
        'dokter_operator',
        'asisten_bedah',
        'jam_operasi',
        'jenis_anastesi',
        'dokter_anastesi',
        'asisten_anastesi',
        'created_by',
        'updated_by'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function booking()
    {
        return $this->hasOne(BookingOperasi::class, 'kode_register', 'kode_register');
    }

    public function postTindakan()
    {
        return $this->hasOne(TindakanPostOperasi::class, 'kode_register', 'kode_register');
    }

    public function postAlat()
    {
        return $this->hasOne(AlatPostOperasi::class, 'kode_register', 'kode_register');
    }

    public function postPemeriksaanFisik()
    {
        return $this->hasOne(PemeriksaanFisikPostOperasi::class, 'kode_register', 'kode_register');
    }

    public function preTindakan()
    {
        return $this->hasOne(TindakanPreOperasi::class, 'kode_register', 'kode_register');
    }

    public function prePemeriksaanFisik()
    {
        return $this->hasOne(PemeriksaanFisikPreOperasi::class, 'kode_register', 'kode_register');
    }

    public function preDataUmum()
    {
        return $this->hasOne(DataUmumPreOperasi::class, 'kode_register', 'kode_register');
    }
}
