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
    //Este fue el metodo original que contenia el error de agregar mas de un usuario a la vez.
    // public function add($users)
    // {

    //     $this->guardAgainstTooManyMembers();

    //     if ($users instanceof User) {
    //         return $this->users()->save($users);
    //     }

    //     $this->users()->saveMany($users);
    // }
    //Metodo corregido para agregar un usuario o una colección de usuarios, asegurando que no se exceda el tamaño máximo del equipo.
    public function add($users)
    {
        if ($users instanceof User) {
            $this->guardAgainstTooManyMembers();
            return $this->users()->save($users);
        }

        // Si es una colección o array de usuarios
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
