<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_proveedor')->unsigned();  
            $table->string('codigo_producto');
            $table->string('numero_factura');
            $table->integer('forma_pago');
            $table->date('fecha');
            $table->date('fecha_vencimiento')->nullable();  
            $table->integer('cantidad');
            $table->float('costo_und',18,14);
            $table->float('compra_total',18,14);
            $table->float('iva_compra',18,14);
            $table->float('total_compra',18,14);
            $table->foreign('id_proveedor')->references('id')->on('proveedores');
            $table->string('iva');
            $table->integer('id_tienda')->unsigned();
            $table->integer('id_user')->unsigned();
            $table->foreign('id_tienda')->references('id')->on('tiendas');
            $table->foreign('id_user')->references('id')->on('users');
            $table->integer('id_producto')->unsigned();
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
        Schema::dropIfExists('compras');
    }
}
