<?php

namespace Database\Seeders;

use App\Models\Graphictype;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GraphictypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Graphictype::create([
            'name' => 'columna',
        ]);
        Graphictype::create([
            'name' => 'circulo',
        ]);
        Graphictype::create([
            'name' => 'barra',
        ]);
    }
}
