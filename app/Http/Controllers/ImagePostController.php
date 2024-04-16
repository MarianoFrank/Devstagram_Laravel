<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImagePostController extends Controller
{
    public static function store(Request $request)
    {

        

        $path_upload = public_path("uploads")  . "/tmp";

        if (!File::exists($path_upload)) {
            File::makeDirectory($path_upload, 0777, true, true);
        }

        $manager = new ImageManager(new Driver()); //gd driver

        $imagen = $manager->read($request->file("file"));

        $name = Str::uuid() . "-" . Date::now()->format("Y-m-d") . ".jpg";

        $imagen->cover(1024, 1024)->toJpeg(90)->save($path_upload  . "/" . $name);

        return response()->json($name);
    }
}
