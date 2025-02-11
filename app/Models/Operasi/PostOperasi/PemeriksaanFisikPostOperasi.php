<?php

namespace App\Models\Operasi\PostOperasi;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Operasi\PostOperasi\DataUmumPostOperasi;

class PemeriksaanFisikPostOperasi extends Model
{
    use HasFactory;

    protected $connection = 'pku';
    protected $table = 'ok_pemeriksaan_fisik_post_operasi';

    protected $fillable = [
        'kode_register',
        'keadaan_umum',
        'kesadaran',
        'tekanan_darah',
        'nadi',
        'suhu',
        'pernafasan',
        'instruksi_dokter',
        'created_by',
        'updated_by'
    ];

    public function postDataUmum()
    {
        return $this->belongsTo(DataUmumPostOperasi::class, 'kode_register', 'kode_register');
    }
}
