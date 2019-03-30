<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateClienteslibranza extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clientes', function (Blueprint $table) {
            $table->integer('aplica_libranza')->unsigned()->nullable();
            $table->foreign('aplica_libranza')->references('id')->on('siyno');
            $table->float('monto_libranza',18,14)->nullable();
            $table->float('porcentaje_descuento',18,14)->nullable();
            $table->integer('entidad')->nullable();
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
