<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Team extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function add($users)
    {

        $users = collect($users instanceof User ? [$users] : $users);

        $this->guardAgainstTooManyMembers($users->count());

        $this->users()->saveMany($users);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    protected function guardAgainstTooManyMembers(int $adding = 1)
    {
        if ($this->users()->count() + $adding > $this->size) {
            throw new Exception("El equipo ya alcanzó su tamaño máximo.");
        }
    }
}
