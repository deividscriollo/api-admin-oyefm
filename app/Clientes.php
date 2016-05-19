<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    protected $tabla = 'clientes';
    protected $fillable = array('id', 'nombre_cliente', 'logo','titulo','descripcion','estado');
}
