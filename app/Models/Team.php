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

        $newCount = $users instanceof User
                ? 1
                : (is_array($users) ? count ($users) : $users ->count());

        $this->guardAgainstTooManyMembers($newCount);

        if ($users instanceof User) {
            return $this->users()->save($users);
        }

        $this->users()->saveMany($users);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    protected function guardAgainstTooManyMembers(int $newMembers =1)
    {
        $current = $this->users()->count();

        if (($current + $newMembers) > $this->size) {
            throw new Exception();
        }
    }
}
