<?php

namespace Tests\Feature;

use App\Models\City;
use App\Models\County;
use Database\Seeders\CountySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class CityApiTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed(CountySeeder::class);
    }

    public function test_create_city_for_county()
    {
        $county = County::query()->inRandomOrder()->first();
        $name = 'Test City';

        $response = $this->post("/api/counties/{$county->id}/city", [
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

    public function test_update_city()
    {
        $city = City::factory()->create();

        $newName = 'Test City';
        $response = $this->put('/api/cities/' . $city->id, [
            'name' => $newName,
        ]);
        $response->assertStatus(Response::HTTP_OK);

        $this->assertDatabaseHas('cities', [
            'id' => $city->id,
            'name' => $newName,
        ]);
    }

    public function test_delete_city()
    {
        $city = City::factory()->create();

        $response = $this->delete('/api/cities/' . $city->id);
        $response->assertStatus(Response::HTTP_OK);

        $this->assertDatabaseMissing('cities', ['id' => $city->id]);
    }
}
