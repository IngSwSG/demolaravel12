<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Like;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{

    use HasFactory;

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function like()
    {
        return $this->likes()->create([
            'user_id' => Auth::id()
        ]);
    }
}
