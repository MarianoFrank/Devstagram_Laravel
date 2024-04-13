<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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


        $imagenes = $request->file("imagenes");
        self::gestionarImagenes($imagenes);

      

        // $post = new Post();
        // $post->title = $request->title;
        // $post->body = $request->body;
        // $post->user_id = $request->user()->id;
        // $post->save();

        // return redirect()->route('dashboard');
    }

    private static function gestionarImagenes($imagenes)
    {
        foreach ($imagenes as $imagen) {
            dump($imagen);
        }
    }
}
