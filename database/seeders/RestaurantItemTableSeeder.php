<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class RestaurantItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 80; $i++) {
            DB::table('restaurant_holidays')->insert([
                'restaurant_id' => $i,
                'sunday' => '1',
                'monday' => '1',
                'tuesday' => '1',
                'wednesday' => '1',
                'thursday' => '1',
                'friday' => '1',
                'saturday' => '1',
                'none' => '0',
            ]);

            DB::table('restaurant_cards')->insert([
                'restaurant_id' => $i,
                'visa' => '1',
                'mastercard' => '0',
                'jcb' => '1',
                'diners' => '0',
                'amex' => '1',
                'other' => '0',
            ]);
            
        }
    }
}
