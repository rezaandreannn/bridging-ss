<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Organization extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getData()
    {
        $data = DB::connection('bridging')
            ->table('satusehat_organization')
            ->get();
        return $data;
    }
}
