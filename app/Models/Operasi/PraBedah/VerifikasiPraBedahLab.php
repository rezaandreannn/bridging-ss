<?php

namespace App\Models\Operasi\PraBedah;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifikasiPraBedahLab extends Model
{
    use HasFactory;

    protected $connection = 'pku';
    protected $table = 'ok_verifikasi_pra_bedah_lab';

    protected $fillable = [
        'kode_register',
        'laboratorium',
        'lab_hemoglobin',
        'lab_leukosit',
        'lab_trombosit',
        'lab_hematrokit',
        'lab_bt',
        'lab_ct',
        'created_by',
        'updated_by'
    ];

    public function assesmenPraBedah()
    {
        return $this->belongsTo(AssesmenPraBedah::class, 'kode_register', 'kode_register');
    }
}
