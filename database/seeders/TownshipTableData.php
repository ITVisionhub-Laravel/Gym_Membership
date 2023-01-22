<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TownshipTableData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('townships')->insert([
            ['name'=>'Tamwe',
            'city_id'=>'1'],
            ['name'=>'Ahlone',
            'city_id'=>'1'],
            ['name'=>'Dawbon',
            'city_id'=>'1'],
            ['name'=>'Hlaing',
            'city_id'=>'1'],
            ['name'=>'Sanchaung',
            'city_id'=>'1'],
            ['name'=>'Botahtaung',
            'city_id'=>'1'],
            ['name'=>'Bahan',
            'city_id'=>'1'],
            ['name'=>'Thingangyun',
            'city_id'=>'1'],
            ['name'=>'Aungmyethaxzi',
            'city_id'=>'2'],
            ['name'=>'Chanayethazan',
            'city_id'=>'2'],
            ['name'=>'Chanmyathazi',
            'city_id'=>'2'],
            ['name'=>'Maha Aungmye',
            'city_id'=>'2'],
            ['name'=>'Pyigyidagun',
            'city_id'=>'2'],
            ['name'=>'Amarapura',
            'city_id'=>'2'],
            ['name'=>'Patheingyi',
            'city_id'=>'2'],
            ['name'=>'Ottarathiri',
            'city_id'=>'3'],
            ['name'=>'Pobbathiri',
            'city_id'=>'3'],
            ['name'=>'Tatkone',
            'city_id'=>'3'],
            ['name'=>'Zeyathiri',
            'city_id'=>'3'],
            ['name'=>'Dekkhinathiri',
            'city_id'=>'3'],
            ['name'=>'Lewe',
            'city_id'=>'3'],
            ['name'=>'Pyinmana',
            'city_id'=>'3'],
            ['name'=>'Zabuthiri',
            'city_id'=>'3'],
        ]);
    }
}
