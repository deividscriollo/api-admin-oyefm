<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosemalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videosemanals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo');
            $table->string('genero');
            $table->string('artista');
            $table->string('cancion');
            $table->string('url');
            $table->string('otros');
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
        Schema::drop('videosemanals');
    }
}
