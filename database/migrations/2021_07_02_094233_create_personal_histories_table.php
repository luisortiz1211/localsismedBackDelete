<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //se añade los campos a la tabla
        Schema::create('personal_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nameCondition');
            $table->integer('yearCondition');
            $table->string('commentCondition');
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
        Schema::dropIfExists('personal_histories');
    }
}
