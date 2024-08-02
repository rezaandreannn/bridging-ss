<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MasterDataFisioterapi extends Model
{
    use HasFactory;

    public function getDiagnosisMedis(){
        
        $data=DB::connection('pku')
        ->table('fis_master_diagnosis_medis')
        ->get();

        return $data;
    }
    public function getDiagnosisFungsi(){

        $data=DB::connection('pku')
        ->table('fis_master_diagnosis_fungsi')
        ->get();

        return $data;
    }
    public function getKesimpulan(){

        $data=DB::connection('pku')
        ->table('fis_master_Kesimpulan')
        ->get();

        return $data;
    }
}
