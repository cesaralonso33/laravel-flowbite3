<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PruebaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $this->call(ModuleSeeder::class);
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

                \App\Models\Edit_tab::factory(4)->create();
                \App\Models\Column::factory(10)->create();


              $this->call(PostSeeder::class);

    }
}
