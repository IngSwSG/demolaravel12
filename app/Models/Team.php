<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    public function add($users)
    {
        if ($users instanceof User) {
            $this->guardAgainstTooManyMembers(1);
            $result = $this->users()->save($users);
        } else {
            $this->guardAgainstTooManyMembers($users->count());
            $result = $this->users()->saveMany($users);
        }
        $this->load('users');
        
        return $result;
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    protected function guardAgainstTooManyMembers($newUsersCount = 1)
    {
        $currentCount = $this->users()->count();
        $futureCount = $currentCount + $newUsersCount;

        if ($futureCount > $this->size) {
            throw new Exception("No se pueden agregar {$newUsersCount} usuarios. El equipo tiene límite de {$this->size}, actualmente tiene {$currentCount}");
        }
    }
}