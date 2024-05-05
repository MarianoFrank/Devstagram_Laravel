<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;

//Este controlador guarda las imagenes en una carpeta temporal, trabaja en conjunto con dropzone

class ImagePostController extends Controller
{
    public static function store(Request $request)
    {
        $name = self::procesarImagen($request->file("file"));

        return response()->json($name);
    }


    private static function procesarImagen($file)
    {
        $manager = new ImageManager(new Driver()); //gd driver
        $imagen = $manager->read($file);
        $name = Str::uuid() . "-" . Date::now()->format("Y-m-d") . ".jpg";
        $imagenJpg = $imagen->cover(1024, 1024)->toJpeg(90);

        //guardar
        Storage::disk('public')->put("/tmp/" . $name, $imagenJpg);

        return $name;
    }


    public static function destroy($imagen)
    {
        Storage::disk('public')->delete("/tmp/" . $imagen);

        return response()->json([], 200);
    }
}
