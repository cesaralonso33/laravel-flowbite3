<?php

namespace Database\Seeders;

use App\Models\ListTable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ListTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ListTable::create([
            'name'=>'Listas',
        ]);

    }
}
