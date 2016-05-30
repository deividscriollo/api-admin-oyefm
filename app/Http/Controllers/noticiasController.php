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
        $this->middleware('jwt.auth', ['except' => ['authenticate']]);
	}
	/**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        if (Noticias::orderBy('id', 'desc')->get()) {
     $noticias = Noticias::orderBy('id', 'desc')->get();
        }
        else{
            $noticias="SIN PUBLICACIONES";
        }
        if (Deportes::orderBy('id', 'desc')->get()) {
                  $deportes = Deportes::orderBy('id', 'desc')->get();
        }
        else{
            $deportes="SIN PUBLICACIONES";
        }
        if (Farandula::orderBy('id', 'desc')->get()) {
                  $farandula = Farandula::orderBy('id', 'desc')->get();
        }
        else{
            $farandula="SIN PUBLICACIONES";
        }
        if (Curiosidades::orderBy('id', 'desc')->get()) {
                  $curiosidades = Curiosidades::orderBy('id', 'desc')->get();
        }
        else{
            $curiosidades="SIN PUBLICACIONES";
        }

       return response()->json(["noticias"=>$noticias,"deportes"=>$deportes,"farandula"=>$farandula,"curiosidades"=>$curiosidades]);
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
            $imgtable->src="http://192.168.1.31/api-admin-oyefm/public/imgcategorias/".$categoria."_".$idnoticias."_".$i.".".$extension;
            $imgtable->save();
            $img->move(base_path().'/public/imgcategorias/', $categoria."_".$idnoticias."_".$i.".".$extension);
            //$tabla::where('id', '=', $idnoticias)->update(['img' => $categoria"_".$idnoticias."_".$i.".".$extension]);
            $i++;
        }


     
       return response()->json(["mensaje"=>"Noticia Creada correctamente"]);

    }

}
