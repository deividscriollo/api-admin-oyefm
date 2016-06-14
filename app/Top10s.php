<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Top10s extends Model
{
    protected $tabla = 'top10s';
    protected $fillable = ['id', 'nombre_cancion','artista','votos','url','estado'];

    protected $hidden = ['created_at','updated_at','estado','votos'];
}
