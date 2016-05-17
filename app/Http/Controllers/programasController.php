<?php

namespace App\ Http\ Controllers;

use App\ Programas;
use App\ locutores;
use Illuminate\ Http\ Request;
use App\ Http\ Requests;
use App\ Http\ Controllers\ Controller;

class programasController extends Controller {

    public
    function __construct() {
        $this-> middleware('cors');
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public
    function index() {
        $noticias = Programas::orderBy('id', 'desc')->get();
        return response()-> json($noticias->toArray());
    }
    //
    public
    function store(Request $request) {

        // $tabla = new Programas;

        // //$tabla->id = $request->input('id');
        // $tabla->nombre = $request->input('nombre');
        // $tabla->target = $request->input('target');
        // $tabla->edades = $request->input('edades');
        // $tabla->audiencia = $request->input('audiencia');
        // $tabla->frecuencias = $request->input('frecuencias');
        // $tabla->musical = $request->input('musical');
        // $strgdias = implode(",", $request->input('dias'));
        // $tabla->dias = $strgdias;
        // $horario = " DE ".$request->input('hinicio').
        // " A ".$request->input('hfin');
        // $tabla->horario = $horario;
        // $tabla->descripcion = $request->input('descripcion');
        // $tabla->estado = "1";
        // $tabla->save();
        // $ultimo_programa = $tabla->id;

        // $locutores = $request->get('locutores');

        // foreach($locutores as $locutor) {
        //     $tabla = new locutores;
        //     $tabla->nombres = $nombres = $locutor['nombres'];
        //     $tabla->apellidos = $apellidos = $locutor['apellidos'];
        //     $tabla->descripcion = $descripcion = $locutor['descripcion'];
        //     $tabla->id_programa = $ultimo_programa;
        //     $tabla->save();
        // }

        return $request->file();

    }
}