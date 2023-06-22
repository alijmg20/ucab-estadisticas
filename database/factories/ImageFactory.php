<?php

namespace Database\Factories;

use App\Helpers\Tools;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = Image::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            // 'url' => $this->faker->imageUrl(640,480),
            'url' => 'projects/'.$this->faker->image('public/storage/projects',640,480,null,false),
        ];
    }
}
