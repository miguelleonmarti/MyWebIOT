<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatossensoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datossensores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_canal')->unsigned();
            $table->float('dato');
            $table->timestamps();
            // id, id_canal, dato, fecha
        });

        Schema::table('datossensores', function(Blueprint $table) {
            $table->foreign('id_canal')->references('id')->on('canales')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('datossensores');
    }
}
