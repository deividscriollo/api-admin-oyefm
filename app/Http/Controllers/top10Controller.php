<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Top10s;

class top10Controller extends Controller
{
	public function __construct() {
        $this-> middleware('cors');
        // $this->middleware('jwt.auth', ['except' => ['authenticate']]);
    }

    public function addTop10(Request $request)
    {
        // $tabla_top=new Top10s();
        // $tabla_top->where('estado',1)->update(["estado"=>0]);

        foreach ($request->file('listatop10') as $key => $obj) {
           $img=$obj['img'];
           $extension=$img->getClientOriginalExtension();
         $tabla_top=new Top10s();
         $tabla_top->nombre_cancion=$request->input('listatop10')[$key]['cancion'];
         $tabla_top->artista=$request->input('listatop10')[$key]['artista'];
         $tabla_top->votos=0;
         $tabla_top->url=$request->input('listatop10')[$key]['url'];
         $tabla_top->img="http://192.168.0.101/api-admin-oyefm/public/imgtop10/default.jpg";
         $tabla_top->estado=1;
         $savelista=$tabla_top->save();
         // //------------------------- imagen --------------------------------
         $idcancion=$tabla_top->id;
         $tabla_top::where('id', '=', $idcancion)->update(['img' => "http://192.168.0.101/api-admin-oyefm/public/imgtop10/top_".$key.".".$extension]);
         // copiar img 
         $img->move(base_path().'/public/imgtop10/', "top_".$key.".".$extension);

        }

       return response()->json(["respuesta"=>true]);
    }

    public function getlistaTop10(Request $request){

    	$table=new Top10s();
    	$datos=$table->orderBy('votos', 'desc')->where('estado','=',1)->get();
    	return response()->json(array('top10'=>$datos));
    }
}
