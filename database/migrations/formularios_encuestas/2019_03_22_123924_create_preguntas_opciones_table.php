<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreguntasOpcionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preguntas_opciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pregunta')->unsigned();
            $table->foreign('pregunta')->references('id')->on('preguntas');
            $table->integer('opcion')->unsigned();
            $table->foreign('opcion')->references('id')->on('opciones');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('preguntas_opciones');
    }
}
