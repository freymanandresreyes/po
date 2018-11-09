<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCajamenorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cajamenors', function (Blueprint $table) {
            $table->increments('id');
            $table->float('base',18,14);
            $table->mediumtext('descripcion');
            $table->integer('entrada_id')->unsigned()->nullable();
            $table->integer('salida_id')->unsigned()->nullable();
            $table->integer('tiendas_id')->unsigned();
            $table->integer('id_usuario')->unsigned();
            $table->foreign('entrada_id')->references('id')->on('entradamenors');
            $table->foreign('salida_id')->references('id')->on('salidamenors');
            $table->foreign('tiendas_id')->references('id')->on('tiendas');
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
        Schema::dropIfExists('cajamenors');
    }
}
