<?php

namespace App\Traits;

use App\Models\Like;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

trait Likeable
{
   
    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

   
    public function isLikedBy(User $user)
    {
        return $this->likes()->where('user_id', $user->id)->exists();
    }

  
    public function like()
    {
        $user = Auth::user();

        if (!$user) {
            return false; 
        }

        if (!$this->isLikedBy($user)) {
            return $this->likes()->create([
                'user_id' => $user->id,
            ]);
        }

        return false; // Ya tiene like
    }

    
    public function unlike()
    {
        $user = Auth::user();

        if (!$user) {
            return false;
        }

        return $this->likes()->where('user_id', $user->id)->delete();
    }

  
    public function toggleLike()
    {
        $user = Auth::user();

        if (!$user) {
            return false;
        }

        $existingLike = $this->likes()->where('user_id', $user->id)->first();

        if ($existingLike) {
            $existingLike->delete();
            return false; 
        } else {
            $this->likes()->create([
                'user_id' => $user->id,
            ]);
            return true; 
        }
    }

   
    public function likesCount()
    {
        return $this->likes()->count();
    }

 
    public function likedBy()
    {
        return $this->hasManyThrough(
            User::class,
            Like::class,
            'likeable_id',
            'id',
            'id',
            'user_id'
        )->where('likes.likeable_type', get_class($this));
    }


    public function likeBy(User $user)
    {
        if (!$this->isLikedBy($user)) {
            return $this->likes()->create([
                'user_id' => $user->id,
            ]);
        }

        return false;
    }


    public function unlikeBy(User $user)
    {
        return $this->likes()->where('user_id', $user->id)->delete();
    }

    public function toggleLikeBy(User $user)
    {
        $existingLike = $this->likes()->where('user_id', $user->id)->first();

        if ($existingLike) {
            $existingLike->delete();
            return false;
        } else {
            $this->likes()->create([
                'user_id' => $user->id,
            ]);
            return true;
        }
    }
}
