<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Programas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('target');
            $table->string('edades');
            $table->string('audiencia');
            $table->string('frecuencias');
            $table->string('sintonia');
            $table->string('musical');
            $table->string('dias');
            $table->string('horario');
            $table->string('descripcion');
            $table->string('estado');
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
        //
    }
}
