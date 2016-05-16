<?php

namespace App\Http\Controllers;

use App\noticias;
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
       $noticias = noticias::all();
       return response()->json($noticias->toArray());
    }
    //
    public function store(Request $request){
    	// noticias::create($request);
        $categoria = $request->input('categoria');
    	// return response()->json(['mensaje'=>'proceso ok']);
    }


}
