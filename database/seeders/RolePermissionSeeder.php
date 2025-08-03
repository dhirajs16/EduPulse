<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $this->createDefaultPermissions();


        $role = new Role();
        $role->name = 'super admin';
        $role->guard_name = 'admin';
        $role->save();

        $accountant = new Role();
        $accountant->name = 'accountant';
        $accountant->guard_name = 'admin';
        $accountant->save();
        $accountant->givePermissionTo('manage accounts');

    }

    function createDefaultPermissions() : void
    {
        Permission::insert([

            array('id' => '1','name' => 'manage accounts','guard_name' => 'admin','group_name' => 'Account Management','created_at' => now(),'updated_at' => now()),
            array('id' => '2','name' => 'manage library','guard_name' => 'admin','group_name' => 'Library Management','created_at' => now(),'updated_at' => now()),
        ]);
    }
}
