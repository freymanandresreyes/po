<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeparadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('separados', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_cliente')->unsigned();
            $table->integer('id_producto')->unsigned();
            $table->float('fecha_vencimiento');
            $table->foreign('id_cliente')->references('id')->on('clientes');
            $table->foreign('id_producto')->references('id')->on('productos');
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
        Schema::dropIfExists('separados');
    }
}
