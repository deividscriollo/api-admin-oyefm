<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTop10sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('top10s', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre_cancion');
            $table->string('artista');
            $table->string('votos');
            $table->string('url');
            $table->integer('estado');
            // $table->date('inicio');
            // $table->date('fin');
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
        Schema::drop('top10s');
    }
}
