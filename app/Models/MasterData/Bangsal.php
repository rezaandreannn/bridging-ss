<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bangsal extends Model
{
    use HasFactory;
    protected $connection = 'db_rsmm';
    protected $table = 'M_BANGSAL';

}
