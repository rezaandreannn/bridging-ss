<?php

namespace App\Models\Operasi\PostOperasi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
