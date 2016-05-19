<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
   protected $tabla = 'sliders';
    protected $fillable = array('idgaleria', 'src','titulo','descripcion');
}
