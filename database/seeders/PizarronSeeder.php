<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PizarronSeeder extends Seeder
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


    }
}
