<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageAvatarController extends Controller
{
    public static function store(Request $request)
    {

        $request->validate([
            "avatar" => [
                "mimes:jpeg,png,jpg",
                "max:2048"
            ]
        ]);

        $user = User::find(auth()->user()->id);

        self::eliminarAvatarAnterior($user->image);

        $fileName = self::procesarImagen($request->file("avatar"));

        $user->image = $fileName;
        $user->save();

        return redirect()->route("profile.index");
    }

    private static function procesarImagen($file)
    {
        $manager = new ImageManager(new Driver()); //gd driver
        $imagen = $manager->read($file);
        $name = Str::uuid() . "-" . Date::now()->format("Y-m-d") . ".jpg";
        $imagenJpg = $imagen->cover(1024, 1024)->toJpeg(90);

        //guardar
        Storage::disk('public')->put($name, $imagenJpg);

        return $name;
    }

    public static function eliminarAvatarAnterior(String $fileName)
    {
        Storage::disk('public')->delete($fileName);
    }
}
