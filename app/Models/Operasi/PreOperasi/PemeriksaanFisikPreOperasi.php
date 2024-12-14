<?php

namespace App\Models\Operasi\PreOperasi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemeriksaanFisikPreOperasi extends Model
{
    use HasFactory;

    protected $connection = 'pku';
    protected $table = 'ok_pemeriksaan_fisik_pre_operasi';

    protected $fillable = [
        'kode_register',
        'tinggi_badan',
        'berat_badan',
        'tekanan_darah',
        'nadi',
        'suhu',
        'pernafasan',
        'created_by',
        'updated_by'
    ];
}
