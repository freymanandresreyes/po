<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDevoluciones2018sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devoluciones2018s', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_factura')->unsigned();
            $table->integer('id_cliente')->unsigned();
            $table->string('codigo_producto');
            $table->string('precio_producto');
            $table->string('cantidad');
            $table->string('n_factura');
            $table->foreign('id_factura')->references('id')->on('facturas');
            $table->foreign('id_cliente')->references('id')->on('clientes');
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
        Schema::dropIfExists('devoluciones2018s');
    }
}
