<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'user_id'
    ];

    /**
     * Get the likes for the post.
     */
    public function likes(): MorphMany
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    /**
     * Get the user that owns the post.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Like the post by the authenticated user.
     */
    public function like(): void
    {
        $user = auth()->user();
        
        if (!$user) {
            throw new \Exception('User must be authenticated to like a post');
        }

        // Evitar likes duplicados
        if (!$this->likes()->where('user_id', $user->id)->exists()) {
            $this->likes()->create([
                'user_id' => $user->id
            ]);
        }
    }
}
