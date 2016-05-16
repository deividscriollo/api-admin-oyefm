<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deportes extends Model
{
    //
    protected $tabla = 'Deportes';
    protected $fillable = array('id', 'titulo', 'descripcion','URL','refencia','img', 'estado', 'created_at');
}
