<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\County;
use Faker\Factory;

class CityFactory extends Factory
{
    protected string $model = City::class;

    public function definition()
    {
        return [
            'name' => $this->faker->city,
            'county_id' => County::inRandomOrder()->first()->id,
        ];
    }
}
