<?php

namespace Database\Seeders;

use App\Models\Organization;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        Organization::create([
            'organization_id' => '861b3be1-9a10-4cc1-b34d-8d5d23779d54',
            'name' => 'STAGING itrsumm08@gmail.com',
            'created_by' => 'seeder'
        ]);
    }
}
