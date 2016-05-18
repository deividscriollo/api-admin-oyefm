<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class galeria extends Model
{
    protected $tabla = 'galerias';
    protected $fillable = array('idgaleria', 'src', 'descripcion');
}
