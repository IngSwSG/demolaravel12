<?php

namespace Database\Factories;

use App\Models\Like;
use App\Models\User;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class LikeFactory extends Factory
{
    protected $model = Like::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'likeable_id' => Post::factory(),
            'likeable_type' => Post::class,
        ];
    }

      public function for($model)
    {
        return $this->state(function (array $attributes) use ($model) {
            return [
                'likeable_id' => $model->id,
                'likeable_type' => get_class($model),
            ];
        });
    }
}