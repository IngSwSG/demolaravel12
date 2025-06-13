<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    /** @use HasFactory<\Database\Factories\TeamFactory> */
    use HasFactory;

    protected $guarded = [];
    
    public function add($users) //el error estaba en la funcion de add
    {
    if ($users instanceof User) {
        $this->guardAgainstTooManyMembers();
        return $this->users()->save($users);
    }

    $usersCount = is_countable($users) ? count($users) : $users->count();
    $currentCount = $this->users()->count();

    if ($currentCount + $usersCount > $this->size) {
        throw new Exception();
    }

    $this->users()->saveMany($users);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    protected function guardAgainstTooManyMembers()
    {
        if ($this->users()->count() >= $this->size) {
            throw new Exception();
        }
    }
}
