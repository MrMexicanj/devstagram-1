<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    //almacenamiento de imagenes
    public function store(Request $request){
        //identificar el archivo que se sube en dropzone
        $imagen = $request->file('file');

        //generar Id unico para cada una de las imagenes que se cargan al server
        $nombreImagen = Str::uuid() . "." . $imagen->extension();

        $imagenServidor =Image::make($imagen);
        $imagenServidor->fit(1000, 1000);

        $imagenPath = public_path('uploads') . '/' . $nombreImagen;
        //pasamos la imagen de memoria al server
        $imagenServidor->save($imagenPath);

        return response()->json(['imagen' => $nombreImagen]);
    }
}
