<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Like;
use Illuminate\Database\Seeder;

class LikeSeeder extends Seeder
{
    public function run()
    {
        Post::all()->each(function (Post $post) {
            Like::factory()
                ->forPost($post)
                ->count(rand(1, 5))
                ->create();
        });
    }
}
