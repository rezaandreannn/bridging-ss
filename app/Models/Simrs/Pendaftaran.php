<?php

namespace App\Models\Simrs;

use App\Models\Operasi\BookingOperasi;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $connection = 'db_rsmm';
    protected $table = 'PENDAFTARAN';

    protected $with = ['registerPasien'];

    public function registerPasien()
    {
        return $this->hasOne(RegisterPasien::class, 'No_MR', 'No_MR');
    }
}
