<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Antrean extends Model
{
    public static function fetchData()
    {
        $response = Http::get('https://daftar.rsumm.co.id/api.simrs/index.php/api/antrian/140');
        return $response->json();
    }
}
