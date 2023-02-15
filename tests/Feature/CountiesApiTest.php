<?php

namespace Tests\Feature;

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
}
