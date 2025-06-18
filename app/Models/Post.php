<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Like;
use App\Models\User;
use Database\Factories\PostFactory; 

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function like()
    {
        return $this->likes()->create([
            'user_id' => auth()->id(),
        ]);
    }

    public function likedBy(User $user)
    {
        return $this->likes()->where('user_id', $user->id)->exists();
    }

    protected static function newFactory()
    {
        return PostFactory::new();
    }
}
