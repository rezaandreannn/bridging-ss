<?php

namespace App\Models;

use App\Models\MasterData\Bangsal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserBangsal extends Model
{
    use HasFactory;
    protected $connection = 'sqlsrv';
    protected $table = 'user_bangsals';

    protected $with = ['bangsal'];

    protected $fillable = [
        'user_id',
        'kode_bangsal',
        'created_at',
        'updated_at'
    ];

    public function bangsal()
    {
        return $this->belongsTo(Bangsal::class, 'kode_bangsal', 'Kode_Bangsal');
    }
}
