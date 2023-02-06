<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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


        $this->call(PostSeeder::class);

        $this->call(RoleSeeder::class);

           \App\Models\User::factory()->create([
             'name' => 'Admin',
             'email' => 'crad@crad.com',
             'isAdmin'=>'Admin'
         ])->assignRole('Super-Admin');

      //  \App\Models\User::factory(10)->create();
      \App\Models\User::factory(3)->create()->each(function($user){
        $user->assignRole('Admin');
     });
         \App\Models\User::factory(3)->create()->each(function($user){
            $user->assignRole('User');
         });
         \App\Models\User::factory(3)->create()->each(function($user){
            $user->assignRole('Super-User');
         });

    }
}
