<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateControlcajasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('controlcajas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_tienda')->unsigned();
            $table->integer('id_vendedor')->unsigned()->nullable();
            $table->integer('n_caja');
            $table->float('saldo',18,14);
            $table->integer('estado');
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->foreign('id_vendedor')->references('id')->on('users');
            $table->foreign('id_tienda')->references('id')->on('tiendas');
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
        Schema::dropIfExists('controlcajas');
    }
}
