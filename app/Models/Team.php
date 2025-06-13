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

        $this->guardAgainstTooManyMembers($users);

        if ($users instanceof User) {
            return $this->users()->save($users);
        }

        $this->users()->saveMany($users);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

protected function guardAgainstTooManyMembers($users)
{
    $currentCount = $this->users()->count();
    $size = $this->size;

    if ($users instanceof User) {
        $newUsersCount = 1;
    } else {
        $newUsersCount = count($users);
    }

    if ($currentCount + $newUsersCount > $size) {
        throw new Exception('El equipo excede el tamaño máximo permitido.');
    }
}
    
}
