<?php

namespace App\Http\Controllers;

use App\Models\Imagen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    //
    public function store(Request $request)
    {
        # code...



        // Editando la imagen
        try {
            // Guardando la imagen en el servidor
            $ruta_imagen = $request->file('file')->store('establecimiento', 'public');

            //code...
            //Ajustando el tamaño de la imagen con image converion
            $img = Image::make(public_path("/storage/{$ruta_imagen}"))->fit(800, 450);
            $img->save();
            //code...


            // Guardando datos de la imagen
            $imagen = new Imagen;
            $imagen->id_establecimiento = $request['uuid'];
            $imagen->ruta_imagen = $ruta_imagen;

            $imagen->save();

            $respuesta = [
                'ruta_imagen' => $ruta_imagen
            ];

            return response()->json($respuesta);
        } catch (\Throwable $th) {
            //throw $th;
            $respuesta = [
                "erro" => "error 500 vuelvelo intenter en otro momento"
            ];

            return response()->json($respuesta);
        }

        // return response()->json($request);
    }

    public function destroy(Request $request)
    {

        $ruta_imagen = $request['imagen'];
        $respuesta = [
            "message" => "imagen no eliminada",
            "has" => File::exists(public_path("/storage/{$ruta_imagen}")),
            "ruta" => $ruta_imagen
        ];

        if (File::exists(public_path("/storage/{$ruta_imagen}"))) {
            File::delete(public_path("/storage/{$ruta_imagen}"));
            $imagen = Imagen::where('ruta_imagen', $ruta_imagen)->first();
            $imagen->delete();
            $respuesta['message'] = "Imagen eliminada";
        }

        return response()->json($respuesta);
    }
}
