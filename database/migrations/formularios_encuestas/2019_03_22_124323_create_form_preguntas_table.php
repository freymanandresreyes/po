<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormPreguntasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_preguntas', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('id_formulario')->unsigned();
            $table->foreign('id_formulario')->references('id')->on('formularios');

            $table->integer('pregunta_opcion')->unsigned();
            $table->foreign('pregunta_opcion')->references('id')->on('preguntas_opciones');

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
        Schema::dropIfExists('form_preguntas');
    }
}
