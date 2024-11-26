<?php

namespace App\Models\Operasi\PraBedah;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifikasiPraBedahEkg extends Model
{
    use HasFactory;

    protected $connection = 'pku';
    protected $table = 'ok_verifikasi_pra_bedah_ekg';

    // mass assigment
    protected $fillable = [
        'kode_register',
        'ekg',
        'deskripsi',
        'created_by',
        'updated_by'
    ];
}
