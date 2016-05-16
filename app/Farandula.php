<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Farandula extends Model
{
    //
    protected $tabla = 'Farandula';
    protected $fillable = array('id', 'titulo', 'descripcion','URL','refencia','img', 'estado', 'created_at');
}
