<?php

namespace App\Http\Controllers;

use App\Deportes;
use App\Farandula;
use App\Curiosidades;
use App\Noticias;
use Illuminate\Http\Request;
use App\Http\Requests;

class deleteController extends Controller
{
   public function destroy( $delId, $categoria){

switch ($categoria) {
    case "Deportes":
        $obj = Deportes::find($delId);
		$obj->delete();
        break;
    case "Noticias":
       	$obj = Noticias::find($delId);
		$obj->delete();
        break;
    case "Farandula":
        $obj = Farandula::find($delId);
		$obj->delete();
        break;
    case "Curiosidades":
        $obj = Curiosidades::find($delId);
		$obj->delete();
        break;
}

        echo "ELIMINADO";
    }
}
