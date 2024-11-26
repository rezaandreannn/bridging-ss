<?php

namespace App\Models\Simrs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruang extends Model
{
    use HasFactory;

    protected $connection = 'db_rsmm';
    protected $table = 'M_RUANG';

    protected $with = 'bangsal';

    public function bangsal()
    {
        return $this->belongsTo(Bangsal::class, 'Kode_Bangsal', 'Kode_Bangsal');
    }
}
