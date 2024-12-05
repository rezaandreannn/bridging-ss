<?php

namespace App\Models\Operasi\PraBedah;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifikasiPraBedahOther extends Model
{
    use HasFactory;

    protected $connection = 'pku';
    protected $table = 'ok_verifikasi_pra_bedah_others';

    protected $fillable = [
        'kode_register',
        'estimasi_waktu',
        'rencana_tindakan',
        'created_by',
        'updated_by'
    ];

    public function assesmenPraBedah()
    {
        return $this->belongsTo(AssesmenPraBedah::class, 'kode_register', 'kode_register');
    }
}
