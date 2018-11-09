<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config_usuarios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_tipo_usuario')->unsigned()->nullable(); 
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->integer('estado')->unsigned()->nullable();
            $table->foreign('id_tipo_usuario')->references('id')->on('tipos_usuarios'); 
            $table->foreign('estado')->references('id')->on('siyno'); 
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
        Schema::dropIfExists('config_usuarios');
    }
}
