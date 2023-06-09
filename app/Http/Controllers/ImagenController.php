<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImagenController extends Controller
{
    //almacenamiento de imagenes
    public function store(Request $request){
        //identificar el archivo que se sube en dropzone
        $imagen = $request->file('file');
        //convertimos el arrgelo $input a formato jason
        return response()->json(['imagen'=>$imagen->extension()]);
    }
}
