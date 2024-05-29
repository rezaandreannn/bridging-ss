<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $default_user_value = [
            'email_verified_at' => now(),
            'password'  => bcrypt('password'),
            'remember_token'    => Str::random(10),
        ];

        $it = User::connection('emr_new')->create(array_merge([
            'email' => 'itrsumm08@gmail.com',
            'name'  => 'IT RSUMM',
        ], $default_user_value));

        $perawat = User::connection('emr_new')->create(array_merge([
            'email' => 'perawat@gmail.com',
            'name'  => 'PERAWAT RSUMM',
        ], $default_user_value));

        $dokter = User::connection('emr_new')->create(array_merge([
            'email' => 'dokter@gmail.com',
            'name'  => 'DOKTER RSUMM',
        ], $default_user_value));

        $manager = User::connection('emr_new')->create(array_merge([
            'email' => 'manager@gmail.com',
            'name'  => 'MANAGER RSUMM',
        ], $default_user_value));

        $role_it = Role::connection('emr_new')->create(['name' => 'Super Admin']);
        $role_perawat = Role::connection('emr_new')->create(['name' => 'perawat']);
        $role_dokter = Role::connection('emr_new')->create(['name' => 'dokter']);
        $role_manager = Role::connection('emr_new')->create(['name' => 'manager']);


        // Permission::create(['name' => 'read role']);
        // Permission::create(['name' => 'create role']);
        // Permission::create(['name' => 'update role']);
        // Permission::create(['name' => 'delete role']);

        // $role_it->givePermissionTo('read role');
        // $role_it->givePermissionTo('create role');
        // $role_it->givePermissionTo('update role');
        // $role_it->givePermissionTo('delete role');

        // $role_perawat->givePermissionTo('read antrean');
        // $role_perawat->givePermissionTo('create antrean');
        // $role_perawat->givePermissionTo('update antrean');
        // $role_perawat->givePermissionTo('delete antrean');


        $it->assignRole('Super Admin');
        $perawat->assignRole('perawat');
        $dokter->assignRole('dokter');
        $manager->assignRole('manager');
    }
}
