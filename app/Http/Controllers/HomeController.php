<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Database\Eloquent\Builder;

class HomeController extends Controller
{
    public function __invoke()
    {

        $posts = [];
        if (Auth::check()) {
            //id's de los usuarios a los que sigue el usuario autenticado
            $followingsIds =  Auth::user()->followings->pluck("id");

            $posts =  Post::whereIn("user_id", $followingsIds)
            ->with("user")
            ->with(['comments' => function (Builder $query) {
                $query->with("user")->latest()->limit(3);
            }])
            ->latest()->paginate(10);

        } else {
            $posts = Post::with("user")
            ->with(['comments' => function (Builder $query) {
                $query->with("user")->latest()->limit(3);
            }])
            ->latest()->paginate(10);
        }



        return view('home', ["posts" => $posts]);
    }
}
