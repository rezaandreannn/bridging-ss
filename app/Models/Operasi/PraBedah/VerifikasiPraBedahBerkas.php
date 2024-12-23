<?php

namespace App\Models\Operasi\PraBedah;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VerifikasiPraBedahBerkas extends Model
{
    use HasFactory;

    protected $connection = 'pku';
    protected $table = 'ok_verifikasi_pra_bedah_berkas';

    protected $fillable = [
        'kode_register',
        'status_pasien',
        'assesmen_pra_bedah',
        'penandaan_lokasi',
        'informed_consent_bedah',
        'informed_consent_anastesi',
        'assesmen_pra_anastesi_sedasi',
        'edukasi_anastesi',
        'created_by',
        'updated_by'
    ];

    public function assesmenPraBedah()
    {
        return $this->belongsTo(AssesmenPraBedah::class, 'kode_register', 'kode_register');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }
}
