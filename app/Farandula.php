<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Farandula extends Model
{
    //
    protected $tabla = 'farandula';
    protected $fillable = array('id', 'titulo', 'descripcion','URL','refencia','estado', 'created_at');
}
