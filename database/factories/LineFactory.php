<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Line;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Line>
 */
class LineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Line::class;

    public function definition() 
    {

        $name = $this->faker->unique()->word(5);

        return [
            'name' => $name,
            'description' => $this->faker->paragraph,
            'slug' => Str::slug($name),
            'status' => 2,
        ];
    }
}
