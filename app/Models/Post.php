<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasFactory;

    // Permitir asignación masiva en todos los campos
    protected $guarded = [];

    /* Relaciones */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    /* Acciones */

    /**
     * Registra un like del usuario (o del autenticado) y evitar duplicados.
     */
    public function like(?User $user = null)
    {
        $user = $user ?: Auth::user();

        if (! $user) {
            throw new \LogicException('No hay usuario autenticado para dar like.');
        }

        return $this->likes()->firstOrCreate([
            'user_id' => $user->id,
        ]);
    }
}
