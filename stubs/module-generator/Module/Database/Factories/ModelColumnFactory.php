<?php
namespace Modules\{Module}\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\{Module}\Models\{Model}Column;

use Illuminate\Support\Str;

class {Model}ColumnFactory extends Factory
{
    protected $model = {Model}Column::class;

    public function definition(): array
    {
        return [
            'name' => Str::uuid(),
            'label' => fake()->name(),
        ];
    }
}
