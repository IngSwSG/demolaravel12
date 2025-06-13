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
    
    public function add($users)
    {
        
        if ($users instanceof User) {
            $users = collect([$users]);
        } elseif (!($users instanceof \Illuminate\Support\Collection)) {
            $users = collect($users);
        }

        foreach ($users as $user) {
            
            if (is_numeric($user)) {
                $user = User::findOrFail($user);
            }
           
            if ($this->users()->where('id', $user->id)->exists()) {
                continue;
            }
            
            if ($this->users()->count() >= $this->size) {
                throw new Exception();
            }
            $this->users()->save($user);
        }
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}