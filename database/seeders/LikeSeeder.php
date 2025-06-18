<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Like;
use App\Models\User;
use App\Models\Post;

class LikeSeeder extends Seeder
{
   public function run()
    {
        $users = User::all();
        $posts = Post::all();

        foreach ($posts as $post) {
            // Algunos usuarios aleatorios dan like a cada post
            $randomUsers = $users->random(rand(1, min(5, $users->count())));
            
            foreach ($randomUsers as $user) {
                Like::create([
                    'user_id' => $user->id,
                    'likeable_id' => $post->id,
                    'likeable_type' => Post::class,
                ]);
            }
        }
    }
}
