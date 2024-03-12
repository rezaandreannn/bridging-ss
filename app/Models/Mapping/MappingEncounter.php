<?php

namespace App\Models\Mapping;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MappingEncounter extends Model
{
    use HasFactory;

    protected $guarded = [];

    const TYPE = [
        'poliklinik',
        'IGD'
    ];
}
