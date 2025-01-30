<?php

namespace App\Models\Operasi\MasterData;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateOperasi extends Model
{
    use HasFactory;

    protected $connection = 'pku';
    protected $table = 'ok_template_laporan_operasi';

    protected $fillable = [
        'macam_operasi',
        'kode_dokter',
        'laporan_operasi',
    ];
}
