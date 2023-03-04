<?php

namespace Modules\{Module}\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Modules\{Module}\Models\{Model}EditTab;

use Modules\{Module}\Models\{Model};

class {Module}DatabaseSeeder extends Seeder
{
    public function run()
    {
/*         {Model}EditTab::create([
            'name' => Str::uuid(),
            'label' => fake()->name(),
        ]);
 */

        for($i=0;$i<600;$i++){
            $itt=new {Model}();
            $itt->save();
        }

        //Model::unguard();


        // $this->call("OthersTableSeeder");

        {}

    }
}
