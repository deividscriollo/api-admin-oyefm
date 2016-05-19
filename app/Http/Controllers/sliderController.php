<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Slider;

class sliderController extends Controller
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
        $noticias = Slider::orderBy('id', 'desc')->get();
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
 	$tabla = new Slider;
 	$tabla->src="default.jpg";
 	$tabla->descripcion=$objdesc['descripcion'];
    $tabla->titulo=$objdesc['titulo'];
 	$tabla->save();
 	$idgaleria=$tabla->id;
 	$idnoticias = $tabla->id;
 	$tabla::where('id', '=', $idgaleria)->update(['src' => "http://192.168.1.31/api-admin-oyefm/public/imgprogramas/imglider/slide_".$i.".".$extension]);
    //------------------------copiar disco
    $img->move(base_path().'/public/imglider/', "slide_".$i.".".$extension);


	$i++;
        }
return response()->json(["mensaje"=>"Galeria Guardada correctamente"]);
    }
}
