<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\module>
 */
class ModuleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $description = ['Active','Desactive'];
        $name = Str::of($description)->snake();

        return [
            'name' => fake()->name(),
            'user_id' => User::all()->random()->id,
            'status' => $name,
        ];
    }
}
