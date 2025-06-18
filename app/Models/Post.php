<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Likeable;

class Post extends Model
{
    use HasFactory, Likeable;

    protected $fillable = [
        'title',
        'body',
    ];
}
