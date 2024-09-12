<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProfileUser extends Model
{
    use HasFactory;

    public function getBiodataUser($id)
    {
        $data = DB::connection('sqlsrv')
            ->table('users')
            ->select(
                'name',
                'email',
                'image',
                )
            ->where('id',$id)
            ->first();
        return $data;
    }
    
}
