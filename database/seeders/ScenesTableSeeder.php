<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class ScenesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 70; $i++) {
            DB::table('scenes')->insert([
                'restaurant_id' => $i,
            ]);
        }
    }
}
