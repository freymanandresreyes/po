<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalidamenorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salidamenors', function (Blueprint $table) {
            $table->increments('id');
            $table->float('salida',18,14)->nullable();
            $table->string('recibe')->nullable();
            $table->string('cedula_recibe')->nullable();
            $table->string('motivo')->nullable();
            $table->integer('tiendas_id')->unsigned();
            $table->foreign('tiendas_id')->references('id')->on('tiendas');
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
        Schema::dropIfExists('salidamenors');
    }
}
