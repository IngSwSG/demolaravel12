<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\Like;

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
        $user = Auth::user();
        return $this->likes()->create([
            'user_id' => $user->id,
        ]);
    }
} 