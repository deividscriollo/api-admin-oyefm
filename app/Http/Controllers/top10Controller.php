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
        
        $file      = $request->file('json');
        $delimiter = ',';
        
        if (($handle = fopen($file, 'r')) !== FALSE) {
            $i = 0;
            while (($lineArray = fgetcsv($handle, 4000, $delimiter, '"')) !== FALSE) {
                for ($j = 0; $j < count($lineArray); $j++) {
                    $arr[$i][$j] = $lineArray[$j];
                }
                $i++;
            }
            fclose($handle);
        }
        
        // Do it
        $data  = $arr;
        // Set number of elements (minus 1 because we shift off the first row)
        $count = count($data) - 1;
        
        //Use first row for names  
        $labels = array_shift($data);
        foreach ($labels as $label) {
            $keys[] = $label;
        }
        // Add Ids, just in case we want them later
        $keys[] = 'id';
        for ($i = 0; $i < $count; $i++) {
            $data[$i][] = $i;
        }
        
        // Bring it all together
        for ($j = 0; $j < $count; $j++) {
            $d            = array_combine($keys, $data[$j]);
            $newArray[$j] = $d;
        }
        // Print it out as JSON
        // $json= json_encode($newArray);

       $this->guardarlistaTop10($newArray,$request->input('inicio'),$request->input('fin'));
    }

    private function guardarlistaTop10($array,$inicio,$fin){
    	$table=new Top10s();
    	$table->where('estado','=',1)->update(['estado' => 0]);

    	foreach ($array as $cancion) {
    		$tabla_top=new Top10s();
    		$tabla_top->nombre_cancion=$cancion['nombre_cancion'];
    		$tabla_top->artista=$cancion['artista'];
    		$tabla_top->votos=0;
    		$tabla_top->url=$cancion['url'];
    		$tabla_top->estado=1;
    		// $tabla_top->inicio=$inicio;
    		// $tabla_top->fin=$fin;
    		$savelista=$tabla_top->save();
    	}
    	if (!$savelista) {
    		App::abort(500,'Error');
    	}else{
    	return response()->json(true,200);
    	}
    }

    public function getlistaTop10(Request $request){

    	$table=new Top10s();
    	$datos=$table->orderBy('votos', 'desc')->where('estado','=',1)->get();
    	return response()->json(array('top10'=>$datos));
    }
}
