<?php

namespace Tests\Unit;

use App\Models\County;
use Database\Seeders\CountySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CountySeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_seeder_inserts_data_correctly()
    {
        $this->seed();

        $counties = [
            'Pest',
            'Győr-Moson-Sopron',
            'Borsod-Abaúj-Zemplén',
            'Fejér',
            'Bács-Kiskun',
            'Hajdú-Bihar',
            'Szabolcs-Szatmár-Bereg',
            'Komárom-Esztergom',
            'Csongrád-Csanád',
            'Veszprém',
            'Vas',
            'Jász-Nagykun-Szolnok',
            'Baranya',
            'Heves',
            'Békés',
            'Zala',
            'Somogy',
            'Tolna',
            'Nógrád',
        ];

        foreach ($counties as $county) {
            $this->assertDatabaseHas('counties', [
                'name' => $county
            ]);
        }

        $this->assertEquals(count(CountySeeder::$counties), County::count());
    }
}
