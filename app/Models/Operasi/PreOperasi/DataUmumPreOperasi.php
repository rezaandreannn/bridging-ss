<?php

namespace App\Models\Operasi\PreOperasi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataUmumPreOperasi extends Model
{
    use HasFactory;

    protected $connection = 'pku';
    protected $table = 'ok_data_umum_pre_operasi';

    protected $fillable = [
        'kode_register',
        'diagnosa',
        'jenis_operasi',
        'nama_operator',
        'puasa_jam',
        'riwayat_asma',
        'alergi',
        'antibiotik_profilaksis',
        'antibiotik_profilaksis_jam',
        'premedikasi',
        'premedikasi_jam',
        'ivfd',
        'dc',
        'assesmen_pra_bedah',
        'edukasi_anastesi',
        'informed_consent_bedah',
        'informed_consent_anastesi',
        'darah',
        'gol',
        'obat',
        'rontgen',
        'created_by',
        'updated_by'
    ];
}
