<?php

use App\Models\Team;
use App\Models\User;

it('un equipo puede agrear usuarios', function(){
    $team = Team::factory()->create();
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();

    $team->add($user1);
    $team->add($user2);

    expect($team->users)->count()->toBe(2);
});

it('un equipo puede tener un tamaño maximo', function(){
    $team = Team::factory()->create(['size' => 2]);
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();
    
    $team->add($user1);
    $team->add($user2);

    expect($team->users)->count()->toBe(2);
      ////Error
    $this->expectException(Exception::class);
    $user3 = User::factory()->create();
    $team->add($user3);


});

it('un equipo puede agregar multiples usuarios a la vez', function(){
    $team = Team::factory()->create(['size' => 3]);
    $users = User::factory(3)->create();

    $team->add($users);

    expect($team->users)->count()->toBe(3);
});


it('lanza una excepción si se intenta agregar más usuarios de los permitidos de una sola vez', function () {
    $team = \App\Models\Team::factory()->create(['size' => 2]);
    $user1 = \App\Models\User::factory()->create();
    $team->add($user1); // Ahora el equipo tiene 1 usuario

    // Intentamos agregar 2 usuarios más, lo que excede el límite
    $users = \App\Models\User::factory(2)->create();

    expect(fn() => $team->add($users))->toThrow(Exception::class);
});