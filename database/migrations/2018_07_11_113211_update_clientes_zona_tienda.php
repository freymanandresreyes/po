<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateClientesZonaTienda extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clientes', function (Blueprint $table) {
            $table->integer('id_zona')->unsigned()->nullable();
            $table->integer('id_tienda')->unsigned()->nullable();    
            $table->foreign('id_zona')->references('id')->on('zonas');   
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
