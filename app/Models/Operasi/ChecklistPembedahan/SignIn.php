<?php

namespace App\Models\Operasi\ChecklistPembedahan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SignIn extends Model
{
    use HasFactory;

    protected $connection = 'pku';
    protected $table = 'ok_checklist_pembedahan_sign_in';

    protected $fillable = [
        'kode_register',
        'identitas_pasien',
        'lokasi_operasi_pasien',
        'mesin_anestesi_lengkap',
        'alergi_pasien',
        'riwayat_asma_pasien',
        'pemasangan_implant',
        'kehilangan_darah',
        'created_by',
        'updated_by'
    ];
}
