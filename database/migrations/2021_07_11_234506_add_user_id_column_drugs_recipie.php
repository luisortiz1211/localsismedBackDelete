<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdColumnDrugsRecipie extends Migration
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
        //Schema::table('drugs_recipies', function (Blueprint $table) {
        //    $table->dropForeign(['user_id']);
        //});
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('drugs_recipies');
        Schema::enableForeignKeyConstraints();
    }
}
