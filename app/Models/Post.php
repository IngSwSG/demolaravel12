<?php

namespace App\Models;
use App\Models\Likes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    protected $guarded = [''];

    protected $fillable = [
        'title',
        'content',
        'user_id',
    ];

    public function like()
    {
        return $this->likes()->create([
            'user_id' => auth()->id(),
        ]);
    }

    public function likes()
    {
        return $this->morphMany(Likes::class, 'likeable');
    }
}