<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIteamReservation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Reservation', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user');
            $table->date('from');
            $table->date('to');
            $table->time('time_from');
            $table->time('time_to');
            $table->integer('reservation_id');
            $table->string('reservation_type');
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
        Schema::dropIfExists('Reservation');
    }
}
