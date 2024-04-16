<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ImagePostController;

Route::get('/', function () {
    return view('home');
});


Route::get('/login', [LoginController::class, "index"])->name("login");
Route::post('/login', [LoginController::class, "store"]);
Route::post('/logout', [LogoutController::class, "store"])->name("logout");

Route::get('/register', [RegisterController::class, "index"])->name("register");
Route::post('/register', [RegisterController::class, "store"]);


//Rutas protegidas
Route::middleware("auth")->group(function () {
    //Post CRUD
    Route::get("/{user}", [PostController::class, "index"])->name("post.index");
    Route::get("/post/create", [PostController::class, "create"])->name("post.create");
    Route::post("/post/create", [PostController::class, "store"])->name("post.store");

    //imagenes post
    Route::post("/api/post/imagen/upload", [ImagePostController::class, "store"]);
});
