<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Follower;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function store(User $user)
    {
        try {
            Follower::create([
                "follower_id" => auth()->user()->id,
                "user_id" => $user->id,
            ]);
            return response()->json(["msg" => "Follow added"], 201);
        } catch (\Throwable $th) {
            return response()->json(["msg" => "DB Error"], 500);
        }
    }

    public function destroy(User $user)
    {
        try {
            $like = Follower::where(['follower_id' => auth()->user()->id, "user_id" => $user->id]);
            $like->delete();
            return response()->json(["msg" => "Follow deleted"], 200);
        } catch (\Throwable $th) {
            return response()->json(["msg" => "DB Error"], 500);
        }
    }
}
