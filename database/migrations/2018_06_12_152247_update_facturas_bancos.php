<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateFacturasBancos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('facturas', function (Blueprint $table) {
            $table->integer('id_clase_pago')->unsigned()->nullable(); 
            $table->integer('id_franquicia')->unsigned()->nullable(); 
            $table->foreign('id_clase_pago')->references('id')->on('tiposdepagos');
            $table->foreign('id_franquicia')->references('id')->on('listadobancos');
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
