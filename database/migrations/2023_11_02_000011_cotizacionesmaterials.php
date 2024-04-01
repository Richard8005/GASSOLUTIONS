<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CotizacionesMaterials extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotizacionesmaterials', function (Blueprint $table) {
            $table->id();
            // Clave foránea para la tabla "cotizacions"
            $table->unsignedBigInteger('cotizacions_id');
            $table->foreign('cotizacions_id')->references('id')->on('cotizacions')->onDelete('cascade');

            // Clave foránea para la tabla "materials"
            $table->unsignedBigInteger('materials_id');
            $table->foreign('materials_id')->references('id')->on('materials')->onDelete('cascade');
        });

           
       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cotizacionesmaterials');
    }
}