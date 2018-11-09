<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_tienda')->unsigned();
            $table->integer('id_vendedor')->unsigned();
            $table->integer('id_cliente')->unsigned();
            $table->string('n_factura');
            $table->string('titulo');
            $table->string('codigo');
            $table->float('precio_base',18,14);
            $table->float('precio_oferta',18,14);
            $table->integer('descuento');
            $table->integer('cantidad');
            $table->integer('tipo_compra');
            $table->float('pago_efectivo',18,14)->nullable();
            $table->float('pago_tarjeta',18,14)->nullable();
            $table->float('total',18,14);
            $table->foreign('id_vendedor')->references('id')->on('users');
            $table->foreign('id_tienda')->references('id')->on('tiendas');
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
        Schema::dropIfExists('facturas');
    }
}
