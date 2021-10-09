<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExplorationPatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //se añade los campos a la tabla
        Schema::create('exploration_patients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('headExplo');
            $table->text('chestExplo');
            $table->text('extremitiesExplo');
            $table->text('neckExplo');
            $table->text('stomachExplo');
            $table->text('genitalsExplo');
            $table->text('forecastExplo');
            $table->text('diagnosisExplo');
            $table->text('treatmentExplo');
            $table->text('commentExplo');
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
        Schema::dropIfExists('exploration_patients');
    }
}
