<?php

namespace App\Models\Operasi\PreOperasi;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Operasi\PostOperasi\DataUmumPostOperasi;

class TindakanPreOperasi extends Model
{
    use HasFactory;

    protected $connection = 'pku';
    protected $table = 'ok_tindakan_pre_operasi';

    protected $fillable = [
        'kode_register',
        'lapor_dokter',
        'lapor_kamar',
        'surat_izin_pembedahan',
        'tandai_daerah_operasi',
        'memakai_gelang_identitas',
        'melepas_aksesoris',
        'menghapus_aksesoris',
        'melakukan_oral_hygiene',
        'memasang_bidai',
        'memasang_infuse',
        'memasang_dc',
        'deskripsi_dc',
        'memasang_ngt',
        'deskripsi_ngt',
        'memasang_drainage',
        'memasang_wsd',
        'mencukur_daerah_operasi',
        'lainnya',
        'deskripsi_lainnya',
        'penyakit_dm',
        'penyakit_hipertensi',
        'penyakit_tb_paru',
        'penyakit_hiv',
        'penyakit_hepatitis',
        'created_by',
        'updated_by'
    ];

    public function postDataUmum()
    {
        return $this->belongsTo(DataUmumPostOperasi::class, 'kode_register', 'kode_register');
    }
}
