<?php

namespace App\Models\Transaksi;

use App\Models\Simrs\Ruang;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransaksiKamar extends Model
{
    use HasFactory;

    protected $connection = 'db_rsmm';
    protected $table = 'TR_KAMAR';

    public function ruang()
    {
        return $this->belongsTo(Ruang::class, 'Kode_Ruang', 'Kode_Ruang');
    }
}
