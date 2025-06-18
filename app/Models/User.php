<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

     public function likes()
    {
        return $this->hasMany(Like::class);
    }

      public function hasLiked($model)
    {
        return $this->likes()
            ->where('likeable_type', get_class($model))
            ->where('likeable_id', $model->id)
            ->exists();
    }

      public function posts()
    {
        return $this->hasMany(Post::class);
    }

      public function likedPosts()
    {
        return $this->morphedByMany(Post::class, 'likeable', 'likes')
                    ->withTimestamps();
    }
}

