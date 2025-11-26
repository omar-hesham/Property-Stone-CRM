<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Building;

class BuildingFactory extends Factory
{
    protected $model = Building::class;

    public function definition()
    {
        return [
            'name' => 'Block ' . $this->faker->bothify('?##'),
            'block_number' => strtoupper($this->faker->bothify('B-#')),
            'floors_count' => $this->faker->numberBetween(1,12),
        ];
    }
}
