<?php

namespace App\Models\Operasi\PascaBedah;

use App\Models\Operasi\BookingOperasi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PerencanaanPascaBedah extends Model
{
    use HasFactory;

    protected $connection = 'pku';
    protected $table = 'ok_perencanaan_medis_pasca_bedah';

    protected $fillable = [
        'kode_register',
        'tingkat_perawatan',
        'monitoring_ttv_start',
        'monitoring_ttv_end',
        'konsultasi_pelayanan',
        'terapi',
        'created_by',
        'updated_by'
    ];

    public function booking()
    {
        return $this->hasOne(BookingOperasi::class, 'kode_register', 'kode_register');
    }
}
