<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPatientIdColumnPhysicalExam extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //se añade el campo que sera foreign key con restriccion para ser borrado
        Schema::table('physical_exams', function (Blueprint $table) {
            $table->unsignedBigInteger('patient_id');
            $table
                ->foreign('patient_id')
                ->references('id')
                ->on('patients')
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
