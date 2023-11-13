<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Line;
use App\Models\Project;
use App\Models\Researcher;
use App\Models\Variable;
use App\Models\Data;
use App\Models\Information;

use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Storage::deleteDirectory('projects');
        Storage::makeDirectory('projects');
        Storage::deleteDirectory('files');
        Storage::makeDirectory('files');
        Storage::deleteDirectory('carrusel');
        Storage::makeDirectory('carrusel');
        Storage::deleteDirectory('lines');
        Storage::makeDirectory('lines');
        Storage::deleteDirectory('attachments');
        Storage::makeDirectory('attachments');
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(LineSeeder::class);
        $this->call(GraphictypeSeeder::class);
        $this->call(VariabletypeSeeder::class);
        $this->call(ProjectSeeder::class);
        
    }
}
