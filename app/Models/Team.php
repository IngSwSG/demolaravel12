<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Team extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function add($users)
    {
        $count = ($users instanceof User) ? 1 : count($users);
        $this->guardAgainstTooManyMembers($count);

        return ($users instanceof User)
            ? $this->users()->save($users)
            : $this->users()->saveMany($users);
    }

    protected function guardAgainstTooManyMembers($newUsersCount = 1)
    {
        if ($this->users()->count() + $newUsersCount > $this->size) {
            throw new Exception('Team size limit exceeded.');
        }
    }


    
    // public function add($users)
    // {

    //     $this->guardAgainstTooManyMembers();// se ejecuta una sola vez

    //     if ($users instanceof User) {
    //         return $this->users()->save($users);
    //     }

    //     $this->users()->saveMany($users);
    // }

    // public function users()
    // {
    //     return $this->hasMany(User::class);
    // }

    // protected function guardAgainstTooManyMembers()// error aqui 
    // {
    //     if ($this->users()->count() >= $this->size) {
    //         throw new Exception();
    //     }
    // }
 

}
