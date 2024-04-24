<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public static function store(Request $request, User $user, Post $post)
    {
        $request->validate([
            'comentario' => 'required|max:255',
        ]);

        Comment::create([
            "content" =>  $request->comentario,
            "user_id" => auth()->user()->id,
            "post_id" => $post->id,
        ]);

        return redirect()->back()->with('alert', ['msg' => trans('auth.succes_comment'), "type" => "success"]);;
    }
}
