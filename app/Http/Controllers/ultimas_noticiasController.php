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

class ultimas_noticiasController extends Controller
{
     public function __construct() {
        $this-> middleware('cors');
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        if (Noticias::orderBy('created_at', 'desc')->first()) {
            $noticias = Noticias::orderBy('created_at', 'desc')->first()->toArray();
            $img=img_noticias::select('src')->where('id_categoria', '=', $noticias['id'])->get();
            $noticias['imagenes']=$img;
        }else  {
           $noticias="Sin noticias";
        } 
        //****************************deportes
        if (Deportes::orderBy('created_at', 'desc')->first()) {
            $deportes = Deportes::orderBy('created_at', 'desc')->first()->toArray();
            $img=img_deportes::select('src')->where('id_categoria', '=', $deportes['id'])->get();
            $deportes['imagenes']=$img;
        }else  {
           $deportes="Sin deportes";
        } 
        //**************************farandula
        if (Farandula::orderBy('created_at', 'desc')->first()) {
            $farandula = Farandula::orderBy('created_at', 'desc')->first()->toArray();
            $img=img_farandula::select('src')->where('id_categoria', '=', $farandula['id'])->get();
            $farandula['imagenes']=$img;
        }else  {
           $farandula="Sin publicaciones de farandula";
        } 
        //***************************curiosidades
        if (Curiosidades::orderBy('created_at', 'desc')->first()) {
            $curiosidades = Curiosidades::orderBy('created_at', 'desc')->first()->toArray();
            $img=img_curiosidades::select('src')->where('id_categoria', '=', $curiosidades['id'])->get();
            $curiosidades['imagenes']=$img;
        }else  {
           $curiosidades="Sin Curiosidades";
        } 

       return response()->json(array(["noticias"=>$noticias]));
    }
}
