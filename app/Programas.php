<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Programas extends Model
{
    protected $tabla = 'programas';
    protected $fillable = array('id', 'nombre','target','logo','edades','audiencia','sintonia', 'frecuencias','musical','dias','horario','descripcion');
}
