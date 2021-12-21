<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class RestaurantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 10; $i++) {
            DB::table('restaurants')->insert([
                'name' => 'オススメ店舗テスト'. $i,
                'pref' => '大阪府',
                'zip' => '532-0000',
                'address' => '住所',
                'open_time' => '10:00',
                'close_time' => '16:00',
                'url' => 'url',
                'tel' => '00-0000-0000',
                'adress_remarks' => '備考',
                'time_remarks' => '備考',
                'inquiry_remarks' => '備考',
                'recommend_flg' => '1',
            ]);
        }
    }
}
