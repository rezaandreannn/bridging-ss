<?php

namespace App\Models\Operasi\PreOperasi;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VerifikasiPreOperasi extends Model
{
    use HasFactory;

    protected $connection = 'pku';
    protected $table = 'ok_verifikasi_anastesi_pre_op';

    protected $with = ['user'];

    protected $fillable = [
        'kode_register',
        'user_id',
        'created_by',
        'updated_by',
    ];

    public function postDataUmum()
    {
        return $this->belongsTo(DataUmumPreOperasi::class, 'kode_register', 'kode_register');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
