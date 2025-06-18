<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    public function like()
    {
        return $this->likes()->create([
            'user_id' => Auth::id(),
        ]);
  
    }
    

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }
}
