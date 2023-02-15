<?php

namespace Tests\Feature;

use App\Models\County;
use Database\Seeders\CountySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class CreateCityTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_create_a_new_city_associated_with_a_county()
    {
        $this->seed(CountySeeder::class);
        $county = County::query()->inRandomOrder()->first();
        $name = 'Test City';

        $response = $this->postJson("/api/counties/{$county->id}/city", [
            'name' => $name,
        ]);

        $response->assertStatus(Response::HTTP_OK);
        $city = $response->json()['data'];

        $this->assertArrayHasKey('id', $city);
        $this->assertIsInt($city['county_id']);
        $this->assertArrayHasKey('name', $city);
        $this->assertIsString($city['name']);

        $this->assertDatabaseHas('cities', [
            'name' => $name,
            'county_id' => $county->id,
        ]);
    }
}
