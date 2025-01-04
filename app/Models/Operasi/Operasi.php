<?php

namespace App\Models\Operasi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operasi extends Model
{
    use HasFactory;

    protected $connection = 'pku';
    protected $table = 'ok_operasi';

    // Mass Assignment

    protected $fillable = [
        'kode_register',
        'jenis_anastesi',
        'kategori',
        'instrumen',
        'created_by',
        'updated_by'
    ];

}
