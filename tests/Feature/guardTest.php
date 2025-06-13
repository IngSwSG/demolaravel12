<?php

use App\Models\Team;
use App\Models\User;
it('lanza una excepción si se agregan múltiples usuarios que exceden el tamaño del equipo', function () {
    $team = Team::factory()->create(['size' => 2]);

    $user1 = User::factory()->create();
    $user2 = User::factory()->create();
    $user3 = User::factory()->create();

    // Esta línea debería lanzar una excepción, porque se están intentando agregar 3 usuarios a un equipo de tamaño 2
    $this->expectException(Exception::class);
    
    $team->add([$user1, $user2, $user3]);
});

