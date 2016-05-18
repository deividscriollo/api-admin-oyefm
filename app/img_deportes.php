<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class img_deportes extends Model
{
    protected $tabla = 'img_deportes';
    protected $fillable = array('idimg', 'id_categoria', 'src');
}
