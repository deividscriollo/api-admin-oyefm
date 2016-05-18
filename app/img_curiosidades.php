<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class img_curiosidades extends Model
{
    protected $tabla = 'img_curiosidades';
    protected $fillable = array('idimg', 'id_categoria', 'src');
}
