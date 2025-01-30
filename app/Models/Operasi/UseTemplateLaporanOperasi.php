<?php

namespace App\Models\Operasi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UseTemplateLaporanOperasi extends Model
{
    use HasFactory;

    protected $connection = 'pku';
    protected $table = 'ok_use_template_laporan_operasi';

    protected $fillable = [
        'kode_dokter',
        'use_template'
    ];
}
