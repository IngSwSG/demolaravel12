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
        $countToAdd = $users instanceof User ? 1 : count($users);

        $this->guardAgainstTooManyMembers($countToAdd);

        return $users instanceof User
            ? $this->users()->save($users)
            : $this->users()->saveMany($users);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    protected function guardAgainstTooManyMembers(int $countToAdd)
    {
        if ($this->users()->count() + $countToAdd > $this->size) {
            throw new Exception("El equipo ya alcanzó el tamaño máximo permitido.");
        }
    }
}