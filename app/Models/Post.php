<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Like;
use App\Models\User;

class Post extends Model
{
    use HasFactory;

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    
    public function like(User $user = null)
    {
        $user = $user ?: auth()->user();

        return $this->likes()->create([
            'user_id' => $user->id,
        ]);
    }
}

