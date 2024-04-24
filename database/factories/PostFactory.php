<?php

namespace Database\Factories;

use Faker\Generator as FakerGenerator;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $imagenes = [];
        for ($i = 1; $i <= mt_rand(2, 9); $i++) {
            array_push($imagenes, $this->faker->imagePicsum(public_path("uploads"), 1000, 1000));
        }

        return [
            "description" => $this->faker->paragraph(3, true),
            "image" => json_encode($imagenes),
            "user_id" => $this->faker->randomElement(['1',"2","3"]),
            
        ];
    }
}
