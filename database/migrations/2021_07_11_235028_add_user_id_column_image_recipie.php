<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdColumnImageRecipie extends Migration
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
            $table->unsignedBigInteger('user_id');
            $table
                ->foreign('user_id')
                ->references('id')
                ->on('users')
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
        //    $table->dropForeign(['user_id']);
        //});
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('image_recipies');
        Schema::enableForeignKeyConstraints();
    }
}
