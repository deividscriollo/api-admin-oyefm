<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class img_noticias extends Model
{
    protected $tabla = 'img_noticias';
    protected $fillable = array('idimg', 'id_categoria', 'src');
}
