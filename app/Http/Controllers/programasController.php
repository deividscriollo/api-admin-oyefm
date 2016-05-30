<?php

namespace App\ Http\ Controllers;

use App\Programas;
use App\locutores;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class programasController extends Controller {

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
         $programas = Programas::orderBy('id', 'desc')->get();
        // $locutores = locutores::orderBy('id', 'desc')->get();
        // return response()->json(["programas"=>$programas,"locutores"=>$locutores]);
         $respuesta=array();
foreach ($programas as $key => $programa) {
    //echo $programa['id'];
    $programavec=array();
    $locutores = locutores::where('id_programa', '=', $programa['id'])->get();
    array_push($programavec,$programa);
    $locutoresvec=array();
    foreach ($locutores as $key => $locutor) {
        array_push($locutoresvec,$locutor);
        //echo $programa['nombre']."---".$locutor['nombres']."<br>";
    }
    array_push($programavec,$locutoresvec);
    array_push($respuesta,$programavec);
     

}



  return $respuesta;

    }
    //
    public
    function store(Request $request) {

        $tabla = new Programas;
        $file = $request->file('file');
        $tabla->nombre = $request->input('datos.nombre');
        $tabla->target = $request->input('datos.target');
        $tabla->logo   = "default.png";
        $tabla->edades = $request->input('datos.edades');
        $tabla->audiencia = $request->input('datos.audiencia');
        $tabla->frecuencias = $request->input('datos.frecuencias');
        $tabla->musical = $request->input('datos.musical');
        $tabla->dias = $request->input('datos.dias');
        $horario = " DE ".$request->input('datos.hinicio')." A ".$request->input('datos.hfin');
        $tabla->horario = $horario;
        $tabla->descripcion = $request->input('datos.descripcion');
        $tabla->estado = "1";
        $tabla->save();
        $ultimo_programa = $tabla->id;

        $locutores = $request->input('datos.locutores');

        foreach($locutores as $locutor) {
            $tabla_locutores = new locutores;
            $tabla_locutores->nombres = $nombres = $locutor['nombres'];
            $tabla_locutores->apellidos = $apellidos = $locutor['apellidos'];
            $tabla_locutores->descripcion = $descripcion = $locutor['descripcion'];
            $tabla_locutores->id_programa = $ultimo_programa;
            $tabla_locutores->save();
        }

        $extension = $file->getClientOriginalExtension();
        $file->move(base_path().'/public/imgprogramas/', "logo_".$request->input('datos.nombre').".".$extension);
        $tabla::where('id', '=', $ultimo_programa)->update(['logo' => "http://192.168.1.31/api-admin-oyefm/public/imgprogramas/".$request->input('datos.nombre')."_".".".$extension]);

        return response()->json(["mensaje"=>"Programa Creado correctamente"]);

    }
}