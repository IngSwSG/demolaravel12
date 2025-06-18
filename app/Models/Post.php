<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;


public function likes()
{
    return $this->morphMany(\App\Models\Like::class, 'likeable');
}

public function like()
{
    $user = Auth::user(); 

    return $this->likes()->create([
        'user_id' => $user->id,
    ]);
}
}
