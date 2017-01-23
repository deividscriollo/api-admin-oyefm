<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Noticias extends Model
{
	protected $tabla = 'Noticias';
    protected $fillable = array('id', 'titulo', 'contenido','video','refencia','stado', 'created_at','id_programa');
}
