<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateComprasConfiguraciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('compras', function (Blueprint $table) {
            $table->integer('oferta')->unsigned()->nullable(); 
            $table->float('descuento_oferta')->nullable(); 
            $table->integer('configuraciones')->unsigned()->nullable(); 
            $table->integer('aplicar_iva')->unsigned()->nullable();
            $table->foreign('oferta')->references('id')->on('siyno'); 
            $table->foreign('configuraciones')->references('id')->on('clasificacionproductos');
            $table->foreign('aplicar_iva')->references('id')->on('siyno');
            
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
