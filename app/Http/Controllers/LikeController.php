<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    //retorna likes y el estado de like del usuario
  
    public function store(Post $post)
    {
        $like = Like::create([
            "post_id" => $post->id,
            "user_id" => auth()->user()->id,
        ]);

        return redirect()->back();
    }

    public function destroy(Post $post)
    {
        $like = Like::where(['post_id' => $post->id, "user_id" => auth()->user()->id]);
        $like->delete();
        return redirect()->back();
    }
}
