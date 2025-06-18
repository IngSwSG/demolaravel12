<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', // Título del post
        'content', // Contenido del post
    ];

    /**
     * Relación polimórfica de los likes
     */
    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    /**
     * Método para registrar un like en el post
     */
    public function like()
    {
        return $this->likes()->create([
            'user_id' => auth()->id(),
        ]);
    }
}
