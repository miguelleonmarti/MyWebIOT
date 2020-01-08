<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGrupoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupo', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->integer('id_creador')->unsigned();
            $table->integer('id_invitado')->unsigned();
            $table->timestamps();
        });

        Schema::table('grupo', function(Blueprint $table) {
            $table->foreign('id_creador')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_invitado')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grupo');
    }
}
