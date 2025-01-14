<?php

namespace App\Models\Operasi\ChecklistPembedahan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SignOut extends Model
{
    use HasFactory;

    protected $connection = 'pku';
    protected $table = 'ok_checklist_pembedahan_sign_out';

    protected $fillable = [
        'kode_register',
        'tindakan_dicatat',
        'instrumen_alat',
        'jaringan_dikirimkan_pa',
        'masalah_peralatan',
        'masalah_pasien',
        'created_by',
        'updated_by'
    ];
}
