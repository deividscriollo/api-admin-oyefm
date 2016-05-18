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

         $tabla = new galeria;


 foreach($request->file('archivos') as $obj) {
 	$tabla->src="default.jpg";
 	$tabla->descripcion="nn";
             echo $obj['file'];
        }

        foreach($request->input('archivos') as $obj) {
           $descripcion=$obj['descripcion'];
           echo $descripcion.',';
        }

       


        // $file = $request->file('file');
        // $extension = $file->getClientOriginalExtension();
        // $file->move(base_path().'/public/logos/', $ultimo_programa.".".$extension);

       

    }
}
