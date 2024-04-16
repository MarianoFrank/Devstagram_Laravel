<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class PostController extends Controller
{

    public function index(User $user)
    {

        return view('dashboard', [
            "user" => $user
        ]);
    }

    public function create()
    {
        return view('post.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            "descripcion" => "required|max:255",
            "imagenes" => "required",
        ]);

        //array con nombres de las imagenes del post
        $arrayImagenes = json_decode($request->input("imagenes"));

        foreach ($arrayImagenes as $nombreImagen) {
            $rutaOrigen = public_path('uploads/tmp/' . $nombreImagen);
            $rutaDestino = public_path('uploads/' . $nombreImagen);

            if (File::exists($rutaOrigen)) {
                File::move($rutaOrigen, $rutaDestino);
            }
        }

        
    }
}
