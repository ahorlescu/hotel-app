<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
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
                'name' => 'piscina',
                'icon' => 'fas fa-swimming-pool',
            ],
            [
                'name' => 'spa și centru de wellness',
                'icon' => 'fas fa-spa',
            ],
            [
                'name' => 'parcare',
                'icon' => 'fas fa-parking',
            ],
            [
                'name' => 'camere de familie',
                'icon' => 'fas fa-users',
            ],
            [
                'name' => 'WiFi gratuit inclus',
                'icon' => 'fas fa-wifi',
            ],
            [
                'name' => 'bar',
                'icon' => 'fas fa-glass-martini',
            ],
        ];

        foreach ($items as $item) {
            DB::table('services')->insert([
                'name' => $item['name'],
                'icon' => $item['icon'],
            ]);
        }
    }
}
