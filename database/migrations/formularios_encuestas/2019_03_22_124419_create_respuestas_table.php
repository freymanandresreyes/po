<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRespuestasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('respuestas', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('id_formulario')->unsigned();
            $table->foreign('id_formulario')->references('id')->on('formularios');
            
            $table->integer('id_pregunta')->unsigned();
            $table->foreign('id_pregunta')->references('id')->on('preguntas');

            $table->integer('id_respuesta')->unsigned()->nullable();
            $table->foreign('id_respuesta')->references('id')->on('preguntas_opciones');

            $table->string('respuesta_abierta')->nullable();

            $table->integer('id_tienda')->unsigned();
            $table->foreign('id_tienda')->references('id')->on('tiendas');

            $table->integer('id_usuario')->unsigned();
            $table->foreign('id_usuario')->references('id')->on('users');

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
        Schema::dropIfExists('respuestas');
    }
}
