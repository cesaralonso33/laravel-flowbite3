<?php

namespace Database\Seeders;

use App\Models\Column;
use App\Models\post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<600;$i++){
            $itt=new post();
            $itt->save();
        }


    }
}
