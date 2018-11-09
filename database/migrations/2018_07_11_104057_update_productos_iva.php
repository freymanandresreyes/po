<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateProductosIva extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('productos', function (Blueprint $table) {  
            $table->integer('aplicar_iva')->unsigned()->nullable();
            $table->foreign('aplicar_iva')->references('id')->on('siyno');
            $table->foreign('oferta')->references('id')->on('siyno');
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
