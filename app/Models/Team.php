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
    $countToAdd = ($users instanceof User) ? 1 : count($users);
    $this->guardAgainstTooManyMembers($countToAdd);

    if ($users instanceof User) {
        return $this->users()->save($users);
    }

    $this->users()->saveMany($users);
}


    public function users()
    {
        return $this->hasMany(User::class);
    }

   protected function guardAgainstTooManyMembers($countToAdd = 1)
{
    $currentCount = $this->users()->count();
    if ($currentCount + $countToAdd > $this->size) {
        throw new Exception();
    }
}

}
