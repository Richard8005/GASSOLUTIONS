<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Evaluacions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluacions', function (Blueprint $table) {
            $table->id();
            $table->float('calificacion');
            $table->foreignId('agendamientos_id');
            $table->foreign('agendamientos_id')->references('id')->on('agendamientos');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evaluacions');

    }
}
