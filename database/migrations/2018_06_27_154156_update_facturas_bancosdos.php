<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateFacturasBancosdos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('facturas', function (Blueprint $table) {
            
            $table->integer('id_clase_pago_dos')->unsigned()->nullable(); 
            $table->integer('id_franquicia_dos')->unsigned()->nullable(); 
            $table->foreign('id_clase_pago_dos')->references('id')->on('tiposdepagos');
            $table->foreign('id_franquicia_dos')->references('id')->on('listadobancos');
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
