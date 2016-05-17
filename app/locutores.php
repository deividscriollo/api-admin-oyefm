<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class locutores extends Model
{
    	protected $tabla = 'locutores';
    protected $fillable = array('id', 'nombres', 'apellidos','descripcion','id_programa');
}
