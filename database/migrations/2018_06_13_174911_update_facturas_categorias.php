<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateFacturasCategorias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('facturas', function (Blueprint $table) {
            $table->integer('id_categoria')->unsigned()->nullable(); 
            $table->integer('id_subcategoria')->unsigned()->nullable(); 
            $table->foreign('id_categoria')->references('id')->on('categorias');
            $table->foreign('id_subcategoria')->references('id')->on('subcategorias');
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
