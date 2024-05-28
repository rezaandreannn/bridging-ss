<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Location extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function getData()
    {
        $data = DB::connection('bridging')
            ->table('satusehat_location')
            ->get();
        return $data;
    }

    public const STATUS = [
        'active',
        'suspended',
        'inactive'
    ];
}
