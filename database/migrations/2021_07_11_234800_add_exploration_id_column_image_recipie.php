<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExplorationIdColumnImageRecipie extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //se añade el campo que sera foreign key con restriccion para ser borrado
        Schema::table('image_recipies', function (Blueprint $table) {
            $table->unsignedBigInteger('exploration_id');
            $table
                ->foreign('exploration_id')
                ->references('id')
                ->on('exploration_patients')
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
        //Schema::table('image_recipies', function (Blueprint $table) {
        //    $table->dropForeign(['exploration_id']);
        //});
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('image_recipies');
        Schema::enableForeignKeyConstraints();
    }
}
