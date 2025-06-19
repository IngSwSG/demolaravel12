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

       $toAdd = $users instanceof User ? collect([$users]) : $users;
        $this->guardAgainstTooManyMembers($toAdd->count());

        if ($users instanceof User) {
            return $this->users()->save($users);
        }

       $this->users()->saveMany($toAdd);
        $this->load('users');
        return $this;

    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

   protected function guardAgainstTooManyMembers(int $newMembers): void
    {
       if (! is_null($this->size) && $this->users()->count() + $newMembers > $this->size) {
    throw new Exception("El equipo no puede tener más de {$this->size} miembros.");
}

        }
    }
