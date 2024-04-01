<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Agendamientos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agendamientos', function (Blueprint $table) {
            $table->id();
            $table->time('hora');
            $table->string('estado');
            $table->date('fecha');
            $table->foreignId('servicios_id');
            $table->foreign('servicios_id')->references('id')->on('servicios');
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
        Schema::dropIfExists('agendamientos');

    }
}
