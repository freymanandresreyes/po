<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDevolucionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devoluciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_factura')->unsigned()->nullable();
            $table->string('factura');
            $table->string('radicado');
            $table->string('producto');
            $table->string('referencia');
            $table->float('valor',18,14);
            $table->integer('cantidad');
            $table->string('descripcion_recibo');
            $table->string('descripcion_entrega')->nullable();
            $table->integer('estado');
            $table->foreign('id_factura')->references('id')->on('facturas');
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
        Schema::dropIfExists('devoluciones');
    }
}
