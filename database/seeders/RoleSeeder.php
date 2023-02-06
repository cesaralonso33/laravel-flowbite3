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
    {/*
        // Crear roles
        $admin=Role::create(['name'=>'Admin']);
        $superuser=Role::create(['name'=>'Super-User']);
        $user=Role::create(['name'=>'User']);

         // create permissions
        Permission::create(['name'=>'dashboard'])->syncRoles([$admin,$superuser,$user]);
        Permission::create(['name'=>'profile.view'])->syncRoles([$admin,$superuser,$user]);
        Permission::create(['name'=>'profile.update'])->syncRoles([$admin,$superuser]);
        Permission::create(['name'=>'profile.destroy'])->syncRoles([$admin]); */

       // app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'edit profile']);
        Permission::create(['name' => 'delete profile']);
        Permission::create(['name' => 'view profile']);

        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'delete users']);
        Permission::create(['name' => 'view users']);


        Permission::create(['name' => 'view permissions']);
        Permission::create(['name' => 'edit permissions']);
        Permission::create(['name' => 'delete permissions']);

        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'edit roles']);
        Permission::create(['name' => 'delete roles']);

        Permission::create(['name' => 'view client']);
        Permission::create(['name' => 'edit client']);
        Permission::create(['name' => 'delete client']);

        Permission::create(['name' => 'view provider']);
        Permission::create(['name' => 'edit provider']);
        Permission::create(['name' => 'delete provider']);

        Permission::create(['name' => 'view product']);
        Permission::create(['name' => 'edit product']);
        Permission::create(['name' => 'delete product']);


        Permission::create(['name' => 'view post']);
        Permission::create(['name' => 'edit post']);
        Permission::create(['name' => 'delete post']);




        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'Admin']);
        $role1->givePermissionTo('view profile');
        $role1->givePermissionTo('edit profile');


        $role2 = Role::create(['name' => 'Super-Admin']);
        $role2->givePermissionTo(Permission::all());


        $role3 = Role::create(['name' => 'User']);
        $role3->givePermissionTo('view profile');
        // gets all permissions via Gate::before rule; see AuthServiceProvider

        $role4 = Role::create(['name' => 'Super-User']);

    }
}
