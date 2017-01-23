<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\galeria;

use App\Http\Requests;

class galeriaController extends Controller
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
        $noticias = galeria::orderBy('idgaleria', 'desc')->get();
        return response()-> json($noticias->toArray());
    }
    //
    public
    function store(Request $request) {

	$i=0;
 foreach($request->file('archivos') as $obj) {
 	$img=$obj['file'];
 	$objdesc=$request->input('archivos.'.$i);
 	$extension=$img->getClientOriginalExtension();
 	$tabla = new galeria;
 	$tabla->src="default.jpg";
 	$tabla->descripcion=$objdesc['descripcion'];
    $tabla->titulo=$objdesc['titulo'];
 	$tabla->save();
 	$idgaleria=$tabla->id;
 	$idnoticias = $tabla->id;
 	$tabla::where('idgaleria', '=', $idgaleria)->update(['src' => "/public/imgprogramas/imggaleria/galeria_".$i.".".$extension]);
    //------------------------copiar disco
    $img->move(base_path().'/public/imggaleria/', "galeria_".$i.".".$extension);


	$i++;
        }
return response()->json(["mensaje"=>"Galeria Guardada correctamente"]);
    }
}
