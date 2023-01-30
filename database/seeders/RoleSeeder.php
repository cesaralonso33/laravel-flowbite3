<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear roles
        $admin=Role::create(['name'=>'Admin']);
        $superuser=Role::create(['name'=>'Super-User']);
        $user=Role::create(['name'=>'User']);

        Permission::create(['name'=>'dashboard'])->syncRoles([$admin,$superuser,$user]);
        Permission::create(['name'=>'profile.edit'])->syncRoles([$admin,$superuser,$user]);
        Permission::create(['name'=>'profile.update'])->syncRoles([$admin,$superuser]);
        Permission::create(['name'=>'profile.destroy'])->syncRoles([$admin]);

    }
}
