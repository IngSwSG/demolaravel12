<?php

namespace Database\Factories;

use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LikeFactory extends Factory
{
    protected $model = Like::class;

    public function definition()
    {
        return [
            'user_id'       => User::factory(),
            'likeable_id'   => Post::factory(),
            'likeable_type' => Post::class,
        ];
    }

    public function forPost(Post $post)
    {
        return $this->state([
            'likeable_id'   => $post->id,
            'likeable_type' => Post::class,
        ]);
    }
}
