<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;

    const STATUS_TODO = 'to do';
    const STATUS_IN_PROGRESS = 'in progress';
    const STATUS_FINISHED = 'finished';

    protected $guarded = [];

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
