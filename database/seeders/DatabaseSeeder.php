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

        $this->call(UserRolePermissionSeeder::class);
        // $this->call(OrganizationSeeder::class);
        // $this->call(LocationTableSeeder::class);
        $this->call(PermissionSeeder::class);
    }
}
