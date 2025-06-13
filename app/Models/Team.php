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
    
    public function add($users)
    {
        $numberOfActualUsers = $this->users()->count();
        $numberOfNewUsers = is_array($users) ? count($users) : 1;
        $totalUsers = $numberOfActualUsers + $numberOfNewUsers;
        if ($totalUsers > $this->size) {
            throw new Exception('El equipo ha alcanzado su tamaño máximo.');
        }


        if ($users instanceof User) {
            return $this->users()->save($users);
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
