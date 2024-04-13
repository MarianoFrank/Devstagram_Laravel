<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login', [
            "header" => false,
            "footer" => false,
            "container" => false,
        ]);
    }

    public function store(Request $request)
    {



        $request->validate([
            'email' => 'bail|required|email|max:64',
            'password' => 'bail|required|min:6',
        ]);

        $remember = false;
        if ($request->remember === "on") {
            $remember = true;
        }

        $credentials = $request->only(["email", "password"]);
        $auth = Auth::attempt($credentials, $remember);
        if (!$auth) {
            return back()->with('alert', ['msg' => trans('auth.failed'), "type" => "error"]);
        }
        $request->session()->regenerate();

        return redirect()->route("post.index",Auth::user()->username);
    }
}
