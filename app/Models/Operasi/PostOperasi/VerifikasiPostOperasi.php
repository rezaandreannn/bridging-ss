<?php

namespace App\Models\Operasi\PostOperasi;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VerifikasiPostOperasi extends Model
{
    use HasFactory;

    protected $connection = 'pku';
    protected $table = 'ok_verifikasi_ruangan_post_op';

    protected $fillable = [
        'kode_register',
        'user_id',
        'created_by',
        'updated_by',
    ];

    public function postDataUmum()
    {
        return $this->belongsTo(DataUmumPostOperasi::class, 'kode_register', 'kode_register');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
