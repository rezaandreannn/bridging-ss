<?php

namespace App\Models\Operasi\PraBedah;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'created_by',
        'updated_by'
    ];
}
