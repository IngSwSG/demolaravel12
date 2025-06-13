<?php

use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('no permite agregar más usuarios que el tamaño máximo del equipo', function () {
    $team = Team::factory()->create(['size' => 3]);

    
    $users = User::factory()->count(2)->make();
    $team->add($users);

    $newUsers = User::factory()->count(2)->make();

    
    $this->expectException(Exception::class);

    $team->add($newUsers);
});
