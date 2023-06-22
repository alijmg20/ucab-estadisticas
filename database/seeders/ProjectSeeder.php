<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Image;
use App\Models\Line;
use App\Models\User;
class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $projects = Project::factory(100)->create();
        $projects = Project::factory(10)->create();
        
        
        
        foreach ($projects as $project)
        {
          Image::factory(1)->create([
            'imageable_id' => $project->id,
            'imageable_type' => Project::class
          ]);
          $project->users()->attach([
            User::all()->random()->id,
            User::all()->random()->id,
            User::all()->random()->id,
          ]);
        }

    }
}
