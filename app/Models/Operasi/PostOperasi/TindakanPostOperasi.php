<?php

namespace App\Models\Operasi\PostOperasi;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Operasi\PostOperasi\DataUmumPostOperasi;

class TindakanPostOperasi extends Model
{
    use HasFactory;

    protected $connection = 'pku';
    protected $table = 'ok_tindakan_post_operasi';

    protected $fillable = [
        'kode_register',
        'status_pasien',
        'catatan_anestesi',
        'laporan_pembedahan',
        'perencanaan_pasca_medis',
        'checklist_keselamatan_pasien',
        'checklist_monitoring',
        'askep_perioperatif',
        'lembar_pemantauan',
        'formulir_pemeriksaan',
        'sampel_pemeriksaan',
        'foto_rontgen',
        'resep',
        'lainnya',
        'deskripsi_lainnya',
        'created_by',
        'updated_by'
    ];

    public function postDataUmum()
    {
        return $this->belongsTo(DataUmumPostOperasi::class, 'kode_register', 'kode_register');
    }
}
