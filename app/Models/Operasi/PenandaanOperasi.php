<?php

namespace App\Models\Operasi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'created_by',
        'updated_by'
    ];
}
