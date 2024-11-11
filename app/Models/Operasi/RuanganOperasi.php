<?php

namespace App\Models\Operasi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RuanganOperasi extends Model
{
    use HasFactory;

    protected $connection = 'pku';
    protected $table = 'ok_ruangan';

    // mass Assignment
    protected $fillable = [];

    public function bookings()
    {
        return $this->hasMany(BookingOperasi::class, 'ruangan_id');
    }
}
