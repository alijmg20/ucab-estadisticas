<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Project;
use App\Models\User;
use App\Models\Line;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Project::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $name = $this->faker->unique()->sentence();

        return [
            'name' => $name,
            'description' => $this->faker->paragraph(),
            'slug' => Str::slug($name),
            // 'user_id' => User::all()->random()->id,
            'user_id' => 1,
            'line_id' => Line::all()->random()->id,
            // 'cost' => $this->faker->randomFloat(2,0,100000),
            'status' => $this->faker->randomElement([2]),
            'date_end' => $this->faker->date(),
        ];
    }
}
