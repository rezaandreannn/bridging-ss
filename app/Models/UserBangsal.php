<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBangsal extends Model
{
    use HasFactory;
    protected $connection = 'sqlsrv';
    protected $table = 'user_bangsals';

    protected $fillable = [
        'user_id',
        'kode_bangsal',
        'created_at',
        'updated_at'
    ];
}
