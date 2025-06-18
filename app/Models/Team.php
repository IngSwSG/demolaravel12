<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    /** @use HasFactory<\Database\Factories\TeamFactory> */
    use HasFactory;

    protected $guarded = [''];
    public function add($users)
    {

        $adding = $users instanceof User ? 1 : count($users);

        $this->guardAgainstTooManyMembers($adding);

        if ($users instanceof User) {
            return $this->users()->save($users);
        }
        return $this->users()->saveMany($users);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    protected function guardAgainstTooManyMembers(int $adding = 1)
    {
        $currentCount = $this->users()->count();
        if ($currentCount + $adding > $this->size) {
            throw new Exception("El equipo no puede tener más de {$this->size} miembros.");
        }
    }
}