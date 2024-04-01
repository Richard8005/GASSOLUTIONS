<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Servicios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicios', function (Blueprint $table) {
            $table->id();
            $table->string('direccion');
            $table->date('fecha');
            $table->time('hora');
            $table->foreignId('tipos_id');
            $table->foreign('tipos_id')->references('id')->on('tipos');
            $table->foreignId('ciudades_id');
            $table->foreign('ciudades_id')->references('id')->on('ciudads');
            $table->foreignId('cliente_id');
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->foreignId('tecnicos_id');
            $table->foreign('tecnicos_id')->references('id')->on('tecnicos');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servicios');
    }
}
