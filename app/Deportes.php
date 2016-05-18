<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deportes extends Model
{
    //
    protected $tabla = 'Deportes';
    protected $fillable = array('id', 'titulo', 'descripcion','URL','refencia','estado', 'created_at');
}
