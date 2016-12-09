<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
// Extras
use DB;

class RadiosController extends Controller
{
	public function Add_Radio(Request $request){
		$cancion=json_encode(["nombre"=>$request->nombre_cancion,"artista"=>$request->artista]);
   	$save=DB::table('administracion.radios')->insert(['nombre'=>$request->input('nombre_radio'), 'stream_url'=>$request->input('stream_url'), 'cancion'=>$cancion, 'estado'=>TRUE]);
	$repuesta['respuesta']=$save;
	return response()->json([$repuesta]);
   }
   public function Get_Radios(Request $request){
   	$radios=DB::table('administracion.radios')->orderBy('nombre','ASC')->get();
	return response()->json(["respuesta"=>$radios]);
   }
}
