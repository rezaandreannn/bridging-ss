<?php

namespace App\Models\Operasi\PostOperasi;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Operasi\PostOperasi\DataUmumPostOperasi;

class AlatPostOperasi extends Model
{
    use HasFactory;

    protected $connection = 'pku';
    protected $table = 'ok_alat_post_operasi';

    protected $fillable = [
        'kode_register',
        'ngt',
        'drain',
        'tampon_hidung',
        'tampon_gigi',
        'tampon_abdomen',
        'tampon_vagina',
        'tranfusi',
        'ivfd',
        'deskripsi_ivfd',
        'kompres_luka',
        'dc',
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
