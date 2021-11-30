<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 20; $i++) {
            DB::table('menus')->insert([
                'restaurant_id' => 71,
                'name' => 'オススメメニューテスト'. $i,
                'price' => '2000' + $i,
                'explain' => 'オススメの麻婆豆腐です！'. $i,
                'recommend_flg' => '1',
            ]);
        }
    }
}
