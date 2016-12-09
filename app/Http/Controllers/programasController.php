<?php

namespace App\ Http\ Controllers;

use App\Programas;
use App\locutores;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use DB;

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
         $programas = DB::table('administracion.programas')->select('nombre','horario','logo','dias')->orderBy('id', 'desc')->get();
        // $locutores = locutores::orderBy('id', 'desc')->get();
        // return response()->json(["programas"=>$programas]);
                 $respuesta=array();
        foreach ($programas as $key => $programa) {
            //echo $programa->id'];
            $horario=explode(',', $programa->horario);
            // $programasvec=array();
            $programaarray=array();
            $programaarray['nombre']=$programa->nombre;
            $programaarray['horainicio']=$horario[0];
            $programaarray['horafin']=$horario[1];
            $programaarray['logo']=$programa->logo;
            $programaarray['diaslaborables']=explode(',', $programa->dias);
            // $locutores = locutores::where('id_programa', '=', $programa->id'])->get();
            // array_push($programasvec,$programaarray);
            // $locutoresvec=array();
            // foreach ($locutores as $key => $locutor) {
            //     array_push($locutoresvec,$locutor);
            //     //echo $programa->nombre']."---".$locutor['nombres']."<br>";
            // }
            // array_push($programavec,$locutoresvec);
            array_push($respuesta,$programaarray);
             

        }
            return response()->json(array($respuesta));

    }
       public function programa_actual() {

        date_default_timezone_set('America/Guayaquil');
        setlocale(LC_TIME, 'spanish');

    $horaactual = date('g:i A');
    $horaactual = strtotime($horaactual);
    $programas = Programas::select('nombre','horario','logo','dias')->orderBy('id', 'desc')->get();
    $dias = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
    
    $acumulador[0]=0;
    $acumulador[1]=array("nombre"=>"Oye Fm","logo"=>"x0.jpg");
    for ($i=0; $i < count($programas) ; $i++) {
    $horario=explode(',', $programas[$i]['horario']);
    $horainicio=strtotime($horario[0]);
    $horafin=strtotime($horario[1]);
    // echo($programas[$i]['nombre'].' hora inicio:'.$horario[0].'-------'.'hora fin:'.$horario[1]."\n");
    if($horaactual > $horainicio && $horaactual < $horafin) {
            $diaactual=$dias[date("w")];
            $diaslaborables=explode(',', $programas[$i]['dias']);
            $res = $this->verificar_dias_laborables($diaactual,$diaslaborables);
            if ($res=='true') {
                $acumulador[0]=1;
                $acumulador[1] =array("nombre"=>$programas[$i]['nombre'],"logo"=>$programas[$i]['logo']);
            }
        }
    }

    return response()->json(["respuesta"=>$acumulador],200);

    }

    function verificar_dias_laborables($diaactual,$diaslaborables){
        $res='false';
        if (in_array($diaactual, $diaslaborables)) {
            $res='true';
        }
        return $res;
    }

    public    function store(Request $request) {

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
        $horario = $request->input('datos.hinicio').",".$request->input('datos.hfin');
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
        $file->move(base_path().'/public/imgprogramas/', "logo_".str_replace(' ', '_', $request->input('datos.nombre')).".".$extension);
        $tabla::where('id', '=', $ultimo_programa)->update(['logo' => "http://apiadmin.nextbook.ec/public/imgprogramas/".str_replace(' ', '_', $request->input('datos.nombre'))."_".".".$extension]);

        return response()->json(["mensaje"=>"Programa Creado correctamente"]);

    }
}