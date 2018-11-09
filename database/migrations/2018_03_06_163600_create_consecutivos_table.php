<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsecutivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consecutivos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_tienda')->unsigned();
            $table->string('tag');
            $table->integer('consecutivo');
            $table->foreign('id_tienda')->references('id')->on('tiendas');
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
        Schema::dropIfExists('consecutivos');
    }
}
