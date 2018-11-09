<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateSaldosTiendaZona extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('saldos', function (Blueprint $table) {
            
            $table->integer('id_tienda')->unsigned()->nullable(); 
            $table->foreign('id_tienda')->references('id')->on('tiendas');
            $table->integer('id_zona')->unsigned()->nullable(); 
            $table->foreign('id_zona')->references('id')->on('zonas');
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
