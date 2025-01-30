<?php

namespace App\Models\MasterData;

use App\Models\Simrs\Dokter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TtdDokter extends Model
{
    use HasFactory;
    protected $connection = 'pku';
    protected $table = 'ttd_dokter';

    protected $with = ['dokter'];

    protected $fillable = [
        'kode_dokter',
        'ttd_dokter',
        'created_at',
        'updated_at'
    ];
    
    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'kode_dokter', 'Kode_Dokter');
    }

}
