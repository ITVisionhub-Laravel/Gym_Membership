<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Address;
use App\Models\City;
use App\Models\Street;
use App\Models\Township;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Street::truncate();
        City::truncate();
        Township::truncate();
        Address::truncate();
        Street::factory(30)->create();

        $this->call([
        CityTableData::class,
        TownshipTableData::class,
        AddressTableData::class,
    ]);
    }
}
