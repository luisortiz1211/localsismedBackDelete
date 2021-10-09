<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduleDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //se añade los campos a la tabla
        Schema::create('schedule_days', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('scheduleDay');
            $table->time('scheduleTime');
            //$table->boolean('availableStatus');
            $table->bigInteger('userAssigned');
            $table->string('scheduleDayState');
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
        Schema::dropIfExists('schedule_days');
    }
}
