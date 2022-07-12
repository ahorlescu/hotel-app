<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            [
                'name' => 'Cameră dublă',
            ],
            [
                'name' => 'Suită',
            ],
            [
                'name' => 'Cameră single',
            ],
        ];

        foreach ($items as $item) {
            DB::table('room_types')->insert([
                'name' => $item['name'],
            ]);
        }
    }
}
