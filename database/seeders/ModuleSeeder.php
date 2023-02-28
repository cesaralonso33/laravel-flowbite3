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


       $listmodules=array("Profile","Users","Permissions","Roles","Posts");


       foreach($listmodules as $item){
                    module::create([
                        "name"=>$item,
                        "user_id"=>1,
                        "status"=>"Active"
                        ]);
       }




    }
}
