<?php
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('the create task form loads successfully and contains users', function () {
    $users = User::factory()->count(3)->create();

    $response = $this->get(route('tasks.create'));

    $response->assertStatus(200);
    $response->assertViewIs('tasks.create');
    $response->assertViewHas('users', function ($viewUsers) use ($users) {
        return $viewUsers->count() === 3;
    });
});

