<?php
use App\Models\Team;
use App\Models\User;



it('no excede limite', function () {
    $team = Team::factory()->create(['size' => 2]);
    $users = User::factory(3)->create();

    expect(fn() => $team->add($users))
        ->toThrow(Exception::class, 'No puedes agregar más usuarios de los permitidos');
});