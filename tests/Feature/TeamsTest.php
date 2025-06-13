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

it('no puede agregar múltiples usuarios si excede el límite', function(){
    $team = Team::factory()->create(['size' => 2]);
    $users = User::factory(3)->create(); // 3 usuarios para team size 2
    
    expect(fn() => $team->add($users))->toThrow(Exception::class);
    
    // CRÍTICO: Verificar que NINGÚN usuario fue agregado
    expect($team->fresh()->users)->count()->toBe(0);
});