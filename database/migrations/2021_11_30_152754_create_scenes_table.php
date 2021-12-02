<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScenesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scenes', function (Blueprint $table) {
            $table->id();
            $table->integer('restaurant_id');
            $table->integer('one_person');
            $table->integer('family');
            $table->integer('with_friend');
            $table->integer('many_people');
            $table->integer('kitty_party');
            $table->integer('dating');
            $table->integer('joint_party');
            $table->integer('reception');
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
        Schema::dropIfExists('scenes');
    }
}
