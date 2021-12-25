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
            DB::table('menus')->where('id', $i)->update([
                'created_at' => date("Y/m/d H:i:s"),
                'updated_at' => date("Y/m/d H:i:s"),
            ]);
        }
    }
}
