<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class LoginIdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 104; $i++) {
            DB::table('restaurants')->where('id', $i)->update([
                'login_id' => 'A'. $i,
            ]);
        }
    }
}
