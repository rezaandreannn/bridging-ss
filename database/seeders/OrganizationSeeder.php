<?php

namespace Database\Seeders;

use App\Models\Organization;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Organization::create([
            'organization_id' => '861b3be1-9a10-4cc1-b34d-8d5d23779d54',
            'name' => 'STAGING itrsumm08@gmail.com',
            'created_by' => 'seeder'
        ]);
    }
}
