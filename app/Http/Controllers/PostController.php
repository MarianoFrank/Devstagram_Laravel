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

    public function create(Request $request)
    {
        return view('post.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            "descripcion" => "required",
            "imagenes" => "required",
        ]);


        $names =  self::gestionarImagenes($request->file("imagenes"));

        dd($names);

        // $post = new Post();
        // $post->title = $request->title;
        // $post->body = $request->body;
        // $post->user_id = $request->user()->id;
        // $post->save();

        // return redirect()->route('dashboard');
    }

    //retorna los nombres de las imagenes guardadas
    private static function gestionarImagenes($imagenes)
    {

        $upload_path = public_path("uploads");

        if (!File::exists($upload_path)) {
            File::makeDirectory($upload_path, $mode = 0777, true, true);
        }

        $manager = new ImageManager(new Driver()); //gd driver
        $names = [];

        foreach ($imagenes as $imagenTmp) {
            $imagen = $manager->read($imagenTmp);

            $name = Str::uuid() . "-" . Date::now()->format("Y-m-d") . ".jpg";

            array_push($names, $name);

            $imagen->cover(1024, 1024)->toJpeg(90)->save($upload_path  . "/" . $name);
        }

        return $names;
    }
}
