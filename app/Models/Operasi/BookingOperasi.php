<?php

namespace App\Models\Operasi;

use App\Models\MasterData\TtdDokter;
use App\Models\Operasi\PostOperasi\DataUmumPostOperasi;
use App\Models\Simrs\Dokter;
use App\Models\Simrs\Pendaftaran;
use App\Models\Transaksi\TransaksiKamar;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingOperasi extends Model
{
    use HasFactory;

    protected $connection = 'pku';
    protected $table = 'ok_booking_operasi';

    // Mass Assignment
    protected $fillable = [
        'kode_register',
        'asal_ruangan',
        'kode_dokter',
        'jenis_operasi',
        'terlaksana',
        'tanggal',
        'rencana_operasi',
        'created_by'
    ];

    protected $with = ['pendaftaran', 'ruangan', 'dokter'];

    public function ruangan()
    {
        return $this->belongsTo(RuanganOperasi::class);
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'kode_dokter', 'Kode_Dokter');
    }

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'kode_register', 'No_Reg');
    }

    public function ttdtandapasien()
    {
        return $this->hasOne(Pendaftaran::class, 'No_Reg', 'kode_register');
    }

    public function ttdDokter()
    {
        return $this->hasOne(TtdDokter::class, 'kode_dokter', 'kode_dokter');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function transaksiKamar()
    {
        return $this->hasMany(TransaksiKamar::class, 'No_Reg', 'kode_register');
    }

}
