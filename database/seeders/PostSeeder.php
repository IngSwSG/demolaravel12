<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run()
    {
        // Crear algunos usuarios si no existen
        if (User::count() === 0) {
            User::factory(5)->create();
        }

        // Crear posts para cada usuario
        User::all()->each(function ($user) {
            Post::factory(3)->create(['user_id' => $user->id]);
        });
    }
}