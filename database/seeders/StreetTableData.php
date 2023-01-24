<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StreetTableData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('streets')->insert([
            ['name'=>'Ananda Gon Yi Street',
            'township_id'=>'1'],
            ['name'=>'Aung Tay Za Street',
            'township_id'=>'1'],
            ['name'=>'Aung Thu Kha Street',
            'township_id'=>'1'],
            ['name'=>'Arthawka Street',
            'township_id'=>'1'],
            ['name'=>'Awbar Street',
            'township_id'=>'1'],
            ['name'=>'Artharwaddy Stree',
            'township_id'=>'2'],
            ['name'=>'Aung Yadana Street',
            'township_id'=>'2'],
            ['name'=>'Aung Zay Ya Street',
            'township_id'=>'2'],
            ['name'=>'Ayarwaddy Street',
            'township_id'=>'2'],
            ['name'=>'Aye Street',
            'township_id'=>'2'],
        ]);
    }
}
