<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->string('name1');
            $table->string('name2');
            $table->string('name3');
            $table->text('profile');
            $table->string('pref', 4);
            $table->string('zip', 8);
            $table->string('address');
            $table->time('open_time');
            $table->time('close_time');
            $table->integer('category_id');
            $table->string('url');
            $table->string('tel', 20);
            $table->string('address_remarks')->nullable();
            $table->string('time_remarks')->nullable();
            $table->string('inquiry_remarks')->nullable();
            $table->integer('recommend_flg')->length(1);
            $table->integer('new_flg')->length(1);
            $table->string('main_img', 50);
            $table->string('sub_img1', 50)->nullable();
            $table->string('sub_img2', 50)->nullable();
            $table->string('sub_img3', 50)->nullable();
            $table->string('sub_img4', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restaurants');
    }
}
