<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCanalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('canales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user')->unsigned();
            $table->string('url');
            $table->string('nombreCanal');
            $table->text('descripcion');
            $table->float('longitud');
            $table->float('latitud');
            $table->string('nombreSensor');
            $table->timestamps();
            // id, id_user, url, nombreCanal, descripcion, longitud, latitud, nombreSensor, fecha
        });

        Schema::table('canales', function(Blueprint $table) {
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('canales');
    }
}
