<?php

namespace Database\Factories;

use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

class ImageFactory extends Factory
{
    protected $model = Image::class;

    public function definition()
    {
        // Vérifiez que le répertoire existe avant de sauvegarder
        if (!Storage::disk('public')->exists('images')) {
            Storage::disk('public')->makeDirectory('images');
        }

        // Utiliser des images d'exemple
        $images = ['1.jpg', '2.jpg', '3.jpg', '4.jpg', '5.jpg', '6.jpg', '7.jpg', '8.jpg', '9.jpg', '10.jpg', '11.jpg', '12.jpg'];
        $fileName = $this->faker->randomElement($images);

        return [
            'path' => 'images/' . $fileName,
        ];
    }
}

