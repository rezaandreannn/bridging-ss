<?php

namespace App\Services\MasterData;

use App\Models\User;


class UserService
{

    public function get(){
        $user = auth()->user(); 
        $userBangsalId = optional($user->userbangsal)->kode_bangsal; 
        return $userBangsalId;
    }

}