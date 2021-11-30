<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommitmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commitments', function (Blueprint $table) {
            $table->id();
            $table->integer('all_eat');
            $table->integer('all_drink');
            $table->integer('private_room');
            $table->integer('net_booking');
            $table->integer('stylish');
            $table->integer('sofa');
            $table->integer('smoking');
            $table->integer('no_smoking');
            $table->integer('reserved');
            $table->integer('morning');
            $table->integer('lunch');
            $table->integer('dinner');
            $table->integer('clean_scenery');
            $table->integer('card');
            $table->integer('celebration');
            $table->integer('take_out');
            $table->integer('bring_in');
            $table->integer('karaoke');
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
        Schema::dropIfExists('commitments');
    }
}
