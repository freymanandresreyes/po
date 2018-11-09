<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_tienda')->unsigned();
            $table->integer('id_categoria')->unsigned();
            $table->integer('id_subcategoria')->unsigned();
            $table->string('ruta')->nullable();
            $table->string('titulo');
            $table->string('codigo');
            $table->string('descripcion');
            $table->float('precio',18,14);
            $table->integer('cantidad_ingreso');
            $table->integer('cantidad');
            $table->integer('cantidad_ventas');
            $table->integer('oferta')->unsigned();
            $table->integer('descuentoOferta');
            $table->datetime('inicioOferta')->nullable();
            $table->datetime('finOferta')->nullable();
            $table->foreign('id_tienda')->references('id')->on('tiendas');
            $table->foreign('id_categoria')->references('id')->on('categorias');
            $table->foreign('id_subcategoria')->references('id')->on('subcategorias');
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
        Schema::dropIfExists('productos');
    }
}
