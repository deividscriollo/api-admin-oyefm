<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Top10s;
//Extras
use Image;
use File;

class top10Controller extends Controller
{
	public function __construct() {
        $this-> middleware('cors');
        // $this->middleware('jwt.auth', ['except' => ['authenticate']]);
    }

    public function addTop10(Request $request)
    {
         $tabla_top=new Top10s();
         $tabla_top->where('estado',1)->update(["estado"=>0]);

        foreach ($request->file('listatop10') as $key => $obj) {

         $audio=$obj['audio'];
         
         $extension_audio=$audio->getClientOriginalExtension();
         $tabla_top=new Top10s();
         $tabla_top->nombre_cancion=$request->input('listatop10')[$key]['cancion'];
         $tabla_top->artista=$request->input('listatop10')[$key]['artista'];
         $tabla_top->votos=0;
         if (array_key_exists('url_video', $request->input('listatop10')[$key])) {
             $tabla_top->url=$request->input('listatop10')[$key]['url_video'];
         }
         
         $tabla_top->img="/public/imgtop10/default.jpg";
         $tabla_top->url="/public/imgtop10/default.mp3";
         $tabla_top->estado=1;
         $savelista=$tabla_top->save();
         $idcancion=$tabla_top->id;
         // //------------------------- imagen --------------------------------
         if (array_key_exists('img',$obj)) {
             $img=$obj['img'];
             $extension=$img->getClientOriginalExtension();
             $tabla_top::where('id', '=', $idcancion)->update(['img' => "/public/imgtop10/top_".$key.".".$extension]);
             // copiar img 
             $path=base_path().'/public/imgtop10/';
             $nombre_img="top_".$key.".".$extension;
             Image::make($img->getRealPath())->resize(50, 50)->save($nombre_img);
             // Mover Archivo IMG
             File::move(public_path().'/'.$nombre_img,$path.$nombre_img);
         }
         
         // //------------------------- audio --------------------------------
         $tabla_top::where('id', '=', $idcancion)->update(['url' => "/public/imgtop10/top_".$key.".".$extension_audio]);
         // copiar AUDIO 
         $path=base_path().'/public/imgtop10/';
         $nombre_audio="top_".$key.".".$extension_audio;
         $audio->move($path, $nombre_audio);

         //$img->move($path, "top_".$key.".".$extension);

        }

       return response()->json(["respuesta"=>true]);
    }

    public function getlistaTop10(Request $request){

    	$table=new Top10s();
    	$datos=$table->orderBy('votos', 'desc')->where('estado','=',1)->orderBy('id','ASC')->get();

        foreach ($datos as $key => $value) {
            $value->url=config('global.dir_servidor').$value->url;
        }

    	return response()->json(array('respuesta'=>$datos));
    }
}
