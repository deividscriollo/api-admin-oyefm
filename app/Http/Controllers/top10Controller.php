<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Top10s;

class top10Controller extends Controller
{
	public function __construct() {
        $this-> middleware('cors');
        // $this->middleware('jwt.auth', ['except' => ['authenticate']]);
    }

    public function addTop10(Request $request)
    {
        $tabla_top=new Top10s();
        $tabla_top->where('estado',1)->update(["estado"=>0]);

        foreach ($request->input('top') as $key => $cancion) {
         $tabla_top=new Top10s();
         $tabla_top->nombre_cancion=$cancion['cancion'];
         $tabla_top->artista=$cancion['artista'];
         $tabla_top->votos=0;
         $tabla_top->url=$cancion['url'];
         $tabla_top->estado=1;
         $savelista=$tabla_top->save();
        }

       return response()->json(["respuesta"=>true]);
    }

    public function getlistaTop10(Request $request){

    	$table=new Top10s();
    	$datos=$table->orderBy('votos', 'desc')->where('estado','=',1)->get();
    	return response()->json(array('top10'=>$datos));
    }
}
