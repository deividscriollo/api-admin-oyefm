<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class img_farandula extends Model
{
    protected $tabla = 'img_farandula';
    protected $fillable = array('idimg', 'id_categoria', 'src');
}
