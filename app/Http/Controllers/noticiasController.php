<?php

namespace App\Http\Controllers;

use App\noticias;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class noticiasController extends Controller{

	public function __construct(){
		$this->middleware('cors');
	}
	/**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
       $noticias = noticias::orderBy('id', 'desc')->get();
       return response()->json($noticias->toArray());
    }
    //
    public function store(Request $request){

$categoria=$request->input('categoria');

if ($request->input('categoria')=="Deportes") {
     $tabla = new Deportes;
    //return response()->json(["mensaje"=>"Deportes"]);
};
if ($request->input('categoria')=="Noticia") {
    $tabla = new Noticias;
   // return response()->json(["mensaje"=>"Farandula"]);
};
if ($request->input('categoria')=="Farandula") {
    $tabla = new Farandula;
   // return response()->json(["mensaje"=>"Farandula"]);
};
if ($request->input('categoria')=="Curiosidades") {
    $tabla = new Curiosidades;
   // return response()->json(["mensaje"=>"Farandula"]);
};
    //$tabla->id = $request->input('id');
        $tabla->titulo = $request->input('titulo');
        $tabla->contenido = $request->input('contenido');
        $tabla->video = $request->input('video');
        $tabla->referencia = $request->input('referencia');
        $tabla->img = "1.jpg";
        $tabla->stado = "1";
        //$tabla->save();
       return response()->json(["mensaje"=>$request->all()]);

    }


}
