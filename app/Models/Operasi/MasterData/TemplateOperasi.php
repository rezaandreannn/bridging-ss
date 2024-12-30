<?php

namespace App\Models\Operasi\MasterData;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateOperasi extends Model
{
    use HasFactory;

    protected $connection = 'pku';
    protected $table = 'ok_template_operasi';

    protected $fillable = [
        'tindakan',
        'template_operasi',
        'created_by',
        'updated_by'
    ];
}
