<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExplorationIdColumnDrugsRecipie extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //se añade el campo que sera foreign key con restriccion para ser borrado
        Schema::table('drugs_recipies', function (Blueprint $table) {
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
        //Schema::table('drugs_recipies', function (Blueprint $table) {
        //    $table->dropForeign(['exploration_id']);
        //});
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('drugs_recipies');
        Schema::enableForeignKeyConstraints();
    }
}
