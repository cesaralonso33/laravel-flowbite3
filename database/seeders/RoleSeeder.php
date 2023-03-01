<?php

namespace Database\Seeders;

use App\Models\module;
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




            $kust=module::all();
            foreach($kust  as $item){
                // create permissions
                Permission::create(['name' => 'view '.$item->name]);
                Permission::create(['name' => 'create '.$item->name]);
                Permission::create(['name' => 'edit '.$item->name]);
                Permission::create(['name' => 'delete '.$item->name]);

            }



        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'Admin']);
        $role1->givePermissionTo('view Profile');
        $role1->givePermissionTo('edit Profile');


        $role2 = Role::create(['name' => 'Super-Admin']);
        $role2->givePermissionTo(Permission::all());


        $role3 = Role::create(['name' => 'User']);
     //   $role3->givePermissionTo('view profile');
        // gets all permissions via Gate::before rule; see AuthServiceProvider

        $role4 = Role::create(['name' => 'Super-User']);

    }
}
