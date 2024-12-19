<?php

namespace Database\Seeders;

use App\Models\UserBangsal as ModelsUserBangsal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserBangsal extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ModelsUserBangsal::create([
            'user_id' => '1',
            'kode_bangsal' => 'MNA',
        ]);
    }
}
