<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntradamenorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entradamenors', function (Blueprint $table) {
            $table->increments('id');
            $table->float('entrada',18,14)->nullable();
            $table->string('entrega')->nullable();
            $table->string('cedula_entrega')->nullable();
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
        Schema::dropIfExists('entradamenors');
    }
}
