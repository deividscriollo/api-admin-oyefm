<?php

namespace App\Http\Controllers;

use App\Deportes;
use App\Farandula;
use App\Curiosidades;
use App\Noticias;
use App\img_noticias;
use App\img_deportes;
use App\img_farandula;
use App\img_curiosidades;
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
       $noticias = Deportes::orderBy('id', 'desc')->get();
       return response()->json($noticias->toArray());
    }
    //
    public function store(Request $request){

$categoria=$request->input('datos.categoria');


switch ($categoria) {
    case "Deportes":
        $tabla = new Deportes;
        break;
    case "Noticia":
       $tabla = new Noticias;
        break;
    case "Farandula":
        $tabla = new Farandula;
        break;
    case "Curiosidades":
        $tabla = new Curiosidades;
        break;
}

        $tabla->titulo = $request->input('datos.titulo');
        $tabla->contenido = $request->input('datos.contenido');
        $tabla->video = $request->input('datos.video');
        $tabla->referencia = $request->input('datos.referencia');
        $tabla->stado = "1";
        $tabla->save();
        $idnoticias = $tabla->id;
           $files = $request->file('file');
        $i=0;
        foreach ($files as $img) {
switch ($categoria) {
    case "Deportes":
        $imgtable = new img_deportes;
        break;
    case "Noticia":
       $imgtable = new img_noticias;
        break;
    case "Farandula":
        $imgtable = new img_farandula;
        break;
    case "Curiosidades":
        $imgtable = new img_curiosidades;
        break;
}
            $extension = $img->getClientOriginalExtension();
            $imgtable->id_categoria=$idnoticias;
            $imgtable->src="noticia_".$idnoticias."_".$i.".".$extension;
            $imgtable->save();
            $img->move(base_path().'/public/imgnoticias/', "noticia_".$idnoticias."_".$i.".".$extension);
            //$tabla::where('id', '=', $idnoticias)->update(['img' => "noticia_".$idnoticias."_".$i.".".$extension]);
            $i++;
        }


     
       return $tabla->id;

    }


}
