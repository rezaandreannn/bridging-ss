<?php

namespace App\Models\Operasi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperatorAsistenDetail extends Model
{
    use HasFactory;

    protected $connection = 'pku';
    protected $table = 'ok_operator_asisten_detail';

    protected $fillable = [
        'kode_register',
        'nama_operator',
        'nama_asisten',
        'nama_perawat',
        'created_by',
        'updated_by'
    ];


}
