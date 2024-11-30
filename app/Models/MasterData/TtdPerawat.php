<?php

namespace App\Models\MasterData;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TtdPerawat extends Model
{
    use HasFactory;
    protected $connection='pku';
    protected $table='ttd_perawat';

    protected $with=['user'];


    protected $fillable = [
        'user_id',
        'ttd_perawat',
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
