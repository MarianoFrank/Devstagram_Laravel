<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ImagePostController;
use App\Http\Controllers\ImageAvatarController;




Route::get('/', HomeController::class)->name("home");

Route::get('/login', [LoginController::class, "index"])->name("login");
Route::post('/login', [LoginController::class, "store"]);
Route::post('/logout', [LogoutController::class, "store"])->name("logout");

Route::get('/register', [RegisterController::class, "index"])->name("register");
Route::post('/register', [RegisterController::class, "store"]);

Route::get("/find", [SearchController::class, "index"])->name("find.index");

//Rutas protegidas
Route::middleware("auth")->group(function () {

    //edicion de perfil
    Route::get("/edit-profile", [ProfileController::class, "index"])->name("profile.index");
    Route::post("/edit-profile", [ProfileController::class, "store"])->name("profile.store");

    //Post 
    Route::get("/posts/create", [PostController::class, "create"])->name("posts.create");
    Route::post("/posts", [PostController::class, "store"])->name("posts.store");
    Route::delete("/posts/{post}", [PostController::class, "destroy"])->name("posts.destroy");

    //api imagenes post
    Route::post("/post/imagen-tmp", [ImagePostController::class, "store"]); //sube a tmp
    Route::delete("/post/imagen-tmp/{imagen}", [ImagePostController::class, "destroy"]); //elimina de tmp

    //guardar avatar
    Route::post("/avatar", [ImageAvatarController::class, "store"])->name("avatar.store");

    //comments 
    Route::post("/{user}/posts/{post}", [CommentController::class, "store"])->name("comments.store");

    Route::post("/{user}/follow", [FollowerController::class, "store"])->name("user.follow");
    Route::delete("/{user}/unfollow", [FollowerController::class, "destroy"])->name("user.unfollow");
});

//posts public
Route::get("/{user}", [PostController::class, "index"])->name("posts.index");
Route::get("/{user}/posts/{post}", [PostController::class, "show"])->name("posts.show");

