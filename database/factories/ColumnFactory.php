<?php

namespace Database\Factories;

use App\Models\Edit_tab;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Column>
 */
class ColumnFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        //$namecul=str::replace(' ','', fake()->jobTitle());
        $namecul=str::replace(' ','', fake()->regexify('[A-Za-z0-9]{10}'));

        return [
            'label' => fake()->name(),
            'name' => $namecul,//str::replace(' ','', fake()->name()),
            'required' => fake()->randomElement([true, false]),
            'list' =>  fake()->randomElement([true, false]),
            'hiddentable' =>  fake()->randomElement([true, false]),
            'edit_tab_id' => Edit_tab::all()->random()->id,
            'type' =>  fake()->randomElement(['TEXT']),
            'user_id'=>1
        ];
    }
}
