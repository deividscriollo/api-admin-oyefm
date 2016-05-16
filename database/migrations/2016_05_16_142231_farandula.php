<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Farandula extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farandula', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo');
            $table->string('contenido');
            $table->string('referencia');
            $table->string('video');
            $table->string('img');
            $table->string('stado');
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
