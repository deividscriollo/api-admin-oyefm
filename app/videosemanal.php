<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class videosemanal extends Model
{
   protected $tabla = 'videosemanals';
    protected $fillable = array('id', 'titulo','genero','artista','cancion','url','otros');
}
