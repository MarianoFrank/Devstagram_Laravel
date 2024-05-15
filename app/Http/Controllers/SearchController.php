<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SearchController extends Controller
{

    public function index(Request $request)
    {

        $query = $request->query();

        $validator = Validator::make($query, [
            'user' => 'required|max:30',
        ]);

        if ($validator->fails()) {
            return redirect()->route("home")->with('alert', ['msg' => trans('auth.try_again'), "type" => "error"]);
        }

        $likeString = $query['user'] . "%";

        $users = User::whereAny(["username", "name"], "like", $likeString)->get();



        return view('search', [
            "users" => $users,
            "query" => $query['user']
        ]);
    }
}
