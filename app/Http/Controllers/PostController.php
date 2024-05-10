<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    public function index(User $user)
    {
        $posts = Post::where("user_id", $user->id)->latest()->paginate(8);

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


        try {
            $imagenesJSON = self::confirmarImagenes($request->imagenes);
           
            //crear post
            Post::create([
                "description" => $request->descripcion,
                "image" => $imagenesJSON,
                "user_id" => Auth::user()->id,
            ]);

            return redirect()->route('posts.index', Auth::user()->username);
        } catch (\Throwable $th) {
            return redirect()->route('posts.index', Auth::user()->username)->with('alert', ['msg' => trans('auth.generic_error'), "type" => "error"]);
        }
    }

    //mueve las imagenes de tmp a el storage
    private static function confirmarImagenes(String $arrayImagenesJSON)
    {
        try {
            $arrayImagenes = json_decode($arrayImagenesJSON);
            foreach ($arrayImagenes as $nombreImagen) {
                if (Storage::disk('public')->exists("/tmp/" . $nombreImagen)) {
                    Storage::disk('public')->move("/tmp/" . $nombreImagen, $nombreImagen);
                }
            }

            return json_encode($arrayImagenes);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function show(User $user, Post $post)
    {
        $post->loadCount("likes");
        return view("posts.show", [
            "user" => $user,
            "post" => $post
        ]);
    }

    public function destroy(Post $post)
    {
        Gate::authorize("delete", $post);

        foreach (json_decode($post->image) as $image) {

            $rutaImagen = public_path('/uploads/' . $image);

            if (file_exists($rutaImagen)) {
                unlink($rutaImagen);
            }
        }

        $post->delete();

        return redirect()->route('posts.index', Auth::user()->username);
    }
}
