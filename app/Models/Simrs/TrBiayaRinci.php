<?php

namespace App\Models\Simrs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrBiayaRinci extends Model
{
    use HasFactory;
    protected $connection = 'db_rsmm';
    protected $table = 'TR_BIAYARINCI';
}
