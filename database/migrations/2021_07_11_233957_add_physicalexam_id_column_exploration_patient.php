<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPhysicalexamIdColumnExplorationPatient extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //se añade el campo que sera foreign key con restriccion para ser borrado
        Schema::table('exploration_patients', function (Blueprint $table) {
            $table->unsignedBigInteger('physicalExam_id');
            $table
                ->foreign('physicalExam_id')
                ->references('id')
                ->on('physical_exams')
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
        Schema::dropIfExists('exploration_patients');
        Schema::enableForeignKeyConstraints();
    }
}
