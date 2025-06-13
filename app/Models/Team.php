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

        $count = $users instanceof User ? 1 : collect($users)->count();
        $this->guardAgainstTooManyMembers($count);

        if ($users instanceof User) {
            return $this->users()->save($users);
        }

        $this->users()->saveMany($users);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    protected function guardAgainstTooManyMembers($newMembersCount = 1)
    {
    $current = $this->users()->count();

        if ($current + $newMembersCount > $this->size) {
            throw new Exception();
        }
    }
}
