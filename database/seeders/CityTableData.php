<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CityTableData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')->insert([
            ['name'=>'Yangon'],
            ['name'=>'Mandaly'],
            ['name'=>'Naypyidaw'],
            ['name'=>'Mawlamyine'],
            ['name'=>'Taunggyi'],
            ['name'=>'Bago'],
            ['name'=>'Monywa'],
            ['name'=>'Myintkyina'],
            ['name'=>'Pathein'],
            ['name'=>'Sittwe'],
            ['name'=>'Pyay'],
            ['name'=>'Pakokku'],
            ['name'=>'Myeik'],
            ['name'=>'Meiktila'],
            ['name'=>'Taungoo'],
        ]);
    }
}
