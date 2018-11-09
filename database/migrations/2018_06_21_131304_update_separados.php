<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateSeparados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('separados', function (Blueprint $table) {
            $table->integer('tipo_pago');
            $table->integer('id_tienda')->unsigned();
            $table->float('precio_producto');
            $table->float('pago_efectivo');
            $table->float('pago_tarjeta_uno');
            $table->float('pago_tarjeta_dos');
            $table->foreign('id_tienda')->references('id')->on('tiendas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
