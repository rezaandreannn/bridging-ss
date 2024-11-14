<?php

namespace App\Models\Operasi;

use App\Models\Simrs\Dokter;
use App\Models\Simrs\Pendaftaran;
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
        'ruangan_id',
        'kode_dokter',
        'nama_tindakan',
        'terlaksana',
        'tanggal',
        'jam_mulai',
        'jam_selesai'
    ];

    protected $with = ['pendaftaran', 'ruangan', 'dokter'];

    public function ruangan()
    {
        return $this->belongsTo(RuanganOperasi::class);
    }
    // Batas Relasi


    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'kode_dokter', 'Kode_Dokter');
    }

    public function pendaftaran()
    {
        return $this->hasOne(Pendaftaran::class, 'No_Reg', 'kode_register');
    }
}
