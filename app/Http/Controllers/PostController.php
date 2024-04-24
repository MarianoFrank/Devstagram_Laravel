<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{

    public function index(User $user)
    {
        $posts = Post::where("user_id", $user->id)->paginate(20);

        return view('dashboard', [
            "user" => $user,
            "posts" => $posts
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            "descripcion" => "required|max:255",
            "imagenes" => "required",
        ]);

        //array con nombres de las imagenes del post
        $arrayImagenes = json_decode($request->imagenes);

        //en este punto las imagenes son validas, mueve las imagenes de tmp a uuploads
        foreach ($arrayImagenes as $nombreImagen) {
            $rutaOrigen = public_path('uploads/tmp/' . $nombreImagen);
            $rutaDestino = public_path('uploads/' . $nombreImagen);

            if (File::exists($rutaOrigen)) {
                File::move($rutaOrigen, $rutaDestino);
            }
        }

        //crear post
        Post::create([
            "description" => $request->descripcion,
            "image" => $arrayImagenes,
            "user_id" => Auth::user()->id,
        ]);


        return redirect()->route('posts.index', Auth::user()->username);
    }

    public function show(User $user, Post $post)
    {

        return view("posts.show", [
            "user" => $user,
            "post" => $post
        ]);
    }

    public function destroy(Post $post)
    {
        dd(Gate::allows("delete", $post));
    }
}
