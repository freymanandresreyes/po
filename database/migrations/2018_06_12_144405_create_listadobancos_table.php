<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListadobancosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listadobancos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_tipo_pago')->unsigned();
            $table->string('nombre'); 
            $table->foreign('id_tipo_pago')->references('id')->on('tiposdepagos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('listadobancos');
    }
}
