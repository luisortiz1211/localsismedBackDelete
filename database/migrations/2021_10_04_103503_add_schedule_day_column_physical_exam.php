<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddScheduleDayColumnPhysicalExam extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('physical_exams', function (Blueprint $table) {
            $table->unsignedBigInteger('schedule_day');
            $table
                ->foreign('schedule_day')
                ->references('id')
                ->on('schedule_days')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('physical_exams');
        Schema::enableForeignKeyConstraints();
    }
}