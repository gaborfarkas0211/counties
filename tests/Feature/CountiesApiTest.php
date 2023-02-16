<?php

namespace Tests\Feature;

use App\Models\City;
use App\Models\County;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Database\Seeders\CountySeeder;

class CountiesApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Seed the database before each test.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(CountySeeder::class);
    }

    public function test_counties_endpoint_returns_correct_data_structure(): void
    {
        $response = $this->get('/api/counties');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'data' => [
                    '*' => [
                        'id',
                        'name'
                    ]
                ]
            ]);
    }

    public function test_counties_endpoint_returns_correct_data(): void
    {
        $response = $this->get('/api/counties');

        $responseData = $response->json()['data'];

        foreach ($responseData as $county) {
            $this->assertArrayHasKey('id', $county);
            $this->assertIsInt($county['id']);
            $this->assertArrayHasKey('name', $county);
            $this->assertIsString($county['name']);
        }
    }

    public function test_county_show_cities_endpoint_returns_correct_data_structure()
    {
        $county = County::query()->inRandomOrder()->first();
        City::factory()->create(['county_id' => $county->id]);

        $response = $this->get('/api/counties/' . $county->id . '/cities');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'data' => [
                    '*' => [
                        'id',
                        'name'
                    ]
                ]
            ]);
    }

    public function test_county_show_cities_endpoint_returns_correct_data()
    {
        $county = County::query()->inRandomOrder()->first();
        $city = City::factory()->create(['county_id' => $county->id]);

        $response = $this->get('/api/counties/' . $county->id . '/cities');

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'data' => [
                    ['id' => $city->id, 'name' => $city->name],
                ]
            ]);
    }
}
