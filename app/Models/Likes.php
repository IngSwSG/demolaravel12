<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
    /** @use HasFactory<\Database\Factories\LikesFactory> */
    use HasFactory;
    protected $guarded = [''];
    protected $fillable = [
        'user_id',
        'likeable_id',
        'likeable_type',
    ];

    protected function likes()
    {
        return $this->hasMany(Post::class, 'likeable_id');
    }
}