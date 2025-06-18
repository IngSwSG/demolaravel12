<?php

namespace App\Traits;

use App\Models\Like;
use App\Models\User;

trait Likeable
{
    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function isLikedBy(User $user)
    {
        if (!$user) {
            return false;
        }
        
        return $this->likes()->where('user_id', $user->id)->exists();
    }

    public function toggleLike(User $user)
    {
        $existingLike = $this->likes()->where('user_id', $user->id)->first();

        if ($existingLike) {
            $existingLike->delete();
            return false; 
        } else {
            $this->likes()->create(['user_id' => $user->id]);
            return true; 
        }
    }

    public function addLike(User $user)
    {
        if (!$user) {
            return false;
        }

        if (!$this->isLikedBy($user)) {
            $this->likes()->create(['user_id' => $user->id]);
            return true;
        }
        
        return false;
    }

    public function removeLike(User $user)
    {
        if (!$user) {
            return false;
        }

        return $this->likes()->where('user_id', $user->id)->delete();
    }

    public function likesCount()
    {
        return $this->likes()->count();
    }

    public function likedBy()
    {
        return $this->morphToMany(User::class, 'likeable', 'likes')
                    ->withTimestamps();
    }
}
