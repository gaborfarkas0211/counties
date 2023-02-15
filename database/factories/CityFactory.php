<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\County;
use Illuminate\Database\Eloquent\Factories\Factory;

class CityFactory extends Factory
{
    protected $model = City::class;

    public function definition(): array
    {
        return [
            'name' => fake()->city,
            'county_id' => County::inRandomOrder()->first()->id,
        ];
    }
}
