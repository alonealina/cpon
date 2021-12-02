<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 50; $i++) {
            DB::table('comments')->insert([
                'restaurant_id' => 1,
                'user_id' => 1,
                'fivestar' => 4,
                'comment' => 'コメントテスト' . $i,
            ]);
        }
    }
}
