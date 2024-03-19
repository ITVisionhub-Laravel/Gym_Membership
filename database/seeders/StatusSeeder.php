<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas =  ['Delivered', 'Returned', 'Paid', 'Not Paid', 'Canceled', 'Ordered'];
        foreach ($datas as $data) {
            Status::create([
                'status' => $data
            ]);
        }
    }
}
