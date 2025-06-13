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
    // Convierte cualquier input a un array plano de modelos Eloquent
    $usersArray = [];

    if ($users instanceof \Illuminate\Database\Eloquent\Collection) {
        $usersArray = $users->all();
    } elseif (is_array($users)) {
        foreach ($users as $user) {
            if ($user instanceof \Illuminate\Database\Eloquent\Collection) {
                $usersArray = array_merge($usersArray, $user->all());
            } else {
                $usersArray[] = $user;
            }
        }
    } else {
        $usersArray[] = $users;
    }

    // Verifica el límite
    if ($this->users()->count() + count($usersArray) > $this->size) {
        throw new \Exception('No puedes agregar más usuarios de los permitidos');
    }

    // Si es solo uno, usa save; si son varios, usa saveMany
    if (count($usersArray) === 1) {
        return $this->users()->save($usersArray[0]);
    }

    return $this->users()->saveMany($usersArray);
}

    public function users()
    {
        return $this->hasMany(User::class);
    }
}