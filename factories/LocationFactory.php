<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Location;

class LocationFactory extends Factory
{
    protected $model = Location::class;

    public function definition()
    {
        return [
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'country' => $this->faker->country,
            'city' => $this->faker->city,
            'district' => $this->faker->streetName,
            'street' => $this->faker->streetAddress,
            'postal_code' => $this->faker->postcode,
            'address_line' => $this->faker->address,
        ];
    }
}
