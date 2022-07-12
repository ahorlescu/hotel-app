<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\Service;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services_count = Service::get()->count();
        $room_type_count = RoomType::get()->count();
        
        for ($count=0; $count < 10; $count++) { 
            $dateFrom = Carbon::now();
            $dateTill = Carbon::now()->addDays(rand(0, 365));
            $services = Service::inRandomOrder()->limit(rand(1,$services_count))->pluck('id');
            $room_type_id = RoomType::inRandomOrder()->get()->pluck('id');
    
            $room = Room::create([
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
                'room_type_id' => $room_type_id[0],
                'available_from' => $dateFrom,
                'available_till' => $dateTill,
            ]);
    
            $room->services()->attach($services);
        }
    }
}
