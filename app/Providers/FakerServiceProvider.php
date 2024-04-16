<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

//clase del generador
use Faker\Generator as FakerGenerator;
//para crear el generador
use Faker\Factory as FakerFactory;
//para crear el provedor propio
use Faker\Provider\Base;

use Alirezasedghi\LaravelImageFaker\ImageFaker;
use Alirezasedghi\LaravelImageFaker\Services\Picsum;


class PicsumProvider extends Base
{
  public function imagePicsum(
    string $dir = null,
    int $width = 640,
    int $height = 480,
    bool $fullPath = false,
    bool $grayscale = false,
    bool|int $blur = false
  ) {
    $imageFaker = new ImageFaker(new Picsum());
    return $imageFaker->image($dir, $width, $height, $fullPath, $grayscale, $blur);
  }
}


class FakerServiceProvider extends ServiceProvider
{
  /**
   * Register services.
   */
  public function register(): void
  {

    //el singleton asegura que tengamos solo una instancia del servicio corriendo en al app
    //esto mejora el rendimiento al evitar instanciar constantemente
    $this->app->singleton(FakerGenerator::class, function () { 

      //esta funcion se ejecuta al momento de instancias Fake\Generator

      $fakerGeneratorInstance = FakerFactory::create(); //retorna un generador configurado por defecto

      $fakerGeneratorInstance->addProvider(new PicsumProvider($fakerGeneratorInstance));

      return $fakerGeneratorInstance;
    });
  }

  /**
   * Bootstrap services.
   */
  public function boot(): void
  {
    //
  }
}
