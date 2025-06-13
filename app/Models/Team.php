<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Team extends Model
{
    /** @use HasFactory<\Database\Factories\TeamFactory> */
    use HasFactory;

    protected $guarded = [];
    
    public function add($users)
    {

        $users = $users instanceof Collection ? $users : collect([$users]);

        $this->guardAgainstTooManyMembers($users);

        $this->users()->saveMany($users);
    }

    public function users()
    {   
        return $this->hasMany(User::class);
    }

    protected function guardAgainstTooManyMembers($users)
    {
        $currentCount = $this->users()->count();
        $toAdd = $users->count();

        if ($currentCount + $toAdd > $this->size) {
            throw new Exception();
        }
    }
}
