<?php

namespace App\Models;

use App\Traits\Likeable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;

     use HasFactory, Likeable;

    protected $fillable = [
        'title',
        'content',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function like($user = null)
    {
        if ($user === null) {
            $user = auth()->user();
        }
        
        return $this->addLike($user);
    }

    public function unlike($user = null)
    {
        if ($user === null) {
            $user = auth()->user();
        }
        
        return $this->removeLike($user);
    }

    public function isLiked()
    {
        return $this->isLikedBy(auth()->user());
    }
}
