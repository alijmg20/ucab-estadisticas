<?php

namespace Database\Seeders;

use App\Models\Variabletype;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VariabletypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Variabletype::create([
            'name' => 'texto'
        ]);
        Variabletype::create([
            'name' => 'Selección simple'
        ]);
        Variabletype::create([
            'name' => 'opción multiple'
        ]);
    }
}
