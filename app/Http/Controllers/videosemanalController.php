<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\videosemanal;

class videosemanalController extends Controller
{
   public function __construct() {
        $this-> middleware('cors');
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public
    function index() {
        $videosemanal = videosemanal::orderBy('id', 'desc')->first()->get();
        return response()-> json($videosemanal->toArray());
    }
    //
    public
    function store(Request $request) {

	$tabla = new videosemanal;
	$tabla->titulo=$request->input('titulo');
	$tabla->genero=$request->input('genero');
	$tabla->artista=$request->input('artista');
	$tabla->cancion=$request->input('cancion');
	$tabla->url=$request->input('url');
	$tabla->otros=$request->input('otros');
	$tabla->save();
    	return response()->json(["mensaje"=>"Video semanal guardado correctamente"]);
    }
}
