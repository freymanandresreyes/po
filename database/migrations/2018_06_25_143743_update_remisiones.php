<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateRemisiones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('remisiones', function (Blueprint $table) {
            $table->string('codigo'); 
            $table->float('precio');
            $table->integer('cantidad');
            $table->integer('tienda_envia')->unsigned();
            $table->integer('tienda_recibe')->unsigned();
            $table->foreign('tienda_envia')->references('id')->on('tiendas');
            $table->foreign('tienda_recibe')->references('id')->on('tiendas');            
            $table->integer('estado');          
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
