<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLibranzaCuotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('libranza_cuotas', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('id_user')->unsigned();
            $table->foreign('id_user')->references('id')->on('users');

            $table->integer('id_factura')->unsigned();
            $table->foreign('id_factura')->references('id')->on('facturas');
            
            $table->integer('id_empresa')->unsigned();
            $table->foreign('id_empresa')->references('id')->on('empresas_cuotas');

            $table->integer('total_cuotas')->nullable();

            $table->integer('cuotas_debe')->nullable();
            
            $table->integer('cuotas_pagas')->nullable();

            $table->float('total_factura',18,14)->nullable();

            $table->float('deuda',18,14)->nullable();

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
        Schema::dropIfExists('libranza_cuotas');
    }
}
