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
        if ($users instanceof User) {
            if ($this->users()->count() >= $this->size) {
                throw new Exception();
            }
            return $this->users()->save($users);
        }

        if ($this->users()->count() + count($users) > $this->size) {
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
