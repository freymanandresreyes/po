<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateRemisionesTraslados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        Schema::table('remisiones', function (Blueprint $table) {
            $table->integer('codigo_producto')->unsigned()->nullable(); 
            $table->integer('id_proveedor')->unsigned()->nullable(); 
            $table->integer('tipo')->nullable(); 
            $table->foreign('codigo_producto')->references('id')->on('productos'); 
            $table->foreign('id_proveedor')->references('id')->on('proveedores');
                     
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
