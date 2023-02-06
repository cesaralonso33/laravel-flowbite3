<?php

namespace Database\Seeders;

use App\Models\module;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // \App\Models\module::factory(3)->create();



        module::create([
            "name"=>"Clientes",
            "user_id"=>"1",
            "status"=>"Active"
            ]);

     module::create([
         "name"=>"Proveedores",
         "user_id"=>"1",
         "status"=>"Active"
         ]);


     module::create([
        "name"=>"Category",
        "user_id"=>"1",
        "status"=>"Active"
        ]);


        module::create([
            "name"=>"Posts",
            "user_id"=>"1",
            "status"=>"Active"
            ]);


    }
}
