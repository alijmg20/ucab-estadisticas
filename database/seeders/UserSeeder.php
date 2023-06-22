<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
class UserSeeder extends Seeder
{
    public function run()
    {

        User::create([
            'name' => 'Ali Jose Mata Grimont',
            'email' => 'alijmata628@gmail.com',
            'password' => bcrypt('password'),
        ])->assignRole('Admin');

        User::factory(9)->create();
    }
}
