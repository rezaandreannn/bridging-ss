<?php

namespace App\Models\Operasi\PostOperasi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
