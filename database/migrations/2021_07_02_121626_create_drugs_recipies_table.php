<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDrugsRecipiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //se añade los campos a la tabla
        Schema::create('drugs_recipies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('coddrug');
            $table->string('nameDrugRecipie');
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
        Schema::dropIfExists('drugs_recipies');
    }
}
