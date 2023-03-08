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


       $listmodules=[];

       $listmodules[]=array(
            'nombre'=>"Users",
            'icon'=>"users",
            'rute'=>'users.index'
       );

       $listmodules[]=array(
            'nombre'=>"Profile",
            'icon'=>"credit-card",
            'rute'=>'profile.edit'
        );
        $listmodules[]= array(
            'nombre'=>"Permissions",
            'icon'=>"key",
            'rute'=>'permissions.index'
        );
         $listmodules[]=array(
            'nombre'=>"Roles",
            'icon'=>"academic-cap",
            'rute'=>'roles.index'
        );
         $listmodules[]=array(
            'nombre'=>"Clients",
            'icon'=>"scale",
            'rute'=>'app.clients.index'
        );
        $listmodules[]=array(
            'nombre'=>"Solicituds",
            'icon'=>"scale",
            'rute'=>'app.solicituds.index'
        );
        $listmodules[]=array(
            'nombre'=>"Destinations",
            'icon'=>"scale",
            'rute'=>'app.destinations.index'
        );

        $listmodules[]=array(
            'nombre'=>"ClientsRates",
            'icon'=>"scale",
            'rute'=>'app.clientsrates.index'
        );

        $listmodules[]=array(
            'nombre'=>"Origins",
            'icon'=>"scale",
            'rute'=>'app.origins.index'
        );

        $listmodules[]=array(
            'nombre'=>"TarifasAliados",
            'icon'=>"scale",
            'rute'=>'app.tarifasaliados.index'
        );





       foreach($listmodules as $item ){
                    module::create([
                        "name"=>$item['nombre'],
                        'rute'=>$item['rute'],
                        'icon'=>$item['icon'],
                        "user_id"=>1,
                        "status"=>"Active"
                        ]);
       }




    }
}
