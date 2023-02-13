<?php

namespace Database\Seeders;

use App\Models\County;
use Illuminate\Database\Seeder;

class CountySeeder extends Seeder
{
    public static array $counties = [
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

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        foreach (self::$counties as $county) {
            County::firstOrCreate(['name' => $county]);
        }
    }
}
