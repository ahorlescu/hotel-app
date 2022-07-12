<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GeneralInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('general_infos')->insert([
            'email' => 'hotelapp@hotel.com',
            'facebook_url' => 'https://facebook.com',
            'map_url' => '<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d11397.142004786554!2d26.0472761!3d44.4273055!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40b201b5f3164efb%3A0xf58f1b78be7f0c97!2sPlaza%20Rom%C3%A2nia!5e0!3m2!1sro!2sro!4v1613494736556!5m2!1sro!2sro" width="100%" height="600" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>',
            'tel' => '+40755656565',
            'address' => 'Bd. Timișoara 26, București 061331',
        ]);

    }
}
