<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //se añade los campos a la tabla
        Schema::create('patients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('ci')->unique();
            $table->string('name');
            $table->string('lastName');
            $table->bigInteger('sex');
            $table->string('civilStatus');
            $table->string('birthay');
            $table->string('employment')->nullable();
            $table->string('email')->unique();
            $table->bigInteger('movil')->nullable();
            $table->bigInteger('landline')->nullable();
            $table->string('address')->nullable();
            $table->string('nationality')->nullable();
            $table->string('city')->nullable();
            $table->string('parish')->nullable();
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
        Schema::dropIfExists('patients');
    }
}
