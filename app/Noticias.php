<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Noticias extends Model
{
	protected $tabla = 'Noticias';
    protected $fillable = array('id', 'titulo', 'descripcion','URL','refencia','img', 'estado', 'created_at');
}
