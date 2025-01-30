<?php

namespace App\Helpers\Ok;

use App\Models\Operasi\PascaBedah\PerencanaanPascaBedah;

class PascaBedahHelper
{
    public static function getStatusPascaBedah($pascaBedah)
    {
        $statusPascaBedah = [];

        foreach ($pascaBedah as $pb) {
            $exists = PerencanaanPascaBedah::where('kode_register', $pb->kode_register)->first();
            $statusPascaBedah[$pb->id] = $exists ? $exists->id : 'create';
        }

        return $statusPascaBedah;
    }
}
