<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuarioGrupoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario_grupo', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_grupo')->unsigned();
            $table->integer('id_usuario')->unsigned();
            $table->timestamps();
        });

        Schema::table('usuario_grupo', function(Blueprint $table) {
            $table->foreign('id_grupo')->references('id')->on('grupos')->onDelete('cascade');
            $table->foreign('id_usuario')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuario_grupo');
    }
}
