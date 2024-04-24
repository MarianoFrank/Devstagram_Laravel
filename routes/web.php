<?php

use App\Http\Controllers\CommentController;
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
    //Post 
    Route::get("/posts/create", [PostController::class, "create"])->name("posts.create");
    Route::post("/posts", [PostController::class, "store"])->name("posts.store");
    Route::delete("/posts/{post}", [PostController::class, "destroy"])->name("posts.destroy");

    //api imagenes post
    Route::post("/post/imagen-tmp", [ImagePostController::class, "store"]); //sube a tmp
    Route::delete("/post/imagen-tmp/{imagen}", [ImagePostController::class, "destroy"]); //elimina de tmp

    //comments 
    Route::post("/{user}/posts/{post}", [CommentController::class, "store"])->name("comments.store");
});

//posts public
Route::get("/{user}", [PostController::class, "index"])->name("posts.index");
Route::get("/{user}/posts/{post}", [PostController::class, "show"])->name("posts.show");
