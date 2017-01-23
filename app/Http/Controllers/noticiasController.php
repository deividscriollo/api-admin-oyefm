<?php

namespace App\Http\Controllers;

use App\Deportes;
use App\Farandula;
use App\Curiosidades;
use App\Noticias;
use App\img_noticias;
use App\img_deportes;
use App\img_farandula;
use App\img_curiosidades;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
//Extras
use config;
use Image;
use File;


class noticiasController extends Controller{

	public function __construct(){
		$this->middleware('cors');
       // $this->middleware('jwt.auth', ['except' => ['authenticate']]);
	}
	/**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        if (count(Noticias::orderBy('id', 'desc')->get())>0) {
        $noticias = Noticias::select('id','descripcion_corta','titulo')->orderBy('id', 'desc')->limit(2)->get();
        foreach ($noticias as $key => $value) {
                    $noticias[$key]['img']=img_noticias::where('id_categoria',$value['id'])->get();
                }
        }
        else{
            $noticias="SIN PUBLICACIONES";
        }
        if (count(Deportes::orderBy('id', 'desc')->get())>0) {
                  $deportes = Deportes::select('id','descripcion_corta','titulo')->orderBy('id', 'desc')->limit(2)->get();

                foreach ($deportes as $key => $value) {
                    $deportes[$key]['img']=img_deportes::where('id_categoria',$value['id'])->get();
                }
        }
        else{
            $deportes="SIN PUBLICACIONES";
        }
        if (count(Farandula::orderBy('id', 'desc')->get())>0) {
                  $farandula = Farandula::select('id','descripcion_corta','titulo')->orderBy('id', 'desc')->limit(2)->get();
           foreach ($farandula as $key => $value) {
                    $farandula[$key]['img']=img_farandula::where('id_categoria',$value['id'])->get();
                }
        }
        else{
            $farandula="SIN PUBLICACIONES";
        }
        if (count(Curiosidades::orderBy('id', 'desc')->get())>0) {
                  $curiosidades = Curiosidades::select('id','descripcion_corta','titulo')->orderBy('id', 'desc')->limit(2)->get();
              foreach ($curiosidades as $key => $value) {
                $curiosidades[$key]['img']=img_curiosidades::where('id_categoria',$value['id'])->get();
            }
        }
        else{
            $curiosidades="SIN PUBLICACIONES";
        }

       return response()->json(["respuesta"=>[
               ["nombre_categoria"=>"NOTICIAS","lista"=>$noticias],
               ["nombre_categoria"=>"DEPORTES","lista"=>$deportes],
               ["nombre_categoria"=>"FARANDULA","lista"=>$farandula],
               ["nombre_categoria"=>"CURIOSIDADES","lista"=>$curiosidades]]
        ]);
    }
    //

    public function Get_Noticias_Programa(Request $request){


        if (count(Noticias::orderBy('id', 'desc')->get())>0) {
        $noticias = Noticias::select('id','descripcion_corta','titulo')->where('id_programa',$request->id)->orderBy('id', 'desc')->limit(2)->get();
        foreach ($noticias as $key => $value) {
                    $noticias[$key]['img']=img_noticias::where('id_categoria',$value['id'])->get();
                }
        }
        else{
            $noticias="SIN PUBLICACIONES";
        }
        if (count(Deportes::orderBy('id', 'desc')->get())>0) {
                  $deportes = Deportes::select('id','descripcion_corta','titulo')->where('id_programa',$request->id)->orderBy('id', 'desc')->limit(2)->get();

                foreach ($deportes as $key => $value) {
                    $deportes[$key]['img']=img_deportes::where('id_categoria',$value['id'])->get();
                }
        }
        else{
            $deportes="SIN PUBLICACIONES";
        }
        if (count(Farandula::orderBy('id', 'desc')->get())>0) {
                  $farandula = Farandula::select('id','descripcion_corta','titulo')->where('id_programa',$request->id)->orderBy('id', 'desc')->limit(2)->get();
           foreach ($farandula as $key => $value) {
                    $farandula[$key]['img']=img_farandula::where('id_categoria',$value['id'])->get();
                }
        }
        else{
            $farandula="SIN PUBLICACIONES";
        }
        if (count(Curiosidades::orderBy('id', 'desc')->get())>0) {
                  $curiosidades = Curiosidades::select('id','descripcion_corta','titulo')->where('id_programa',$request->id)->orderBy('id', 'desc')->limit(2)->get();
              foreach ($curiosidades as $key => $value) {
                $curiosidades[$key]['img']=img_curiosidades::where('id_categoria',$value['id'])->get();
            }
        }
        else{
            $curiosidades="SIN PUBLICACIONES";
        }

       return response()->json(["respuesta"=>[
               ["nombre_categoria"=>"NOTICIAS","lista"=>$noticias],
               ["nombre_categoria"=>"DEPORTES","lista"=>$deportes],
               ["nombre_categoria"=>"FARANDULA","lista"=>$farandula],
               ["nombre_categoria"=>"CURIOSIDADES","lista"=>$curiosidades]]
        ]);


    }

    public function Get_Detalle_Publicacion(Request $request){

        $categoria=$request->input('categoria');


        switch ($categoria) {
            case "DEPORTES":
                $tabla = new Deportes;
                $tabla_img= new img_deportes();
                break;
            case "NOTICIAS":
               $tabla = new Noticias;
               $tabla_img= new img_noticias();
                break;
            case "FARANDULA":
                $tabla = new Farandula;
                $tabla_img= new img_farandula();
                break;
            case "CURIOSIDADES":
                $tabla = new Curiosidades;
                $tabla_img= new img_curiosidades();
                break;
        }


        $datos = $tabla->select('id','contenido','titulo','created_at')->Where('id', $request->input('id'))->get();
        $datos[0]['img']=$tabla_img->where('id_categoria',$request->input('id'))->get();

        return response()->json(["nombre_categoria"=>$request->input('nombre_categoria'),"lista"=>$datos]);

    }
    public function store(Request $request){

$categoria=$request->input('datos.categoria');


switch ($categoria) {
    case "Deportes":
        $tabla = new Deportes;
        break;
    case "Noticia":
       $tabla = new Noticias;
        break;
    case "Farandula":
        $tabla = new Farandula;
        break;
    case "Curiosidades":
        $tabla = new Curiosidades;
        break;
}

        $tabla->titulo = $request->input('datos.titulo');
        $tabla->contenido = $request->input('datos.contenido');
        $tabla->video = $request->input('datos.video');
        $tabla->referencia = $request->input('datos.referencia');
        $tabla->stado = "1";
        $tabla->descripcion_corta = $request->input('datos.descripcion_corta');
        $tabla->id_programa = $request->input('datos.programa');
        $tabla->save();
        $idnoticias = $tabla->id;
        $files = $request->file('file');
        $i=0;
        foreach ($files as $img) {
        switch ($categoria) {
            case "Deportes":
                $imgtable = new img_deportes;
                break;
            case "Noticia":
               $imgtable = new img_noticias;
                break;
            case "Farandula":
                $imgtable = new img_farandula;
                break;
            case "Curiosidades":
                $imgtable = new img_curiosidades;
                break;
        }
            $extension = $img->getClientOriginalExtension();
            $imgtable->id_categoria=$idnoticias;
            $imgtable->src="/public/imgcategorias/".$categoria."_".$idnoticias."_".$i.".".$extension;
            $imgtable->save();

            //guardar Imagen
            $path=base_path().'/public/imgcategorias/';
            $nombre_img=$categoria."_".$idnoticias."_".$i.".".$extension;
            Image::make($img->getRealPath())->resize(600, 400)->save($nombre_img);
             // Mover Archivo
            File::move(public_path().'/'.$nombre_img,$path.$nombre_img);
            //$img->move($path, $categoria."_".$idnoticias."_".$i.".".$extension);
            //$tabla::where('id', '=', $idnoticias)->update(['img' => $categoria"_".$idnoticias."_".$i.".".$extension]);
            $i++;
        }
       return response()->json(["respuesta"=>true]);

    }

}
