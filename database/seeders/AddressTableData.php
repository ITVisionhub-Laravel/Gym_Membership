<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddressTableData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('addresses')->insert([
            ['street_id'=>'1',
            'township_id'=>'1'],
            ['street_id'=>'2',
            'township_id'=>'1'],
            ['street_id'=>'3',
            'township_id'=>'1'],
            ['street_id'=>'4',
            'township_id'=>'1'],
            ['street_id'=>'5',
            'township_id'=>'1'],
            ['street_id'=>'6',
            'township_id'=>'2'],
            ['street_id'=>'7',
            'township_id'=>'2'],
            ['street_id'=>'8',
            'township_id'=>'2'],
            ['street_id'=>'9',
            'township_id'=>'2'],
            ['street_id'=>'10',
            'township_id'=>'2'],
            ['street_id'=>'11',
            'township_id'=>'3'],
            ['street_id'=>'12',
            'township_id'=>'3'],
            ['street_id'=>'13',
            'township_id'=>'3'],
            ['street_id'=>'14',
            'township_id'=>'3'],
            ['street_id'=>'15',
            'township_id'=>'3'],
        ]);
    }
}
