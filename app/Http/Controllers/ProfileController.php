<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\Username;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => [
                "required", "min:5", "max:20", new Username
            ],
        ]);

        User::find(auth()->user()->id)->update([
            "username" => $request->username
        ]);

        return redirect()->route("profile.index")->with('alert', ['msg' => trans('validation.change_saved'), "type" => "success"]);
    }
}
