<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curiosidades extends Model
{
    //
    protected $tabla = 'Curiosidades';
    protected $fillable = array('id', 'titulo', 'descripcion','URL','refencia','estado', 'created_at');
}
