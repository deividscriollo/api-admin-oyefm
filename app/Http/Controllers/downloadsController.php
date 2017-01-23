<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Storage;

class downloadsController extends Controller
{
    public function descargar_documentos(Request $request){

    $headers = array(
                        'Content-Type' => 'application/octet-stream',
                        'Content-Disposition' => 'attachment; filename="document.pdf'
                    );
    return response()->download(Storage::disk('public').'/Documentos/'.'proforma-local.pdf', $headers);

    }
}
