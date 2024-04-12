<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\Username;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register', [
            "header" => false,
            "footer" => false,
            "container" => false,
        ]);
    }

    public function store(Request $request)
    {

        //Valida si no pasa las validaciones regresa a la url anterior
        $request->validate([
            'nombre' => 'bail|required|max:30',
            'username' => [
                "bail", "required", "min:5", "max:20", new Username
            ],
            'email' => 'bail|required|email|max:255|unique:users',
            'password' => 'bail|required|min:6|confirmed',
        ]);

        User::create([
            "name" => $request->nombre,
            "username" => $request->username,
            "email" => $request->email,
            "password" => $request->password,
        ]);

        //autenticar 
        $credentials = $request->only(["email", "password"]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
        }

        return redirect()->intended('muro');
    }
}
