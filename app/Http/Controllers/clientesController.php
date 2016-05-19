<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Clientes;

class clientesController extends Controller
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
        $noticias = Clientes::orderBy('id', 'desc')->get();
        return response()-> json($noticias->toArray());
    }
    //
    public
    function store(Request $request) {

        $tabla = new Clientes;

        $tabla->nombre_cliente = $request->input('datos.nombre');
        $tabla->logo = "default.jpg";
        $tabla->titulo = $request->input('datos.titulo');
        $tabla->descripcion = $request->input('datos.descripcion');
        $tabla->estado = "1";
        $tabla->save();
        $ultimo_cliente = $tabla->id;

        $file = $request->file('file');
        $extension = $file->getClientOriginalExtension();
        $file->move(base_path().'/public/imgclientes/', "cliente_".$ultimo_cliente.".".$extension);
        $tabla::where('id', '=',$ultimo_cliente)->update(['logo' => "cliente_".$ultimo_cliente.".".$extension]);

        return response()->json(["mensaje"=>"Cliente creado correctamente"]);

    }
}
