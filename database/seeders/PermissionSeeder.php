<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Permission::create([
            'name' => 'master data',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'manage user',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'kunjungan',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'encounter',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'mappings',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'nurse record',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'satu sehat',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'fisioterapi',
            'guard_name' => 'web'
        ]);
    }
}
