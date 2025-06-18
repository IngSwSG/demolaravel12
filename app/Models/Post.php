<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasFactory;

    // Solo los campos necesarios para el test
    protected $fillable = ['user_id'];

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    // Método para dar like al post
    public function like()
    {
        return $this->likes()->create([
            'user_id' => Auth::id(),
        ]);
    }
}